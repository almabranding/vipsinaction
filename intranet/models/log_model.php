<?php
class Log_Model extends Model {
    public $pag;
    public function __construct() {
        parent::__construct();
    }
    
    public function getLog($id) {
        $role=$this->db->select("SELECT * FROM log WHERE id=".$id);
        return $role[0]['name'];
    }
    public function getLogList($pag,$maxpp,$order) {
        $min=$pag*$maxpp-$maxpp;
        return $this->db->select("SELECT * FROM log ORDER by ".$order." LIMIT ".$min.",".$maxpp);  
    }
    public function logToTable($lista,$order) {
        $order=  explode(' ', $order);
        $orden=(strtolower($order[1])=='desc')?' ASC':' DESC';
        $b['sort']=true;
        $b['title']=array(
           array(
               "title"  =>"Name",
                "link"  => URL.LANG.'/log/lista/'.$this->pag.'/user_id'.$orden,
               "width"  =>"10%"
           ),array(
               "title"  =>"Info",
                "link"  => URL.LANG.'/log/lista/'.$this->pag.'/info'.$orden,
               "width"  =>"40%"
           ),array(
               "title"  =>"Time/Date",
                 "link"  => URL.LANG.'/log/lista/'.$this->pag.'/updated_at'.$orden,
               "width"  =>"10%"   
           ));   
        foreach($lista as $key => $value) {
            $b['values'][]=   
            array(
                "name"  =>$this->getUser($value['user_id']),
                "info"  =>$value['info'],
                "Time/Date"  =>$this->getTimeStamp($value['updated_at'])
            );
        }
        return $b;
    }
    public function getUser($id) {
        $role=$this->db->select("SELECT * FROM users WHERE id=".$id);
        return $role[0]['firstname'].' '.$role[0]['lastname'];
    }
    public function deleteLog(){
        $this->db->delete('log', "`id` != 0");
    }
}