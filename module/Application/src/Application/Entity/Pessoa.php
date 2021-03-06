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
 * @ORM\MappedSuperclass
 */
abstract class Pessoa {

    /**
     * @var string
     * 
     * @ORM\Column(type="string",length=200)
     */
    private $nome;

    /**
     *
     * @var Identidade
     * 
     * @ORM\OneToOne(targetEntity="Identidade", inversedBy="pessoa", cascade={"persist"})
     * @ORM\JoinColumn(name="codigoIdentidade", referencedColumnName="codigoIdentidade",nullable=FALSE)
     */
    private $identidade;

    /**
     * @var string
     * 
     * @ORM\Column(type="string",length=14, unique=TRUE)
     */
    private $cpf;

    /**
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
     * @var string
     * 
     * @ORM\Column(type="string",length=12,nullable=TRUE, unique=TRUE)
     */
    private $nis;

    /**
     *
     * @var TipoSexo
     * 
     * @ORM\ManyToOne(targetEntity="TipoSexo", inversedBy="pessoas")
     * @ORM\JoinColumn(name="codigoTipoSexo", referencedColumnName="codigoTipoSexo", nullable=FALSE)
     */
    private $tipoSexo;

    /**
     *
     * @var Cidade
     * 
     * @ORM\ManyToOne(targetEntity="Cidade", inversedBy="pessoas")
     * @ORM\JoinColumn(name="naturalidade", referencedColumnName="codigoCidade", nullable=FALSE)
     */
    private $naturalidade;

    /**
     * @var float
     * 
     * @ORM\Column(type="float")
     */
    private $renda;

    /**
     *
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    private $acolhimentoInstitucional;

    function __construct() {
        
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getIdentidade() {
        return $this->identidade;
    }

    public function setIdentidade(Identidade $identidade) {
        $this->identidade = $identidade;
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

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function getDeficienteFisico() {
        return $this->deficienteFisico;
    }

    public function setDeficienteFisico($deficienteFisico) {
        $this->deficienteFisico = $deficienteFisico;
    }

    public function getNis() {
        return $this->nis;
    }

    public function setNis($nis) {
        $this->nis = $nis;
    }

    public function getRenda() {
        return $this->renda;
    }

    public function setRenda($renda) {
        $this->renda = $renda;
    }

    public function getTipoSexo() {
        return $this->tipoSexo;
    }

    public function setTipoSexo(TipoSexo $tipoSexo) {
        $this->tipoSexo = $tipoSexo;
    }

    public function getNaturalidade() {
        return $this->naturalidade;
    }

    public function setNaturalidade(Cidade $naturalidade) {
        $this->naturalidade = $naturalidade;
    }

    public function getAcolhimentoInstitucional() {
        return $this->acolhimentoInstitucional;
    }

    public function setAcolhimentoInstitucional($acolhimentoInstitucional) {
        $this->acolhimentoInstitucional = $acolhimentoInstitucional;
    }

}