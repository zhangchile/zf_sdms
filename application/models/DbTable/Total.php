<?php

class Application_Model_DbTable_Total extends Zend_Db_Table_Abstract
{

    protected $_name = 'Home';
    protected $db = null;

    public function init()
    {
        $this->db = Zend_Db_Table::getDefaultAdapter();
    }
    public function getTotal()//获取汇总信息
    {
        $data['stu_num'] = $this->db->fetchOne("SELECT COUNT(*) FROM student ");
        $data['dor_num'] = $this->db->fetchOne("SELECT COUNT(*) FROM dormitory ");
        $data['v_num'] = $this->db->fetchOne("SELECT COUNT(*) FROM visitor ");
        $data['worker_num'] = $this->db->fetchOne("SELECT COUNT(*) FROM worker ");
        $data['building_num'] = count($this->db->fetchAssoc("SELECT DISTINCT b_no FROM  `dormitory` "));
        return $data;
    }
    public function get_building()
    {
        return $this->db->fetchAll("SELECT DISTINCT b_no FROM dormitory");
    }

}

