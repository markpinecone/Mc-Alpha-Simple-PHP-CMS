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
    } else {
        return true;
    }
}


function emptyInput($email, $name, $lastname, $password, $repeatPassword)
{
    $empty;
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
    $empty;
    if (empty($email) || empty($password)) {
        $empty = true;
    } else {
        $empty = false;
    }
    return  $empty;
}

function invalidEmail($email)
{
    $invalid;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $invalid = true;
    } else {
        $invalid = false;
    }
    return $invalid;
}

function invalidName($name, $lastname)
{
    $invalid;
    $regex = '/^[a-zA-Z]*$/';
    if (!preg_match($regex, $name) or !preg_match($regex, $lastname)) {
        $invalid = true;
    } else {
        $invalid = false;
    }
    return $invalid;
}

function passwordMatch($password, $repeat)
{
    $match;
    if ($password === $repeat) {
        $match = true;
    } else {
        $match = false;
    }
    return $match;
}

function emailExist($conn, $email)
{
    $answer;
    $emailQuery = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $emailQuery)) {
        header("location: /signup.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        $answer = false;
        return $answer;
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
    header("location: /signup.php?error=none");
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