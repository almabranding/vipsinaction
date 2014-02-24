<?php

class Pages_Model extends Model {

    public function __construct() {
        parent::__construct();
    }
    public function homeForm($type = 'add', $id = 'null') {
        $action = ($type == 'add') ? URL . LANG . '/pages/create' : URL . LANG . '/pages/edit/' . $id;
        
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );

        $form = new Zebra_Form('addProject', 'POST', $action, $atributes);
        $element=$this->getPages($id);
        $form->add('hidden', '_add', 'project');
        $form->add('label', 'label_template', 'template', 'Template:');
        $obj = $form->add('select', 'template', $element['template']);
        $templates=$this->getTemplates();
        foreach($templates as $template){
            $options[$template['name']]=$template['name'];
        }
        $obj->add_options($options, true);
        foreach ($this->_langs as $lng) {
            if ($type == 'edit')
                $element=$this->getDescrption($id,$lng);
            $obj = $form->add('label', 'label_name_' . $lng, 'name_' . $lng, 'Page name '.$lng.':');
       
            $obj = $form->add('text', 'name_' . $lng, $element['name'], array('autocomplete' => 'off', 'required' => array('error', 'Name is required!')));

            $obj = $form->add('label', 'label_content_' . $lng, 'content_' . $lng, 'Content ' . $lng);
            $obj->set_attributes(array(
                'style' => 'float:none',
            ));
            $obj = $form->add('textarea', 'content_' . $lng, $element['content'], array('autocomplete' => 'off'));
            $obj->set_attributes(array(
                'class' => 'wysiwyg',
            ));
        }
        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }
    public function sort(){
        foreach($_POST['foo'] as $key=>$value){
            $data = array(
                'position' => $key
            );
             $this->db->update('pages', $data, 
            "`photo_id` = '{$value}' AND `section_id` = '{$_POST['id']}'");
        }
        exit;
    }
    public function create() {
        $data = array(
            'template' => $_POST['template'],
            'updated_at' => $this->getTimeSQL(),
            'created_at' => $this->getTimeSQL()
        );
        $id = $this->db->insert('pages', $data);
        unset($data);
        $data['page_id']=$id;
        foreach ($this->_langs as $lng) {
            $data['language_id']=$lng;
            $data['name']=$_POST['name_'.$lng];
            $data['content']=$_POST['content_'.$lng];
            $this->db->insert('pages_description', $data);
        }
        return $id;
    }
    

    public function edit($id) {
        $data = array(
            'template' => $_POST['template'],
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('pages', $data, "`id` = '{$id}'");
        unset($data);
        foreach ($this->_langs as $lng) {
            $data['page_id']=$id;
            $data['language_id']=$lng;
            $data['name']=$_POST['name_'.$lng];
            $data['content']=$_POST['content_'.$lng];
            $exist=$this->db->select("SELECT * FROM pages_description WHERE page_id=".$id." AND `language_id`='".$lng."'");
            if(sizeof($exist))
                $this->db->update('pages_description', $data, "`page_id` = '{$id}' AND `language_id` = '{$lng}'");
            else
                $this->db->insert('pages_description', $data);
        }
    }
    public function delete($id) {
        $this->db->delete('pages', "`id` = {$id}");
        $this->db->delete('pages_description', "`page_id` = {$id}");
    }
    public function getTemplates() {
        return $this->db->select("SELECT * FROM templates");
    }
    public function getPagesList() {
        return $this->db->select("SELECT * FROM pages ORDER by position");
    }
    public function getPages($id) {
        return $this->db->selectOne("SELECT * FROM pages WHERE id=".$id);
    }
    public function getDescrption($id,$lang=LANG) {
        return $this->db->selectOne("SELECT * FROM pages_description WHERE page_id=".$id.' AND language_id="'.$lang.'"');
    }
    public function toTable($lista) {
        $b['sort']=true;
        $b['title']=array(
          array(
               "title"  =>"Section",
               "width"  =>"60%"
           ),array(
               "title"  =>"Template",
               "width"  =>"10%"
           ),array(
               "title"  =>"Options",
               "width"  =>"10%"
           ));       
        foreach($lista as $key => $value) {
            $pageinfo=$this->getPages($value['id']);
            $page=$this->getDescrption($value['id']);
            $b['values'][]=   
            array(
                "Section"   =>$page['name'],
                "Template"   =>$pageinfo['template'],
                "Options"  =>'<a href="'.URL.LANG.'/pages/view/'.$value['id'].'"><button title="Edit" type="button" class="edit"></button></a><button type="button" title="Delete" class="delete" onclick="secureMsg(\'Do you want to delete this page?\',\'pages/delete/'.$value['id'] . '\');"></button>'
            );
        }
        return $b;
    }

}