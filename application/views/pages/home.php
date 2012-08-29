<div>
	<p>To view the entire list of locations click on View Locations above.</p>
</div>
<div>
	<table>
	<thead>
		<tr>
			<td colspan="6">Found <?php echo $num_locations; ?> locations<span id="refresh_box"><input type="checkbox" id="do_refresh"/>Refresh Automatically</span></td>
		</tr>
		<tr>
			<?php foreach ($fields as $title => $field): ?>
			<th><?php echo $title; ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($locations as $location):?>
		<tr>
			<td>
				<?php echo $location->pilot; ?>
				<span class="bc_link">
					<a href="http://eve.battleclinic.com/killboard/combat_record.php?type=player&name=<?php echo rawurlencode($location->pilot); ?>#losses" target="_new">[bc]</a>
				</span>
				<span class="search_link">
					<?php echo anchor('locations?pilot=' . $location->pilot, '[?]'); ?>
				</span>
			</td>
			<td><?php echo timespan(strtotime($location->date)),' ago'; ?></td>
			<td><?php echo $location->station; ?></td>
			<td>
				<span class="set_system">
					<a href="#" id="<?php echo $location->system_id; ?>"><?php echo $location->system; ?></a>
				</span>
				<span class="dl_link">
					<a href="http://evemaps.dotlan.net/map/<?php echo str_replace(' ', '_', $location->region) ?>/<?php echo $location->system?>#sec" target="_new">[dl]</a>
				</span>
				<span class="search_link">
					<?php echo anchor('locations?system=' . $location->system, '[?]'); ?>
				</span>
			</td>
			<td><?php echo $location->constellation; ?><span class="search_link"><?php echo anchor('locations?constellation=' . $location->constellation, '[?]'); ?></span></td>
			<td><?php echo $location->region; ?><span class="search_link"><?php echo anchor('locations?region=' . $location->region, '[?]'); ?></span></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	</table>
</div>
