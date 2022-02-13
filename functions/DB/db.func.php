<?php

function fetchInputData($field, $id, $table)
{
    if (isAdmin() && isset($_GET["edit"])) {
        if ($id) {
            require INCLUDE_DIR . '/dbh.inc.php';
            $data = getDataRows($conn, $id, $table);
            return $data[$field];
        } else {
            header("location: /admin/index.php?action=pages&error=fetchfailure");
            exit();
        }
    }
    return ($_POST['$field'] ?? '');

}

function checkTableExists($conn, $table): bool
{
    $query = "SHOW TABLES LIKE '{$table}'";
    $stmt = mysqli_stmt_init($conn);
    $result = false;
    if (!mysqli_stmt_prepare($stmt, $query)) {
        // pass
    } else {
        mysqli_stmt_execute($stmt);
        $stmtResult = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($stmtResult) > 0) {
            $result = true;
        }
    }
    mysqli_stmt_close($stmt);
    return $result;
}

function countTableRows($conn, $table): int|string
{
    $query = "SELECT * FROM {$table}";
    $stmt = mysqli_stmt_init($conn);
    $result = 0;
    if (!mysqli_stmt_prepare($stmt, $query)) {
        //pass
    } else {
        mysqli_stmt_execute($stmt);
        $stmtResult = mysqli_stmt_get_result($stmt);
        $result = mysqli_num_rows($stmtResult);
    }

    mysqli_stmt_close($stmt);
    return $result;
}

function deleteRow($conn, $id, $table): void
{
    $userQuery = "DELETE FROM {$table} WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $userQuery)) {
        header("location: /admin/index.php?action=".strtolower($table)."&error=stmtfailed)");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function getDataRows($conn, $id, $table)
{
    // Fetches data from DB to be inserted in USER/PAGE update form
    $userQuery = "SELECT * FROM {$table} WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $userQuery)) {
        header("location: /signup.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($stmtResult)) {
        mysqli_stmt_close($stmt);
        return $row;
    }
    mysqli_stmt_close($stmt);
}