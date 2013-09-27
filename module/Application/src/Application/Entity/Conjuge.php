<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Conjuge")
 */
class Conjuge extends Pessoa{
    
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoConjuge;
    
    /**
     *
     * @var Titular
     * 
     * @ORM\OneToOne(targetEntity="Titular", inversedBy="conjuge")
     * @ORM\JoinColumn(name="codigoTitular", referencedColumnName="codigoTitular", nullable=FALSE)
     */
    private $titular;
            
    function __construct() {
        parent::__construct();
    }

    public function getCodigoConjuge() {
        return $this->codigoConjuge;
    }
    
    public function getTitular() {
        return $this->titular;
    }

    public function setTitular(Titular $titular) {
        $this->titular = $titular;
    }

}