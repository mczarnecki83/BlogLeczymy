<?php

namespace Leczymy\BlogBundle\Service;
use Symfony\Component\HttpFoundation\Session\Session;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class NotificationService 
{
	
    private $session;
    
    function __construct(Session $session) {
        $this->session = $session;
    }
    
    protected function addMessage($type, $message){
        $this->session->getFlashBag()->add($type, $message);
    }

    public function addSuccess($message){
        $this->addMessage('success', $message);
    }
    
    public function addError($message){
        $this->addMessage('danger', $message);
    }
    public function addNotice($message){
        $this->addMessage('notice', $message);
    }    
}