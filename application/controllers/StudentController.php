<?php

class StudentController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_redirector = $this->_helper->getHelper('Redirector');
        $this->_normal = new Application_Model_DbTable_Normal();
    }

    public function indexAction()
    {
        // action body
        $this->view->result = $this->_normal->get_info('student');
        $b_num = new Application_Model_DbTable_Total();        
        $this->view->building = $b_num->get_building();
    }

    public function editAction()
    {
        // action body
        $s_no = $this->_request->get('s_no');
        $this->view->result = array($this->_normal->get_info_by_id('student', "s_no", $s_no));
        if(!$this->view->result['0']) {
            $this->_redirector->setGotoSimple('index', 'student');
        }
        $b_num = new Application_Model_DbTable_Total(); 
        $this->view->building = $b_num->get_building();
    }

    public function deleteAction()
    {
        $s_no = $this->_request->get('s_no');
        $flag = $this->_normal->delete('student', 's_no', $s_no);
        if($flag) {
            $this->_redirector->setGotoSimple('success', 'msg');
        } else {
            $this->_redirector->setGotoSimple('fail', 'msg');
        }
    }

    public function updateAction()
    {
        if($this->getRequest()->isPost()){
            $data = $this->_request->getPost();
            $flag = $this->_normal->update('student', $data, 's_no', $data['s_no']);
            if($flag) {
                $this->_redirector->setGotoSimple('success', 'msg');
            } else {
                $this->_redirector->setGotoSimple('fail', 'msg');
            }            
        } else {
            $this->_redirector->setGotoSimple('index', 'student');
        }
    }

    public function addAction()
    {
        if($this->getRequest()->isPost()){
            $data = $this->_request->getPost();
            $flag = $this->_normal->add('student', $data);
            if($flag) {
                $this->_redirector->setGotoSimple('success', 'msg');
            } else {
                $this->_redirector->setGotoSimple('fail', 'msg');
            }            
        } else {
            $this->_redirector->setGotoSimple('index', 'student');
        }
    }


}









