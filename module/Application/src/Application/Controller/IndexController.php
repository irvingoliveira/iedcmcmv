<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
//use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $objectManager;
    
    public function getObjectManager() {
        if(!$this->objectManager)
            $this->objectManager = $this->getServiceLocator()->get('ObjectManager');
        return $this->objectManager;
    }

    public function indexAction()
    {
        //$objectManager = $this->getObjectManager();
        
        //$form = $this->getServiceLocator()->get('cadastro-form');
        
        $formManager = $this->serviceLocator->get('FormElementManager');
        $form = $formManager->get('Application\Form\Cadastro\TitularForm');
        return array('form' =>  $form);
    }
}
