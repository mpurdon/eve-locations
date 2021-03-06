<div>
	<ul>
		<li>Click on a column name to sort</li>
		<li>Click on a [?] link to filter by that value</li>
		<li>Click the [bc] link to see the pilot's Battleclinic losses</li>
		<li>Click the [dl] link to see the dotlan security map for the system</li>
		<li>Click on the system name to set that system as your destination</li>
	</ul>
	<table>
	<thead>
		<tr>
			<td colspan="6">Found <?php echo $num_locations; ?> locations<span id="refresh_box"><input type="checkbox" id="do_refresh"/>Refresh Automatically</span></td>
		</tr>
		<tr>
			<?php foreach ($fields as $title => $field): ?>
			<th<?php if($field==$sort_by): ?> class="sort_<?php echo $sort_dir; ?>"<?php endif; ?>>
			<?php echo anchor('locations/'.$field.'/'.(($field==$sort_by && $sort_dir=='asc') ? 'desc':'asc').(strlen($_SERVER['QUERY_STRING']) > 0 ? '?' . $_SERVER['QUERY_STRING'] : ''), $title); ?>
			</th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($locations as $location):?>
		<tr>
			<td>
				<?php echo $location->pilot; ?><?php if (strlen($location->ship_type) > 0 && $location->ship_type != 'unknown'): ?>&nbsp;&lt;<?php echo $location->ship_type; ?>&gt;<?php endif; ?>
				<span class="bc_link">
					<a href="http://eve.battleclinic.com/killboard/combat_record.php?type=player&name=<?php echo rawurlencode($location->pilot); ?>#losses" target="_new">[bc]</a>
				</span>
				<span class="search_link">
					<?php echo anchor(current_url() . '?pilot=' . $location->pilot, '[?]'); ?>
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
					<?php echo anchor(current_url() . '?system=' . $location->system, '[?]'); ?>
				</span>
			</td>
			<td><?php echo $location->constellation; ?><span class="search_link"><?php echo anchor(current_url() . '?constellation=' . $location->constellation, '[?]'); ?></span></td>
			<td><?php echo $location->region; ?><span class="search_link"><?php echo anchor(current_url() . '?region=' . $location->region, '[?]'); ?></span></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	</table>

	<?php if(strlen($pagination) > 0): ?>
	<div>
	Pages: <?php echo $pagination; ?>
	</div>
	<?php endif; ?>
</div>
