<form id="mainform" action="">
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table" class='<?=($this->list['sort']) ? 'sortable' : '' ?>'>      
        <?php
        if (!$this->list || !$this->list['values'])
            exit;
        echo ' <tr id="titleTable">';
        foreach ($this->list['title'] as $k => $value) {
            $style = 'width:' . $value['width'];
            $colspan = 'colspan="' . $value['colspan'] . '"';
            $nolink = (!$value['link'] || $value['link'] == '#') ? ' class="noOrder "' : '';
            echo '<th class="table-header-repeat line-left minwidth-1" style="text-transform:capitalize;' . $style . '" ' . $colspan . '><a' . $nolink . ' href="' . $value['link'] . '">' . $value['title'] . '</a></th>';
        }
        echo '</tr>';
        foreach ($this->list['values'] as $k => $row) {
            if(!$this->list['noRow'])$alternate = (($k % 2) == 0) ? 'alternate-row' : '';
            $classRow=$this->list['classRow'][$k];
            echo '<tr id="'.$row['sortId'].'" class="'.$alternate.' '.$classRow.'">';
            foreach ($row as $key=>$value) {
                if($key!='sortId') echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }
        ?>
    </table>
</form>