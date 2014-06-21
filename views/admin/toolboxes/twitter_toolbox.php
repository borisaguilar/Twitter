<div class="divider">
    <a class="button light" id="newUserToolbarButton">
        <i class="icon-plus"></i><?php echo lang('module_twitter_button_create_user'); ?>
    </a>
</div>
 
<script type="text/javascript">
 
    $('newUserToolbarButton').addEvent('click', function(e)
    {
        ION.formWindow(
            'user',
            'userForm',
            Lang.get('module_twitter_label_new_user'),
            admin_url + 'module/twitter/user/create',
            {
               'width':350,
               'height':220
            }
        );
    });
 
</script>