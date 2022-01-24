<form method="post" action="">
    <h3 class="mt-3">Sign In</h3>
    <!-- Email input -->
    <div class="form-group col-md-4 mb-3">
        <label class="form-label" for="user">E-Mail</label>
        <input class="form-control" id="user" type="user" name='user'>
    </div>
    <!-- Password input -->
    <div class="form-group col-md-4 mb-3">
        <label class="form-label" for="pass">Password</label>
        <input id="pass" class="form-control" type="password" name='pass'>
    </div>
    <input type="checkbox" id="remember" name="remember">
    <label for="remember">Remember me</label>
    <br><br>
    <button class="btn btn-primary"  type="submit" value="Submit" name="submit">Log In</button>
</form>
