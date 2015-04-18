<table class="table table-condensed">
	<thead>
		<tr>
			<th width="5%">
				#
			</th>
			<th width="90%">
				Training Name
			</th>
			<th width="5%">
				&nbsp
			</th>
		</tr>
	</thead>
	<tbody>
		<?= empty_table($user_trainings, 3, $message = 'No training found!') ?>
		<?php
		$index = 1;
		foreach ($user_trainings as $training) { ?>
			<tr>
				<td>
					<?=$index;$index++ ?>
				</td>
				<td>
					<?= $training->title ?>
				</td>
				<td>
					<span><?= $training->pivot->participate ?></span>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>