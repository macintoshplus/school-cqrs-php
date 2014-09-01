<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\School\Listener;

use Jbnahan\Domain\School\Event\ClassOpened;
use Jbnahan\Bundle\SchoolBundle\Entity\StudentsClass;

/**
 * Description of StudentViewListener
 *
 * @author jb
 */
class ClassViewListener {
    
    private $doctrine;


    public function __construct($doctrine) {
        $this->doctrine = $doctrine;
    }
    
    public function onClassOpened(ClassOpened $event) {
        $student = new StudentsClass();
        
        $student->setId($event->id);
        $student->setName($event->identity->name);
        $student->setGrade($event->identity->grade);
        $student->setVersion(1);
        
        $this->doctrine->getManager()->persist($student);
        $this->doctrine->getManager()->flush();
    }
}
