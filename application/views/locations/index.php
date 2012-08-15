<div>
	<table>
	<thead>
		<tr>
			<td colspan="6">Found <?php echo $num_locations; ?> locations</td>
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
			<td><?php echo $location->pilot; ?><span class="search_link"><?php echo anchor(current_url() . '?pilot=' . $location->pilot, '[?]'); ?></span></td>
			<td><?php echo timespan(strtotime($location->date)),' ago'; ?></td>
			<td><?php echo $location->station; ?></td>
			<td><?php echo $location->system; ?><span class="search_link"><?php echo anchor(current_url() . '?system=' . $location->system, '[?]'); ?></span></td>
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
