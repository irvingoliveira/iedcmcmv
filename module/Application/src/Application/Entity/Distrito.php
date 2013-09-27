<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Distrito")
 */
class Distrito {
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoDistrito;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=8,unique=TRUE)
     */
    private $nome;
    
    /**
     *
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="Endereco", mappedBy="distrito")
     */
    private $enderecos;
    
    function __construct() {
        
    }
    
    public function getCodigoDistrito() {
        return $this->codigoDistrito;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEnderecos() {
        return $this->enderecos;
    }

    public function setEnderecos($enderecos) {
        $this->enderecos = $enderecos;
    }


}