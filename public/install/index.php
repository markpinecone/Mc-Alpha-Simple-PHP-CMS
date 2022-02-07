<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/static/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> 
    <title>CMS101 Setup</title>
</head>
<body>

<?php
require_once '../../config/config.php';
echo '<div class="container text-center">';
?>
  <div class="">
  <h2 class="mt-3 mb-3">Site Setup</h2>
  <h1 class="mb-3">Create Admin user</h1>
<?php
    if (isset($_POST["db"])) {
        include INSTALL_DIR . '/db.php';
}
    if (isset($_POST["submit"])) {
       include INSTALL_DIR . '/includes/install.inc.php'; 
    }



?>
  </div>
  <div class="d-flex justify-content-center">
  <form method="POST" action="">
      <button class="btn btn-primary" type="submit" value="db" name="db">Setup Database tables</button><br><br>
      <!-- Email input -->
      <div class="form-group mb-3">
          <input class="form-control col-md-4" type="email" name='email' value="<?php echo(isset($_GET['email']) ? $_GET['email'] : ''); ?>" id=""
              class="" placeholder="Admin e-mail">
      </div>
      <div class="form-group mb-3">
          <input class="form-control" type="name" name='name' value="<?php echo(isset($_GET['name']) ? $_GET['name'] : ''); ?>" id=""
              placeholder="First Name">
      </div>
      <div class="form-group mb-3">
          <input class="form-control" type="lastname" name='lastname'
              value="<?php echo(isset($_GET['lastname']) ? $_GET['lastname'] : ''); ?>" placeholder="Last Name">
      </div>
      <!-- Password input -->
      <div class="form-group mb-3">
          <input class="form-control" type="password" name='pass' placeholder="Enter password">
      </div>
      <div class="form-group mb-3">
          <input class="form-control" type="password" name='repeat-pass' placeholder="Repeat password">
      </div>
      <button class="btn btn-primary" type="submit" value="submit" name="submit" class="">Create ADM User</button>
  </form>
  </div>            
</div>
<?php
require VIEWS_DIR . '/footer.view.php';
?>
