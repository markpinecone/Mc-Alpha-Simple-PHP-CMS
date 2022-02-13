<?php
function updateSettings($conn, $id, $value)
{
    $settingsQuery = "UPDATE Settings SET value=? WHERE id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $settingsQuery)) {
        header("location: /admin/index.php?action=settings&edit={$id}&error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ii", $value, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /admin/index.php?action=settings&edit={$id}&notify=updatesuccess");
    exit();
}