<?php
/**
 * 
 * User: Windows
 * Date: 2/27/14
 * Time: 3:31 PM
 * 
 */

namespace UserProfileEditor\Form\Filter;


use UserProfileEditor\Form\Filter\Model\ImageFormatter;
use Zend\Filter\AbstractFilter;
use Zend\Filter\Exception;
use Zend\Filter\File\RenameUpload;

class ImageFilter extends RenameUpload {


    protected $imageFormatter;

    protected $options = array(
        'target'               => null,
        'dir_path' => null,
        'use_upload_name'      => false,
        'use_upload_extension' => false,
        'overwrite'            => false,
        'randomize'            => false,
    );

    /**
     * Returns the result of filtering $value
     *
     * @param  mixed $value
     * @throws Exception\RuntimeException If filtering $value is impossible
     * @return mixed
     */
    public function filter($value)
    {

        // An uploaded file? Retrieve the 'tmp_name'


        $isFileUpload = (is_array($value) && isset($value['tmp_name']));
        if ($isFileUpload) {
            $uploadData = $value;
            $sourceFile = $value['tmp_name'];

        } else {
            $uploadData = array(
                'tmp_name' => $value,
                'name'     => $value,
            );
            $sourceFile = $value;
        }

        if (isset($this->alreadyFiltered[$sourceFile])) {
            return $this->alreadyFiltered[$sourceFile];
        }

        $targetFile = $this->getFinalTarget($uploadData);

        if (!file_exists($sourceFile) || $sourceFile == $targetFile) {
            return $value;
        }

        $this->checkFileExists($targetFile);


        array_map('unlink', glob($this->options['dir_path'] . "/*") ? : []);



        $this->moveUploadedFile($sourceFile, $targetFile);

        $return = $targetFile;

        if ($isFileUpload) {
            $return = $uploadData;
            $return['tmp_name'] = $targetFile;
        }

        $formatter = new ImageFormatter($return['tmp_name']);
        $formatter->formatImage();
        $this->alreadyFiltered[$sourceFile] = $return;
        return $return;

    }



} 