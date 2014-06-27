<?php

namespace Jbnahan\Bundle\ScoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Rhumsaa\Uuid\Uuid;
use Jbnahan\Domain\Scool\Command\RegisterStudentCommand;

class StudentController extends Controller
{
    public function registerAction(Request $request)
    {
        $command = new RegisterStudentCommand();
        
        $form = $this->createFormBuilder($command)
            ->add('firstName', 'text')
            ->add('lastName', 'text')
            ->add('bornOn', 'date')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        
        if($form->isValid()){
            $command->studentId = Uuid::uuid1();

            $this->get('command_bus')->handle($command);
        }
        
        return $this->render('JbnahanScoolBundle:Student:register.html.twig', array(
                'form' => $form->createView(),
            ));    }

    public function showAction()
    {
        return $this->render('JbnahanScoolBundle:Student:show.html.twig', array(
                // ...
            ));    }

}