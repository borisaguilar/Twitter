<ul class="authorPanelList list mb20 mt10">
 
    <?php foreach($usersx as $u) :?>
 
    <?php
    $id = $u['id_user'];
    ?>
 
    <li class="user<?php echo $id ?> pointer" id="user_<?php echo $id ?>" data-id="<?php echo $id ?>">
        <a class="icon drag left"></a>
        <a class="left pl5 edit title" data-id="<?php echo $id ?>">
            <?php print_r($u) ?>
        </a>
    </li>
 
    <?php endforeach ;?>
 
</ul>