<?php
/**
 * 
 * User: Windows
 * Date: 3/3/14
 * Time: 12:03 PM
 * 
 */

namespace UserProfileEditor\Entity;


use Application\Entity\AbstractEntity;

class ProfilePicture  extends AbstractEntity{

    public $name = null;
    public $tmp_name =null;
    public $error = null;
    public $size = null;
    public $prefix = 'av_';

    /*
    public function __construct($picture = null){

    }
    */

    /**
     * @return string
     */

    public function getParsedName(){
        if(!$this->tmp_name) return null;
        $img_suffix = $this->prefix;
        $parsed  = preg_filter('/.*[^'.$img_suffix.'\w+\.]/','',$this->tmp_name);
        $result = array('profile_picture' => $parsed);
        return $result;
    }

    /**
     * @param null $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return null
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return null
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param null $tmp_name
     */
    public function setTmpName($tmp_name)
    {
        $this->tmp_name = $tmp_name;
    }

    /**
     * @return null
     */
    public function getTmpName()
    {
        return $this->tmp_name;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }




} 