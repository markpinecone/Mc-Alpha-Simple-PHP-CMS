<?php
function checkEmail($stmt, $query) {
    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo "SQL statement failed";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            $userexist = false;
        }else {
            $userexist = true;
        }

    }

    return $userexist;
}
