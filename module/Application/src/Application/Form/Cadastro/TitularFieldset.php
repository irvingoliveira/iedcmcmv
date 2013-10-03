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
                    'id'    =>  'titularNome',
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
                    'id'    =>  'titularDataNascimento',
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
                    'id'    =>  'titularCpf',
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
                    'id'    =>  'titularDataNascimento',
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
                    'id'    =>  'titularNis',
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
                'id'    =>  'titularNaturalidade',
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
                'id'    =>  'titularSexo',
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
                    'id'    =>  'titularDeficienteFisico',
                )
        ));
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'renda',
                'options'   =>  array(
                    'label' =>  'Renda:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'titularRenda',
                )
            )
        );

    }

    public function getInputFilterSpecification() {
        return array(
            'nome' => array(
                'required' => 'true',
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 3,
                            'max' => 200,
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StripToUpper'),
                ),
            ),
            
            'dataInscricao' => array(
                'required' => 'true',
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 10,
                            'max' => 10,
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StripToUpper'),
                ),
            ),
            
            'cpf' => array(
                'required' => 'true',
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 14,
                            'max' => 14,
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StripToUpper'),
                ),
            ),
            
        );
    }
}