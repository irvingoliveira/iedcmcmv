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
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Dependente")
 */
class Dependente {

    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoDependente;

    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=200)
     */
    private $nome;

    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=14,unique=TRUE,nullable=TRUE)
     */
    private $cpf;

    /**
     *
     * @var DateTime
     * 
     * @ORM\Column(type="date")
     */
    private $dataNascimento;

    /**
     *
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    private $deficienteFisico;

    /**
     *
     * @var float
     * 
     * @ORM\Column(type="float")
     */
    private $renda;

    /**
     *
     * @var Titular
     * 
     * @ORM\ManyToOne(targetEntity="Titular", inversedBy="dependentes")
     * @ORM\JoinColumn(name="codigoTitular", referencedColumnName="codigoTitular", nullable=FALSE)
     */
    private $titular;

    /**
     *
     * @var TipoGrauDeParentesco
     * 
     * @ORM\ManyToOne(targetEntity="TipoGrauDeParentesco", inversedBy="dependentes")
     * @ORM\JoinColumn(name="codigoTipoGrauDeParentesco", referencedColumnName="codigoTipoGrauDeParentesco", nullable=FALSE)
     */
    private $tipoGrauDeParentesco;

    /**
     *
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    private $acolhimentoInstitucional;

    function __construct() {
        
    }

    public function getCodigoDependente() {
        return $this->codigoDependente;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function setDataNascimento(\DateTime $dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function getDeficienteFisico() {
        return $this->deficienteFisico;
    }

    public function setDeficienteFisico($deficienteFisico) {
        $this->deficienteFisico = $deficienteFisico;
    }

    public function getRenda() {
        return $this->renda;
    }

    public function setRenda($renda) {
        $this->renda = $renda;
    }

    public function getTitular() {
        return $this->titular;
    }

    public function setTitular(Titular $titular) {
        $this->titular = $titular;
    }

    public function getTipoGrauDeParentesco() {
        return $this->tipoGrauDeParentesco;
    }

    public function setTipoGrauDeParentesco(TipoGrauDeParentesco $tipoGrauDeParentesco) {
        $this->tipoGrauDeParentesco = $tipoGrauDeParentesco;
    }

    public function getAcolhimentoInstitucional() {
        return $this->acolhimentoInstitucional;
    }

    public function setAcolhimentoInstitucional($acolhimentoInstitucional) {
        $this->acolhimentoInstitucional = $acolhimentoInstitucional;
    }

}