<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\School\Listener;

use Jbnahan\Domain\School\Event\ClassOpened;
use Jbnahan\Bundle\SchoolBundle\Entity\StudentsClass;

use Broadway\EventHandling\EventListenerInterface;
use Broadway\Domain\DomainMessageInterface;
use Doctrine\ORM\EntityManager;

/**
 * Description of StudentViewListener
 *
 * @author jb
 */
class ClassViewListener {
    
    private $em;


    public function __construct(EntityManager $em) {
        $this->em = $em;
    }


    public function handle(DomainMessageInterface $domainMessage)
    {
        
        //print_r($domainMessage);
        $evt = $domainMessage->getPayload();
        $class = explode("\\",get_class($evt));
        $method = 'on' . end($class);
        if (! method_exists($this, $method)) {

            return;
        }

        $this->$method($evt, $domainMessage->getPlayhead());
    }
    
    public function onClassOpened(ClassOpened $event, $version) {
        $student = new StudentsClass();
        
        $student->setId($event->id);
        $student->setName($event->identity->name);
        $student->setGrade($event->identity->grade);
        $student->setVersion($version);
        
        $this->em->persist($student);
        $this->em->flush();
    }


    
    public function onClassRenamed(ClassOpened $event, $version) {
        $student = $this->em->getRepository('JbnahanSchoolBundle:StudentsClass')->find($event->id);
        
        $student->setName($event->name);
        $student->setVersion($version);
        
        $this->em->persist($student);
        $this->em->flush();
    }
}
