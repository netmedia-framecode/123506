<?php if (!isset($_SESSION)) {
  session_start();
}
require_once("../controller/auth.php");
if (isset($_SESSION["project_cv_aquila_indonesia"])) {
  unset($_SESSION["project_cv_aquila_indonesia"]);
  header("Location: ./");
  exit();
}
