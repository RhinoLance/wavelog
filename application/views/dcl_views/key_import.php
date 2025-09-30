<div class="container dcl">

	<h2><?= __("DCL Key Import"); ?></h2>

	<!-- Card Starts -->
	<div class="card">
		<div class="card-header">
			<?= __("DCL Key Management"); ?>
		</div>

		<div class="card-body">
			<div class="alert alert-info" role="alert">
				<h5><?= __("Import Key"); ?></h5>
				<?= __("You requested a key for DCL-Dataexchange, which was successful. The following data has been imported"); ?>
			</div>

			<div class="mb-3">
				<?php if (($is_valid) && ($dcl_info)) { ?>
					<b><?= __("Received a valid DCL-Key"); ?></b>
					<br/><?= __("DOK History"); ?>:
					<table class="table-sm table table-hover table-striped table-condensed dataTable">
						<tr>
						<th>DOK</th>
						<th><?= __("Validity"); ?></th>
						</tr>
				<?php 
					usort($dcl_info->DOKs, fn($a, $b) => $a->startDate <=> $b->startDate);
					foreach ($dcl_info->DOKs as $key => $value) {
						if (($value->endDate ?? '') == '') {
							$value->endDate='-------';
						} else {
							$value->endDate=date($date_format,strtotime($value->endDate));
						}
						echo "<tr>";
						echo "<td>".$value->dok."</td>";
						echo "<td>".date($date_format,strtotime($value->startDate)).' - '.$value->endDate."</td>";
						echo "</tr>";
					}
				?>
					</table>
					<br/>
					<?= __("Call History"); ?>:
					<table class="table-sm table table-hover table-striped table-condensed dataTable">
						<tr>
						<th><?= __("Call"); ?></th>
						<th><?= __("Validity"); ?></th>
						</tr>
				<?php
					usort($dcl_info->Callsigns, fn($a, $b) => $a->startDate <=> $b->startDate);
					foreach ($dcl_info->Callsigns as $key => $value) {
						if (($value->endDate ?? '') == '') {
							$value->endDate='-------';
						} else {
							$value->endDate=date($date_format,strtotime($value->endDate));
						}
						echo "<tr>";
						echo "<td>".$value->callsign."</td>";
						echo "<td>".date($date_format,strtotime($value->startDate)).' - '.$value->endDate."</td>";
						echo "</tr>";
					}
					echo "</table>";
				} else { ?>
					<b><?= __("Received an invalid DCL-Key. Please check your DCL-Login, and try again"); ?></b>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
