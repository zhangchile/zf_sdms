<?php

class HomeController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $total = new Application_Model_DbTable_Total();
        $this->view->info = $total->getTotal();
        $session = new Zend_Session_Namespace();
        $this->view->name = $session->login['name'];
    }


}

