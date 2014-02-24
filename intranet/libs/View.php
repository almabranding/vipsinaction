<?php

class View {

    function __construct() {
        //echo 'this is the view';
    }

    public function render($name, $noInclude = false)
    {
        if ($noInclude == true) {
            require 'views/' . $name . '.php';    
        }
        else {
            require 'views/head.php';
            require 'views/header.php';
            require 'views/' . $name . '.php';
            require 'views/footer.php';    
        }
    }
    public function getView($name)
    {
        require 'views/' . $name . '.php';
    }
    function viewUploadFile($typeUpload){
        $view= '<h2 style="width:100%">Upload image</h2>
        <div id="dropbox">
            <input id="project" type="hidden" value="'.$id.'">
            <input id="typeUpload" type="hidden" value="'.$typeUpload.'">
            <input id="bbdd" type="hidden" value="images">
            <span class="message">Drop images here to upload. <br /><i></i></span>
        </div>
        <div class="file-uploads"><input id="fileinput" type="file" value="Select file" name="foto" multiple><button>Upload Image</button></div>';
        echo $view;
    }
    public function viewGrill($l) 
    { 
        $this->title=$l[0];
        unset($l[0]);
        $this->list=$l;
        $widthAuto=(100/sizeof($this->title)).'%';
        $sortable=($this->options)?'sortable':'';
        $view='<ul class="tableView "><li><ul class="colsView tableTitle">';

        foreach ($this->title as $id=>$value){
            $width=($value['value']!=null)?$value['width']:$widthAuto;
            $view.="<li style='width:".$width.";'><a>".$value['value']."</a></li>";
        }
        $view.='</ul></li><li class="tableContent"><ul class="'.$sortable.'">';
        foreach ($this->list as $id=>$value){
            $alternate=(($id%2)==0)?'alternate-row':'';
            if($value['_link']) $view.='<a href="'.$value['_link'].'">';
            $view.='<li class="'.$alternate.'"><ul class="colsView">';
            $i=0;
            foreach ($value as $subid=>$subvalue){
                if(!strstr($subid, '_')){
                    $width=($this->title[$i]['width']!=null)?$this->title[$i]['width']:$widthAuto;
                    $view.="<li  style='width:".$width.";'>$subvalue</li>";
                    $i++;
                }
            }
            $view.='</ul></li>';
            if($value['_link']) $view.='</a>';
        }
        $view.='</ul></li></ul>';
        echo $view;
    }

}