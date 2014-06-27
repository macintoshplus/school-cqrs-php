<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\Model;

use LiteCQRS\AggregateRoot;
use Jbnahan\Domain\School\Event\ClassOpened;

/**
 * Description of Class
 *
 * @author jb
 */
class StudentsClass extends AggregateRoot {
    
    protected $students;
    
    protected $identity;

    public function __construct($id) {
        $this->setId($id);
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function openClass($name, $grade) {
        $identity = new ClassIdentity($name, $grade);
        
        $this->apply(new ClassOpened($this->getId(), $identity));
    }
    
    
    
    protected function applyClassOpened($event) {
        $this->identity = $event->identity;
    }
}
