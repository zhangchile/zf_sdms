<?php

class LoginController extends Zend_Controller_Action
{

    protected $_redirector = null;

    public function init()
    {

        $this->_helper->layout->setLayout('default');//use default layout
        /* Initialize action controller here */
        $this->_redirector = $this->_helper->getHelper('Redirector');
        // 取得登录状态，状态存储在Zend_Session中
        $session = new Zend_Session_Namespace();
        $login = $session->login;         
        if (isset($login)) {
            // 给view中相关变量赋值
            $this->view->uid = $login['uid'];
            $this->view->pwd = $login['pwd'];
            $this->view->name = $login['name'];
        } else {
            $this->view->uid = $this->view->pwd = $this->view->name =  null;
        }
    }

    public function indexAction()
    {
        // action body
        // $session=new Zend_Session_Namespace();
        // var_dump($session->login);
        $this->view->error = false;
    }

    public function checkAction()
    {
        // action body
        //从request参数中获取用户输入的用户名和密码

        $uid = $this->_getParam('uid');
        $pwd = $this->_getParam('pwd');
        //启动Session
        $session = new Zend_Session_Namespace();
        $admin = new Application_Model_DbTable_Admin();
        $result = $admin->check($uid, $pwd);
        if($result) {
            $session->login = array(
                    'uid' => $result['uid'],
                    'pwd' => $result['pwd'],
                    'name'=> $result['name']);
            // var_dump($result);
            $this->_redirector->setGotoSimple('index', 'home');        
        } else {
            $this->_redirector->setGotoSimple('index', 'login');
        }
    }

    public function logoutAction()
    {
        // action body
    }


}





