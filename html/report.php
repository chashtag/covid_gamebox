
<?php session_start();
if(!isset($_SESSION['report_name']) || empty($_SESSION['report_name'])){
    header("Location: index.php?error=1");
    die();
}else{
    include 'templates/core.php';
} ?>

<main role="main" class="inner cover">
    <h1 class="cover-heading"></h1>
    <p class="lead">
    <?php printf("Report %s ready",$_SESSION['report_name']); ?>
    </p>
    <p class="lead">
      <a href=" <?php printf("reports/%s.html",$_SESSION['report_name']); ?>" class="btn btn-lg btn-secondary">View Report</a>
      <br>
      <sub>To download right click and save as</sub>
    </p>
</main>

  <?php include 'templates/footer.php';?>