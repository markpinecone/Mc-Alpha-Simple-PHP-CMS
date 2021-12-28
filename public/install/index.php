<?php
require_once '../../config/config.php';
require INCLUDE_DIR . '/dbh.inc.php';
require VIEWS_DIR . '/header.view.php';
require VIEWS_DIR . '/navbar.view.php';
require INSTALL_DIR . '/includes/install.inc.php';
?>
<div id="form">
    <h2>Site Setup</h2>
    <h1>Create Admin user</h1>
    <?php
    if (isset($_POST["db"])) {
        include INSTALL_DIR . '/db.php';
    }
    ?>
    <form method="POST" action="">
        <button type="submit" value="db" name="db">Setup Database tables</button><br><br>
        <!-- Email input -->
        <div class="">
            <input type="email" name='email' value="<?php echo (isset($_GET['email']) ? $_GET['email'] : ''); ?>" id=""
                class="" placeholder="Admin e-mail">
        </div>
        <br>
        <div class="">
            <input type="name" name='name' value="<?php echo (isset($_GET['name']) ? $_GET['name'] : ''); ?>" id=""
                class="" placeholder="First Name">
        </div>
        <br>
        <div class="">
            <input type="lastname" name='lastname'
                value="<?php echo (isset($_GET['lastname']) ? $_GET['lastname'] : ''); ?>" placeholder="Last Name">
        </div>
        <br>

        <!-- Password input -->
        <div class="">
            <input type="password" name='pass' placeholder="Enter password">
        </div>
        <br>
        <div class="">
            <input type="password" name='repeat-pass' placeholder="Repeat password">
        </div>
        <br>
        <button type="submit" value="submit" name="submit" class="">Create User</button>
    </form>
</div>
<?php
require VIEWS_DIR . '/footer.view.php';
?>