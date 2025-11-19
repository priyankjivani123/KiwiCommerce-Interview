<?php
namespace Priyank\Testimonials\Controller\Adminhtml\Testimonials;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\App\Filesystem\DirectoryList;

class ExportCsv extends Action
{
    /**
     * File factory instance
     *
     * @var FileFactory
     */
    protected $fileFactory;

    /**
     * CSV processor instance
     *
     * @var \Magento\Framework\File\Csv
     */
    protected $csvProcessor;

    /**
     * Constructor
     *
     * @param Context                     $context
     * @param FileFactory                 $fileFactory
     * @param \Magento\Framework\File\Csv $csvProcessor
     */
    public function __construct(
        Context $context,
        FileFactory $fileFactory,
        \Magento\Framework\File\Csv $csvProcessor
    ) {
        $this->fileFactory = $fileFactory;
        $this->csvProcessor = $csvProcessor;
        parent::__construct($context);
    }

    /**
     * Execute export CSV action
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $fileName = 'testimonials_' . date('Y-m-d_H-i-s') . '.csv';
        $filesystem = $this->_objectManager->get(\Magento\Framework\Filesystem::class);
        $varDir = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        $varDir->create('');
        $filePath = $varDir->getAbsolutePath($fileName);

        $this->csvProcessor->setDelimiter(',')->setEnclosure('"');

        $collection = $this->_objectManager->create(
            \Priyank\Testimonials\Model\ResourceModel\Testimonials\Collection::class
        );

        $header = ['company_name','name','message','post','profile_pic','status','created_at','updated_at'];

        $rows = array_map(function ($row) use ($header) {
            return array_values(array_intersect_key($row, array_flip($header)));
        }, $collection->getData());

        $data = array_merge([$header], $rows);

        $this->csvProcessor->saveData($filePath, $data);

        return $this->fileFactory->create(
            $fileName,
            [
                'type'  => 'filename',
                'value' => $fileName,
                'rm'    => true
            ],
            DirectoryList::VAR_DIR,
            'text/csv'
        );
    }

    /**
     * Check ACL permission
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Priyank_Testimonials::testimonial');
    }
}
