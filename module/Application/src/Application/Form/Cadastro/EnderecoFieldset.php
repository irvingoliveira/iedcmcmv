<?php

namespace Application\Form\Cadastro;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class EnderecoFieldset extends Fieldset implements InputFilterProviderInterface{
    
    public function __construct(ObjectManager $objectManager) {
        parent::__construct('EnderecoFieldset');
        
        $this->setHydrator(new DoctrineHydrator($objectManager, 
                                                'Application\Entity\Endereco'));

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'tipoLogradouro',
            'options' => array(
                'label' =>  'Tipo de logradouro:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha um tipo de logradouro ---',
                'target_class'   => 'Application\Entity\TipoLogradouro',
                'property'       => 'nome',
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
        
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'distrito',
            'options' => array(
                'label' =>  'Distrito:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha um distrito ---',
                'target_class'   => 'Application\Entity\Distrito',
                'property'       => 'nome',
                'is_method'      => true,
                'find_method'    => array(
                    'name'   => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy'  => array('codigoDistrito' => 'ASC'),
                    ),
                ),

            ),
            'attributes'    =>  array(
                'id'    =>  'distrito',
            ),
        ));
        
        
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