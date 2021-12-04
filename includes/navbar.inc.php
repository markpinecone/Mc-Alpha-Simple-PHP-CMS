<div id="main-container">
<nav class="navbar">
            <ul class="">
                <li>
                    <a class="nav-link" href="../index.php">Public</a>
                </li>

                <?php
                if (!$_SESSION["LoggedIn"]) {

                    echo '<li> <a class="nav-link " href="/admin/Login.php">Login</a> </li>';

                } else {

                    echo '<li><a class="nav-link" href="/admin/index.php">Admin</a></li>';
                    echo '<li> <a class="nav-link " href="/admin/logout.php">Logout</a> </li>';
                }
                ?>
                <!-- <li>
                    <a class="nav-link " href="/admin/subscribe.php">Sign Up</a>
                </li> -->
            </ul>
</nav>