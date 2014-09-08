<?php

namespace Jbnahan\Domain\School\Model;

use Jbnahan\Domain\School\Event\StudentRegistred;
use Jbnahan\Domain\School\Event\StudentSubscribedInClass;
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

    protected $classSubscribe;
    
    /**
     * 
     * @param Uuid $id
     */
    public function __construct() {
        $this->classSubscribe = array();
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

    /**
     * Create a new Aggregate
     * @param RegisterStudentCommand $command
     * @return Student
     */
    public static function registration(RegisterStudentCommand $command){
        $student = new Student();

        $event = new StudentRegistred();

        $event->id = $command->studentId;
        $event->identity = new StudentIdentity($command->firstName, $command->lastName, $command->bornOn);
        
        $student->apply($event);

        return $student;
    }
    
    /**
     * Add ClassId in student subscription
     * @param string $classId
     */
    public function registerInClass($classId, $classFullName){
        if(in_array($classId, $this->classSubscribe)){
            throw new \Exception("Cannot subscribe twice");
        }

        $this->apply(new StudentSubscribedInClass($this->id, $classId, $classFullName));

    }
    
    /**
     * Apply StudentRegistred Event
     * @param StudentRegistred $event
     */
    protected function applyStudentRegistred($event) {
        $this->identity = $event->identity;
        $this->id = $event->id;
    }

    /**
     * Apply StudentSubscribedInClass Event
     * @param StudentSubscribedInClass $event
     */
    protected function applyClassSubscribed($event){
        $this->classSubscribe[]=$event->classId;
    }
}
