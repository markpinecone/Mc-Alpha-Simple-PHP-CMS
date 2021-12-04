<div id="main-container">
<nav class="navbar">
            <ul class="">
                <li>
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php
                if (!$_SESSION["LoggedIn"]) {

                    echo '<li> <a class="nav-link " href="login.php">Login</a> </li>';
                    echo '<li> <a class="nav-link " href="sign_up.php">Sign Up</a> </li>';

                }
                ?>
            </ul>
</nav>