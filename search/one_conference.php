<div class="conference_preview">
<table class="conference_table">
	<tr>
		<td><a href="conference.php?id=<?= $conference->c_id ?>"><?= $conference->c_name ?></a></td>
	</tr>
	<tr>
		<td>Start Date: </td>
		<td><?= date("d, M, Y - H",strtotime($conference->c_start_date)) ?></td>
	</tr>
	<tr>
		<td>End Date: </td>
		<td><?= date("d, M, Y - H",strtotime($conference->c_end_date))  ?></td>
	</tr>
	<tr>
		<td>Duration: </td>
		<td><?= $conference->duration ?> hours</td>
	</tr>
	<tr>
		<td>Venue: </td>
		<td><?= $conference->venue ?></td>
	</tr>
</table>
</div>