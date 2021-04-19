<?php

namespace Models;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="projects")
 */
class Project {
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id_projects;
    /** 
     * @ORM\Column(type="string")
     */
    protected $p_name;
    
    public function getId(){
        return $this->id_projects;
    }
    public function getName(){
        return $this->p_name;
    }
    public function setName($p_name){
        $this->p_name = $p_name;
    }
    
}
