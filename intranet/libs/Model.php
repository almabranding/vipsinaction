<?php
class Model {
    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        //$this->delTree(CACHE);
    }
    function endConn() {
        $this->db = null;
    }
    function getMenu($id=null,$column=null){
        $column=($column==null)?'*':$column;
        if($id==null)return $this->db->select("SELECT * FROM menu WHERE parent=0");
        else $consulta=$this->db->select('SELECT '.$column.' FROM menu WHERE id = :id', 
            array('id' => $id));
        if($column==null) return $consulta;
        else return $consulta[0][$column];
    }
    function getTemplate($id=null,$column=null){
        $column=($column==null)?'*':$column;
        if($id==null)return $this->db->select("SELECT * FROM template");
        else $consulta=$this->db->select('SELECT '.$column.' FROM template WHERE id = :id', 
            array('id' => $id));
        if($column==null) return $consulta;
        else return $consulta[0][$column];
    }
    function delTree($dir) { 
        if(!is_dir($dir)) return false;
        $files = array_diff(scandir($dir), array('.','..')); 
         foreach ($files as $file) { 
           (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file"); 
         } 
        return rmdir($dir); 
    } 
    public function getPageInfo($id){
         $consulta=$this->db->select('SELECT * FROM page WHERE id = :id', 
            array('id' => $id));
         return $consulta;
    }
    public function getTimeStamp($sqlTime){
        $timestamp = strtotime($sqlTime);
        return date("d M Y G:i",$timestamp);
    }
    public function getTimeSQL(){
        return date("Y-m-d G:i:s");
    }
    public function getRouteImg($date) {
        $timestamp = strtotime($date);
        return date("Y",$timestamp).'/'.date("m",$timestamp).'/';
     }
    public function getPagination($now,$numpp,$table,$url,$order=null){
        $sth = $this->db->prepare("SELECT * FROM ".$table);
        $sth->execute();
        $sth->fetch();
        $count =  $sth->rowCount();
        $pagination['url']=$url;
        $pagination['min']=1;
        $pagination['now']=(int)$now;
        $pagination['max']=(int)($count/$numpp);
        $pagination['order']=$order;
        return $pagination;
    }
    public function getPaginationCond($now,$numpp,$table,$where,$url,$order=null){
        $sth = $this->db->prepare("SELECT * FROM ".$table.' '.$where);
        $sth->execute();
        $sth->fetch();
        $count =  $sth->rowCount();
        $pagination['url']=$url;
        $pagination['min']=1;
        $pagination['now']=(int)$now;
        $pagination['max']=(int)($count/$numpp);
        $pagination['order']=$order;
        return $pagination;
    }
    public function idToRute($id) {
       $id=str_pad($id, 9, "0", STR_PAD_LEFT);
       $folder=str_split($id,3);
       foreach($folder as $value){
           $rute.=$value.'/';
       } 
       return $rute;
    }
    public function uploadFile($sub = '', $name = 'pic') {
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc');
        $allowed_img = array('jpg', 'jpeg', 'png', 'gif');
        if (!is_dir(UPLOAD))
            mkdir(UPLOAD);
        $uploadDir = UPLOAD . $sub . '/';
        if (!is_dir($uploadDir)) mkdir($uploadDir);
        if (array_key_exists($name, $_FILES) && $_FILES[$name]['error'] == 0) {
            $pathinfo = pathinfo($_FILES[$name]["name"]);
            $nameFile = (file_exists($uploadDir . $_FILES[$name]["name"])) ? $pathinfo['filename'] . '_' . rand() : $pathinfo['filename'];
            $file = $nameFile . '.' . $pathinfo['extension'];
            if (!in_array($pathinfo['extension'], $allowed_img))
                exit;
            if (move_uploaded_file($_FILES[$name]['tmp_name'], $uploadDir . $file)) {
                $data['img'] = true;
                if ($pathinfo['extension'] == 'png') {
                    $this->png2jpg($uploadDir . $file, $uploadDir . $nameFile . '.jpg');
                    $file = $nameFile . '.jpg';
                }
                $data['file'] = $file;
                $data['nameFile'] = $nameFile;
                $data['file_size'] = filesize($uploadDir . $file);
                list($data['width'], $data['height'], $imgType, $atributos) = getimagesize($uploadDir . $file);
                $data['file_content_type'] = image_type_to_mime_type($imgType);
                return $data;
            }
        }
        return false;
    }
    public function png2jpg($originalFile, $outputFile, $quality = 100) {
        $image = imagecreatefrompng($originalFile);
        imagejpeg($image, $outputFile, $quality);
        unlink($originalFile);
        imagedestroy($image);
    }
    public function getType($id=null){
        $type=array(0=>'accommodation',1=>'experience');
        if($id==null)return $type;
        else return $type[$id];
    }
    public function getSections($id=null,$lang=LANG) {
        if($id==null)return $this->db->select("SELECT *,p.created_at as img FROM home_sections s JOIN home_sections_description sd ON sd.home_sections_id=s.id JOIN photos p ON p.id=s.photo_id WHERE sd.language_id=:lang ORDER by position",array('lang'=>$lang));
        else return $this->db->selectOne("SELECT *,p.created_at as img FROM home_sections s JOIN home_sections_description sd ON sd.home_sections_id=s.id JOIN photos p ON p.id=s.photo_id WHERE s.id=:id AND sd.language_id=:lang ORDER by position",array('id'=>$id,'lang'=>$lang));
    }

}