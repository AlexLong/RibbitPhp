<?php
/**
 * 
 * User: Windows
 * Date: 1/15/14
 * Time: 8:35 PM
 * 
 */

namespace Application\Controller\Plugin;


use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Mvc\Controller\Plugin\Redirect;
use Zend\Mvc\MvcEvent;

class UserPlugin extends AbstractPlugin  {


    protected  $redirect;



    public  function RedirectToAuth(MvcEvent $event, array $authPath = null)
    {
        if($authPath == null)
            $authPath = array('route' => "index/index_child", 'action' => 'login');

        $action = $event->getRouteMatch()->getParam('action');
        $routeName = $event->getRouteMatch()->getMatchedRouteName();
        return $this->getRedirect()->toRoute($authPath['route'],
            array('action' => $authPath['action']), array('query' =>
                array( 'rt' => $routeName.'/'.$action  )));
    }



    public function setRedirect(Redirect $redirect)
    {
        if(null == $this->redirect )
            $this->redirect = $redirect;

       $this->redirect = $redirect;
    }


    protected function getRedirect()
    {

        return $this->redirect;
    }




} 