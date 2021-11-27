<?php
session_start();
include '../header.php';
include './navbar.php';
// echo $_SERVER['DOCUMENT_ROOT']
?>

<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/draw2.png" class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4"> Repeat Password</label>
                            <input type="password" class="form-control" id="inputPassword4" placeholder="Repeat Password">
                        </div><br>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
            </div>
        </div>

        </form>
    </div>
    </div>
    </div>


    <?php
    include '../footer.php';
    ?>