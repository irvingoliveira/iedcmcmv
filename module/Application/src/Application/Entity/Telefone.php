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
 * @ORM\Table(name="Telefone")
 */
class Telefone {
    
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoTelefone;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=14)
     */
    private $numero;
    
    /**
     *
     * @var Titular
     * 
     * @ORM\ManyToOne(targetEntity="Titular", inversedBy="telefones")
     * @ORM\JoinColumn(name="codigoTitular", referencedColumnName="codigoTitular", nullable=FALSE)
     */
    private $titular;
    
    /**
     *
     * @var TipoTelefone
     * 
     * @ORM\ManyToOne(targetEntity="TipoTelefone", inversedBy="telefones")
     * @ORM\JoinColumn(name="codigoTipoTelefone", referencedColumnName="codigoTipoTelefone", nullable=FALSE)
     */
    private $tipoTelefone;
    
    function __construct() {
        
    }

    public function getCodigoTelefone() {
        return $this->codigoTelefone;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getTitular() {
        return $this->titular;
    }

    public function setTitular(Titular $titular) {
        $this->titular = $titular;
    }

    public function getTipoTelefone() {
        return $this->tipoTelefone;
    }

    public function setTipoTelefone(TipoTelefone $tipoTelefone) {
        $this->tipoTelefone = $tipoTelefone;
    }

}