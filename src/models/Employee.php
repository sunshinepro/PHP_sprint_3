<?php

namespace Models;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="emploees")
 */
class Employee {
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id_emploees;
    /** 
     * @ORM\Column(type="string")
     */
    protected $f_name;
    
    public function getId(){
        return $this->id_emploees;
    }
    public function getName(){
        return $this->f_name;
    }
    public function setName($f_name){
        $this->f_name = $f_name;
    }
    
}