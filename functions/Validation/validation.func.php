<?php

function isLoggedIn(): bool
{
    if (isset($_SESSION["login-status"])) {
        return true;
    } elseif (isset($_COOKIE["logged-in"])) {
        $_SESSION["login-status"] = true;
        $_SESSION["id"] = $_COOKIE["logged-in"];
        return true;
    }
    return false;
}

function isAdmin(): bool
{
    if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
        return false;
    }
    return true;
}

function emptyInput($email, $name, $lastname, $password, $repeatPassword, $display_name): bool
{
    if (empty($email) || empty($name) || empty($lastname) || empty($password) || empty($repeatPassword) || empty($display_name)) {
        $empty = true;
    } else {
        $empty = false;
    }
    return $empty;
}

function emptyLoginInput($user, $password): bool
{
    if (empty($user) || empty($password)) {
        $empty = true;
    } else {
        $empty = false;
    }
    return $empty;
}

function invalidEmail($email): bool
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $invalid = true;
    } else {
        $invalid = false;
    }
    return $invalid;
}

function invalidName($name, $lastname): bool
{
    $regex = '/^[a-zA-Z]*$/';
    if (!preg_match($regex, $name) || !preg_match($regex, $lastname)) {
        $invalid = true;
    } else {
        $invalid = false;
    }
    return $invalid;
}

function passwordMatch($password, $repeat): bool
{
    if ($password === $repeat) {
        $match = true;
    } else {
        $match = false;
    }
    return $match;
}

function userExist($conn, $user)
{
    $emailQuery = "SELECT * FROM users WHERE email = ? OR display_name = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $emailQuery)) {
        header("location: /signup.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $user, $user);
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($stmtResult)) {
        mysqli_stmt_close($stmt);
        return $row;
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }
}

function test_input($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}