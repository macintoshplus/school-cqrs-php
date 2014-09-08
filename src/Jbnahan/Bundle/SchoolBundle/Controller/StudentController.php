<?php

namespace Jbnahan\Bundle\SchoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Rhumsaa\Uuid\Uuid;
use Jbnahan\Domain\School\Command\RegisterStudentCommand;
use Jbnahan\Domain\School\Command\SubsribeStudentInClassCommand;
use Jbnahan\Bundle\SchoolBundle\Entity\Student;

class StudentController extends Controller
{
    public function registerAction(Request $request)
    {
        $command = new RegisterStudentCommand();
        
        $form = $this->createFormBuilder($command)
            ->add('firstName', 'text',array(
                'required'=>true
            ))
            ->add('lastName', 'text',array(
                'required'=>true
            ))
            ->add('bornOn', 'date',array(
                'required'=>true
            ))
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        
        if($form->isValid()){
            $command->studentId = $this->get('broadway.uuid.generator')->generate();
            try{
                $this->get('broadway.command_handling.command_bus')->dispatch($command);
                $this->get('session')->getFlashBag()->add('notice', 'Registration saved.');
                return $this->redirect($this->generateUrl('jbnahan_school_student_show',array('id'=>$command->studentId)));
            }catch(\Exception $e){
                $this->get('session')->getFlashBag()->add('notice', 'Error : '.$e->getMessage());
            }
        }
        
        return $this->render('JbnahanSchoolBundle:Student:register.html.twig', array(
                'form' => $form->createView(),
            ));
    }

    public function showAction(Request $request, Student $id)
    {
        return $this->render('JbnahanSchoolBundle:Student:show.html.twig', array(
                'student'=>$id,
                'subscription'=>$this->getDoctrine()->getManager('readmodel')->getRepository('JbnahanSchoolBundle:StudentSubscription')->findBy(array('studentId'=>$id->getId()))
            ));
    }

    public function subscriptionAction(Request $request, $id){

        $command = new SubsribeStudentInClassCommand();
        $command->studentId = $id;
        
        $form = $this->createFormBuilder($command)
            ->add('classId', 'entity',array(
                'required'=>true,
                'class' => 'JbnahanSchoolBundle:StudentsClass',
                'em'=>'readmodel',
                'empty_value'=>false
                /*'class' => 'Jbnahan\Bundle\SchoolBundle\Entity\StudentsClass'*/
            ))
            ->add('studentId', 'hidden',array(
                'required'=>true
            ))
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        
        if($form->isValid()){
            try{
                $this->get('broadway.command_handling.command_bus')->dispatch($command);
                $this->get('session')->getFlashBag()->add('notice', 'Subscription saved.');
                return $this->redirect($this->generateUrl('jbnahan_school_student_show',array('id'=>$command->studentId)));
            }catch(\Exception $e){
                $this->get('session')->getFlashBag()->add('notice', 'Error : '.$e->getMessage());
            }
        }
        
        return $this->render('JbnahanSchoolBundle:Student:subscription.html.twig', array(
                'form' => $form->createView(),
            ));
    }

}
