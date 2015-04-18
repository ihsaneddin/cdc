<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title><?=  $training->slug ?></title>
        <meta name="description" content="">

        <link href="css/pure.min.css" rel="stylesheet" media="screen">

    </head>

    <body>

    	<div width="100%;">
    	<center>
    		<h2>Daftar Hadir</h2>

    		<h3>
    			<?= $training->title ?>
    		</h3>
    	</center>

    	<p>
    		Date : .....................................
    	</p>
    	<table class="pure-table" width="100%;">
			<thead>
				<tr>
					<th width="5%">
						No
					</th>
					<th width="50%">
						Nama Peserta
					</th>
					<th width="20%">
						NIM
					</th>
					<th>
						Paraf
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$list_of_attendances = $training->list_of_attendances();
				if (empty($list_of_attendances)) {
					echo empty_table($list_of_attendances, $column=4, $message = 'No attendance found!');
				}else{
					$index=1;?>

					<?php foreach ($list_of_attendances as $attendance) {?>
						<tr>
							<td>
							<?= $index;$index++ ?>
							</td>
							<td>
								<?= $attendance->full_name ?>
							</td>
							<td>
								<?=  $attendance->student_id ?>
							</td>
							<td>

							</td>
						</tr>
					<?php }?>
				<?php }?>
			</tbody>
		</table>
		</div>
    </body>

</html>
