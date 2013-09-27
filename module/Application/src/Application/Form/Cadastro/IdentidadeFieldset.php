<?php

namespace Application\Form\Cadastro;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Application\Entity\Identidade;
use Zend\Stdlib\Hydrator\ClassMethods;

class IdentidadeFieldset extends Fieldset implements InputFilterProviderInterface{

    public function __construct() {
        parent::__construct('Identidade');
        $this->setObject(new Identidade())
             ->setHydrator(new ClassMethods());
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'numero',
                'options'   =>  array(
                    'label' =>  'Número:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'numero',
                )
        ));
        
        $this->add(array(
        'type'  =>  'Zend\Form\Element\Date',
                'name'  =>  'dataEmissao',
                'options'   =>  array(
                    'label' =>  'Data de Emissão:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'dataemissao',
                )
        ));
        
        $this->add(array(
        'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'orgaoEmissor',
                'options'   =>  array(
                    'label' =>  'Orgão Emissor:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'orgaoEmissor',
                )
        ));
        
    }

    public function getInputFilterSpecification() {
        return array();
    }
}