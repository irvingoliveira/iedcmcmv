<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="TipoTelefone")
 */
class TipoTelefone {
    
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoTipoTelefone;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=50,unique=TRUE)
     */
    private $descricao;
    
    /**
     *
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="Telefone", mappedBy="tipoTelefone")
     */
    private $telefones;
    
    function __construct() {
        
    }
    
    public function getCodigoTipoTelefone() {
        return $this->codigoTipoTelefone;
    }
    
    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getTelefones() {
        return $this->telefones;
    }

    public function setTelefones($telefones) {
        $this->telefones = $telefones;
    }

}