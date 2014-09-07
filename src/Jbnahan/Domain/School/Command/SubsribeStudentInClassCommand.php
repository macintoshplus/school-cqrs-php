<?php


namespace Jbnahan\Domain\School\Command;


/**
 * Description of SubsribeStudentInClassCommand
 *
 * @author jb
 */
class SubsribeStudentInClassCommand {
    
    public $classId;

    public $studentId;
    

    public function __construct($classId, $studentId) {
        $this->classId = $classId;
        $this->studentId = $studentId;
    }
    
}
