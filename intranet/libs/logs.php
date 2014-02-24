<?php

class Logs
{
    public static function set($info)
    {
        $data = array(
            'user_id' => Session::get('userid'),
            'info' => $info,
            'updated_at' =>Model::getTimeSQL()
        );
        $model=new model();
        $model->db->insert('log', $data);
    }
    
    public static function get($key)
    {
        $model=new model();
        return $model->db->select('SELECT * FROM log WHERE id = :id', 
            array('id' => $key));
    }
    
    
}