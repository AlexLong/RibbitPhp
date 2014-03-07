<?php
/**
 * 
 * User: Windows
 * Date: 2/24/14
 * Time: 9:35 PM
 * 
 */

namespace Application\ViewHelpers;


use Zend\Form\View\Helper\FormElementErrors;

class UserFormErrors  extends FormElementErrors {


    /**@+
     * @var string Templates for the open/close/separators for message tags
     */
    protected $messageCloseString     = ''; //</div>
    protected $messageOpenFormat      = '%s'; // <div%s>
    protected $messageSeparatorString = '';
    /**@-*/

    protected $attributes = array(
      //  'class' => 'alert alert-danger'
    );

} 