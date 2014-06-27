<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\Scool\Command;

use LiteCQRS\Command;

/**
 * Description of RegisterStudent
 *
 * @author jb
 */
class RegisterStudentCommand implements Command {
    
    public $studentId;

    public $firstName;
    
    public $lastName;
    
    public $bornOn;
    
    public function __construct(/*$id ,$firstName, $lastName, \DateTime $bornOn*/) {
        /*$this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->bornOn = $bornOn;
        $this->studentId = $id;*/
    }
}
