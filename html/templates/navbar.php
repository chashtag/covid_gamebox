
<?php
function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  
  if($currect_page == $url){
      echo 'active'; //class name in css 
  } 
}
?>

<nav class="nav nav-masthead justify-content-center">
    <a class="nav-link <?php active('');active('index.php'); ?>" href="/">Home</a>
    <a class="nav-link <?php active('about.php');?>" href="/about.php">About</a>
</nav>