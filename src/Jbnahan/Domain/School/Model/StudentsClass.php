<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\School\Model;

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
	
	protected $id;

    public function __construct($id) {
        $this->id = $id;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function openClass($name, $grade) {
        $identity = new ClassIdentity($name, $grade);
        
        $this->apply(new ClassOpened(array('id' =>$this->id,'identity'=>$identity)));
    }
    
    
    
    protected function applyClassOpened($event) {
        $this->identity = $event->identity;
    }
}
