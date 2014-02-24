<ul class="pagination">     
        <?php 
        $min=$this->pagination['min'];
        $max=$this->pagination['max'];
        $now=$this->pagination['now'];
        $url=$this->pagination['url'];
        $order=$this->pagination['order'];
        for($i=$min;$i<=$max;$i++) {
            $sel=($i==$now)?'pagSelected':'';
            if(($i<=3 || $i>$max-3)) echo '<a href="'.URL.LANG.'/'.$url.'/'.$i.'/'.$order.'"><li class="'.$sel.'">'.$i.'</li></a>';
            if($i==4 && $i<$now-5) echo '...';
            if(($i>3 && $i<=$max-3)){
                if($i>=$now-5 && $i<=$now+5) echo '<a href="'.URL.LANG.'/'.$url.'/'.$i.'/'.$order.'"><li class="'.$sel.'">'.$i.'</li></a>';
                
            }
            if($i==$max-4 && $i>$now+5) echo '...';
        }
        ?>
</ul>