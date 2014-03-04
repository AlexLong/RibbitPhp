<?php
/**
 * 
 * User: Windows
 * Date: 3/2/14
 * Time: 5:11 PM
 * 
 */

namespace Application\Entity;


abstract class AbstractEntity {


    public function __construct(array $newData = null){
        if(is_array($newData)){
            $this->ExchangeArray($newData);
        }
    }

    public function ExchangeArray(array $data){
       $entity_fields = get_object_vars($this);
     //   var_dump($entity_fields);
       foreach($data  as $key => $val){
           if(array_key_exists($key,$entity_fields)){
              $this->{$key} = $val;
           }
       }
        return $this;

    }
    public function  getFields(){
        return get_object_vars($this);
    }


} 