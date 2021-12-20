<?php

if (isset($_GET['error'])) {
    handleMessage($_GET['error'], "error");
} elseif (isset($_GET['notify'])) {
    handleMessage($_GET['notify'], "notify");
}
function handleMessage($message, $type) {
    if ($type === "error") {
        switch ($message) {
            case "stmtfailure":
                echo "<div class='alert'>Statement failed</div>";
                break;
            case "missinginput":
                echo "<div class='alert'>Please fill required fields</div>";
                break;
            case "invalidemail":
                echo "<div class='alert'>Please provide valid e-mail address</div>";
                break;
            case "invalidname":
                echo "<div class='alert'>Please provide valid first name and last name</div>";
                break;
            case "passmatch":
                echo "<div class='alert'>Password didn't match</div>";
                break;
            case "emailexist":
                echo "<div class='alert'>User with provided e-mail already exists</div>";
                break;
            default:
                break;
            }
       } elseif ($type === "notify") {
            switch ($message) {
                case "usersuccess":
                    echo "<div class='notify'>User created successfully</div>";
                    break;
                case "pagesuccess":
                    echo "<div class='notify'>Page created successfully</div>";
                    break;
                default:
                    break;
            }
        }
}

