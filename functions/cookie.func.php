<?php

function loggedIn()
{
    if (isset($_SESSION["LoggedIn"])) {
        return true;
    } elseif (isset($_COOKIE["logged-in"])) {
        $_SESSION["LoggedIn"] = true;
        $_SESSION["email"] = $_COOKIE["logged-in"];
        return true;
    } else {
        return false;
    }
}