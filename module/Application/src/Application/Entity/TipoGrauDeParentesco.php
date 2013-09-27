<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="TipoGrauDeParentesco")
 */
class TipoGrauDeParentesco {
    
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoTipoGrauDeParentesco;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=50)
     */
    private $descricao;
    
    /**
     *
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="Dependente", mappedBy="tipoGrauDeParentesco")
     */
    private $dependentes;
    
    function __construct() {
        
    }
    
    public function getCodigoTipoGrauDeParentesco() {
        return $this->codigoTipoGrauDeParentesco;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getDependentes() {
        return $this->dependentes;
    }

    public function setDependentes($dependentes) {
        $this->dependentes = $dependentes;
    }

}