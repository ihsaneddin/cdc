<h3>Participants</h3>
<table class="table table-hover">
	<tr>
		<th>#</th>
		<th>Student Id</th>
		<th>Student Name</th>
		<th>&nbsp</th>
	</tr>
	<tbody>
		<?php if ($training->confirmed_participants()->isEmpty()){?>
			<tr class="danger">
				<td colspan="5">
					<center>
						No participants.
					</center>
				</td>
			</tr>
		<?php } else{?>
			<?php foreach ($training->confirmed_participants() as $index => $participant) {?>
				<tr class="<?= participant_confirmation_tr($participant->pivot->participate) ?>">
					<td>
						<?=$index+1?>
					</td>
					<td>
						<?=$participant->student_id?>
					</td>
					<td>
						<?=$participant->full_name?>
					</td>
					<td>
						<? if ($training->certifiable()) { ?>
							<?= anchor('trainings/'.$training->slug.'/certificate/'.$participant->student_id, '<i class="fa fa-print"></i>', array('title' => 'Print Certificate')) ?>
							<!--<img src="<?= $participant->avatar_url ?>", class=" img-square img-responsive" height="40" width="30">-->
						<?php } ?>
					</td>
				</tr>
			<?php }?>
		<?php }?>
	</tbody>
</table>
<span class="pull-right">
	Total participants <?= $training->participants()->count() ?>
</span>