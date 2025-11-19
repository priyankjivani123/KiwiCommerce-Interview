<?php
declare(strict_types=1);

namespace Priyank\Testimonials\Console\Command;

use Magento\Framework\App\State;
use Magento\Framework\Console\Cli;
use Magento\Framework\File\Csv;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem\Driver\File as FileDriver;
use Priyank\Testimonials\Model\TestimonialsFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportTestimonials extends Command
{
    /** @var string */
    public const FILE_PATH = 'file_path';

    /** @var Csv */
    private $csvProcessor;

    /** @var TestimonialsFactory */
    private $testimonialsFactory;

    /** @var State */
    private $appState;

    /** @var FileDriver */
    private $fileDriver;

    /**
     * Constructor
     *
     * @param Csv $csvProcessor
     * @param TestimonialsFactory $testimonialsFactory
     * @param State $appState
     * @param FileDriver $fileDriver
     */
    public function __construct(
        Csv $csvProcessor,
        TestimonialsFactory $testimonialsFactory,
        State $appState,
        FileDriver $fileDriver
    ) {
        $this->csvProcessor = $csvProcessor;
        $this->testimonialsFactory = $testimonialsFactory;
        $this->appState = $appState;
        $this->fileDriver = $fileDriver;
        parent::__construct();
    }

    /**
     * Configure console command
     */
    protected function configure(): void
    {
        $this->setName('testimonials:import')
            ->setDescription('Import Testimonials from CSV file')
            ->addArgument(
                self::FILE_PATH,
                InputArgument::REQUIRED,
                'CSV file full path'
            );
        parent::configure();
    }

    /**
     * Execute console command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->appState->setAreaCode('adminhtml'); // Ensure area code is set

            $filePath = $input->getArgument(self::FILE_PATH);

            if (!$this->fileDriver->isExists($filePath)) {
                throw new LocalizedException(__('File does not exist: %1', $filePath));
            }

            $rows = $this->csvProcessor->getData($filePath);

            if (count($rows) <= 1) {
                $output->writeln('<error>No data found in CSV</error>');
                return Cli::RETURN_FAILURE;
            }

            $header = array_map('strtolower', $rows[0]); // header row
            unset($rows[0]); // remove header

            foreach ($rows as $row) {
                $data = array_combine($header, $row);

                $testimonial = $this->testimonialsFactory->create();
                $testimonial->setCompanyName($data['company_name'] ?? '');
                $testimonial->setName($data['name'] ?? '');
                $testimonial->setMessage($data['message'] ?? '');
                $testimonial->setPost($data['post'] ?? '');
                $testimonial->setProfilePic($data['profile_pic'] ?? '');
                $testimonial->setStatus($data['status'] ?? 1);
                $testimonial->setCreatedAt(date('Y-m-d H:i:s'));
                $testimonial->setUpdatedAt(date('Y-m-d H:i:s'));

                $testimonial->save();
            }

            $output->writeln('<info>Testimonials imported successfully!</info>');
            return Cli::RETURN_SUCCESS;
        } catch (\Exception $e) {
            $output->writeln('<error>Error: ' . $e->getMessage() . '</error>');
            return Cli::RETURN_FAILURE;
        }
    }
}
