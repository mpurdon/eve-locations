<h2>Record a War Target Sighting</h2>
<p>Using the IGB most of the form should be filled out for you.</p>

<div style="color:red;">
<p><?php echo $save_error; ?></p>
<?php echo validation_errors(); ?>
</div>

<?php echo form_open('locations/sighting', array('id'=>'form-location-sighting')); ?>
<div>
<?php echo form_label('Pilot', 'pilot'); ?>
<?php echo form_input('pilot', set_value('pilot'), 'id="title"'); ?>
</div>
<div>
<?php echo form_label('Ship', 'ship'); ?>
<?php echo form_input('ship', set_value('ship'), 'id="ship"'); ?>
</div>
<div>
<?php echo form_label('Station', 'station'); ?>
<?php echo form_input('station', set_value('station', (isset($_SERVER['HTTP_EVE_STATIONNAME'])  && $_SERVER['HTTP_EVE_STATIONNAME'] != 'None' ? $_SERVER['HTTP_EVE_STATIONNAME'] : '(in space)')), 'id="station"'); ?>
</div>
<div>
<?php echo form_label('System', 'system'); ?>
<?php echo form_input('system', set_value('system', (isset($_SERVER['HTTP_EVE_SOLARSYSTEMNAME']) ? $_SERVER['HTTP_EVE_SOLARSYSTEMNAME'] : '')), 'id="system"'); ?>
<button id="in-wormhole">Wormhole</button>
</div>
<div>
<?php echo form_label('Constellation', 'constellation'); ?>
<?php echo form_input('constellation', set_value('constellation', (isset($_SERVER['HTTP_EVE_CONSTELLATIONNAME']) ? $_SERVER['HTTP_EVE_CONSTELLATIONNAME'] : '')), 'id="constellation"'); ?>
</div>
<div>
<?php echo form_label('Region', 'region'); ?>
<?php echo form_input('region', set_value('region', (isset($_SERVER['HTTP_EVE_REGIONNAME']) ? $_SERVER['HTTP_EVE_REGIONNAME'] : '')), 'id="region"'); ?>
</div>
<?php echo form_close() ?>
<button id="submit-sighting">Add Sighting</button>
