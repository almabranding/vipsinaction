<?php

class Temp_Model extends Model {

    public $_where, $_limit;

    public function __construct() {
        parent::__construct();
    }

    public function modelsSection() {
        return $this->db->select('SELECT * FROM home_photos pm JOIN photos p ON (pm.photo_id=p.id) ' . $this->_where . ' order by pm.position ' . $this->_limit);
    }

    public function getLatestPosts() {
        ini_set('default_charset', 'utf-8');
        $doc = new DOMDocument;
        @$doc->loadHTMLFile('http://blog.sight-management.com');
        $data = array();
        $nPost = 6;
        $xpath = new DOMXPath($doc);
        $elements = $xpath->query("//div[@id='theloop']//div//div//div//div//h2[@class='entry-title']//a");

        if (!is_null($elements)) {
            $i = 0;
            foreach ($elements as $element) {
                //echo $element->textContent."<br />";
                $data[$i]['title'] = $element->textContent;
                $data[$i]['link'] = $element->getAttribute('href');
                $i++;

                if ($i == $nPost)
                    break;
            }
        }

        $elements = $xpath->query("//div[@id='theloop']//div//div//div//div[@class='post-excerpt']");

        if (!is_null($elements)) {
            $i = 0;
            foreach ($elements as $element) {
                $data[$i]['desc'] = trim(strip_tags(html_entity_decode($element->textContent, ENT_QUOTES, "UTF-8")));
                $i++;
                if ($i == $nPost)
                    break;
            }
        }

        $elements = $xpath->query("//div[@id='theloop']//div//div//div//img");

        if (!is_null($elements)) {
            $i = 0;
            foreach ($elements as $element) {
                $image = '<img src="' . $element->getAttribute('src') . '">';

                if (!empty($image)) {
                    $data[$i]['img'] = '<img src="' . $element->getAttribute('src') . '">';
                } else {
                    $data[$i]['img'] = '';
                }

                $i++;
                if ($i == $nPost)
                    break;
            }
        }
        return $data;
    }

}