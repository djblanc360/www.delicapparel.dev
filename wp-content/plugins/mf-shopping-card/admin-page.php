<h1>MF Shopping Cart</h1>
<?php
    $mfscs = $wpdb->get_results(
		"
		SELECT *
		FROM $table_name
		"
	);
?>
<table style="width:100%">
	<tr style="text-align: left">
		<th>Shopping Cart ID</th>
		<th>Content</th>
		<th>Creation</th>
		<th>Last Update</th>
		<th>Delete</th>
	</tr>
<?php
	foreach ($mfscs as $mfsc) {
		echo '<tr>';
		echo '<td>' . $mfsc->id . '</td>';
		echo '<td>' . $mfsc->content . '</td>';
		echo '<td>' . $mfsc->creation_time . '</td>';
		echo '<td>' . $mfsc->modification_time . '</td>';
		echo '<td>';
		delete_cart_button($mfsc->id);
		echo '</td>';
		echo '</tr>';
	}
?>
</table>