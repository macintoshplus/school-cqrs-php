<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\School\Listener;

use Jbnahan\Domain\School\Event\StudentRegistred;
use Jbnahan\Bundle\SchoolBundle\Entity\Student;

/**
 * Description of StudentViewListener
 *
 * @author jb
 */
class StudentViewListener {
    
    private $doctrine;


    public function __construct($doctrine) {
        $this->doctrine = $doctrine;
    }
    
    public function onStudentRegistred(StudentRegistred $event) {
        $student = new Student();
        
        $student->setId($event->id);
        $student->setLastName($event->identity->lastName);
        $student->setFirstName($event->identity->firstName);
        $student->setBornOn($event->identity->bornOn);
        $student->setVersion(1);
        
        $this->doctrine->getManager()->persist($student);
        $this->doctrine->getManager()->flush();
    }
}
