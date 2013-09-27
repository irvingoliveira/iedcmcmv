<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="TipoSexo")
 */
class TipoSexo {

    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoTipoSexo;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=9,unique=TRUE)
     */
    private $nome;
    
    /**
     *
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="Pessoa", mappedBy="tipoSexo")
     */
    private $pessoas;
    
    function __construct() {
        
    }
    
    public function getId() {
        return $this->codigoTipoSexo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getPessoas() {
        return $this->pessoas;
    }

    public function setPessoas($pessoas) {
        $this->pessoas = $pessoas;
    }

}