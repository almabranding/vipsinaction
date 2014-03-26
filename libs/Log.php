<?php

class Log
{
    public static function set($info)
    {
        $model=new model();
        $user=Session::get('user');
        $data = array(
            'user_id' => $user['id'],
            'info' => $info,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'updated_at' =>$model->getTimeSQL()
        );
        $model->db->insert('log', $data);
    }
    
    public static function get($key)
    {
        $model=new model();
        return $model->db->select('SELECT * FROM log WHERE id = :id', 
            array('id' => $key));
    }
    
    
}