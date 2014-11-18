<?php
    $id = $id_user;
?>
 
<form name="userForm<?php echo $id ?>" id="userForm<?php echo $id ?>" action="<?php echo admin_url() ?>module/twitter/user/save">
 
    <!-- Hidden fields -->
    <input id="id_user<?php echo $id ?>" name="id_user" type="hidden" value="<?php echo $id ?>" />
    <input id="lastupdate<?php echo $id ?>" name="lastupdate" type="hidden" value="<?php echo $lastupdate ?>" />
 
    <!-- username -->
    <dl class="small">
        <dt>
            <label for="username<?php echo $id ?>"><?php echo lang('module_twitter_label_username')?></label>
        </dt>
        <dd>
            <!--
                The validation of this mandatory field is first done by JS
                by adding the attribute data-validators="required"
                see : <a href="http://mootools.net/docs/more/Forms/Form.Validator#Validators" target="_blank">http://mootools.net/docs/more/Forms/Form.Validator#Validators</a>
            -->
            <input id="username<?php echo $id ?>" name="username" class="inputtext required" type="text" value="<?php echo $username ?>" data-validators="required"/>
        </dd>
    </dl>

    <!-- accesstoken -->
    <dl class="small">
        <dt>
            <label for="accesstoken<?php echo $id ?>"><?php echo lang('module_twitter_label_accesstoken')?></label>
        </dt>
        <dd>
            <input id="accesstoken<?php echo $id ?>" name="accesstoken" class="inputtext required" type="text" value="<?php echo $accesstoken ?>" data-validators="required"/>
        </dd>
    </dl>

    <!-- accesstokensecret -->
    <dl class="small">
        <dt>
            <label for="accesstokensecret<?php echo $id ?>"><?php echo lang('module_twitter_label_accesstokensecret')?></label>
        </dt>
        <dd>
            <input id="accesstokensecret<?php echo $id ?>" name="accesstokensecret" class="inputtext required" type="text" value="<?php echo $accesstokensecret ?>" data-validators="required"/>
        </dd>
    </dl>

    <!-- consumerkey -->
    <dl class="small">
        <dt>
            <label for="consumerkey<?php echo $id ?>"><?php echo lang('module_twitter_label_consumerkey')?></label>
        </dt>
        <dd>
            <input id="consumerkey<?php echo $id ?>" name="consumerkey" class="inputtext required" type="text" value="<?php echo $consumerkey ?>" data-validators="required"/>
        </dd>
    </dl>

    <!-- consumersecret -->
    <dl class="small">
        <dt>
            <label for="consumersecret<?php echo $id ?>"><?php echo lang('module_twitter_label_consumersecret')?></label>
        </dt>
        <dd>
            <input id="consumersecret<?php echo $id ?>" name="consumersecret" class="inputtext required" type="text" value="<?php echo $consumersecret ?>" data-validators="required"/>
        </dd>
    </dl>

    <!-- max_time_difference -->
    <dl class="small">
        <dt>
            <label for="max_time_difference<?php echo $id ?>"><?php echo lang('module_twitter_label_max_time_difference')?></label>
        </dt>
        <dd>
            <input id="max_time_difference<?php echo $id ?>" name="max_time_difference" class="inputtext required" type="text" value="<?php echo $max_time_difference ?>" data-validators="validate-integer required"/>
        </dd>
    </dl>

 
</form>
 
<!-- Save / Cancel buttons
   Must be named bSave[windows_id] where 'window_id' is the used ID
   or the window opening through ION.formWindow()
-->
<div class="buttons">
    <button id="bSaveuser<?php echo $id ?>" type="button" class="button yes right"><?php echo lang('ionize_button_save_close') ?></button>
    <button id="bCanceluser<?php echo $id ?>"  type="button" class="button no right"><?php echo lang('ionize_button_cancel') ?></button>
</div>
 
<script type="text/javascript">
 
    // Autogrow textareas of the given form ID
    ION.initFormAutoGrow('userForm<?php echo $id ?>');
 
</script>