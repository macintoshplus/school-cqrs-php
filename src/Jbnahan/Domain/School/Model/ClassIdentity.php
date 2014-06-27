<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\Model;

/**
 * Description of ClassIdentity
 *
 * @author jb
 */
class ClassIdentity {
    protected $name;
    
    protected $grade;
    
    public function __construct($name, $grade) {
        $this->name = $name;
        $this->grade = $grade;
    }
}
