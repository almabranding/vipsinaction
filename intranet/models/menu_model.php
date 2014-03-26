<?php

class Menu_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function form($id = null) {
        $action = ($id == null) ? URL . LANG . '/menu/create' : URL . LANG . '/menu/edit/' . $id;

        $atributes = array(
            'enctype' => 'multipart/form-data',
        );

        $form = new Zebra_Form('addProject', 'POST', $action, $atributes);
        if ($id !=null)
            $element=$this->getMenu($id);
        
        $form->add('hidden', '_add', 'project');
        $form->add('label', 'label_link', 'link', 'Link type:');
        $obj = $form->add('select', 'link', $element['page_id']);
        $options = array(
            '#' => 'Extern',
        );
        foreach ($this->getPagesList() as $page) {
            $options[$page['id']] = $page['name'];
        };
        $obj->add_options($options, true);
        $form->add('label', 'label_url', 'url', 'URL:');
        $form->add('text', 'url', $element['url']);

        foreach ($this->_langs as $lng) {
            if ($type == 'edit')
                $element = $this->getDescrption($id, $lng);
            $form->add('label', 'label_name_' . $lng, 'name_' . $lng, 'Link name (' . $lng . '):');
            $form->add('text', 'name_' . $lng, $element['name'], array('autocomplete' => 'off', 'required' => array('error', 'Name is required!')));
        }
        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function sort() {
        foreach ($_POST['sort'] as $key => $value) {
            $data = array(
                'position' => $key
            );
            $this->db->update('menus', $data, "`id` = '{$value}'");
        }
        exit;
    }

    public function create() {    
        $page=$this->getPages($_POST['link']);
        $link = ($_POST['link'] != '#') ? array('id' => $page['id'], 'url' => '/'.$page['template'].'/view/'.$page['name']) : array('id' => '#', 'url' => $_POST['url']);
        $data = array(
            'page_id' => $link['id'],
            'updated_at' => $this->getTimeSQL(),
            'created_at' => $this->getTimeSQL()
        );
        $id = $this->db->insert('menus', $data);
        unset($data);
        foreach ($this->_langs as $lng) {
            $data['menu_id'] = $id;
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['url'] = $link['url'];
            $this->db->insert('menus_description', $data);
        }
        return $id;
    }

    public function edit($id) {            
        $page=$this->getPages($_POST['link']);
        $link = ($_POST['link'] != '#') ? array('id' => $page['id'], 'url' => '/'.$page['template'].'/view/'.$page['name']) : array('id' => '#', 'url' => $_POST['url']);
        
        $data = array(
            'page_id' => $link['id'],
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('menus', $data, "`id` = '{$id}'");
        unset($data);
        foreach ($this->_langs as $lng) {
            $data['menu_id'] = $id;
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['url'] = $link['url'];
            $exist = $this->db->select("SELECT * FROM menus_description WHERE menu_id=" . $id . " AND `language_id`='" . $lng . "'");
            if (sizeof($exist))
                $this->db->update('menus_description', $data, "`menu_id` = '{$id}' AND `language_id` = '{$lng}'");
            else
                $this->db->insert('menus_description', $data);
        }
    }

    public function delete($id) {
        $this->db->delete('menus', "`id` = {$id}");
        $this->db->delete('menus_description', "`menu_id` = {$id}");
    }

    public function getMenu($id, $lng = LANG) {
        return $this->db->selectOne("SELECT * FROM menus m JOIN menus_description md ON md.menu_id=m.id WHERE m.id=" . $id . ' AND language_id="' . $lng . '"');
    }

    public function getMenuList() {
        return $this->db->select("SELECT * FROM menus ORDER by position");
    }

    public function getPages($id, $lng = 'en') {
        return $this->db->selectOne("SELECT *, p.id FROM pages p JOIN pages_description pd ON pd.page_id=p.id WHERE p.id=" . $id . ' AND language_id="' . $lng . '"');
    }

    public function getPagesList() {
        return $this->db->select("SELECT *, p.id as id FROM pages p JOIN pages_description pd ON pd.page_id=p.id WHERE language_id='" . LANG . "'");
    }

    public function getDescrption($id, $lang = LANG) {
        return $this->db->selectOne("SELECT * FROM menus_description WHERE menu_id=" . $id . ' AND language_id="' . $lang . '"');
    }

    public function toTable($lista) {
        $b['sort'] = true;
        $b['title'] = array(
            array(
                "title" => "Name",
                "width" => "40%"
            ), array(
                "title" => "Url",
                "width" => "10%"
            ), array(
                "title" => "Options",
                "width" => "10%"
        ));
        foreach ($lista as $key => $value) {
            $menu = $this->getDescrption($value['id']);
            $b['values'][] = array(
                        "Name" => $menu['name'],
                        "Url" => $menu['url'],
                        "Options" => '<a href="' . URL . LANG . '/menu/view/' . $value['id'] . '"><button title="Edit" type="button" class="edit"></button></a><button type="button" title="Delete" class="delete" onclick="secureMsg(\'Do you want to delete this menu?\',\'menu/delete/' . $value['id'] . '\');"></button>',
                        "sortId" => $value['id'],
            );
        }
        return $b;
    }

}
