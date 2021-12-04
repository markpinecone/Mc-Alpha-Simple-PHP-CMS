<div id="main-container">
<nav class="navbar">
            <ul class="">
                <li>
                    <a class="nav-link" href="../index.php">Public</a>
                </li>

                <?php
                if (!isset($_SESSION["LoggedIn"])) {

                    echo '<li> <a class="nav-link " href="/login.php">Login</a> </li>';

                } else {

                    if ($_SESSION['role'] == 'admin') {
                        echo '<li><a class="nav-link" href="/admin/index.php">Admin</a></li>';
                    }
                    echo '<li> <a class="nav-link " href="/logout.php">Logout</a> </li>';
                }
                ?>
            </ul>
</nav>