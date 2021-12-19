<?php
session_start();
require_once '../config/config.php';
require INCLUDE_DIR . '/header.inc.php';
require INCLUDE_DIR . '/navbar.inc.php';
require INCLUDE_DIR . '/login.inc.php';
require FUNCTIONS_DIR . '/functions.func.php';
if (isLoggedIn()) {
    header('Location: /index.php');
}
?>
<div id="form-container" class="center">
    <div id="form">
        <form method="post" action="">

            <!-- Email input -->
            <div class="">
                <input type="email" name='email' placeholder="Enter a valid email" />
            </div><br>

            <!-- Password input -->
            <div class="">
                <input type="password" name='pass' placeholder="Enter password" />
            </div><br>
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
            <br><br>
            <button type="submit" value="Submit" name="submit" class="">Log In</button>
        </form>
    </div>
</div>


<?php
require INCLUDE_DIR . '/footer.inc.php';
?>