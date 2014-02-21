<?php
/**
 * 
 * User: Windows
 * Date: 1/11/14
 * Time: 8:22 PM
 * 
 */

namespace UserAuc\Form;


class FormFactory {


   public static $forms = array(
       'login' => 'UserAuc\Form\LoginForm',
       'sign' => 'UserAuc\Form\SignForm'

    );

    public  static function CreateForm($form, $name = "")
    {
        $content = self::$forms[$form];

        return new $content();
    }



} 