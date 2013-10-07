<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface,
                        FormElementProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getFormElementConfig() {
        return array(
            'factories' =>  array(
                'TitularFieldset' => function ($sm){
                    $objectManager = $sm->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                    $fieldset = new \Application\Form\Cadastro\TitularFieldset($objectManager);
                    return $fieldset;
                },
                'IdentidadeTitularFieldset' => function ($sm){
                    $objectManager = $sm->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                    $fieldset = new \Application\Form\Cadastro\IdentidadeTitularFieldset($objectManager);
                    return $fieldset;
                },
                'ConjugeFieldset' => function ($sm){
                    $objectManager = $sm->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                    $fieldset = new \Application\Form\Cadastro\ConjugeFieldset($objectManager);
                    return $fieldset;
                },
                'IdentidadeConjugeFieldset' => function ($sm){
                    $objectManager = $sm->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                    $fieldset = new \Application\Form\Cadastro\IdentidadeConjugeFieldset($objectManager);
                    return $fieldset;
                },
                'EnderecoFieldset' => function ($sm){
                    $objectManager = $sm->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                    $fieldset = new \Application\Form\Cadastro\EnderecoFieldset($objectManager);
                    return $fieldset;
                },
                'DependenteFieldset' => function ($sm){
                    $objectManager = $sm->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                    $fieldset = new \Application\Form\Cadastro\DependenteFieldset($objectManager);
                    return $fieldset;
                },
            )
        );
    }

    public function getServiceConfig(){
        return array(
            'factories' =>  array(
                'ObjectManager' => function($sm) {
                    $objectManager = $sm->get('Doctrine\ORM\EntityManager');
                    return $objectManager;
                },
                'cadastro-form' => function(){
                    $form = new \Application\Form\Cadastro\TitularForm();
                    return $form;
                },
            )
        );
    }
}
