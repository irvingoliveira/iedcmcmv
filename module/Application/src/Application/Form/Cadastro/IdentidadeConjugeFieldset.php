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

class IdentidadeConjugeFieldset extends Fieldset implements InputFilterProviderInterface{

    public function __construct(ObjectManager $objectManager) {
        parent::__construct('IdentidadeFieldset');
        
        $this->setHydrator(new DoctrineHydrator($objectManager, 
                                                'Application\Entity\Identidade'));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'numero',
                'options'   =>  array(
                    'label' =>  'Número da identidade:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'identidadeConjugeNumero',
                    'size' => '12',
                    'maxlength' => '15',
                )
        ));
        
        $this->add(array(
        'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'dataEmissao',
                'options'   =>  array(
                    'label' =>  'Data de Emissão:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'identidadeConjugeDataEmissao',
                )
        ));
        
        $this->add(array(
        'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'orgaoEmissor',
                'options'   =>  array(
                    'label' =>  'Orgão Emissor:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'identidadeConjugeOrgaoEmissor',
                    'size' => '50',
                    'maxlength' => '200',
                )
        ));
        
    }

    public function getInputFilterSpecification() {
        return array(
            
            'numero' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 6,
                            'max' => 15,
                            'messages' => array(
                                'stringLengthTooShort' => 'O campo "Número da identidade" deve ter entre exatamente 12 caracteres!', 
                                'stringLengthTooLong' => 'O campo "Número da identidade" deve ter entre exatamente 12 caracteres!', 
                            ),
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            
            'dataEmissao' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'Date',
                        'options' => array(
                            'format' => 'd/m/Y',
                            'messages' => array(
                                \Zend\Validator\Date::FALSEFORMAT => 'O campo "Data de emissão" foi preenchido de forma inválida.',
                                \Zend\Validator\Date::INVALID => 'O campo "Data de emissão" foi preenchido de forma inválida.',
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
            
            'orgaoEmissor' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 2,
                            'max' => 200,
                            'messages' => array(
                                'stringLengthTooShort' => 'O campo "Orgão emissor" deve ter entre 3 e 200 caracteres!', 
                                'stringLengthTooLong' => 'O campo "Orgão emissor" deve ter entre 3 e 200 caracteres!' 
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
        );
    }
}