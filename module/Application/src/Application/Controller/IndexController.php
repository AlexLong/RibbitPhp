<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;


use Application\Domain\Entity\RibbitUser;

use Application\Form\LoginForm;
use Zend\Stdlib\Parameters;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractBaseController
{

   public function indexAction()
   {

        return new ViewModel();
   }

    public function loginAction()
    {
        $this->getUserPlugin()->signedUserRedirect();

        if($this->getRequest()->isPost()){

            $data = $this->getRequest()->getPost();

            if($this->getAuthService()->authenticate($data) == false)
            {


                $messages = $this->getAuthService()->getValidationMessages();


                $failed_form = new LoginForm(false);
                $failed_form->setData($data);

                return new ViewModel(array('validation_messages' => $messages,
                                            'failed_form' => $failed_form));
            }
            if($this->getUserPlugin()->hasReturnUri())
            {
                return $this->getUserPlugin()->redirectToReturnUri();
            }
            return  $this->getUserPlugin()->redirectToHome();
        }

        if($this->getRequest()->getQuery('rt') != null)
        {

            $this->getUserPlugin()->generateReturnUri($this->getRequest()->getQuery('rt'));

        }
       return new ViewModel();
    }

    public function signAction()
    {

    }

    public function logoutAction()
    {
        $this->layout()->terminate();

        $this->getAuthService()->logout();

        if($this->getRequest()->getQuery('rt') != null)
        {
            $rt = $this->getRequest()->getQuery('rt');

            if($this->getUserPlugin()->validateReturnUri($rt))
            {
              return  $this->redirect()->toUrl($rt);
            }
        }

      return $this->getUserPlugin()->redirectToIndex();

    }

}
