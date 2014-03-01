<?php
/**
 * 
 * User: Windows
 * Date: 2/27/14
 * Time: 5:13 PM
 * 
 */

namespace UserProfileEditor\Form\Filter\Model;


class ImageFormatter {


    protected $default_with = 240;

    protected $image_format = 'jpeg';

    protected $imagePath;


    public $image_tick;

    public function __construct($image_path){

        $this->image_tick = new \Imagick($image_path);
        $this->imagePath = $image_path;
        $this->image_tick->setformat($this->image_format);
        $this->image_tick->setcolorspace(\Imagick::COLORSPACE_SRGB);
      $this->image_tick->setcompression(\Imagick::COMPRESSION_JPEG2000);
    }

    public  function formatImage(){

        $size = $this->image_tick->getimagegeometry();


        $this->image_tick->cropthumbnailimage($this->default_with,$this->default_with);
        //$high = ($size['height'] / $size['width']) * $this->default_with;
            $height = $size['height'];
            $width =  $size['width'];
        /*
      $this->image_tick->resizeimage($this->default_with, $high,\Imagick::FILTER_LANCZOS, 1);
        $this->image_tick->thumbnailimage($this->default_with,$this->default_with,1,0);
      $this->image_tick->sh


        if($width > $height){
            $newHeight = $this->default_with;
            $newWidth = ($this->default_with / $height) * $width;
        }else{
            $newWidth = $this->default_with;
            $newHeight = ($this->default_with / $width) * $height;
        }
        $this->image_tick->resizeImage($newWidth,$newHeight, \Imagick::FILTER_LANCZOS, 1, true);
        $this->image_tick->cropImage ($this->default_with,$this->default_with,0,0);

        */
        $handler = fopen($this->imagePath,'w');
        if(!$handler){
            throw new \Exception("Unable to open file : ".$this->imagePath . "to write.");
        }
        $this->image_tick->writeimagefile($handler);
        fclose($handler);
        unset($handler);
        $this->image_tick->clear();
        $this->image_tick->destroy();
    }







} 