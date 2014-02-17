<?php

class Application_Model_DbTable_Admin extends Zend_Db_Table_Abstract
{

    protected $_name = 'admin';

    public function check($uid, $pwd)
    {
        $query = $this->_db->select()
                            ->from($this->_name)
                            ->where('uid = ?', $uid)
                            ->where('pwd = ?', md5($pwd));
        $result = $this->getAdapter()->fetchRow($query);
        if($result) {
            return $result;
        }
        return false;
    }

}

