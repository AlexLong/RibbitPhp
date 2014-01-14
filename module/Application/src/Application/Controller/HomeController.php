<?php
/**
 * 
 * User: Windows
 * Date: 1/13/14
 * Time: 7:17 PM
 * 
 */

namespace Application\Controller;


use Zend\View\Model\ViewModel;

class HomeController extends  AbstractBaseController {


    public  function indexAction()
    {

        return new ViewModel();
    }



} 