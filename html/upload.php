<?php
session_start();
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
// Check if image file is a actual image or fake image
if(isset($_FILES["file_upload"])) {
    $name = $_FILES["file_upload"]["tmp_name"];
    $report_name = hash('sha1', random_bytes(24));

    $target_file = sprintf('%/uploads/%s', getcwd(), $report_name);
    move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file);

    $cmd = sprintf('/usr/bin/nipper --input=%s --output=%s/reports/%s.html', $target_file, getcwd(), $report_name);
    
    $output = '';
    $ret_val = -1;
    exec($cmd, $output, $ret_val);


    if($ret_val === 0){
        $_SESSION["report_name"] = $report_name;
        header("Location: report.php");
    }else{
        header("Location: index.php?error=1");
    }
    die();
}
?>