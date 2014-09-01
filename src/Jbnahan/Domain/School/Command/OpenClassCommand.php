<?php


namespace Jbnahan\Domain\School\Command;

use LiteCQRS\Command;

/**
 * Description of OpenClassCommand
 *
 * @author jb
 */
class OpenClassCommand implements Command {
    
    public $classId;

    public $name;
    
    public $grade;

    /*public function __construct($classId, $name, $grade) {
        $this->name = $name;
        $this->grade = $grade;
        $this->classId = $classId;
    }*/
    
}
