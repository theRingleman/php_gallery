<?php
  include("includes/header.php");
  if (!$session->is_signed_in()) {
    redirect('login.php');
  }
?>

  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <?php include('includes/top_nav.php'); ?>
    <?php include('includes/sidebar_nav.php') ?>

    <!-- /.navbar-collapse -->
  </nav>

  <div id="page-wrapper">

    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          Blank Page
          <small>Subheading</small>
        </h1>
        <ol class="breadcrumb">
          <li>
            <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
          </li>
          <li class="active">
            <i class="fa fa-file"></i> Blank Page
          </li>
        </ol>

        <?php
          $users = User::all();
          foreach ($users as $user) {
            echo $user->username .  " - " . $user->first_name . "<br>";
          }
          $user = User::find_by_id(2);
          echo "<hr>";
          echo $user->last_name;
        ?>

      </div>
    </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>
