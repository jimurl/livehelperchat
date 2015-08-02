<?php include(erLhcoreClassDesign::designtpl('lhchat/lists_titles/pendingchats.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhchat/lists/search_panel.tpl.php')); ?>

<?php if ($pages->items_total > 0) { ?>

<form action="<?php echo $input->form_action,$inputAppend?>" method="post">

<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhchat/lists_chats_parts/append_table_class.tpl.php'));?>

<table cellpadding="0" cellspacing="0" class="table<?php echo $appendTableClass?>" width="100%">
    <thead>
        <tr>
        	<th width="1%"><input class="mb0" type="checkbox" ng-model="check_all_items" /></th>
            <th width="1%">ID</th>
            <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/pendingchats','Information');?></th>
            <th width="1%"></th>
        </tr>
    </thead>
    <?php foreach ($items as $chat) : ?>
    <tr>
    	<td><input ng-checked="check_all_items" class="mb0" type="checkbox" name="ChatID[]" value="<?php echo $chat->id?>" /></td>
        <td><?php echo $chat->id?></td>
        <td>
          <?php if ( !empty($chat->country_code) ) : ?><img src="<?php echo erLhcoreClassDesign::design('images/flags');?>/<?php echo $chat->country_code?>.png" alt="<?php echo htmlspecialchars($chat->country_name)?>" title="<?php echo htmlspecialchars($chat->country_name)?>" />&nbsp;<?php endif; ?>
          <a class="action-image material-icons" data-title="<?php echo htmlspecialchars($chat->nick,ENT_QUOTES);?>" onclick="lhinst.startChatNewWindow('<?php echo $chat->id;?>',$(this).attr('data-title'))" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/pendingchats','Open in a new window');?>">open_in_new</a>
	      
	      <?php if ($can_delete_global == true || ($can_delete_general == true && $chat->user_id == $current_user_id)) : ?>
	      <a class="csfr-required material-icons" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/pendingchats','Reject chat');?>" href="<?php echo erLhcoreClassDesign::baseurl('chat/delete')?>/<?php echo $chat->id?>">delete</a>
	      <?php endif;?>
	      
	      <?php echo $chat->id;?>. <?php echo htmlspecialchars($chat->nick);?> (<?php echo date(erLhcoreClassModule::$dateDateHourFormat,$chat->time);?>) (<?php echo $chat->department;?>)
        </td>
        <td><?php if ($chat->fbst == 1) : ?><i class="icon-thumbs-up up-voted"></i><?php elseif ($chat->fbst == 2) : ?><i class="icon-thumbs-down down-voted"><?php endif;?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?>

<?php if (isset($pages)) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
<?php endif;?>

<input type="submit" name="doDelete" class="btn btn-danger" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Delete selected');?>" />

</form>

<?php } else { ?>
<p><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/pendingchats','Empty...');?></p>
<?php } ?>
