<?php
session_start();
$con=mysqli_connect("localhost","root","","lms");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/php/LMS/');
define('SITE_PATH','http://localhost/LMS/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/image/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/image/');
?>