<nav id="navbar">
    <ul class="">
        <li>
            <a class="nav-link" href="../index.php">Home</a>
        </li>

        <?php
        if (!isset($_SESSION["login-status"])) {
            echo '<li style="float: right; background-color: teal;"> <a class="nav-link " href="/login.php">Login</a> </li>';
            echo '<li style="float: right;"> <a class="nav-link " href="/signup.php">Sign Up</a> </li>';
        } else {
            echo '<div class="right">';
            if (isAdmin()) {
                echo '
                <li><a href="/admin/index.php">Admin Panel</a></li>
                <li><a href="/admin/index.php?action=pages">Pages</a></li>
                <li><a href="/admin/index.php?action=users">Users</a></li>';
            }
            echo '<li style="background-color: crimson;"> <a class="nav-link " href="/logout.php">Logout</a> </li>';
        }
        echo '</div>';
        ?>
    </ul>
</nav>