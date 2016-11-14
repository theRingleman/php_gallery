<?php include("includes/header.php"); ?>

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
          $user = new User;
          $all_users = $user->find_all_users();
          while ($row = mysqli_fetch_array($all_users)) {
            echo $row["username"] . "<br>";
          }
        ?>

      </div>
    </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>
