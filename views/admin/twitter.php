<div id="maincolumn">
 
    <h2 class="main twitter"><?php echo lang('module_twitter_title'); ?></h2>
 
    <div class="subtitle">
 
        <!-- About this module -->
        <p class="lite">
            <?php echo lang('module_twitter_about'); ?>
        </p>
    </div>
</div>

<div id="moduleTwitterUsersList"></div>
 
<script type="text/javascript">
 
    // Init the panel toolbox is mandatory
    ION.initModuleToolbox('twitter','twitter_toolbox');
    // Update the authors list
    ION.HTML(
            'module/twitter/user/get_list',      // URL to the controller
            {},                                 // Data send by POST. Nothing
            {'update':'moduleTwitterUsersList'}  // JS request options
    );
 
 
</script>