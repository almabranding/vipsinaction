<?php
class Image_Model extends Model {
    public function __construct() {
        parent::__construct();
    }  
    public function form($type='add',$id='null') {
        $action=($type=='add')?URL.LANG.'/image/create':URL.LANG.'/image/edit/'.$id;
        if ($type=='edit')
            foreach ($this->getInfo($id) as $value);
        $group[0]='None';
        foreach ($this->getGroups($value['page']) as $groups)
            $group[$groups['pos']]=$groups['pos'].'. '.$groups['name'];
        $form = new Zebra_Form('addProject','POST',$action);
        $form->add('hidden', '_add', 'page');
        $form->add('hidden', 'page', $value['page']);
        $form->add('hidden', 'fileName', $value['img']);
        $form->add('label', 'label_name', 'name', 'Name');
        $obj = $form->add('text', 'name', $value['name'], array('autocomplete' => 'off','required'  =>  array('error', 'Name is required!')));
        
        $form->add('label', 'label_caption', 'caption', 'Caption');
        $obj = $form->add('text', 'caption', $value['caption_'.LANG], array('autocomplete' => 'off','required'  =>  array('error', 'Name is required!')));
        
        $form->add('label', 'label_description', 'description', 'Description');
        $obj=$form->add('textarea', 'description', $value['description'], array('autocomplete' => 'off'));
        
        $form->add('label', 'label_thumbPos', 'thumbPos', 'Thumbnail position(px)');
        $obj=$form->add('text', 'thumbPos', $value['thumbPos'], array('autocomplete' => 'off'));
        
        /*$form->add('label', 'label_group', 'group', 'Group');
        $obj = $form->add('select', 'group',$value['group'], array('autocomplete' => 'off'));
        $obj->add_options($group);
        
        $obj = $form->add('text', 'group', $value['group'], array('autocomplete' => 'off'));
        $obj->set_attributes(array(
            'style'    => 'width:20px',
        ));*/
        
        $form->add('label', 'label_hide', 'hide', 'Hide in gallery');
        $obj = $form->add('checkboxes', 'hide',
            array(
                '1' => ''
            )
        );
        $obj->set_attributes(array(
            'autocomplete' => 'off'
        ));
        if($value['hide']){
            $obj->set_attributes(array(
                'checked' => 'checked'
            ));
        }
        
        /*$form->add('label', 'label_replace', 'replace', 'Replace text');
        $obj = $form->add('checkboxes', 'replace',
            array(
                '1' => ''
            )
        );
        $obj->set_attributes(array(
                'autocomplete' => 'off'
            ));
        if($value['replace']){
            $obj->set_attributes(array(
                'checked' => 'checked'
            ));
        }
        */
        
        if($value['video']){
            $form->add('label', 'label_vimeo', 'vimeo', 'Vimeo ID');
            $obj = $form->add('text', 'vimeo', $value['vimeo'], array('autocomplete' => 'off'));
        }
        /*$obj=$form->add('label', 'label_info', 'info', 'Information');
        $obj->set_attributes(array(
                'style'    => 'float:none',
            ));
        $obj = $form->add('textarea', 'info', $value['info'], array('autocomplete' => 'off'));
        $obj->set_attributes(array(
            'class'    => 'wysiwyg',
        ));
         */
        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }
    public function getInfo($id){
        return $this->db->select('SELECT * FROM images WHERE id = :id', 
           array('id' => $id));
    }
    public function getGroups($page){
        return $this->db->select('SELECT * FROM imagesGroups WHERE page = :page ORDER BY pos', 
           array('page' => $page));
    }
    public function edit($id){
        $data = array(
            'name'      => $_POST['name'],
            'caption_'.LANG => $_POST['caption'],
            'description'=>$_POST['description'],
            'vimeo'     => $_POST['vimeo'],
            'group'     => $_POST['group'],
            'thumbPos'  => $_POST['thumbPos'],
            'replace'   => $_POST['replace'],
            'hide'      => $_POST['hide'],
            'info'      => stripslashes($_POST['info'])
        );
        echo $this->db->update('images', $data, 
            "`id` = '{$id}'");
            
        $uploadDir = UPLOADIMG.$_POST['page'].'/';
        if($_POST['thumb']!='') $this->createThumbs($_POST['fileName'],$uploadDir, $uploadDir, $_POST['thumb'] );
    }
    public function delete($id){
         foreach ($this->getInfo($id) as $value){
            $this->db->delete('images', "`id` = {$id}");
            @unlink(UPLOAD.$value['page'].'/'.$value['img']);
            @unlink(UPLOAD.$value['page'].'/'.$value['thumb']);
         } 
    }
    public function createThumbs($fname,$pathToImages, $pathToThumbs, $thumbWidth ) 
    {
        $info = pathinfo($pathToImages . $fname);
        if ( strtolower($info['extension']) == 'jpg' ) $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
        if ( strtolower($info['extension']) == 'png' ) $img = imagecreatefrompng( "{$pathToImages}{$fname}" );

          $width = imagesx( $img );
          $height = imagesy( $img );
          $fname='thumb_'.$fname;
          // calculate thumbnail size
          $new_width = $thumbWidth;
          $new_height = floor( $height * ( $thumbWidth / $width ) );
          $data['w']=$new_width;
          $data['h']=$new_height;
          // create a new temporary image
          $tmp_img = imagecreatetruecolor( $new_width, $new_height ); 
          // copy and resize old image into new image 
          imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
          // save thumbnail into a file
          imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
          return $data;

    }
}