<?php
/**
 * 
 * User: Windows
 * Date: 2/18/14
 * Time: 9:08 PM
 * 
 */

namespace UserTimeline\ViewHelpers;

use UserTimeline\Form\ShareMoodForm;
use Zend\View\Helper\AbstractHelper;

class ShareMoodHelper  extends  AbstractHelper{



   public  function __invoke()
   {

      return $this;
   }

    public function get(){
        return new ShareMoodForm();
    }
}