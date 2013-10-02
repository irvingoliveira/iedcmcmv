<?php

namespace Application\Form\Cadastro;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class DependenteFieldset extends Fieldset implements InputFilterProviderInterface{
    
    public function __construct(ObjectManager $objectManager) {
        parent::__construct("DependendeFieldset");
        
        $this->setHydrator(new DoctrineHydrator($objectManager, 
                                                'Application\Entity\Dependente'));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'nome',
                'options'   =>  array(
                    'label' =>  'Nome:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'nome',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'cpf',
                'options'   =>  array(
                    'label' =>  'Cpf:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'cpf',
                )
        ));
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'grauDeParentesco',
            'options' => array(
                'label' =>  'Grau de parentesco:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha um grau de parentesco ---',
                'target_class'   => 'Application\Entity\TipoGrauDeParentesco',
                'property'       => 'descricao',
                'is_method'      => true,
                'find_method'    => array(
                    'name'   => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy'  => array('descricao' => 'ASC'),
                    ),
                ),

            ),
            'attributes'    =>  array(
                'id'    =>  'grauDeParentesco',
            ),
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Date',
                'name'  =>  'dataNascimento',
                'options'   =>  array(
                    'label' =>  'Data de nascimento:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'dataNascimento',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Radio',
                'name'  =>  'deficienteFisico',
                'options'   =>  array(
                    'label' =>  'Possui algum tipo de deficiência?',
                    'value_options' => array(
                        '0' => 'Não',
                        '1' => 'Sim'
                    )
                ),
                'attributes'    =>  array(
                    'id'    =>  'deficienteFisico',
                )
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