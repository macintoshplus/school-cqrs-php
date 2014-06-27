<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\Scool\CommandHandler;

use Jbnahan\Domain\Scool\Command;
use Jbnahan\Domain\Scool\Model;

/**
 * Description of ClassCommandHandler
 *
 * @author jb
 */
class StudentEngineHandler {
    protected  $repository;
    
    public function __construct($repository) {
        $this->repository = $repository;
    }
    
    public function registerStudent(Command\RegisterStudentCommand $command){
        $student = new Model\Student($command->studentId);
        
        $student->registration($command->studentId, $command->firstName, $command->lastName, $command->bornOn);
        
        $this->repository->save($student);
    }
}
