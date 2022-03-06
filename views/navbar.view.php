<!-- Navbar -->
<div class="container">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
            data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="#">
                <img src="/static/img/htp.png" height="30" alt="CMS101"
                    loading="lazy" />
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?action=home">Home</a>
                </li>
                <?php
                // Load Pages from Database
                  if (checkTableExists($conn, 'Pages')) {
                      getAllPages($conn);
                  }
                ?>
 
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    if (!isset($_SESSION["login-status"])) {
                        echo '<li class="nav-item"> <a class="nav-link" href="/index.php?action=signup">Sign Up</a> </li>';
                        echo '<li class="nav-item rounded-pill" style="background-color: teal;"> <a class="nav-link" href="/index.php?action=login">Login</a> </li>';
                    } else {
                        if (isAdmin()) {
                            echo '<li class="nav-item ml-3">'.
                                '<a class="nav-link" href="/admin/index.php"><i class="bi h3 bi-gear-fill"></i></a>';
                        }
                        if (isLoggedIn()) {

                            echo '<li class="nav-item ml-3">'.
                                '<a class="nav-link" href="/index.php?action=messages"><i class="bi bi-envelope h3 position-relative"></i><span class="position-absolute top-10 start-10
                                     translate-middle badge rounded-pill bg-danger">'.
                                      countUnreadMessages($conn)
                                      .'<span class="visually-hidden">unread messages</span></span></a>'.
                                '<li class="nav-item ml-3">'.
                                '<a class="nav-link" href="/index.php?action=profile"><i class="bi h3 bi-person-circle"></i></a>';
                        }
                        echo '<li class="">'.
                             '<a class="btn btn-danger mt-1" href="/index.php?action=logout">Logout</a>';
                    }
                    ?>
 
                </ul>
            </div>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
  </div>
</nav>
</div>
<div class="container">
<!-- Navbar -->
