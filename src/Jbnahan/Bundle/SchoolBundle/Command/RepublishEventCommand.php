<?php

namespace Jbnahan\Bundle\SchoolBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Broadway\Domain\DomainEventStream;

class RepublishEventCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('jbnahan:event:republish')
            ->setDescription('republish a event on event bus.')
            ->addArgument('version', InputArgument::REQUIRED, 'The pleahead number (version)')
            ->addArgument('uuid', InputArgument::REQUIRED, 'The Aggregate UUID')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('version');
        $uuid = $input->getArgument('uuid');
        try{
        	$eventStream = $this->getContainer()->get('broadway.event_store')->load($uuid);
        }catch(\Exception $e){

	        $output->writeln("Error ".$e->getMessage());
	        return;
        }

        foreach ($eventStream as $key => $value) {
        	if($id === $value->getPlayhead()){
        		$this->getContainer()->get('broadway.event_handling.event_bus')->publish(new DomainEventStream(array($value)));
        		//var_dump($value);
        		$output->writeln("Published !");
        		return;
        	}
        }


        $output->writeln("No event found !");
    }
}