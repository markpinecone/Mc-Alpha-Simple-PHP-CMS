<?php
// I should be using prepared statements here
function getSentMessages($conn, $id): array|false
{
    $query = "SELECT * FROM Messages WHERE from_id={$id} AND deleted_from = 0;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: /index.php?action=messages&error=stmtfailure");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($stmtResult) > 0) {
        while ($row = mysqli_fetch_assoc($stmtResult)) {
            $messages[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $messages;
    } else {
        return false;
    }
}



function getRecievedMessages($conn, $id): array|false
{
    $query = "SELECT * FROM Messages WHERE to_id={$id} AND deleted_to = 0;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: /index.php?action=messages&error=stmtfailure");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($stmtResult) > 0) {
        while ($row = mysqli_fetch_assoc($stmtResult)) {
            $messages[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $messages;
    } else {
        return false;
    }
}

function getDisplayName($conn, $id): string | false
{
    $query = "SELECT display_name FROM Users WHERE id={$id};";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: /index.php?action=messages&error=stmtfailure");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($stmtResult) > 0) {
        $result = mysqli_fetch_assoc($stmtResult);
        mysqli_stmt_close($stmt);
        return $result["display_name"];
        }
    mysqli_stmt_close($stmt);
    return false;
}

//function getUID($conn, $id): string | false
//{
//    $query = "SELECT display_name FROM Users WHERE id={$id};";
//    $stmt = mysqli_stmt_init($conn);
//    if (!mysqli_stmt_prepare($stmt, $query)) {
//        header("location: /index.php?action=messages&error=stmtfailure");
//        exit();
//    }
//    mysqli_stmt_execute($stmt);
//    $stmtResult = mysqli_stmt_get_result($stmt);
//    if (mysqli_num_rows($stmtResult) > 0) {
//        $result = mysqli_fetch_assoc($stmtResult);
//        mysqli_stmt_close($stmt);
//        return $result["display_name"];
//    }
//    mysqli_stmt_close($stmt);
//    return false;
//}

function getSingleMessage($conn, $id): array | false
{
    $query = "SELECT * FROM Messages WHERE id={$id};";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: /index.php?action=messages&error=stmtfailure");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($stmtResult) > 0) {
        $result = mysqli_fetch_assoc($stmtResult);
        mysqli_stmt_close($stmt);
        return $result;
    }
    mysqli_stmt_close($stmt);
    return false;
}

function countUnreadMessages($conn)
{
    $to_id = (int) $_SESSION["id"];
    $sql = "SELECT COUNT(has_been_read) FROM Messages WHERE to_id={$to_id} AND has_been_read=0;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: /index.php?action=messages&error=stmtfailure");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return (int) mysqli_fetch_array($result)[0];

}