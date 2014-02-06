<?php
/**
 * 
 * User: Windows
 * Date: 1/9/14
 * Time: 5:29 PM
 * 
 */

namespace Application\Domain\DbLayerConcrete;


use Application\Domain\DbLayerInterfaces\RepositoryInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class RepositoryAccessor implements ServiceLocatorAwareInterface {



    protected $repositories =
    array(
      'users' => 'Application\Domain\DbLayerConcrete\UserRepository',
      'user_profile' => 'Application\Domain\DbLayerConcrete\UserProfileRepository'
    );

    protected $serviceLocator;

    /**
     * Get a repository Object.
     *
     * @param string $repository
     * @return  RepositoryInterface
     */
    public function get($repository)
    {
        $repo = $this->repositories[$repository];
        return new $repo($this->getServiceLocator());
    }

    /**
     * Checks a repository by specified key
     *
     * @param $repository
     * @return bool
     */

    public function has($repository){

        return array_key_exists($repository,$this->repositories);
    }


    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
       $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
       return $this->serviceLocator;
    }


}