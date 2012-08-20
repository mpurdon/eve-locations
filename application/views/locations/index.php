<div>
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
			<td><?php echo $location->pilot; ?><span class="bc_link"><a href="http://eve.battleclinic.com/killboard/combat_record.php?type=player&name=<?php echo urlencode($location->pilot); ?>#losses" target="_new">[bc]</a></span></span><span class="search_link"><?php echo anchor(current_url() . '?pilot=' . $location->pilot, '[?]'); ?></span></td>
			<td><?php echo timespan(strtotime($location->date)),' ago'; ?></td>
			<td><?php echo $location->station; ?></td>
			<td><?php echo $location->system; ?><span class="search_link"><?php echo anchor(current_url() . '?system=' . $location->system, '[?]'); ?></span><a class="set_system" id="<?php echo $location->system_id; ?>">[GO]</a></td>
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
