<div class="content homeContent">
    <ul class="rslides" id="slider1">
        <? foreach ($this->banner as $value) { ?>
            <li><img src="<?php echo UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . 'original/' . $value['file_file_name']; ?>" alt="<?= $value['caption'] ?>"></li>

        <? } ?>
    </ul>

    <div id="top_content">
        <h2><span class="inner"><?= $this->lang['latest_campaigns']; ?></span></h2>
        <ul id="latest-campaigns" class="model-list">
            <? foreach ($this->latest as $value) { ?>
                <li><a href="<?= $value['link'] ?>"><span class="photo"><img src="<?php echo UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . $value['file_file_name']; ?>"  alt='<?= $value['caption'] ?>' /></span><span class="name"><?= $value['content_' . LANG] ?></span></a></li>
            <? } ?>
        </ul>

        <h2><span class="inner"><?= $this->lang['most_wanted']; ?>!</span></h2>
        <ul id="most-wanted" class="model-list">
            <? foreach ($this->wanted as $value) { ?>
                <li><a href="<?= $value['link'] ?>"><span class="photo"><img src="<?php echo UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . $value['file_file_name']; ?>"  alt='<?= $value['caption'] ?>' /></span><span class="name"><?= $value['content_' . LANG] ?></span></a></li>
            <? } ?>

        </ul>
    </div>

    <div id="sidebar">
        <h2><span class="inner"><?= $this->lang['fashion_shows']; ?></span></h2>
    <div style="position:relative;">
       

            <? if ($this->vimeo) {
                $value = $this->vimeo[0]; ?>
         <div id="catwalk" classid="" width="372" height="556" rel="<?=$value['vimeo'] ?>">
                            <object width="408" height="650">
                    <param name="allowfullscreen" value="true" />
                    <param name="allowscriptaccess" value="always" />
                    <param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?= $value['vimeo'] ?>&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1&amp;autoplay=1&amp;loop=1" />
                    <embed src="http://vimeo.com/moogaloop.swf?clip_id=<?=$value['vimeo'] ?>&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1&amp;autoplay=1&amp;loop=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="408" height="650"></embed>
                </object>
                <!--                <iframe id="player1" src="//player.vimeo.com/video/<? //$value['vimeo'] ?>?api=1&player_id=player1&amp;title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=1" width="408" height="650" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>-->
            <div class="videoLabel" id="videoLabel"><?= $value['content_' . LANG] ?></div>

        </div>
                    <? } ?>
            
        <a id="" href="http://shows.sight-management.com/" target="_blank"><img class="capaVideo" src="<? echo URL ?>public/images/capaVideo.png"></a>
        <button  id="silenceVimeo" style="display:none">Silence</button>
    </div>
        <a id="" href="http://shows.sight-management.com/" target="_blank"><div id="videoLabel2" class="videoLabel" style="display: none;"><?= $value['content_' . LANG] ?></div></a>
    </div>
    <div id="coverBlog">

        <h2><span class="inner"><?= $this->lang['on_cover']; ?></span></h2>
        <ul id="cover" class="cover-list">
            <? foreach ($this->cover as $value) { ?>
                <li><a href="<?= $value['link'] ?>"><span class="photo"><img src="<?php echo UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . $value['file_file_name']; ?>"  alt='<?= $value['caption'] ?>' /></span><span class="name"></span></a></li>
<? } ?>
        </ul>

        <h2><span class="inner"><?= $this->lang['latest_blog']; ?></span></h2>
        <iframe id="frameBox" src="latestPosts.php" frameborder="0" marginheight="0" marginwidth="0" style="width:100%; height: 280px; overflow:hidden;">Loading...</iframe>          
    </div>
    <div class="clr"></div>
</div>
<div class="clr"></div>
<div id="white_full" class="promotion hide"><div id="closeX"><img src="<?=URL?>public/images/closeX_white.png"></div></div>
<div id="white_box" class="promotion hide">
    <img src="<?=UPLOAD.'sight_christmas.jpg'?>">
</div>
