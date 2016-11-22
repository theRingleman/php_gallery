<?php include("includes/header.php"); ?>
<?php
  redirect_if_not_logged_in();
  $users = User::all();
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
            USERS
          </h1>
          <ol class="breadcrumb">
            <li>
              <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
            </li>
            <li class="active">
              <i class="fa fa-file"></i> Users
            </li>
          </ol>

          <ul>
            <?php foreach($users as $user) : ?>
              <li><?php echo $user->username . " - " . $user->get_full_name(); ?></li>
            <?php endforeach ?>
          </ul>

        </div>
      </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>
