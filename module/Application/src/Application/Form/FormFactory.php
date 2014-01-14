<?php
/**
 * 
 * User: Windows
 * Date: 1/11/14
 * Time: 8:22 PM
 * 
 */

namespace UserAuth\Form;


class FormFactory {


   public static $forms = array(
       'login' => 'Application\Form\LoginForm'
    );

    public  static function CreateForm($form, $name = "")
    {

        $content = self::$forms[$form];

        return new $content;
    }



} 