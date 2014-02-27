<?php
/**
 * 
 * User: Windows
 * Date: 2/21/14
 * Time: 6:12 PM
 * 
 */

namespace UserProfileEditor\Form;


use Application\Service\UserFolderServiceInterface;
use UserAuc\Service\AuthenticationService;
use UserAuc\Service\Interfaces\AuthenticationServiceInterface;
use UserProfileEditor\Form\Filter\ImageFilter;
use UserProfileEditor\Service\UserDirServiceInterface;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ProfileFormModel implements InputFilterAwareInterface {

    protected $inputFilter;
    protected $fileInputFilter;
    protected $user_dir_service;
    protected $user_id;
    protected $profile_pic;
    protected $dir_service;
    protected $user_auc;
    protected $pic_name = "av.jpg";

    public function setInputFilter(InputFilterInterface $inputFilter)
    {

        throw new \Exception("Not used");
    }


    public function getInputFilter()
    {
        if(!$this->inputFilter){
            //   var_dump( $this->getEmailValidator());
            $inputFilter = new InputFilter();
            $fileInput = new FileInput('profile_picture');
            $fileInput->breakOnFailure();
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
            /*
            $fileInput->getFilterChain()
                      ->attachByName(
                        'filerenameupload',
                        array(
                            'target' => $this->targetPath(),
                            'randomize' => true,
                            'overwrite' =>true
                        )
                    );
            */
            $inputFilter->add($fileInput);

          //  $fileInput->getFilterChain()->attachByName();

            $inputFilter->add(array(
                    'name' => 'first_name',
                    'required' => true,
                    'filters' => array(
                      array(
                          'name' =>'StripTags'
                      )
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'break_chain_on_failure' => true,
                            'options' => array(
                                'max' => 20,
                                'messages' => array(
                                    \Zend\Validator\StringLength::TOO_LONG => 'Your first name exceeds maximal length.',
                                ),
                            ),

                        ),
                      //  $this->getUsernameValidator(),
                    )
                )
            );
            $inputFilter->add(array(
                    'name' => 'last_name',
                    'required' => true,
                    'filters' => array(
                        array(
                            'name' =>'StripTags'
                        )
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'break_chain_on_failure' => true,
                            'options' => array(
                                'max' => 20,
                                'messages' => array(
                                    \Zend\Validator\StringLength::TOO_LONG => 'Your last name exceeds maximal length.',
                                ),
                            ),

                        ),
                        //  $this->getUsernameValidator(),
                    )
                )
            );

            $this->inputFilter = $inputFilter;
        }
     //   var_dump($this->inputFilter);
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