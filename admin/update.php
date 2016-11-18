<?php
  require_once('includes/header.php');

  $username = $user->username;
  $password = $user->password;
  $first_name = $user->first_name;
  $last_name = $user->last_name;
  $message = "";

  if (!$session->is_signed_in()) {
    redirect("login.php");
  }

  if (isset($_POST['submit'])) {
    $username = ($_POST["username"]);
    $password = ($_POST['password']);
    $first_name = ($_POST['first_name']);
    $last_name = ($_POST['last_name']);

    $user->username = $username;
    $user->password = $password;
    $user->first_name = $first_name;
    $user->last_name = $last_name;

    if($user->update()){
      redirect('index.php');
    }else{
      $message = "You fucked something up...";
    }
  }

?>

<div class="col-md-4 col-md-offset-3">

  <h2 class="text-primary">Update User Information</h2>

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
			<label for="username">First Name</label>
			<input type="text" class="form-control" name="first_name" value="<?php echo htmlentities($first_name); ?>" >
		</div>

    <div class="form-group">
			<label for="username">Last Name</label>
			<input type="text" class="form-control" name="last_name" value="<?php echo htmlentities($last_name); ?>" >
		</div>

		<div class="form-group">
		<input type="submit" name="submit" value="Submit" class="btn btn-primary">
		</div>
	</form>
</div>
