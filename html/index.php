
<?php include 'templates/core.php';?>

<main role="main" class="inner cover">
    <h1 class="cover-heading"></h1>
    <p class="lead">
    Welcome to the Cisco Online Vulnerability Inspector Device.
    </p>
    <?php if(isset($_GET["error"])) : ?>
    <p><strong style="color: red;">Not a vaild config!</strong></p>
    <?php endif; ?>
    <br/><br/><br/><br/>
    <p>
    Upload a Cisco IOS config to get started. <br/>
    <sub><a href='example.cfg'>Need a sample config to test?</a></sub>
    </p>
    <form action="/upload.php" method="POST" enctype="multipart/form-data">
  <div class="custom-file">
    <input type="file" class="custom-file-input" name="file_upload" id="file_upload">
    <label class="custom-file-label" for="customFile">Choose file</label>
    <br><br>
    <button type="submit" name="submit" class="btn btn-primary">Upload</button>
  </div>
  
</form>

<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
  </main>

  <?php include 'templates/footer.php';?>