<?php

$messageTypes = ["success", "success-delete", "info", "warning", "danger", "dark"];

if (!isset($_SESSION["project_cv_aquila_indonesia"]["users"])) {
  if (isset($_SESSION["project_cv_aquila_indonesia"]["time_message"]) && (time() - $_SESSION["project_cv_aquila_indonesia"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_cv_aquila_indonesia"]["message_$type"])) {
        unset($_SESSION["project_cv_aquila_indonesia"]["message_$type"]);
      }
    }
    unset($_SESSION["project_cv_aquila_indonesia"]["time_message"]);
  }
} else if (isset($_SESSION["project_cv_aquila_indonesia"]["users"])) {
  if (isset($_SESSION["project_cv_aquila_indonesia"]["users"]["time_message"]) && (time() - $_SESSION["project_cv_aquila_indonesia"]["users"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_cv_aquila_indonesia"]["users"]["message_$type"])) {
        unset($_SESSION["project_cv_aquila_indonesia"]["users"]["message_$type"]);
      }
    }
    unset($_SESSION["project_cv_aquila_indonesia"]["users"]["time_message"]);
  }
}
