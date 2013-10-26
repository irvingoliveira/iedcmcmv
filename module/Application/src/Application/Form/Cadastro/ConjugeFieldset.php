<?php
/**
 * IEDCMCMV (http://mcmv.duquedecaxias.rj.gov.br)
 *
 * @link      https://github.com/irvingoliveira/iedcmcmv.git para o código-fonte
 * @copyright Copyright (c) 2013 Irving Fernando de Medeiros Oliveira, Guilherme Sousa dos Santos,
 * Eduardo Agusto Costa Bastos, Secretaria Municipal de Controle Interno, Ciência, Tecnologia e Sistemas de Duque de Caxias - RJ 
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public Licence Version 3
 * 
 * Este arquivo é parte do programa IEDCMCMV
 *
 * IEDCMCMV é um software livre; você pode redistribuí-lo e/ou 
 * modificá-lo dentro dos termos da Licença Pública Geral GNU como 
 * publicada pela Fundação do Software Livre (FSF); na versão 3 da 
 * Licença.
 *
 * Este programa é distribuído na esperança de que possa ser  útil, 
 * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer
 * MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
 * Licença Pública Geral GNU para maiores detalhes.
 * 
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU
 * junto com este programa, se não, escreva para a Fundação do Software
 * Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

namespace Application\Form\Cadastro;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ConjugeFieldset extends Fieldset implements InputFilterProviderInterface{
  
    private $objectManager;

    public function __construct(ObjectManager $objectManager) {
        parent::__construct('ConjugueFieldset');
        
        $this->setHydrator(new DoctrineHydrator($objectManager, 
                                                'Application\Entity\Conjuge'));
        
        $this->objectManager = $objectManager;
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'nome',
                'options'   =>  array(
                    'label' =>  'Nome:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'conjugeNome',
                    'size' => '50',
                    'maxlength' => '200',
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
                    'id'    =>  'conjugeCpf',
                    'size' => '14',
                    'maxlength' => '14',
                )
            )
        );
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'dataNascimento',
                'options'   =>  array(
                    'label' =>  'Data de nascimento:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'conjugeDataNascimento',
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
                    'id'    =>  'conjugeNis',
                    'size' => '12',
                    'maxlength' => '12',
                )
            )
        );
         
        $estados = $objectManager->getRepository('Application\Entity\Estado')
                                    ->findAll();
        
        foreach ($estados as $estado){
            foreach ($estado->getCidades() as $cidade){
                $cidades[$cidade->getCodigoCidade()] = $cidade->getNome();
            }
            
            $naturalidades[] = array(
                'label' => $estado->getNome(),
                'options' => $cidades
            );
            unset($cidades);
        }
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'naturalidade',
            'options' => array(
                'label' =>  'Naturalidade:',
                'object_manager' => $objectManager,
//                'empty_option'    => '--- Escolha uma cidade ---',
                'target_class'   => 'Application\Entity\Cidade',
                'property'       => 'nome',
                'value_options' => $naturalidades
//                'is_method'      => true,
//                'find_method'    => array(
//                    'name'   => 'findBy',
//                    'params' => array(
//                        'criteria' => array(),
//                        'orderBy'  => array('nome' => 'ASC'),
//                    ),
//                ),
            ),
            'attributes'    =>  array(
                'id'    =>  'conjugeNaturalidade',
                'size'  =>  8,
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
                'id'    =>  'conjugeSexo',
            ),
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Radio',
                'name'  =>  'acolhimentoInstitucional',
                'options'   =>  array(
                    'label' =>  'O conjuge se encontra em acolhimento institucional?',
                    'value_options' => array(
                        '0' => 'Não',
                        '1' => 'Sim'
                    )
                ),
                'attributes'    =>  array(
                    'class'    =>  'conjugeAcolhimentoInstitucional',
                    'value' => '0',
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
                    'id'    =>  'conjugeDeficienteFisico',
                    'value' => '0',
                )
        ));
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'renda',
                'options'   =>  array(
                    'label' =>  'Renda:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'conjugeRenda',
                    'size' => '10',
                    'maxlength' => '10',
                )
            )
        );
    }
    
    public function getInputFilterSpecification() {
        return array(
            'nome' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 3,
                            'max' => 200,
                            'messages' => array(
                                'stringLengthTooShort' => 'O nome deve ter entre 3 e 200 caracteres!', 
                                'stringLengthTooLong' => 'O nome deve ter entre 3 e 200 caracteres!' 
                            ),
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StringToUpper'),
                ),
            ),
            
            'cpf' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 14,
                            'max' => 14,
                                'messages' => array(
                                'stringLengthTooShort' => 'O campo "cpf" deve ter exatamente 14 caracteres!', 
                                'stringLengthTooLong' => 'O campo "cpf" deve ter exatamente 14 caracteres!',
                            ),
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            
            'dataNascimento' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'Date',
                        'options' => array(
                            'format' => 'd/m/Y',
                            'messages' => array(
                                \Zend\Validator\Date::FALSEFORMAT => 'O campo "Data de nascimento" foi preenchido de forma inválida.',
                                \Zend\Validator\Date::INVALID => 'O campo "Data de nascimento" foi preenchido de forma inválida.' ,
                            ),
                        ),
                    ),
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Data de nascimento" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 10,
                            'max' => 10,
                            'messages' => array(
                                'stringLengthTooShort' => 'Campos de data devem ter exatamente 10 caracteres!', 
                                'stringLengthTooLong' => 'Campos de data devem ter exatamente 10 caracteres!' 
                            ),
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            
            'nis' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 12,
                            'max' => 12,
                            'messages' => array(
                                'stringLengthTooShort' => 'O campo "Nis" deve ter exatamente 12 caracteres!', 
                                'stringLengthTooLong' => 'O campo "Nis" deve ter exatamente 12 caracteres!' 
                            ),
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            
            'naturalidade' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'DoctrineModule\Validator\ObjectExists',
                        'options' => array(
                            'object_repository' => $this->objectManager->getRepository('Application\Entity\Cidade'),
                            'fields' => 'codigoCidade',
                            'messages' => array(
                                \DoctrineModule\Validator\ObjectExists::ERROR_NO_OBJECT_FOUND => 'Opção de naturalidade inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'tipoSexo' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'DoctrineModule\Validator\ObjectExists',
                        'options' => array(
                            'object_repository' => $this->objectManager->getRepository('Application\Entity\TipoSexo'),
                            'fields' => 'codigoTipoSexo',
                            'messages' => array(
                                \DoctrineModule\Validator\ObjectExists::ERROR_NO_OBJECT_FOUND => 'Opção de naturalidade inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'acolhimentoInstitucional' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'InArray',
                        'options' => array(
                            'haystack'  => array('0','1'),
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'Opção do campo "O conjuge se encontra em acolhimento institucional?" inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'deficienteFisico' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'InArray',
                        'options' => array(
                            'haystack'  => array('0','1'),
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'Opção do campo "O conjuge se encontra em acolhimento institucional?" inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'renda' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 10,
                            'messages' => array(
                                'stringLengthTooShort' => 'O campo "Renda" deve ter entre 1 e 10 dígitos!', 
                                'stringLengthTooLong' => 'O campo "Renda" deve ter entre 1 e 10 dígitos!' 
                            ),
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
        );
    }
}