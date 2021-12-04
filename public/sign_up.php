<?php
session_start();
require_once '../config/config.php';
require INCLUDE_DIR . '/header.inc.php';
require INCLUDE_DIR . '/navbar.inc.php';
require INCLUDE_DIR . '/sign_up.inc.php';
?>
<div id="form-container" class="center">
    <div id="form">
        <form method="get" action="">

            <!-- Email input -->
            <div class="">
                <input type="email" name='email' id="" class=""
                       placeholder="E-mail"/>
            </div>
            <br>
            <div class="">
                <input type="name" name='name' id="" class=""
                       placeholder="First Name"/>
            </div>
            <br>
            <div class="">
                <input type="lastname" name='lastname' id="" class=""
                       placeholder="Last Name"/>
            </div>
            <br>

            <!-- Password input -->
            <div class="">
                <input type="password" name='password' id="" class=""
                       placeholder="Enter password"/>
            </div>
            <br>
            <div class="">
                <input type="password" name='repeat-password' id="" class=""
                       placeholder="Repeat password"/>
            </div>
            <br>
            <button type="submit" value="Submit" name="submit" class="">Sign Up</button>
        </form>
    </div>
</div>