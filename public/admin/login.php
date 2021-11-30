<?php
session_start();
require_once '../../vendor/autoload.php';
require INCLUDE_DIR . '/header.inc.php';
require INCLUDE_DIR . '/navbar.inc.php';
require INCLUDE_DIR . '/login.inc.php';
?>

<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/draw2.png"
                    class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method="get" action="">

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="user" name='user' id="form3Example3" class="form-control form-control-lg"
                            placeholder="Enter a valid user name" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <input type="password" name='password' id="form3Example4" class="form-control form-control-lg"
                            placeholder="Enter password" />
                    </div>
                    <button type="submit" value="Submit" name="submit" class="btn btn-primary align-middle">Log In</button>

                </form>
            </div>
        </div>
    </div>

</section>

<?php
require INCLUDE_DIR . '/footer.inc.php';
?>