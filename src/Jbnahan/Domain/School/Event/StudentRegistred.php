<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\School\Event;

use LiteCQRS\DefaultDomainEvent;
use Jbnahan\Domain\School\Model\StudentIdentity;

/**
 * Description of StudentRegistred
 *
 * @author jb
 */
class StudentRegistred extends DefaultDomainEvent {
    public $identity;
    
    public $id;
    
    /*public function __construct($id, StudentIdentity $identity) {
        $this->id = $id;
        $this->identity = $identity;
    }*/
}
