<?php 
  session_start();
  session_destroy();
  header("Location: index.php"); // redirecciona hacia index.php
  exit();
?>