<?php

function isLoggedIn()
{
    if (isset($_SESSION["login-status"])) {
        return true;
    } elseif (isset($_COOKIE["logged-in"])) {
        $_SESSION["login-status"] = true;
        $_SESSION["email"] = $_COOKIE["logged-in"];
        return true;
    }
    return false;
}

function isAdmin()
{
    if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
        return false;
    } 
	return true;
}


function emptyInput($email, $name, $lastname, $password, $repeatPassword)
{
    if (
        empty($email) ||
        empty($name) ||
        empty($lastname) ||
        empty($password) ||
        empty($repeatPassword)
    ) {
        $empty = true;
    } else {
        $empty = false;
    }
    return  $empty;
}

function emptyLoginInput($email, $password)
{
    if (empty($email) || empty($password)) {
        $empty = true;
    } else {
        $empty = false;
    }
    return  $empty;
}

function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $invalid = true;
    } else {
        $invalid = false;
    }
    return $invalid;
}

function invalidName($name, $lastname)
{
    $regex = '/^[a-zA-Z]*$/';
    if (!preg_match($regex, $name) || !preg_match($regex, $lastname)) {
        $invalid = true;
    } else {
        $invalid = false;
    }
    return $invalid;
}

function passwordMatch($password, $repeat)
{
    if ($password === $repeat) {
        $match = true;
    } else {
        $match = false;
    }
    return $match;
}

function emailExist($conn, $email)
{
    $emailQuery = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $emailQuery)) {
        header("location: /signup.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($stmtResult)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $email, $pass, $name, $lastname, $role)
{
    $userQuery = "INSERT INTO users (email, pass, name, lastname, role) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $userQuery)) {
        header("location: /signup.php?error=stmtfailure");
        exit();
    }
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $email, $hashedPassword, $name, $lastname, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /signup.php?notify=usersuccess");
    exit();
}

function userLogin($conn, $email, $password, $remember)
{
    $emailExists = emailExist($conn, $email);
    if ($emailExists === false) {
        header("location: /login.php?error=incorrect");
        exit();
    }
    $hashedPass = $emailExists["pass"];
    $role = $emailExists["role"];
    $checkPass = password_verify($password, $hashedPass);
    if ($checkPass === false) {
        header("location: /login.php?error=incorrect");
        exit();
    } elseif ($checkPass === true) {
        $_SESSION["email"] = $emailExists["email"];
        $_SESSION["login-status"] = true;
        $_SESSION["role"] = $role;
        if ($remember) {
            setcookie("logged-in", $email, time() + (86400 * 30), "/");
        }
        header("location: /index.php");
        exit();
    }
}

function getPages($conn) {
    $pagesQuery = "SELECT id, title FROM pages ORDER BY orderby ASC";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $pagesQuery)) {
        header("location: /index.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($stmtResult)) {
        $num = $row["id"];
        $title = $row["title"];
        echo "<li><a href='index.php?id={$num}'>{$title}</a></li>";
    }
    mysqli_stmt_close($stmt);
}

function getContent($conn, $id) {
    $contentQuery = "SELECT * FROM pages WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $contentQuery)) {
        header("location: /index.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($stmtResult) == 1) {
        $row = mysqli_fetch_assoc($stmtResult);
        echo "<h2>".$row["title"]."</h2>";
        echo '<p>' . $row["content"] . '</p>';
    } else {
        include VIEWS_DIR . '/404.view.php';
        exit();
    }
    mysqli_stmt_close($stmt);
}

function createPage($conn, $title, $content, $order) {
    $createPageQuery = "INSERT INTO Pages (title, content, orderby) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $createPageQuery)) {
        header("location: /admin/pages.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $order);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /signup.php?notify=pagesuccess");
    exit();
}

function checkTableExists($conn, $table) {
    $query = "SHOW TABLES LIKE '{$table}'";
    $stmt = mysqli_stmt_init($conn);
    $result = false;
    if (!mysqli_stmt_prepare($stmt, $query)) {
        // pass
    } else {
        mysqli_stmt_execute($stmt);
        $stmtResult = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($stmtResult) > 0) {
            $result = true ;
        }
    }
    mysqli_stmt_close($stmt);
    return $result;
}

function countTableRows($conn, $table) {
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

function deleteRow($conn, $id, $table,)
{
    $userQuery = "DELETE FROM ? WHERE id = ?;";
	$stmt = mysqli_stmt_init($conn);
	$page = strtolower($table);	
	if (!mysqli_stmt_prepare($stmt, $userQuery)) {
        header("location: /admin/index.php?action={$page}&error=stmtfailed)");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "is", $id, $table);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /admin/index.php?action={$page}&notify=deletesuccess");
	exit();
}
