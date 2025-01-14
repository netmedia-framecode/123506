<?php

if (!isset($_SESSION["project_cv_aquila_indonesia"]["users"])) {
  function alert($message, $message_type)
  {
    $_SESSION["project_cv_aquila_indonesia"] = [
      "message_$message_type" => $message,
      "time_message" => time()
    ];

    return true;
  }
}

if (isset($_SESSION["project_cv_aquila_indonesia"]["users"])) {
  function alert($message, $message_type)
  {
    global $conn;
    $id_user = valid($conn, $_SESSION["project_cv_aquila_indonesia"]["users"]["id"]);
    $id_role = valid($conn, $_SESSION["project_cv_aquila_indonesia"]["users"]["id_role"]);
    $role = valid($conn, $_SESSION["project_cv_aquila_indonesia"]["users"]["role"]);
    $email = valid($conn, $_SESSION["project_cv_aquila_indonesia"]["users"]["email"]);
    $name = valid($conn, $_SESSION["project_cv_aquila_indonesia"]["users"]["name"]);
    $image = valid($conn, $_SESSION["project_cv_aquila_indonesia"]["users"]["image"]);
    $tlpn = valid($conn, $_SESSION["project_cv_aquila_indonesia"]["users"]["tlpn"]);
    $alamat = valid($conn, $_SESSION["project_cv_aquila_indonesia"]["users"]["alamat"]);

    $_SESSION["project_cv_aquila_indonesia"]["users"] = [
      "id" => $id_user,
      "id_role" => $id_role,
      "role" => $role,
      "email" => $email,
      "name" => $name,
      "image" => $image,
      "tlpn" => $tlpn,
      "alamat" => $alamat,
      "message_$message_type" => $message,
      "time_message" => time()
    ];
  }
}
