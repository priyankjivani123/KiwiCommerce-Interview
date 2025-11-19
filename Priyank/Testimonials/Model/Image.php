<?php
namespace Priyank\Testimonials\Model;

use Magento\Framework\UrlInterface;
use Magento\Framework\Filesystem;

class Image
{
    /**
     * Media directory sub-folder for storing images.
     *
     * @var string
     */
    protected $subDir = 'wysiwyg/helloworld/';
    
    /**
     * URL builder instance for generating media URLs.
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * Filesystem component for interacting with directories.
     *
     * @var \Magento\Framework\Filesystem
     */
    protected $fileSystem;
    
    /**
     * Constructor.
     *
     * @param UrlInterface $urlBuilder
     * @param Filesystem $fileSystem
     */
    public function __construct(
        UrlInterface $urlBuilder,
        Filesystem $fileSystem
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->fileSystem = $fileSystem;
    }

    /**
     * Get the base URL for uploaded images.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]) . $this->subDir;
    }
}
