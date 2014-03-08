<?php
/**
 * 
 * User: Windows
 * Date: 2/28/14
 * Time: 5:33 PM
 * 
 */

namespace UserProfileEditor\Entity;


use Application\Entity\AbstractEntity;

class EditProfile extends  AbstractEntity {

   public  $first_name;
   public  $last_name;

    public function __construct(array $data = null){
        if($data){
            $this->ExchangeArray($data);
        }
    }


    public function toUpdate($sessionData = array()){

        $current = $this->getFields();
        foreach($current as $key => $val){
            if($current[$key] == $sessionData[$key]){
                unset($current[$key]);
            }
        }
       return $current;
    }


    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

} 