<?php

if(!isLoggedIn())
{
    header("location: /index.php?action=login");
    exit();
}

function fetchData($conn, $field, $id, $table)
{
    if ($_GET["action"] == "profile") {
        if ($id) {
            require INCLUDE_DIR . '/dbh.inc.php';
            $data = getDataRows($conn, $id, $table);
            return $data[$field];
        } else {
            header("location: /index.php?action=profile&error=fetchfailure");
            exit();
        }
    }
    return ($_POST['$field'] ?? '');

}

$userid = $_SESSION["id"];

echo '<div class="mt-3 fw-bold h3">';
echo 'Welcome'. ' ' . fetchData($conn,'name', $userid, 'users') . ' ' . fetchData($conn,'lastname', $userid, 'users'). '!';
echo '</div>';
?>
<div class="container ">
    <div style="max-width:220px !important;">
        <img class="img-fluid img-thumbnail" src="/static/avatars/<?php echo getAvatarImgName($conn, $userid); ?>">
    </div>
    <form class="w-50" method="post" action="" enctype="multipart/form-data">
        <div class="form-group col-md-4 mt-3 mb-3">
            <label class="form-label fw-bold mb-3" for="filename">Upload Avatar</label>
            <input class="form-control btn btn-secondary mb-3" type="file" id="img" name="img">
            <input class="btn btn-primary" type="submit" name="upload" value="Upload">
        </div>
    </form>
</div>
<div class="mt-3 container justify-content-between" id="form">
    <form class="float-start w-50" method="post" action="">

        <!-- Email input -->
        <div class="form-group col-md-4 mb-3">
            <label class="form-label" for="email">E-Mail</label>
            <input type="email" name='email' value="<?php
            echo fetchData($conn,'email', $userid, 'users');
            ?>" id="email" class="form-control">
        </div>
        <div class="form-group col-md-4 mb-3">
            <label class="form-label" for="name">Name</label>
            <input class="form-control" id="name" type="name" name='name' value="<?php
            echo fetchData($conn,'name', $userid, 'users');
            ?>">
        </div>
        <div class="form-group col-md-4 mb-3">
            <label class="form-label" for="lastname">Last name</label>
            <input class="form-control" id="lastname" type="lastname" name='lastname' value="<?php
            echo fetchData($conn,'lastname', $userid, 'users');
            ?>">
        </div>
        <div class="form-group col-md-4 mb-3">
            <label class="form-label" for="Display Name">Display name</label>
            <input class="form-control" id="display_name" type="display_name" name='display_name' value="<?php
            echo fetchData($conn,'display_name', $userid, 'users');
            ?>">
        </div>
        <?php
        echo '<button class="btn btn-primary" type="submit" value="update_profile" name="update_profile" class="">Change profile info.</button>';

        ?>
    </form>
</div>

