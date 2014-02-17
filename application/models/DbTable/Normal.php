<?php

class Application_Model_DbTable_Normal extends Zend_Db_Table_Abstract{

    protected $_name = '$_table_name';
    protected $db = null;

    public function init()
    {
        $this->db = Zend_Db_Table::getDefaultAdapter();
    }

    /**
    * get_arr($table_name)
    * @param $table_name 表名
    * @return array 关联数组
    */
    public function get_info($table_name)
    {
        $result = $this->db->fetchAssoc("SELECT * FROM $table_name");
        return $result;
    }
    /**
    * get_arr($table_name, $id)
    * @param $table_name 表名
    * @param $id
    * @return array 关联数组
    */
    public function get_info_by_id($table_name, $id)
    {
        $result = $this->db->fetchAssoc(
        "SELECT * FROM $table_name WHERE id = :id",
        array('title' => $id)
        );
        return $result;
    }    
    /**
    * update($table_name, $data, $where)
    * @param $table_name 表名
    * @param $data 要更新的数据
    * @param $where where条件语句
    * @return array 关联数组
    */
    public function update($table_name, $data, $where)
    {    
        // where条件语句过滤，防止攻击
        $where = $this->db->quoteInto($where);
        return $this->db->update($table_name, $data, $where);
    }
    /**
    * update($table_name, $data)
    * @param $table_name 表名
    * @param $data 要插入的数据
    * @return array 关联数组
    */
    public function add($table_name, $data)
    {
        return $this->db->insert($table_name, $row);
    }
    /**
    * add($table_name, $where)
    * @param $table_name 表名
    * @param $where where条件语句
    * @return array 关联数组
    */    
    public function delete($table_name, $where)
    {
        // where条件语句过滤，防止攻击
        $where = $this->db->quoteInto($where);        
        return $this->db->delete($table_name, $where);
    }
}

