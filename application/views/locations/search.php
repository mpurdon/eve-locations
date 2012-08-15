<?php echo form_open('locations/search') ?>
<div>
<?php echo form_label('Pilot', 'pilot'); ?>
<?php echo form_input('pilot', set_value('pilot'), 'id="title"'); ?>
<?php echo form_error('pilot'); ?>
</div>
<div>
<?php echo form_label('System', 'system'); ?>
<?php echo form_input('system', set_value('system'), 'id="system"'); ?>
<?php echo form_error('system'); ?>
</div>
<div>
<?php echo form_label('Constellation', 'constellation'); ?>
<?php echo form_input('constellation', set_value('constellation'), 'id="constellation"'); ?>
<?php echo form_error('constellation'); ?>
</div>
<div>
<?php echo form_label('Region', 'region'); ?>
<?php echo form_input('region', set_value('region'), 'id="region"'); ?>
<?php echo form_error('region'); ?>
</div>
<div>
<?php echo form_submit('action', 'Search'); ?>
</div>
<?php echo form_close() ?>
