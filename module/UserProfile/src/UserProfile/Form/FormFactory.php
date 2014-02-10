<?php
/**
 * 
 * User: Windows
 * Date: 1/11/14
 * Time: 8:22 PM
 * 
 */

namespace UserProfile\Form;


class FormFactory {


   public static $forms = array(
       'login' => 'UserProfile\Form\LoginForm',
       'sign' => 'UserProfile\Form\SignForm'

    );

    public  static function CreateForm($form, $name = "")
    {
        $content = self::$forms[$form];

        return new $content();
    }



} 