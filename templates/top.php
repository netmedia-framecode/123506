<!doctype html>
<html class="no-js" lang="zxx">

<head>
  <?php require_once("sections/head.php")?>
</head>

<body>
  <?php foreach ($messageTypes as $type) {
    if (isset($_SESSION["project_cv_aquila_indonesia"]["users"]["message_$type"])) {
      echo "<div class='message-$type' data-message-$type='{$_SESSION["project_cv_aquila_indonesia"]["users"]["message_$type"]}'></div>";
    }
  }

  require_once("sections/nav.php")?>