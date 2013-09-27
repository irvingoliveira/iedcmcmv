<?php

namespace Application\Form\Cadastro;

use Zend\Form\Form;
use Zend\ServiceManager\ServiceManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

class TitularForm extends Form{
    public function __construct(ServiceManager $sm) {
        parent::__construct('CadastroForm');
        
        $objectManager = $sm->get('Doctrine\ORM\EntityManager');
        
        $this->setHydrator(new DoctrineObject($objectManager,
                                              'Application\Entity\Titular'));
        $fieldset = new TitularFieldset($sm);
        $fieldset->setUseAsBaseFieldset(TRUE);
        
        $this->add($fieldset);
    }
}