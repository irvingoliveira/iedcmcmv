<?php

namespace Application\Form\Cadastro;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Application\Entity\Endereco;
use Zend\Stdlib\Hydrator\ClassMethods;

class EnderecoFieldset extends Fieldset implements InputFilterProviderInterface{
    
    public function __construct() {
        parent::__construct('Endereco');
        
        $this->setObject(new Endereco())
             ->setHydrator(new ClassMethods());
        /*
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'naturalidade',
            'options' => array(
                'label' =>  'Naturalidade:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha uma cidade ---',
                'target_class'   => 'Application\Entity\TipoLogradouro',
                'property'       => 'tipoLogradouro',
                'is_method'      => true,
                'find_method'    => array(
                    'name'   => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy'  => array('nome' => 'ASC'),
                    ),
                ),

            ),
            'attributes'    =>  array(
                'id'    =>  'tipoLogradouro',
            ),
        ));
        */
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'nomeLogradouro',
                'options'   =>  array(
                    'label' =>  'Nome do logradouro:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'nomeLogradouro',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'numero',
                'options'   =>  array(
                    'label' =>  'Numero:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'numero',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'complemento',
                'options'   =>  array(
                    'label' =>  'Complemento:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'complemento',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'bairro',
                'options'   =>  array(
                    'label' =>  'Bairro:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'bairro',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'comunidade',
                'options'   =>  array(
                    'label' =>  'Comunidade:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'comunidade',
                )
        ));
        
        /*
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'distrito',
            'options' => array(
                'label' =>  'Distrito:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha uma cidade ---',
                'target_class'   => 'Application\Entity\Distrito',
                'property'       => 'distrito',
                'is_method'      => true,
                'find_method'    => array(
                    'name'   => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy'  => array('nome' => 'ASC'),
                    ),
                ),

            ),
            'attributes'    =>  array(
                'id'    =>  'distrito',
            ),
        ));
        */
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'cep',
                'options'   =>  array(
                    'label' =>  'CEP:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'cep',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Radio',
                'name'  =>  'areaDeRisco',
                'options'   =>  array(
                    'label' =>  'É área de risco?',
                    'value_options' => array(
                        '0' => 'Não',
                        '1' => 'Sim'
                    )
                ),
                'attributes'    =>  array(
                    'id'    =>  'areaDeRisco',
                )
        ));
        
    }
    
    public function getInputFilterSpecification() {
        return array();
    }
}