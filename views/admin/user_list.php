<ul class="usersPanelList list mb20 mt10">
 
    <?php foreach($usersx as $u) :?>
 
    <?php
    $id = $u['id_user'];
    ?>
 
    <li class="user<?php echo $id ?> pointer" id="user_<?php echo $id ?>" data-id="<?php echo $id ?>">
        <a class="icon delete right"></a>
        <a class="left pl5 edit title" data-id="<?php echo $id ?>">
            <?php echo $u['username'] ?>
        </a>
    </li>
 
    <?php endforeach ;?>
 
</ul>
<script type="text/javascript">
 
    // Click Event to display the details of one creator
    $$('.usersPanelList li').each(function(item, idx)
    {
        var id = item.getProperty('data-id');
        var a = item.getElement('a.title');
        var del = item.getElement('a.delete');
 
        a.removeEvents('click');
        a.addEvent('click', function(e)
        {
            // see : /themes/admin/javascript/ionize/ionize_window.js
            // ION.formWindow : function(id, form, title, wUrl, wOptions, data)
            ION.formWindow(
                    'user' + id, // ID of the window
                    'userForm' + id, // ID of the author form
                    'module_twitter_title_edit_user', // term of the window title
                    'module/twitter/user/get/' + id, // URL of the controller
                    {
                        'width':350,
                        'height':200
                    }
            );
        });
        ION.initRequestEvent(
                del, // The item to add the event on
                admin_url + 'module/twitter/user/delete/' + id, // URL to call
                {}, // Data to send. Here nothing.
                // Confirmation object
                {
                    'confirm': true,
                    'message': Lang.get('ionize_confirm_element_delete')
                }
        );
    });
 
</script>