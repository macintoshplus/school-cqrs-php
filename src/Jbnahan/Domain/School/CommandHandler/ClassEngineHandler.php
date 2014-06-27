<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\School\CommandHandler;

use Jbnahan\Domain\School\Command;
use Jbnahan\Domain\Model;

/**
 * Description of ClassCommandHandler
 *
 * @author jb
 */
class ClassEngineHandler {
    protected  $repository;
    
    public function __construct($repository) {
        $this->repository = $repository;
    }
    
    public function openClass(Command\OpenClassCommand $command){
        $class = new Model\StudentsClass($command->classId);
        
        $class->openClass($command->name, $command->grade);
        
        $this->repository->save($class);
    }
}
