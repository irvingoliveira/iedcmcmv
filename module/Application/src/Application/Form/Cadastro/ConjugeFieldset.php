<?php

namespace Application\Form\Cadastro;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Application\Entity\Conjuge;
use Zend\Stdlib\Hydrator\ClassMethods;

class ConjugeFieldset extends Fieldset implements InputFilterProviderInterface{
    public function __construct() {
        parent::__construct('Conjugue');
        
        $this->setObject(new Conjuge())
             ->setHydrator(new ClassMethods());
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'nome',
                'options'   =>  array(
                    'label' =>  'Nome:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'nome',
                )
            )
        );
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'cpf',
                'options'   =>  array(
                    'label' =>  'CPF:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'cpf',
                )
            )
        );
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Date',
                'name'  =>  'dataNascimento',
                'options'   =>  array(
                    'label' =>  'Data de nascimento:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'dataNascimento',
                )
            )
        );
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'nis',
                'options'   =>  array(
                    'label' =>  'NIS:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'nis',
                )
            )
        );
        /* 
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'naturalidade',
            'options' => array(
                'label' =>  'Naturalidade:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha uma cidade ---',
                'target_class'   => 'Application\Entity\Cidade',
                'property'       => 'naturalidade',
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
                'id'    =>  'naturalidade',
            ),
        ));
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'sexo',
            'options' => array(
                'label' =>  'Sexo:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha um sexo ---',
                'target_class'   => 'Application\Entity\TipoSexo',
                'property'       => 'sexo',
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
                'id'    =>  'sexo',
            ),
        ));
         */
        $this->add(array(
            'type' => 'Application\Form\Cadastro\IdentidadeFieldset',
            'name' => 'identidade',
            'options' => array(
                'label' => 'Identidade do conjugue'
            ),
            'attributes'    =>  array(
                'id'    =>  'identidade',
            ),
        ));
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'renda',
                'options'   =>  array(
                    'label' =>  'Renda:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'renda',
                )
            )
        );
    }
    
    public function getInputFilterSpecification() {
        return array();
    }
}