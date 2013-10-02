<?php

namespace Application\Form\Cadastro;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class TitularFieldset extends Fieldset implements InputFilterProviderInterface{
    
    public function __construct(ObjectManager $objectManager) {
        parent::__construct('TitularFieldset');
        
        $this->setHydrator(new DoctrineHydrator($objectManager, 
                                                'Application\Entity\Titular'));
               
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
                'type'  =>  'Zend\Form\Element\Date',
                'name'  =>  'dataInscricaso',
                'options'   =>  array(
                    'label' =>  'Data de inscrição:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'dataNascimento',
                    'value' => date("d/m/Y"),
                    'disabled' => 'disabled',
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
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'naturalidade',
            'options' => array(
                'label' =>  'Naturalidade:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha uma cidade ---',
                'target_class'   => 'Application\Entity\Cidade',
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
                'id'    =>  'naturalidade',
            ),
        ));
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'tipoSexo',
            'options' => array(
                'label' =>  'Sexo:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha um sexo ---',
                'target_class'   => 'Application\Entity\TipoSexo',
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
                'id'    =>  'sexo',
            ),
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