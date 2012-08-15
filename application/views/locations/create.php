<h2>Record a War Target Location</h2>
<p>Paste the notification from your locator agent into the form below.</p>

<?php echo validation_errors(); ?>

<?php echo form_open('locations/create'); ?>
<div>
	<?php echo form_label('Notice', 'notice'); ?>
	<textarea rows="10" columns="135" name="notice"></textarea><br />
</div>
</div>
	<input type="submit" name="submit" value="Save" /><a href="/locations">Cancel</a>
</div>
<?php echo form_close(); ?>
