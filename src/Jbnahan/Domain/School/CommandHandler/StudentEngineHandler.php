<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\School\CommandHandler;

use Jbnahan\Domain\School\Command;
use Jbnahan\Domain\School\Model\Student;
use Broadway\CommandHandling\CommandHandler;
use Broadway\EventSourcing\EventSourcingRepository;

/**
 * Description of ClassCommandHandler
 *
 * @author jb
 */
class StudentEngineHandler extends CommandHandler {
    
    
    private $repository;

    public function __construct(EventSourcingRepository $repository){
        $this->repository = $repository;
    }
    
    /**
     * Execute command RegisterStudent
     * @param RegisterStudentCommand $command
     * @return void
     */
    public function handleRegisterStudentCommand(Command\RegisterStudentCommand $command){

        $student = Student::registration($command);
        
        $this->repository->add($student);
    }
}
