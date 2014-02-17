<?php

class StudentController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $students = new Application_Model_DbTable_Normal();
        $this->view->result = $students->get_info('student');
    }


}

