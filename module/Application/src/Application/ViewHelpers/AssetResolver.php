<?php
/**
 * 
 * User: Windows
 * Date: 2/19/14
 * Time: 5:25 PM
 * 
 */

namespace Application\ViewHelpers;


use Zend\View\Helper\AbstractHelper;

class AssetResolver extends  AbstractHelper {

    protected $assetDirectory;

    public function __invoke(){

        return $this->getAssetDirectory();
    }
    /**
     * @param mixed $assetDirectory
     */
    public function setAssetDirectory($assetDirectory)
    {
        $this->assetDirectory = $assetDirectory;
    }

    /**
     * @return mixed
     */
    public function getAssetDirectory()
    {
        return $this->assetDirectory;
    }



} 