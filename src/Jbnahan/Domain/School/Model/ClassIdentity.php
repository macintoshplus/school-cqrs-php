<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\School\Model;

/**
 * Description of ClassIdentity
 *
 * @author jb
 */
class ClassIdentity {
    public $name;
    
    public $grade;
    
    public function __construct($name, $grade) {
        $this->name = $name;
        $this->grade = $grade;
    }
}
