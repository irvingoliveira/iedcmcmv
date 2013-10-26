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
 * @ORM\Table(name="Identidade")
 */
class Identidade {
    
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoIdentidade;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=14,unique=TRUE)
     */
    private $numero;
    
    /**
     *
     * @var DateTime
     * 
     * @ORM\Column(type="date")
     */
    private $dataEmissao;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=200)
     */
    private $orgaoEmissor;
    
    /**
     *
     * @var Pessoa
     * 
     * @ORM\OneToOne(targetEntity="Pessoa", mappedBy="identidade")
     */
    private $pessoa;
    
    function __construct() {
        
    }
    
    public function getCodigoIdentidade() {
        return $this->codigoIdentidade;
    }

    public function setCodigoIdentidade($codigoIdentidade) {
        $this->codigoIdentidade = $codigoIdentidade;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getDataEmissao() {
        return $this->dataEmissao;
    }

    public function setDataEmissao(\DateTime $dataEmissao) {
        $this->dataEmissao = $dataEmissao;
    }

    public function getOrgaoEmissor() {
        return $this->orgaoEmissor;
    }

    public function setOrgaoEmissor($orgaoEmissor) {
        $this->orgaoEmissor = $orgaoEmissor;
    }

    public function getPessoa() {
        return $this->pessoa;
    }

    public function setPessoa(Pessoa $pessoa) {
        $this->pessoa = $pessoa;
    }
    
}