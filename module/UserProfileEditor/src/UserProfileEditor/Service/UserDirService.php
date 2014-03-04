<?php
/**
 * 
 * User: Windows
 * Date: 2/24/14
 * Time: 11:08 AM
 * 
 */

namespace UserProfileEditor\Service;


class UserDirService implements UserDirServiceInterface{

    protected $public_directory;

    protected $user_id;

    protected $profile_image_folder;

    protected $directory_permission;

    public function __construct($options = array()){
        $this->setPublicDirectory($options['directories']['public_directory']);
        $this->setProfileImageFolder($options['directories']['profile_image_folder']);
        $this->setDirectoryPermission($options['directory_permission']);
    }


    public function createProfileDir($user_id){
        $path = $this->profileDirPath($user_id);
        if(is_dir($path)) return true;
        if(!mkdir($path,$this->getDirectoryPermission())){
            throw new \Exception('Unable to create a directory by path: '. $path);
        }
        $this->createProfileImageDir($user_id);
        return true;
    }

    public function createProfileImageDir($user_id){
            $path = $this->profilePicPath($user_id);
            if(is_dir($path)) return true;
            if(!mkdir($path,$this->getDirectoryPermission())){
                throw new \Exception('Unable to create a directory by path: '. $path);
            }
        return true;
    }
    public function profileDirPath($user_id){
       $path = join(DIRECTORY_SEPARATOR,array($this->getPublicDirectory(),$user_id));
        return rtrim($path,DIRECTORY_SEPARATOR);
    }

    public function profilePicPath($user_id){
        $path = join(DIRECTORY_SEPARATOR,array($this->profileDirPath($user_id),$this->getProfileImageFolder()));
        return rtrim($path,DIRECTORY_SEPARATOR);
    }


    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $public_directory
     */
    public function setPublicDirectory($public_directory)
    {
        if(!is_dir($public_directory)){
            throw new \Exception("The directory " . $public_directory . " doesn't exist");
        }elseif(!is_writeable($public_directory)){
            throw new \Exception("The directory " . $public_directory . " is not write able");
        }
        if (!is_dir($public_directory)) {
            throw new  \Exception(
                "Cache directory '{$public_directory}' not found or not a directory"
            );
        } elseif (!is_writable($public_directory)) {
            throw new \Exception(
                "Cache directory '{$public_directory}' not writable"
            );
        } elseif (!is_readable($public_directory)) {
            throw new \Exception(
                "Cache directory '{$public_directory}' not readable"
            );
        }
        $public_directory = rtrim(realpath($public_directory), DIRECTORY_SEPARATOR);
        $this->public_directory = $public_directory;

        return $this;
      //  $this->public_directory = $public_directory;
    }

    /**
     * @return mixed
     */
    public function getPublicDirectory()
    {

        return $this->public_directory;
    }
    /**
     * @param mixed $profile_image_folder
     */
    public function setProfileImageFolder($profile_image_folder)
    {
        $this->profile_image_folder = $profile_image_folder;
    }

    /**
     * @return mixed
     */
    public function getProfileImageFolder()
    {
        return $this->profile_image_folder;
    }

    /**
     * @param mixed $directory_permission
     */
    public function setDirectoryPermission($directory_permission)
    {
        $this->directory_permission = $directory_permission;
    }
    /**
     * @return mixed
     */
    public function getDirectoryPermission()
    {
        return $this->directory_permission;
    }

} 