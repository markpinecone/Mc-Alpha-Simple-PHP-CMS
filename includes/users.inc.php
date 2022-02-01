<?php

if (isset($_GET["delete"])) {
    echo '<div><h3>User will be deleted</h3>';
    echo '<from method="GET" action=""><button type="submit" name="accept" value="accept">Confirm</button>  ';
    echo '<button type="submit" name="cancel" value="cancel">Cancel</button></form></div>';
}


if (isset($_GET["accept"])) {
    $id = (int)	$_GET["delete"];
    try {
        deleteRow($conn, 'users', $id, 'Users');
    } catch (Exception $e) {
        echo 'Caught exception: ' . $e->getMessage() . '<br>';
    }
} elseif (isset($_GET["cancel"])) {
    header("Location: /admin/index.php?action=users");
    exit();
}



if (isset($_POST["update"]) && $_GET["action"] == 'users') {
    $email = test_input($_POST["email"]);
    $name = test_input($_POST["name"]);
    $lastname = test_input($_POST["lastname"]);
    $role = test_input($_POST["role"]);
    $id = (int) $_GET["edit"];
    if (empty($email) || empty($name) || empty($lastname) || empty($id)) {
        header("Location: /admin/index.php?action=users&edit={$id}&error=missinginput");
        exit();
    } elseif (invalidEmail($email)) {
        header("Location: /admin/index.php?action=users&edit={$id}&error=invalidemail");
        exit();
    } elseif (invalidName($name, $lastname)) {
        header("Location: /admin/index.php?action=users&edit={$id}&error=invalidname");
        exit();
    } elseif ($role != 'user' && $role != 'admin') {
        header("Location: /admin/index.php?action=users&edit={$id}&error=invalidrole");
        exit();
    } else {
        updateUser($conn, $email, $name, $lastname, $role, $id);
    }
}
