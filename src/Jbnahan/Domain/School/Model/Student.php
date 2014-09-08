<?php

namespace Jbnahan\Domain\School\Model;

use Jbnahan\Domain\School\Event\StudentRegistred;
use Jbnahan\Domain\School\Command\RegisterStudentCommand;

use Broadway\EventSourcing\EventSourcedAggregateRoot;

/**
 * Description of Student
 *
 * @author jb
 */
class Student extends EventSourcedAggregateRoot {
    
    /**
     *
     * @var StudentIdentity
     */
    protected $identity;

    protected $id;
    
    /**
     * 
     * @param Uuid $id
     */
    public function __construct() {

    }
    
    public function getId(){
        return $this->id;
    }

	
    /**
     * Compute the student Age
     * @return integer
     */
    public function getAge(){
        $now = date('Y');
        return $now - $this->identity->bornOn->format('Y');
    }


    public static function registration(RegisterStudentCommand $command){
        $student = new Student();

        $event = new StudentRegistred();
        
        $event->id = $command->studentId;
        $event->identity = new StudentIdentity($command->firstName, $command->lastName, $command->bornOn);
        
        $student->apply($event);

        return $student;
    }
    
    
    /**
     * Apply StudentRegistred Event
     * @param StudentRegistred $event
     */
    protected function applyStudentRegistred($event) {
        $this->identity = $event->identity;
        $this->id = $event->id;
    }
}
