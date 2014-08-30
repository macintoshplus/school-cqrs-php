<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\School\Command;

use LiteCQRS\DefaultCommand;


/**
 * Description of RegisterStudent
 *
 * @author jb
 */
class RegisterStudentCommand extends DefaultCommand {
    
    public $studentId;

    public $firstName;
    
    public $lastName;
    
    public $bornOn;
    
    
    
}
