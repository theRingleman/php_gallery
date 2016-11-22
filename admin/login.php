<?php
  require_once('includes/header.php');

  $username = "";
  $password = "";
  $message = "";

  if ($session->is_signed_in()) {
    redirect("index.php");
  }

  if (isset($_POST['submit'])) {
    $username = ($_POST["username"]);
    $password = ($_POST['password']);
    $user = User::verify_user($username, $password);
    if ($user) {
      $session->login($user);
    }else{
      $message = "Your username or password are incorrect";
    }
  }

?>

<div class="col-md-4 col-md-offset-3">

  <h2 class="text-primary">Login</h2>

	<h4 class="bg-danger"><?php if (isset($message)) {echo $message;}; ?></h4>

	<form id="login-id" action="" method="post">
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >
		</div>

		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
		</div>

		<div class="form-group">
		<input type="submit" name="submit" value="Submit" class="btn btn-primary">
		</div>
	</form>
  <a href="signup.php">Or Signup</a>
</div>
