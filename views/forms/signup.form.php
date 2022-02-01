<?php
echo($_GET["action"] !== "users" ? '<h3 class="mt-3">User Sign Up</h3>' : '<h3 class="mt-3">Change user details</h3>');
if (isset($_GET["edit"]) && !empty($_GET["edit"])) {
    $userid = (int) $_GET["edit"];
} else {
    $userid = null;
}
function fetchInputData($field, $id, $table)
{
    if (isAdmin() && isset($_GET["edit"])) {
        if ($id) {
            require INCLUDE_DIR . '/dbh.inc.php';
            $data = getDataRows($conn, $id, $table);
            return $data[$field];
        } else {
            header("location: /admin/index.php?action=users&error=fetchfailure");
            exit();
        }
    } else {
        return (isset($_POST['$field']) ? $_POST['$field'] : '');
    }
}

?>
    <div id="form">
        <form method="post" action="">

        <!-- Email input -->
        <div class="form-group col-md-4 mb-3">
          <label class="form-label" for="email">E-Mail</label>
				  <input type="email" name='email' value="<?php
                        echo fetchInputData('email', $userid, 'users');
                    ?>" id="email" class="form-control">
        </div>
        <div class="form-group col-md-4 mb-3">
          <label class="form-label" for="name">Name</label>  
          <input class="form-control" id="name" type="name" name='name' value="<?php
                        echo fetchInputData('name', $userid, 'users');
                    ?>">
        </div>
        <div class="form-group col-md-4 mb-3">
          <label class="form-label" for="lastname">Last name</label>
          <input class="form-control" id="lastname" type="lastname" name='lastname' value="<?php
                        echo fetchInputData('lastname', $userid, 'users');
                    ?>">
          </div>
          <div class="form-group col-md-4 mb-3">
            <label class="form-label" for="Display Name">Display name</label>
            <input class="form-control" id="display_name" type="display_name" name='display_name' value="<?php
                        echo fetchInputData('display_name', $userid, 'users');
                      ?>">
          </div>
          <?php
            if (isset($_GET["edit"])) {
                echo '<div class="form-group col-md-4 mb-3">' .
              '<label class="form-label" for="role">Role:</label>' .
              '<select class="form-select" name="role">' .
              '<option value="user">User</option>' .
              '<option value="admin">Admin</option>' .
              '</select></div>' .
              '<button class="btn btn-secondary mb-3" type="update" value="update" name="update" class="">Update User</button>';
            }
          ?>
        <!-- Password input -->
        <div class="form-group col-md-4 mb-3">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" id="password" type="password" name='pass'>
        </div>
        <div class="form-group col-md-4 mb-3">
            <label class="form-label" for="repeat">Repeat password</label>
            <input id="repeat" class="form-control" type="password" name='repeat-pass'>
        </div>
			<?php
                if ($_GET["action"] != 'users') {
                    echo '<button class="btn btn-primary" type="submit" value="submit" name="submit" class="">Sign Up</button>';
                } else {
                    echo '<button class="btn btn-secondary mb-3" type="submit" value="updatepass" name="updatepass" class="">Change Password</button>';
                }
            ?>
        </form>
    </div>
