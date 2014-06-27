<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\Scool\Model;

/**
 * Description of StudentIdentity
 *
 * @author jb
 */
class StudentIdentity {
    public $firstName;
    
    public $lastName;
    
    public $bornOn;
    
    public function __construct($firstName, $lastName, \DateTime $bornOn) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->bornOn = $bornOn;
    }
}
