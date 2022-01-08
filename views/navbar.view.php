<nav id="navbar">
    <ul>
        <li>
            <a class="nav-link" href="/index.php">Home</a>
        </li>
        <?php
        // Load Pages from Database
        if (checkTableExists($conn, 'Pages')) {
            getPages($conn);
        }
        if (!isset($_SESSION["login-status"])) {
            echo '<li style="float: right; background-color: teal;"> <a class="nav-link " href="/index.php?action=login">Login</a> </li>';
            echo '<li style="float: right;"> <a class="nav-link " href="/index.php?action=signup">Sign Up</a> </li>';
        } else {
            echo '<div class="right">
				<li style="background-color: crimson;"> <a href="/index.php?action=logout">Logout</a> </li></div>';
        }
        ?>
    </ul>
</nav>
