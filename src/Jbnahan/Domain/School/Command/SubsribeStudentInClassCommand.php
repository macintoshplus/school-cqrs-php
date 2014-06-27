<?php


namespace Jbnahan\Domain\School\Command;

use LiteCQRS\Command;

/**
 * Description of SubsribeStudentInClassCommand
 *
 * @author jb
 */
class SubsribeStudentInClassCommand implements Command {
    
    public $classId;

    public $studentId;
    

    public function __construct($classId, $studentId) {
        $this->classId = $classId;
        $this->studentId = $studentId;
    }
    
}
