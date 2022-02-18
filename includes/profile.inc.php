<?php
$id = (int)$_SESSION["id"];
// echo $_SERVER['REQUEST_URI'];
if (isset($_POST["update_profile"])) {
    if ($_GET["action"] == 'profile' &&
        !empty($_POST["email"]) &&
        !empty($_POST["name"]) &&
        !empty($_POST["lastname"]) &&
        !empty($_POST["display_name"]) &&
        !invalidEmail($_POST["email"])) {
        $email = trim($_POST["email"]);
        $name = test_input($_POST["name"]);
        $lastname = test_input($_POST["lastname"]);
        $display_name = test_input($_POST["display_name"]);
        updateProfile($conn, $email, $name, $lastname, $display_name, $id);
    } else {
        header("location: /index.php?action=profile&error=updatefailed");
        exit();
    }
}


if(isset($_FILES['img'])){
    $errors= array();
    $fileName = $_FILES['img']['name'];
    $fileSize =$_FILES['img']['size'];
    $fileTmp =$_FILES['img']['tmp_name'];
    $imgHash = md5_file($fileTmp);
    $fileType=$_FILES['img']['type'];
    $array = explode('.', $_FILES['img']['name']);
    $fileExt=strtolower(string: end(array: $array));
    $extensions= array("jpeg","jpg","png");
    $hashedFileName = $imgHash.'.'.$fileExt;

    if(!in_array($fileExt,$extensions)){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    if($fileSize > 2097152){
        $errors[]='File size must be exactly 2 MB';
    }

    if(empty($errors)){
        $staticDir = PUBLIC_DIR . '/static/avatars/';
        move_uploaded_file($fileTmp,$staticDir.$hashedFileName);
        assignAvatarImg($conn, $id, $hashedFileName);
        header("location: /index.php?action=profile&notify=upload-complete");
        exit();
    }else{
        print_r($errors);
    }
}