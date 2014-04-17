<?php

class Model {

    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    function endConn() {
        $this->db = null;
    }

    function getUser($id = null) {
       if($id!=null) return $this->db->selectOne('SELECT * FROM ' . BID_PREFIX . 'users WHERE id = :id', array('id' => $id));
    }

    function getGallery($id) {
        return $this->db->select('SELECT * FROM photos WHERE page = :page ORDER BY orden', array('page' => $id));
    }

    function setLang($lang) {
        $this->lang = $lang;
    }

    public function loadLang($name = null) {
        $langPath = 'lang/' . LANG . '/';
        require $langPath . 'default.php';
        $path = $langPath . $name . '.php';
        if (file_exists($path)) {
            require $path;
        }
        $this->lang = $lang;
    }

    public function getImageById($id) {
        $img = $this->db->selectOne('SELECT * FROM photos WHERE id = :id', array('id' => $id));
        return $this->getRouteImg($img['created_at']) . $img['file_name'];
    }

    public function getType($id = null) {
        $type = array(0 => 'accommodation', 1 => 'experience');
        if ($id == null)
            return $type;
        else
            return $type[$id];
    }

    public function getSections($id = null, $lang = LANG) {
        if ($id == null)
            return $this->db->select("SELECT *,p.created_at as img FROM home_sections s JOIN home_sections_description sd ON sd.home_sections_id=s.id JOIN photos p ON p.id=s.photo_id WHERE sd.language_id=:lang ORDER by position", array('lang' => $lang));
        else
            return $this->db->selectOne("SELECT *,p.created_at as img FROM home_sections s JOIN home_sections_description sd ON sd.home_sections_id=s.id JOIN photos p ON p.id=s.photo_id WHERE s.id=:id sd.language_id=:lang ORDER by position", array('id' => $id, 'lang' => $lang));
    }

    public function getSectionsByName($name, $lang = LANG) {
        return $this->db->selectOne("SELECT *,p.created_at as img FROM home_sections s JOIN home_sections_description sd ON sd.home_sections_id=s.id JOIN photos p ON p.id=s.photo_id WHERE sd.name LIKE :name AND sd.language_id=:lang ORDER by position", array('name' => $name, 'lang' => $lang));
    }

    public static function getRouteImg($date) {
        $timestamp = strtotime($date);
        return date("Y", $timestamp) . '/' . date("m", $timestamp) . '/';
    }

    public static function getTimeReverse($time) {
        $fecha = date_create_from_format('d-m-Y', $time);
        return date_format($fecha, 'Y-m-d');
    }

    public static function getTimeStamp($sqlTime) {
        $timestamp = strtotime($sqlTime);
        return date("d M Y G:i", $timestamp);
    }

    public function getTimeSQL() {
        return date("Y-m-d G:i:s");
    }

    public static function getTime($sqlTime) {
        $timestamp = strtotime($sqlTime);
        return date("d-m-Y", $timestamp);
    }

    public static function getRemaingTime($sqlTime) {
        $a = new DateTime(date('Y-m-d h:i:s', $sqlTime));
        $b = new DateTime(date('Y-m-d h:i:s', time()));
        $fecha = $a->diff($b);
        if ($sqlTime > time())
            return $fecha;
        else
            return false;
    }

    public static function CheckMoney($amount) {
        if (!preg_match('#^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(\.[0-9]{0,3})?$#', $amount))
            return false;
        //if (!preg_match('#^([0-9]+|[0-9]{1,3}(\.[0-9]{3})*)(,[0-9]{0,3})?$#', $amount))
        //return false;
        return true;
    }

    function input_money($str) {
        $str = str_replace('.', ',', $str);
        return number_format($str,2,',','.');
        
    }
    function recortar_texto($texto, $limite=50){  
    $texto = trim($texto);
    $texto = strip_tags($texto);
    $tamano = strlen($texto);
    $resultado = '';
    if($tamano <= $limite){
        return $texto;
    }else{
        $palabras = explode(' ', $texto);
        foreach($palabras as $palabra){
            if(strlen($resultado)+strlen($palabra).' '<$limite) $resultado.=$palabra.' ';
        }
        $resultado = substr($resultado, 0, -1);
        $resultado .= '...';
    }  
    return $resultado;
}

}
