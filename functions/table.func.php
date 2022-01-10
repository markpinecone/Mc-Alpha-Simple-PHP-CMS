<?php
function showTable($conn, $array, $dbtable) {
	$query = "SELECT * FROM {$dbtable}";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        //pass
	} else {
        mysqli_stmt_execute($stmt);
        $stmtResult = mysqli_stmt_get_result($stmt);
	}
	// Table headers
	echo '<table><tr>';
	echo '<th></th>';
	while (current($array)) {
		$header = key($array);
		echo '<th>' . $header . '</th>';
	next($array);
	}
	echo '<th>Edit</th>';
	echo '</tr>';
	// Table rows
	echo '<tr>';
	while ($row = mysqli_fetch_assoc($stmtResult)) {
		echo '<td><input type="checkbox" id="selected" name="selected" value="' . $row["id"] . '"></td>';
		foreach($array as $key => $value) {
			echo '<td>' . $row[$value] . '</td>';
		}
		echo '<td><a href="/admin/index.php?action='.strtolower($dbtable).'&edit='. $row["id"].'">Edit</a></td>';
		echo '</tr>';
	}
	echo '</table>';
}
?>
