<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a href="#" class="navbar-brand mb-0 h1">CMS-ADM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ms-auto text-center">
                <li>
                    <a class="nav-link" href="../index.php">Public</a>
                </li>
                <li>
                    <a class="nav-link" href="/admin/index.php">Admin</a>
                </li>
                <?php
                if (!$_SESSION["LoggedIn"]) {
                    echo '<li> <a class="nav-link " href="/admin/Login.php">Login</a> </li>';
                } else {
                    '<li> <a class="nav-link " href="/admin/logout.php">Login</a> </li>';
                }
                ?>
                <!-- <li>
                    <a class="nav-link " href="/admin/subscribe.php">Sign Up</a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>