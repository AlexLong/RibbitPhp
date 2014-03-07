<?php
/**
 * 
 * User: Windows
 * Date: 3/3/14
 * Time: 7:39 PM
 * 
 */

namespace UserProfileEditor\Form;


use UserAuc\Service\Interfaces\AuthenticationServiceInterface;
use UserProfileEditor\Form\Filter\ImageFilter;
use UserProfileEditor\Service\UserDirServiceInterface;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class PictureModel implements  InputFilterAwareInterface {

    protected $inputFilter;

    protected $dir_service;

    protected $user_auc;

    protected $pic_name = "av.jpg";

    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {

        if(!$this->inputFilter){
            $inputFilter = new InputFilter();
            $fileInput = new FileInput('profile_picture');

            $fileInput->setAllowEmpty(true);
            $fileInput->getValidatorChain()
                ->attachByName("filesize",array('max' => '5MB' ))
                ->attachByName('filemimetype',  array('mimeType' =>
                    'image/png,image/x-png,image/gif,
                    image/jpeg'))
                ->attachByName('fileimagesize', array('maxWidth' => 5000,
                    'maxHeight' => 5000));

            $fileInput->getFilterChain()->attach(new ImageFilter(array(
                'dir_path' => $this->dirPath(),
                'target' => $this->target(),
                'randomize' => true,
                'overwrite' =>true
            )),1);

           $fileInput->setBreakOnFailure(true);
            $inputFilter->add($fileInput);

            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

    public function target(){
        $path = join(DIRECTORY_SEPARATOR,array(
            $this->getDirService()->profilePicPath($this->getUserId()),
            $this->pic_name
        ));
        return $path;
    }
    public function dirPath(){
        $path = $this->getDirService()->profilePicPath($this->getUserId());
        return $path;
    }

    /**
     * @param mixed $dir_service
     */
    public function setDirService(UserDirServiceInterface $dir_service)
    {
        $this->dir_service = $dir_service;
    }

    /**
     * @return mixed
     */
    public function getDirService()
    {
        return $this->dir_service;
    }

    /**
     * @param mixed $user_auc
     */
    public function setUserAuc(AuthenticationServiceInterface $user_auc)
    {
        $this->user_auc = $user_auc;
    }

    /**
     * @return mixed
     */
    public function getUserAuc()
    {
        return $this->user_auc;
    }

    public function getUserId(){

        return $this->getUserAuc()->getUserIdentify('id');
    }



} 