<ul id="navigation">
	<li><?php echo anchor('/', 'Home'); ?></li>
	<li><?php echo anchor('/locations', 'Recent Locations'); ?></li>
	<li><?php echo anchor('/locations/search', 'Search Locations'); ?></li>
	<li><?php echo anchor('/locations/create', 'Add a Location'); ?></li>
	<li><?php echo anchor('/locations/sighting', 'Add a Sighting', array('id'=>'add_sighting')); ?></li>
	<li><?php echo anchor('/whitelist', 'Add an IP', array('id'=>'add_ip')); ?></li>
</ul>
<form id="igb_headers">
	<?php if(array_key_exists('HTTP_EVE_SOLARSYSTEMNAME', $_SERVER)): ?>
	<input type="hidden" name="HTTP_EVE_SOLARSYSTEMID" value="<?php echo $_SERVER['HTTP_EVE_SOLARSYSTEMID']; ?>"/>
	<input type="hidden" name="HTTP_EVE_SOLARSYSTEMNAME" value="<?php echo $_SERVER['HTTP_EVE_SOLARSYSTEMNAME']; ?>"/>
	<input type="hidden" name="HTTP_EVE_CHARID" value="<?php echo $_SERVER['HTTP_EVE_CHARID']; ?>"/>
	<input type="hidden" name="HTTP_EVE_CHARNAME" value="<?php echo $_SERVER['HTTP_EVE_CHARNAME']; ?>"/>
	<?php endif; ?>
</form>
