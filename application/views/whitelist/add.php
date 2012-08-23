<?php echo form_open('whitelist') ?>
<div>
	<p>It looks like your IP address is <?php echo $ip; ?> and <?php echo $in_whitelist; ?> in the whitelisted IP list.</p>
	<p>Adding an IP to the whitelist will enable you to view the tool from your computer's regular browser and not require the use of the IGB.</p>
</div>
<div>
<?php echo form_hidden('ip', $ip, 'id="ip"'); ?>
<?php echo form_error('ip'); ?>
</div>
<div>
<?php echo form_hidden('character_id', $_SERVER['HTTP_EVE_CHARID'], 'id="character_id"'); ?>
<?php echo form_error('character_id'); ?>
</div>
<div>
<?php echo form_submit('action', 'Add IP To Whitelist'); ?>
</div>
<?php echo form_close() ?>
