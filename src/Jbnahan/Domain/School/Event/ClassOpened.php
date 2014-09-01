<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\School\Event;

use LiteCQRS\DefaultDomainEvent;
use Jbnahan\Domain\School\Model\ClassIdentity;

/**
 * Description of ClassOpenedEvent
 *
 * @author jb
 */
class ClassOpened extends DefaultDomainEvent {
    
    public $id;

    public $identity;
    
    /*public function __construct($id, ClassIdentity $identity) {
        $this->id = $id;
        $this->identity = $identity;
    }*/
}
