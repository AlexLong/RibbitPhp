<?php
/**
 * 
 * User: Windows
 * Date: 1/11/14
 * Time: 8:22 PM
 * 
 */

namespace Application\Form;


class FormFactory {


   public static $forms = array(
       'login' => 'Application\Form\LoginForm',
       'sign' => 'Application\Form\SignForm'

    );

    public  static function CreateForm($form, $name = "")
    {
        $content = self::$forms[$form];

        return new $content();
    }



} 