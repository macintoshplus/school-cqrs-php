<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\Scool\Model;

use LiteCQRS\AggregateRoot;
use Jbnahan\Domain\Scool\Event\StudentRegistred;

/**
 * Description of Student
 *
 * @author jb
 */
class Student extends AggregateRoot {
    protected $identity;
    
    public function __construct($id) {
        $this->setId($id);
    }
    
    public function registration($id, $firstName, $lastName, \DateTime $bornOn) {
        $identity = new StudentIdentity($firstName,$lastName,$bornOn);
        
        $event = new StudentRegistred($id, $identity);
        
        $this->apply($event);
    }
    
    protected function applyStudentRegistred($event) {
        $this->identity = $event->identity;
    }
}
