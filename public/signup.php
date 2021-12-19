<?php
session_start();
require '../config/config.php';
require INCLUDE_DIR . '/header.inc.php';
require INCLUDE_DIR . '/navbar.inc.php';
require INCLUDE_DIR . '/signup.inc.php';
require FUNCTIONS_DIR . '/functions.func.php';

if (isLoggedIn()) {
    header('Location: /index.php');
    die();
}

?>
<div id="form-container" class="center">
    <div id="form">
        <form method="post" action="">

            <!-- Email input -->
            <div class="">
                <input type="email" name='email' value="<?php echo (isset($_POST['email']) ? $_POST['email'] : ''); ?>"
                    id="" class="" placeholder="E-mail" />
            </div>
            <br>
            <div class="">
                <input type="name" name='name' value="<?php echo (isset($_POST['name']) ? $_POST['name'] : ''); ?>"
                    placeholder="First Name" />
            </div>
            <br>
            <div class="">
                <input type="lastname" name='lastname'
                    value="<?php echo (isset($_POST['lastname']) ? $_POST['lastname'] : ''); ?>"
                    placeholder="Last Name" />
            </div>
            <br>

            <!-- Password input -->
            <div class="">
                <input type="password" name='pass' placeholder="Enter password" />
            </div>
            <br>
            <div class="">
                <input type="password" name='repeat-pass' placeholder="Repeat password" />
            </div>
            <br>
            <button type="submit" value="submit" name="submit" class="">Sign Up</button>
        </form>
    </div>
</div>
<?php
require INCLUDE_DIR . '/footer.inc.php';
?>