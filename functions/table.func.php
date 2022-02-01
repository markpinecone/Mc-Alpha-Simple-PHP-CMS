<?php

function showTable($conn, $array, $dbtable)
{
    $query = "SELECT * FROM {$dbtable}";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        //pass
    } else {
        mysqli_stmt_execute($stmt);
        $stmtResult = mysqli_stmt_get_result($stmt);
    }
    // Table headers
    echo '<table class="table table-light table-striped"><tr>';
    echo '<th></th>';
    while (current($array)) {
        $header = key($array);
        echo '<th class="col-md-auto">' . $header . '</th>';
        next($array);
    }
    echo '<th class="col-md-1">EDIT</th>';
    echo '<th class="col-md-1">DELETE</th>';
    echo '</tr>';
    // Table rows
    echo '<tr>';
    while ($row = mysqli_fetch_assoc($stmtResult)) {
        echo '<td><input type="checkbox" class="" name="row[]" value="'.$row["id"].'"></td>';
        foreach ($array as $key => $value) {
            echo '<td>' . $row[$value] . '</td>';
        }
        echo '<td><a href="/admin/index.php?action='.strtolower($dbtable).'&edit='. $row["id"].'"><i class="bi bi-pencil-square text-success"></i></a></td>';
        echo '<td><a href="/admin/index.php?action='.strtolower($dbtable).'&delete='. $row["id"].'"><i class="bi bi-trash-fill text-danger"></i></a></td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<button class="btn btn-warning mt-1 mb-3"  type="submit" value="delete" name="delete">Delete selected</button>';
}
