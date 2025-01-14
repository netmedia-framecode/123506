<?php

function handle_error($errno, $errstr, $errfile, $errline)
{
  // Create error log file path based on the file where the error occurred
  $errorLog = dirname(__FILE__) . '/error_log.log'; // Error log file location within the project folder

  // Format error message with additional information
  $error_message = "[" . date("Y-m-d H:i:s") . "] Error [$errno]: $errstr in $errfile on line $errline" . PHP_EOL;

  // Attempt to open the error log file in append mode, creating it if it doesn't exist
  $file_handle = fopen($errorLog, 'a');
  if ($file_handle !== false) {
    // Write error message to the log file
    fwrite($file_handle, $error_message);
    // Close the file handle
    fclose($file_handle);
  }

  // Save error message in session
  $_SESSION['error_message'] = $error_message;

  // Redirect user back to the same page only if there is no error
  if (!isset($_SESSION['error_flag'])) {
    // Set error flag to prevent infinite redirection loop
    $_SESSION['error_flag'] = true;
    // Redirect user back to the same page
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit(); // Stop further execution
  }
}

function valid($conn, $value)
{
  if (is_array($value)) {
    // Rekursif untuk setiap elemen array
    return array_map(function ($item) use ($conn) {
      return valid($conn, $item);
    }, $value);
  }

  // Proses jika $value adalah string
  $value = trim($value); // Hilangkan spasi di awal/akhir
  $value = mysqli_real_escape_string($conn, $value); // Lindungi dari injeksi SQL
  $value = addslashes($value); // Escape karakter khusus
  $value = htmlspecialchars($value); // Konversi karakter HTML
  return $value;
}

function separateAlphaNumeric($string)
{
  $alpha = "";
  $numeric = "";
  // Mengiterasi setiap karakter dalam string
  for ($i = 0; $i < strlen($string); $i++) {
    // Memeriksa apakah karakter adalah huruf
    if (ctype_alpha($string[$i])) {
      $alpha .= $string[$i];
    }
    // Memeriksa apakah karakter adalah angka
    if (ctype_digit($string[$i])) {
      $numeric .= $string[$i];
    }
  }
  // Mengembalikan array yang berisi huruf dan angka terpisah
  return array(
    "alpha" => $alpha,
    "numeric" => $numeric
  );
}

function generateToken()
{
  // Generate a random 6-digit number
  $token = mt_rand(100000, 999999);
  return $token;
}

function compressImage($source, $destination, $quality)
{
  // mendapatkan info image
  $imgInfo = getimagesize($source);
  $mime = $imgInfo['mime'];
  // membuat image baru
  switch ($mime) {
      // proses kode memilih tipe tipe image 
    case 'image/jpeg':
      $image = imagecreatefromjpeg($source);
      break;
    case 'image/png':
      $image = imagecreatefrompng($source);
      break;
    default:
      $image = imagecreatefromjpeg($source);
  }

  // Menyimpan image dengan ukuran yang baru
  imagejpeg($image, $destination, $quality);

  // Return image
  return $destination;
}

function hapusFolderRecursively($folderPath)
{
  if (is_dir($folderPath)) {
    $files = glob($folderPath . '/*');
    foreach ($files as $file) {
      is_dir($file) ? hapusFolderRecursively($file) : unlink($file);
    }
    rmdir($folderPath);
  }
}

function generateOrderID($length)
{
  $characters = '0123456789';
  $idLength = $length;
  $orderID = '';
  for ($i = 0; $i < $idLength; $i++) {
    $randomChar = $characters[rand(0, strlen($characters) - 1)];
    $orderID .= $randomChar;
  }
  return $orderID;
}

function generateTokenTagihan($length)
{
  return bin2hex(random_bytes($length));
}

if (!isset($_SESSION["project_cv_aquila_indonesia"]["users"])) {
  function register($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkEmail = "SELECT * FROM users WHERE email='$data[email]'";
      $checkEmail = mysqli_query($conn, $checkEmail);
      if (mysqli_num_rows($checkEmail) > 0) {
        $message = "Maaf, email yang anda masukan sudah terdaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        if ($data['password'] !== $data['re_password']) {
          $message = "Maaf, konfirmasi password yang anda masukan belum sama.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        } else {
          $password = password_hash($data['password'], PASSWORD_DEFAULT);
          $token = generateToken();
          $en_user = password_hash($token, PASSWORD_DEFAULT);
          $en_user = str_replace("$", "", $en_user);
          $en_user = str_replace("/", "", $en_user);
          $en_user = str_replace(".", "", $en_user);
          $to       = $data['email'];
          $subject  = "Account Verification - CV Aquila Indonesia";
          $message  = "<!doctype html>
          <html>
            <head>
                <meta name='viewport' content='width=device-width'>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <title>Account Verification</title>
                <style>
                    @media only screen and (max-width: 620px) {
                        table[class='body'] h1 {
                            font-size: 28px !important;
                            margin-bottom: 10px !important;}
                        table[class='body'] p,
                        table[class='body'] ul,
                        table[class='body'] ol,
                        table[class='body'] td,
                        table[class='body'] span,
                        table[class='body'] a {
                            font-size: 16px !important;}
                        table[class='body'] .wrapper,
                        table[class='body'] .article {
                            padding: 10px !important;}
                        table[class='body'] .content {
                            padding: 0 !important;}
                        table[class='body'] .container {
                            padding: 0 !important;
                            width: 100% !important;}
                        table[class='body'] .main {
                            border-left-width: 0 !important;
                            border-radius: 0 !important;
                            border-right-width: 0 !important;}
                        table[class='body'] .btn table {
                            width: 100% !important;}
                        table[class='body'] .btn a {
                            width: 100% !important;}
                        table[class='body'] .img-responsive {
                            height: auto !important;
                            max-width: 100% !important;
                            width: auto !important;}}
                    @media all {
                        .ExternalClass {
                            width: 100%;}
                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                            line-height: 100%;}
                        .apple-link a {
                            color: inherit !important;
                            font-family: inherit !important;
                            font-size: inherit !important;
                            font-weight: inherit !important;
                            line-height: inherit !important;
                            text-decoration: none !important;
                        .btn-primary table td:hover {
                            background-color: #d5075d !important;}
                        .btn-primary a:hover {
                            background-color: #000 !important;
                            border-color: #000 !important;
                            color: #fff !important;}}
                </style>
            </head>
            <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
                <tr>
                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                    <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                    <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
            
                        <!-- START CENTERED WHITE CONTAINER -->
                        <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
            
                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                            <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                                <tr>
                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $data['name'] . ",</p>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Selamat akun kamu sudah terdaftar, tinggal satu langkah lagi kamu sudah bisa menggunakan akun. Silakan salin kode token dibawah ini untuk memverifikasi akun kamu.</p>
                                    <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                    <tbody>
                                        <tr>
                                        <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                            <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                            <tbody>
                                                <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>" . $token . "</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah mendaftar di CV Aquila Indonesia.</p>
                                    <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                                </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
            
                        <!-- END MAIN CONTENT AREA -->
                        </table>
                        
                        <!-- START FOOTER -->
                        <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                        <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                            <tr>
                            <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                                <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                            </td>
                            </tr>
                            <tr>
                            <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                                Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                            </td>
                            </tr>
                        </table>
                        </div>
                        <!-- END FOOTER -->
            
                    <!-- END CENTERED WHITE CONTAINER -->
                    </div>
                    </td>
                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                </tr>
                </table>
            </body>
          </html>";
          smtp_mail($to, $subject, $message, "", "", 0, 0, true);
          $_SESSION['data_auth'] = ['en_user' => $en_user];
          $sql = "INSERT INTO users(en_user,token,name,email,password) VALUES('$en_user','$token','$data[name]','$data[email]','$password')";
        }
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function re_verifikasi($conn, $data, $action)
  {
    if ($action == "update") {
      $checkEN = "SELECT * FROM users WHERE en_user='$data[en_user]'";
      $checkEN = mysqli_query($conn, $checkEN);
      if (mysqli_num_rows($checkEN) == 0) {
        $message = "Maaf, sepertinya ada kesalahan saat mendaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else if (mysqli_num_rows($checkEN) > 0) {
        $row = mysqli_fetch_assoc($checkEN);
        $name = $row['name'];
        $email = $row['email'];
        $token = generateToken();
        $reen_user = password_hash($token, PASSWORD_DEFAULT);
        $reen_user = str_replace("$", "", $reen_user);
        $reen_user = str_replace("/", "", $reen_user);
        $reen_user = str_replace(".", "", $reen_user);
        $to       = $email;
        $subject  = "Account Verification - CV Aquila Indonesia";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Account Verification</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $name . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Selamat akun kamu sudah terdaftar, tinggal satu langkah lagi kamu sudah bisa menggunakan akun. Silakan salin kode token dibawah ini untuk memverifikasi akun kamu.</p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>" . $token . "</td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah mendaftar di CV Aquila Indonesia.</p>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
        $_SESSION['data_auth'] = ['en_user' => $reen_user];
        $sql = "UPDATE users SET en_user='$reen_user', token='$token', updated_at=current_timestamp WHERE en_user='$data[en_user]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function verifikasi($conn, $data, $action)
  {
    if ($action == "update") {
      $checkEN = "SELECT * FROM users WHERE en_user='$data[en_user]'";
      $checkEN = mysqli_query($conn, $checkEN);
      if (mysqli_num_rows($checkEN) == 0) {
        $message = "Maaf, sepertinya ada kesalahan saat mendaftar.";
        $message_type = "warning";
        alert($message, $message_type);
        return false;
      } else if (mysqli_num_rows($checkEN) > 0) {
        $row = mysqli_fetch_assoc($checkEN);
        $token_primary = $row['token'];
        $updated_at = strtotime($row['updated_at']);
        $current_time = time();
        if (($current_time - $updated_at) > (5 * 60)) {
          $message = "Maaf, waktu untuk verifikasi telah habis.";
          $message_type = "warning";
          alert($message, $message_type);
          $_SESSION["project_cv_aquila_indonesia"] = [
            "message-warning" => "Maaf, waktu untuk verifikasi telah habis.",
            "time-message" => time()
          ];
          return false;
        }
        if ($data['token'] !== $token_primary) {
          $message = "Maaf, kode token yang anda masukan masih salah.";
          $message_type = "warning";
          alert($message, $message_type);
          return false;
        }
        $sql = "UPDATE users SET id_active='1', updated_at=current_timestamp WHERE en_user='$data[en_user]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function forgot_password($conn, $data, $action, $baseURL)
  {
    if ($action == "update") {
      $checkEmail = "SELECT * FROM users WHERE email='$data[email]'";
      $checkEmail = mysqli_query($conn, $checkEmail);
      if (mysqli_num_rows($checkEmail) === 0) {
        $message = "Maaf, email yang anda masukan belum terdaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $row = mysqli_fetch_assoc($checkEmail);
        $name = valid($conn, $row['name']);
        $token = generateToken();
        $en_user = password_hash($token, PASSWORD_DEFAULT);
        $en_user = str_replace("$", "", $en_user);
        $en_user = str_replace("/", "", $en_user);
        $en_user = str_replace(".", "", $en_user);
        $to       = $data['email'];
        $subject  = "Reset password - CV Aquila Indonesia";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Reset password</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $name . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Pesan ini secara otomatis dikirimkan kepada anda karena anda meminta untuk mereset kata sandi. Jika anda tidak sama sekali ingin mereset atau bukan anda yang ingin mereset abaikan saja. Klik tombol reset berikut untuk melanjutkan:</p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center;' valign='top' bgcolor='#ffffff' align='center'>
                                                  <a href='" . $baseURL . "auth/new-password?en=" . $en_user . "' target='_blank' style='background-color: #ffffff; border: solid 1px #000; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; border-color: #000; color: #000;'>Atur Ulang Kata Sandi</a> 
                                                </td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
        $sql = "UPDATE users SET en_user='$en_user', token='$token', updated_at=current_timestamp WHERE email='$data[email]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function new_password($conn, $data, $action)
  {
    if ($action == "update") {
      $lenght = strlen($data['password']);
      if ($lenght < 8) {
        $message = "Maaf, password yang anda masukan harus 8 digit atau lebih.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else if ($data['password'] !== $data['re_password']) {
        $message = "Maaf, konfirmasi password yang anda masukan belum sama.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password='$password' WHERE email='$data[email]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function login($conn, $data)
  {
    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users JOIN user_role ON users.id_role=user_role.id_role WHERE users.email='$data[email]'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $message = "Maaf, akun yang anda masukan belum terdaftar.";
      $message_type = "danger";
      alert($message, $message_type);
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if (password_verify($data['password'], $row["password"])) {
        $_SESSION["project_cv_aquila_indonesia"]["users"] = [
          "id" => $row["id_user"],
          "id_role" => $row["id_role"],
          "role" => $row["role"],
          "email" => $row["email"],
          "name" => $row["name"],
          "image" => $row["image"],
          "tlpn" => $row["tlpn"],
          "alamat" => $row["alamat"]
        ];
        return mysqli_affected_rows($conn);
      } else {
        $message = "Maaf, kata sandi yang anda masukan salah.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
    }
  }
}

if (isset($_SESSION["project_cv_aquila_indonesia"]["users"])) {

  function profil($conn, $data, $action, $id_user)
  {
    if ($action == "update") {
      $path = "../assets/img/profil/";
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['image']["name"])) {
        $unwanted_characters = "../assets/img/profil/";
        $remove_image = str_replace($unwanted_characters, "", $data['imageOld']);
        if ($remove_image != "default.svg") {
          unlink($path . $remove_image);
        }
      } else if (empty($_FILE['image']["name"])) {
        $image = $data['imageOld'];
      }
      if (!empty($data['password'])) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name='$data[name]', image='$image', password='$password', tlpn='$data[tlpn]', alamat='$data[alamat]' WHERE id_user='$id_user'";
      } else {
        $sql = "UPDATE users SET name='$data[name]', image='$image', tlpn='$data[tlpn]', alamat='$data[alamat]' WHERE id_user='$id_user'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function setting($conn, $data, $action)
  {

    if ($action == "update") {
      $path = "../assets/img/auth/";
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          move_uploaded_file($imageTemp, $imageUploadPath);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['image']["name"])) {
        $unwanted_characters = "../assets/img/auth/";
        $remove_image = str_replace($unwanted_characters, "", $data['imageOld']);
        unlink($path . $remove_image);
      } else if (empty($_FILE['image']["name"])) {
        $image = $data['imageOld'];
      }
      $sql = "UPDATE auth SET image='$image', bg='$data[bg]', model='$data[model]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function utilities($conn, $data, $action)
  {

    if ($action == "update") {
      $path = "../assets/img/";
      if (!empty($_FILES['logo']["name"])) {
        $fileName = basename($_FILES["logo"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["logo"]["tmp_name"];
          move_uploaded_file($imageTemp, $imageUploadPath);
          $logo = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['logo']["name"])) {
        $unwanted_characters = "../assets/img/";
        $remove_image = str_replace($unwanted_characters, "", $data['logoOld']);
        unlink($path . $remove_image);
      } else if (empty($_FILE['logo']["name"])) {
        $logo = $data['logoOld'];
      }
      $sql = "UPDATE utilities SET logo='$logo', name_web='$data[name_web]', keyword='$data[keyword]', description='$data[description]', author='$data[author]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function users($conn, $data, $action)
  {

    if ($action == "update") {
      $sql = "UPDATE users SET id_role='$data[id_role]', id_active='$data[id_active]' WHERE id_user='$data[id_user]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function role($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkRole = "SELECT * FROM user_role WHERE role LIKE '%$data[role]%'";
      $checkRole = mysqli_query($conn, $checkRole);
      if (mysqli_num_rows($checkRole) > 0) {
        $message = "Maaf, role yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $sql = "INSERT INTO user_role(role) VALUES('$data[role]')";
      }
    }

    if ($action == "update") {
      if ($data['role'] !== $data['roleOld']) {
        $checkRole = "SELECT * FROM user_role WHERE role LIKE '%$data[role]%'";
        $checkRole = mysqli_query($conn, $checkRole);
        if (mysqli_num_rows($checkRole) > 0) {
          $message = "Maaf, role yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_role SET role='$data[role]' WHERE id_role='$data[id_role]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_role WHERE id_role='$data[id_role]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function menu($conn, $data, $action)
  {
    if ($action == "insert") {
      $namaFolder = strtolower($data['menu']);
      $namaFolder = str_replace(" ", "-", $namaFolder);
      $checkMenu = "SELECT * FROM user_menu WHERE menu='$data[menu]'";
      $checkMenu = mysqli_query($conn, $checkMenu);
      if (mysqli_num_rows($checkMenu) > 0) {
        $message = "Maaf, menu yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $pathFolder = __DIR__ . '/../views/' . $namaFolder;
        if (!is_dir($pathFolder)) {
          mkdir($pathFolder, 0777, true);
          $file = fopen($pathFolder . '/redirect.php', "w");
          fwrite($file, '<?php if (!isset($_SESSION["project_cv_aquila_indonesia"]["users"])) {
            header("Location: ../../auth/");
            exit;
          }
          ');
          fclose($file);

          $file_controller = fopen("../controller/" . $namaFolder . ".php", "w");
          fwrite($file_controller, '<?php
  
          require_once("../../config/Base.php");
          require_once("../../config/Auth.php");
          require_once("../../config/Alert.php");
          require_once("../../views/' . $namaFolder . '/redirect.php");
          ');
          fclose($file_controller);
        } else {
          $message = "Folder $namaFolder sudah ada!";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
        $sql = "INSERT INTO user_menu(icon,menu) VALUES('$data[icon]','$data[menu]')";
      }
    }

    if ($action == "update") {
      $menu_baru = strtolower(str_replace(' ', '-', $data['menu']));
      $menu_lama = strtolower(str_replace(' ', '-', $data['menuOld']));
      if ($menu_baru !== $menu_lama) {
        $checkMenu = "SELECT * FROM user_menu WHERE menu='$data[menu]'";
        $checkMenu = mysqli_query($conn, $checkMenu);
        if (mysqli_num_rows($checkMenu) > 0) {
          $message = "Maaf, menu yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
        $folder_lama = __DIR__ . '/../views/' . $menu_lama;
        $folder_baru = __DIR__ . '/../views/' . $menu_baru;
        if (is_dir($folder_lama)) {
          if ($menu_baru !== $menu_lama) {
            if (rename($folder_lama, $folder_baru)) {
            } else {
              $message = "Gagal mengubah nama folder.";
              $message_type = "danger";
              alert($message, $message_type);
              return false;
            }
          }
        } else {
          $message = "Folder lama tidak ditemukan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_menu SET icon='$data[icon]', menu='$data[menu]' WHERE id_menu='$data[id_menu]'";
    }

    if ($action == "delete") {
      $menu = strtolower(str_replace(' ', '-', $data['menu']));
      $pathFolder = __DIR__ . '/../views/' . $menu;
      unlink("../controller/" . $menu . ".php");
      hapusFolderRecursively($pathFolder);
      $sql = "DELETE FROM user_menu WHERE id_menu='$data[id_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function sub_menu($conn, $data, $action, $baseURL)
  {
    $url = strtolower($data['title']);
    $url = str_replace(" ", "-", $url);

    if ($action == "insert") {
      $checkSubMenu = "SELECT * FROM user_sub_menu WHERE title='$data[title]'";
      $checkSubMenu = mysqli_query($conn, $checkSubMenu);
      if (mysqli_num_rows($checkSubMenu) > 0) {
        $message = "Maaf, nama sub menu yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $menu = "SELECT * FROM user_menu WHERE id_menu = '$data[id_menu]'";
        $view_menu = mysqli_query($conn, $menu);
        $data_menu = mysqli_fetch_assoc($view_menu);
        $menu = strtolower($data_menu['menu']);
        $menu = str_replace(" ", "-", $menu);

        $file_views = fopen("../views/" . $menu . "/" . $url . ".php", "w");
        fwrite($file_views, '<?php require_once("../../controller/' . $menu . '.php");
        $_SESSION["project_cv_aquila_indonesia"]["name_page"] = "' . $data['title'] . '";
        require_once("../../templates/views_top.php"); ?>

        <div class="nxl-content" style="height: 100vh;">

          <!-- [ page-header ] start -->
          <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
              <div class="page-header-title">
                <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item">' . $data['title'] . '</li>
                <li class="breadcrumb-item"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></li>
              </ul>
            </div>
            <div class="page-header-right ms-auto">
              <div class="page-header-right-items">
                <div class="d-flex d-md-none">
                  <a href="javascript:void(0)" class="page-header-right-close-toggle">
                    <i class="feather-arrow-left me-2"></i>
                    <span>Back</span>
                  </a>
                </div>
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                  <a href="add-' . $url . '" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>
                    <span>Tambah</span>
                  </a>
                </div>
              </div>
              <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                  <i class="feather-align-right fs-20"></i>
                </a>
              </div>
            </div>
          </div>
          <!-- [ page-header ] end -->

          <!-- [ Main Content ] start -->
          <div class="main-content">
          </div>
          <!-- [ Main Content ] end -->

        </div>

        <?php require_once("../../templates/views_bottom.php") ?>
        ');
        fclose($file_views);

        $file_views_add = fopen("../views/" . $menu . "/add-" . $url . ".php", "w");
        fwrite($file_views_add, '<?php require_once("../../controller/' . $menu . '.php");
        $_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Tambah ' . $data['title'] . '";
        require_once("../../templates/views_top.php"); ?>

        <div class="nxl-content" style="height: 100vh;">

          <!-- [ page-header ] start -->
          <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
              <div class="page-header-title">
                <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item">' . $data['title'] . '</li>
                <li class="breadcrumb-item"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></li>
              </ul>
            </div>
          </div>
          <!-- [ page-header ] end -->

          <!-- [ Main Content ] start -->
          <div class="main-content">
          </div>
          <!-- [ Main Content ] end -->

        </div>

        <?php require_once("../../templates/views_bottom.php") ?>
        ');
        fclose($file_views_add);

        $petik = "'";
        $file_views_edit = fopen("../views/" . $menu . "/edit-" . $url . ".php", "w");
        fwrite($file_views_edit, '<?php require_once("../../controller/' . $menu . '.php");
        if(!isset($_GET["p"])){
          header("Location: menu");
          exit();
        }else{
          $id = valid($conn, $_GET["p"]); 
          $pull_data = "SELECT * FROM  WHERE  = ' . $petik . '$id' . $petik . '";
          $store_data = mysqli_query($conn, $pull_data);
          $view_data = mysqli_fetch_assoc($store_data);
        $_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Ubah ' . $data['title'] . '";
        require_once("../../templates/views_top.php"); ?>

        <div class="nxl-content" style="height: 100vh;">

          <!-- [ page-header ] start -->
          <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
              <div class="page-header-title">
                <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item">' . $data['title'] . '</li>
                <li class="breadcrumb-item"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"].' . $petik . ' ' . $petik . '.$view_data[""]  ?></li>
              </ul>
            </div>
          </div>
          <!-- [ page-header ] end -->

          <!-- [ Main Content ] start -->
          <div class="main-content">
          </div>
          <!-- [ Main Content ] end -->

        </div>

        <?php }
        require_once("../../templates/views_bottom.php") ?>
        ');
        fclose($file_views_edit);

        $url_sub = $menu . "/" . $url;
        $sql = "INSERT INTO user_sub_menu(id_menu,id_active,title,url) VALUES('$data[id_menu]','$data[id_active]','$data[title]','$url_sub')";
      }
    }

    if ($action == "update") {
      if ($data['title'] !== $data['titleOld']) {
        $checkSubMenu = "SELECT * FROM user_sub_menu WHERE title='$data[title]'";
        $checkSubMenu = mysqli_query($conn, $checkSubMenu);
        if (mysqli_num_rows($checkSubMenu) > 0) {
          $message = "Maaf, nama sub menu yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $menu = "SELECT * FROM user_menu WHERE id_menu = '$data[id_menu]'";
      $view_menu = mysqli_query($conn, $menu);
      $data_menu = mysqli_fetch_assoc($view_menu);
      $menu = strtolower($data_menu['menu']);
      $menu = str_replace(" ", "-", $menu);
      rename($menu . '/' . $data['urlOld'] . '.php', $menu . '/' . $url . '.php');
      rename($menu . '/' . "add-" . $data['urlOld'] . '.php', $menu . '/' . "add-" . $url . '.php');
      rename($menu . '/' . "edit-" . $data['urlOld'] . '.php', $menu . '/' . "edit-" . $url . '.php');
      $sql = "UPDATE user_sub_menu SET id_menu='$data[id_menu]', id_active='$data[id_active]', title='$data[title]', url='$url' WHERE id_sub_menu='$data[id_sub_menu]'";
    }

    if ($action == "delete") {
      unlink("../views/" . $data['menu'] . "/" . $url . ".php");
      unlink("../views/" . $data['menu'] . "/" . "add-" . $url . ".php");
      unlink("../views/" . $data['menu'] . "/" . "edit-" . $url . ".php");
      $sql = "DELETE FROM user_sub_menu WHERE id_sub_menu='$data[id_sub_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function menu_access($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO user_access_menu(id_role,id_menu) VALUES('$data[id_role]','$data[id_menu]')";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_access_menu WHERE id_access_menu='$data[id_access_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function sub_menu_access($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO user_access_sub_menu(id_role,id_sub_menu) VALUES('$data[id_role]','$data[id_sub_menu]')";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_access_sub_menu WHERE id_access_sub_menu='$data[id_access_sub_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function status_produk($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO status_produk (status_produk) VALUES ('$data[status_produk]')";
    }

    if ($action == "update") {
      $sql = "UPDATE status_produk SET status_produk = '$data[status_produk]' WHERE id_status_produk = '$data[id_status_produk]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM status_produk WHERE id_status_produk = '$data[id_status_produk]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function kategori_produk($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO kategori_produk (kategori_produk) VALUES ('$data[kategori_produk]')";
    }

    if ($action == "update") {
      $sql = "UPDATE kategori_produk SET kategori_produk = '$data[kategori_produk]' WHERE id_kategori_produk = '$data[id_kategori_produk]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM kategori_produk WHERE id_kategori_produk = '$data[id_kategori_produk]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function printProduk($conn, $bulan, $tahun, $name)
  {
    $bulan_array = [
      '01' => 'JANUARI',
      '02' => 'FEBRUARI',
      '03' => 'MARET',
      '04' => 'APRIL',
      '05' => 'MEI',
      '06' => 'JUNI',
      '07' => 'JULI',
      '08' => 'AGUSTUS',
      '09' => 'SEPTEMBER',
      '10' => 'OKTOBER',
      '11' => 'NOVEMBER',
      '12' => 'DESEMBER'
    ];
    if (!empty($bulan)) {
      $query = "SELECT produk.*, kategori_produk.kategori_produk, status_produk.status_produk
                FROM produk
                JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
                JOIN status_produk ON produk.id_status_produk = status_produk.id_status_produk
                WHERE DATE_FORMAT(produk.updated_at, '%m') = '$bulan'
                AND DATE_FORMAT(produk.updated_at, '%Y') = '$tahun'";
      $bulan_text = "BULAN " . $bulan_array[$bulan] ?? "";
    } else {
      $query = "SELECT produk.*, kategori_produk.kategori_produk, status_produk.status_produk
        FROM produk
        JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
        JOIN status_produk ON produk.id_status_produk = status_produk.id_status_produk
        WHERE DATE_FORMAT(produk.updated_at, '%Y') = '$tahun'
      ";
      $bulan_text = "";
    }
    $result = mysqli_query($conn, $query);
    $mpdf = new \Mpdf\Mpdf();
    $html = '
    <div style="position: relative; width: 100%; height: 100vh; text-align: center; page-break-after: always;">
        <!-- Konten Tengah -->
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <img src="../../assets/img/logo.png" alt="Logo" style="max-width: 200px; margin-bottom: 20px;">
            <h2 style="font-size: 24px; line-height: 1.5;">LAPORAN PRODUK CV. AQUILA INDONESIA <br>KUPANG ' . $bulan_text . ' TAHUN ' . $tahun . '</h2>
        </div>
    </div>
    ';
    $html .= '<table border="1" cellspacing="0" cellpadding="5">
                <tr>
                  <th>No</th>
                  <th class="text-center">Produk</th>
                  <th class="text-center">Kategori</th>
                  <th class="text-center">Status</th>
                  <th class="text-center" style="width: 200px;">Deskripsi</th>
                  <th class="text-center">Jumlah</th>
                  <th class="text-center">Harga</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Tgl Kadaluarsa</th>
                </tr>';
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      $tgl_kadaluarsa = date_create($row["tgl_kadaluarsa"]);
      $tgl_kadaluarsa = date_format($tgl_kadaluarsa, "d M Y");
      $html .= '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . $row['nama_produk'] . '</td>
                    <td>' . $row['kategori_produk'] . '</td>
                    <td>' . $row['status_produk'] . '</td>
                    <td>' . $row['deskripsi'] . '</td>
                    <td>' . $row['jumlah_produk'] . '</td>
                    <td>Rp. ' . number_format($row['harga']) . ' / pcs</td>
                    <td>Rp. ' . number_format($row['harga'] * $row['jumlah_produk']) . '</td>
                    <td>' . $tgl_kadaluarsa . '</td>
                 </tr>';
    }
    $html .= '</table>
    <div style="margin-top: 100px; right: 10px; text-align: right; font-size: 14px;">
      <p style="margin-bottom: 50px;">Kupang, ' . date('d F Y') . '</p>
      <p style="margin: 0; font-weight: bold;">' . $name . '</p>
    </div>
    ';
    $mpdf->WriteHTML($html);
    $mpdf->Output('LAPORAN_PRODUK_CV._AQUILA_INDONESIA_KUPANG_' . $bulan_text . '_tahun_' . $tahun . '.pdf', 'D');
  }

  function exportProduk($conn, $bulan)
  {
    if (!empty($bulan)) {
      $query = "SELECT produk.*, kategori_produk.kategori_produk, status_produk.status_produk
                FROM produk
                JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
                JOIN status_produk ON produk.id_status_produk = status_produk.id_status_produk
                WHERE DATE_FORMAT(produk.updated_at, '%m') = '$bulan'";
    } else {
      $query = "SELECT produk.*, kategori_produk.kategori_produk, status_produk.status_produk
        FROM produk
        JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
        JOIN status_produk ON produk.id_status_produk = status_produk.id_status_produk
      ";
    }
    $result = mysqli_query($conn, $query);
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $spreadsheet->getProperties()->setCreator('Creator')
      ->setLastModifiedBy('Last Modified By')
      ->setTitle('Data Produk')
      ->setSubject('Data Produk')
      ->setDescription('Data Produk')
      ->setKeywords('Data Produk')
      ->setCategory('Data');
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama Produk');
    $sheet->setCellValue('C1', 'Kategori');
    $sheet->setCellValue('D1', 'Status');
    $sheet->setCellValue('E1', 'Deskripsi');
    $sheet->setCellValue('F1', 'Jumlah');
    $sheet->setCellValue('G1', 'Harga');
    $sheet->setCellValue('H1', 'Total');
    $sheet->setCellValue('I1', 'Tgl Kadaluarsa');
    $row = 2;
    $no = 1;
    while ($row_data = mysqli_fetch_assoc($result)) {
      $tgl_kadaluarsa = date_create($row_data["tgl_kadaluarsa"]);
      $tgl_kadaluarsa = date_format($tgl_kadaluarsa, "d M Y");
      $sheet->setCellValue('A' . $row, $no);
      $sheet->setCellValue('B' . $row, $row_data['nama_produk']);
      $sheet->setCellValue('C' . $row, $row_data['kategori_produk']);
      $sheet->setCellValue('D' . $row, $row_data['status_produk']);
      $sheet->setCellValue('E' . $row, $row_data['deskripsi']);
      $sheet->setCellValue('F' . $row, $row_data['jumlah_produk']);
      $sheet->setCellValue('G' . $row, "Rp." . number_format($row_data['harga']));
      $sheet->setCellValue('H' . $row, "Rp." . number_format($row_data['harga'] * $row_data['jumlah_produk']));
      $sheet->setCellValue('I' . $row, $tgl_kadaluarsa);
      $row++;
      $no++;
    }
    foreach (range('A', 'I') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $filename = 'data_produk.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
  }

  function produk($conn, $data, $action, $name)
  {
    $path = "../../assets/img/produk/";

    if ($action == "insert") {
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      } else {
        $image = "default.png";
      }
      $sql = "INSERT INTO produk (id_kategori_produk,id_status_produk,image_produk,nama_produk,deskripsi,jumlah_produk,harga,tgl_kadaluarsa) VALUES ('$data[id_kategori_produk]','$data[id_status_produk]','$image','$data[nama_produk]','$data[deskripsi]','$data[jumlah_produk]','$data[harga]','$data[tgl_kadaluarsa]')";
      mysqli_query($conn, $sql);
    }

    if ($action == "update") {
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
          $remove_image = str_replace($path, "", $data['imageOld']);
          if ($remove_image != "default.png") {
            unlink($path . $remove_image);
          }
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      } else if (empty($_FILE['image']["name"])) {
        $image = $data['imageOld'];
      }
      $sql = "UPDATE produk SET id_kategori_produk = '$data[id_kategori_produk]', id_status_produk = '$data[id_status_produk]', image_produk = '$image', nama_produk = '$data[nama_produk]', deskripsi = '$data[deskripsi]', jumlah_produk = '$data[jumlah_produk]', harga = '$data[harga]', tgl_kadaluarsa = '$data[tgl_kadaluarsa]' WHERE id_produk = '$data[id_produk]'";
      mysqli_query($conn, $sql);
    }

    if ($action == "delete") {
      $remove_image = str_replace($path, "", $data['image_produk']);
      unlink($path . $remove_image);
      $sql = "DELETE FROM produk WHERE id_produk = '$data[id_produk]'";
      mysqli_query($conn, $sql);
    }

    if ($action == "print") {
      $bulan = $data['bulan'];
      $tahun = $data['tahun'];
      printProduk($conn, $bulan, $tahun, $name);
    }

    if ($action == "export") {
      $bulan = $data['bulan'];
      exportProduk($conn, $bulan);
    }

    return mysqli_affected_rows($conn);
  }

  function keranjang($conn, $data, $action, $id_user)
  {
    if ($action == "insert") {
      $id_produk_array = isset($data['id_produk']) && is_array($data['id_produk']) ? $data['id_produk'] : [];
      $jumlah_keranjang_array = isset($data['jumlah_keranjang']) && is_array($data['jumlah_keranjang']) ? $data['jumlah_keranjang'] : [];
      $harga_array = isset($data['harga']) && is_array($data['harga']) ? $data['harga'] : [];
      if (count($id_produk_array) == count($jumlah_keranjang_array) && count($jumlah_keranjang_array) == count($harga_array)) {
        for ($i = 0; $i < count($id_produk_array); $i++) {
          $id_produk = $id_produk_array[$i];
          $jumlah_keranjang = $jumlah_keranjang_array[$i];
          $sql_insert = "INSERT INTO keranjang (id_user,id_produk,jumlah_keranjang) VALUES ('$id_user','$id_produk','$jumlah_keranjang')";
          mysqli_query($conn, $sql_insert);
        }
      }
    }

    if ($action == "delete") {
      $sql_delete = "DELETE FROM keranjang WHERE id_keranjang = '$data[id_keranjang]'";
      mysqli_query($conn, $sql_delete);
    }

    return mysqli_affected_rows($conn);
  }

  function wishlist($conn, $data, $action, $id_user)
  {
    if ($action == "insert") {
      $id_produk_array = isset($data['id_produk']) && is_array($data['id_produk']) ? $data['id_produk'] : [];
      $jumlah_keranjang_array = isset($data['jumlah_keranjang']) && is_array($data['jumlah_keranjang']) ? $data['jumlah_keranjang'] : [];
      $harga_array = isset($data['harga']) && is_array($data['harga']) ? $data['harga'] : [];
      if (count($id_produk_array) == count($jumlah_keranjang_array) && count($jumlah_keranjang_array) == count($harga_array)) {
        for ($i = 0; $i < count($id_produk_array); $i++) {
          $id_produk = $id_produk_array[$i];
          $sql_insert = "INSERT INTO wishlist (id_user,id_produk) VALUES ('$id_user','$id_produk')";
          mysqli_query($conn, $sql_insert);
        }
      }
    }

    if ($action == "delete") {
      $sql_delete = "DELETE FROM wishlist WHERE id_wishlist = '$data[id_wishlist]'";
      mysqli_query($conn, $sql_delete);
    }

    return mysqli_affected_rows($conn);
  }

  function tagihan($conn, $data, $action, $id_user)
  {
    if ($action == "insert") {
      $order_id = generateOrderID(6);
      $token = generateTokenTagihan(12);
      $id_keranjang_all_array = isset($data['id_keranjang_all']) && is_array($data['id_keranjang_all']) ? $data['id_keranjang_all'] : [];
      $id_produk_array = isset($data['id_produk']) && is_array($data['id_produk']) ? $data['id_produk'] : [];
      $jumlah_keranjang_array = isset($data['jumlah_keranjang']) && is_array($data['jumlah_keranjang']) ? $data['jumlah_keranjang'] : [];
      $harga_array = isset($data['harga']) && is_array($data['harga']) ? $data['harga'] : [];
      if (count($id_produk_array) == count($jumlah_keranjang_array) && count($jumlah_keranjang_array) == count($harga_array)) {
        for ($i = 0; $i < count($id_produk_array); $i++) {
          $id_keranjang_all = $id_keranjang_all_array[$i];
          $id_produk = $id_produk_array[$i];
          $jumlah_keranjang = $jumlah_keranjang_array[$i];
          $harga = $harga_array[$i];
          if ($id_keranjang_all !== 0) {
            $sql_keranjang = "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang_all'";
            mysqli_query($conn, $sql_keranjang);
          }
          $sql_pembelian = "INSERT INTO pembelian (id_user, id_produk, order_id, token, jumlah_produk, harga_satuan) 
                  VALUES ('$id_user', '$id_produk', '$order_id', '$token', '$jumlah_keranjang', '$harga')";
          mysqli_query($conn, $sql_pembelian);
        }
      }
    }

    if ($action == "update") {
      $sql = "UPDATE pembelian SET catatan = '$data[catatan]' WHERE id_pembelian = '$data[id_pembelian]'";
      mysqli_query($conn, $sql);
    }

    if ($action == "delete") {
      $sql = "DELETE FROM pembelian WHERE id_pembelian = '$data[id_pembelian]'";
      mysqli_query($conn, $sql);
    }

    return mysqli_affected_rows($conn);
  }

  function printPembelian($conn, $bulan, $tahun, $name)
  {
    $bulan_array = [
      '01' => 'JANUARI',
      '02' => 'FEBRUARI',
      '03' => 'MARET',
      '04' => 'APRIL',
      '05' => 'MEI',
      '06' => 'JUNI',
      '07' => 'JULI',
      '08' => 'AGUSTUS',
      '09' => 'SEPTEMBER',
      '10' => 'OKTOBER',
      '11' => 'NOVEMBER',
      '12' => 'DESEMBER'
    ];
    if (!empty($bulan)) {
      $query = "SELECT pembelian.*, users.image, users.name, users.email, users.tlpn, users.alamat, produk.image_produk, produk.nama_produk, produk.harga, status_pembelian.status_pembelian, kategori_produk.kategori_produk
        FROM pembelian
        JOIN users ON pembelian.id_user = users.id_user
        JOIN produk ON pembelian.id_produk = produk.id_produk
        JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
        JOIN status_pembelian ON pembelian.id_status_pembelian = status_pembelian.id_status_pembelian
        WHERE pembelian.id_status_pembelian = '1'
        AND DATE_FORMAT(pembelian.updated_at, '%m') = '$bulan'
        AND DATE_FORMAT(pembelian.updated_at, '%Y') = '$tahun'
      ";
      $bulan_text = "BULAN " . $bulan_array[$bulan] ?? "";
    } else {
      $query = "SELECT pembelian.*, users.image, users.name, users.email, users.tlpn, users.alamat, produk.image_produk, produk.nama_produk, produk.harga, status_pembelian.status_pembelian, kategori_produk.kategori_produk
        FROM pembelian
        JOIN users ON pembelian.id_user = users.id_user
        JOIN produk ON pembelian.id_produk = produk.id_produk
        JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
        JOIN status_pembelian ON pembelian.id_status_pembelian = status_pembelian.id_status_pembelian
        WHERE pembelian.id_status_pembelian = '1'
        AND DATE_FORMAT(pembelian.updated_at, '%Y') = '$tahun'
      ";
      $bulan_text = "";
    }
    $result = mysqli_query($conn, $query);
    $mpdf = new \Mpdf\Mpdf();
    $html = '
    <div style="position: relative; width: 100%; height: 100vh; text-align: center; page-break-after: always;">
        <!-- Konten Tengah -->
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <img src="../../assets/img/logo.png" alt="Logo" style="max-width: 200px; margin-bottom: 20px;">
            <h2 style="font-size: 24px; line-height: 1.5;">LAPORAN PENDAPATAN CV. AQUILA INDONESIA <br>KUPANG ' . $bulan_text . ' TAHUN ' . $tahun . '</h2>
        </div>
    </div>
    ';
    $html .= '<table border="1" cellspacing="0" cellpadding="5">
                <tr>
                  <th>No</th>
                  <th class="text-center">Status Bayar</th>
                  <th class="text-center">Order ID</th>
                  <th class="text-center">Pembeli</th>
                  <th class="text-center">Produk</th>
                  <th class="text-center">Kategori</th>
                  <th class="text-center">Jumlah Beli</th>
                  <th class="text-center">Harga</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Catatan</th>
                  <th class="text-center">Tgl Tagihan</th>
                  <th class="text-center">Tgl Pembayaran</th>
                </tr>';
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      $tanggal_tagihan = date_create($row["tanggal_tagihan"]);
      $tgl_tagihan = date_format($tanggal_tagihan, "d M Y");
      if (!empty($row["tanggal_pembayaran"])) {
        $tgl_pembayaran = date_create($row["tanggal_pembayaran"]);
        $tgl_pembayaran = date_format($tgl_pembayaran, "d M Y");
      } else {
        $tgl_pembayaran = '-';
      }
      $html .= '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . $row['status_pembelian'] . '</td>
                    <td>#' . $row['order_id'] . '</td>
                    <td>' . $row['name'] . "<br>" . $row['email'] . "<br>" . $row['tlpn'] . "<br>" . $row['alamat'] . '</td>
                    <td>' . $row['nama_produk'] . '</td>
                    <td>' . $row['kategori_produk'] . '</td>
                    <td>' . $row['jumlah_produk'] . '</td>
                    <td>Rp. ' . number_format($row['harga']) . ' / pcs</td>
                    <td>Rp. ' . number_format($row['total_harga']) . '</td>
                    <td>' . $row['catatan'] . '</td>
                    <td>' . $tgl_tagihan . '</td>
                    <td>' . $tgl_pembayaran . '</td>
                 </tr>';
    }
    $html .= '</table>
    <div style="margin-top: 100px; right: 10px; text-align: right; font-size: 14px;">
      <p style="margin-bottom: 50px;">Kupang, ' . date('d F Y') . '</p>
      <p style="margin: 0; font-weight: bold;">' . $name . '</p>
    </div>';
    $mpdf->WriteHTML($html);
    $mpdf->Output('LAPORAN_PENDAPATAN_CV._AQUILA_INDONESIA_KUPANG_' . $bulan_text . '_tahun_' . $tahun . '.pdf', 'D');
  }

  function exportPembelian($conn, $bulan)
  {
    if (!empty($bulan)) {
      $query = "SELECT pembelian.*, users.image, users.name, users.email, users.tlpn, users.alamat, produk.image_produk, produk.nama_produk, produk.harga, status_pembelian.status_pembelian, kategori_produk.kategori_produk
        FROM pembelian
        JOIN users ON pembelian.id_user = users.id_user
        JOIN produk ON pembelian.id_produk = produk.id_produk
        JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
        JOIN status_pembelian ON pembelian.id_status_pembelian = status_pembelian.id_status_pembelian
        WHERE pembelian.id_status_pembelian = '1'
        AND DATE_FORMAT(pembelian.updated_at, '%m') = '$bulan'
      ";
    } else {
      $query = "SELECT pembelian.*, users.image, users.name, users.email, users.tlpn, users.alamat, produk.image_produk, produk.nama_produk, produk.harga, status_pembelian.status_pembelian, kategori_produk.kategori_produk
        FROM pembelian
        JOIN users ON pembelian.id_user = users.id_user
        JOIN produk ON pembelian.id_produk = produk.id_produk
        JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
        JOIN status_pembelian ON pembelian.id_status_pembelian = status_pembelian.id_status_pembelian
        WHERE pembelian.id_status_pembelian = '1'
      ";
    }
    $result = mysqli_query($conn, $query);
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $spreadsheet->getProperties()->setCreator('Creator')
      ->setLastModifiedBy('Last Modified By')
      ->setTitle('Data Pembelian')
      ->setSubject('Data Pembelian')
      ->setDescription('Data Pembelian')
      ->setKeywords('Data Pembelian')
      ->setCategory('Data');
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Order ID');
    $sheet->setCellValue('C1', 'Nama Pembeli');
    $sheet->setCellValue('D1', 'Email / Tlpn');
    $sheet->setCellValue('E1', 'Alamat');
    $sheet->setCellValue('F1', 'Nama Produk');
    $sheet->setCellValue('G1', 'Kategori');
    $sheet->setCellValue('H1', 'Jumlah Beli');
    $sheet->setCellValue('I1', 'Harga');
    $sheet->setCellValue('J1', 'Total');
    $sheet->setCellValue('K1', 'Status Bayar');
    $sheet->setCellValue('L1', 'Catatan');
    $sheet->setCellValue('M1', 'Tgl Tagihan');
    $sheet->setCellValue('N1', 'Tgl Pembayaran');
    $row = 2;
    $no = 1;
    while ($row_data = mysqli_fetch_assoc($result)) {
      $tanggal_tagihan = date_create($row_data["tanggal_tagihan"]);
      $tanggal_tagihan = date_format($tanggal_tagihan, "d M Y");
      $tanggal_pembayaran = date_create($row_data["tanggal_pembayaran"]);
      $tanggal_pembayaran = date_format($tanggal_pembayaran, "d M Y");
      $sheet->setCellValue('A' . $row, $no);
      $sheet->setCellValue('B' . $row, "#" . $row_data['order_id']);
      $sheet->setCellValue('C' . $row, $row_data['name']);
      if (empty($row_data['tlpn'])) {
        $sheet->setCellValue('D' . $row, $row_data['email']);
      } else {
        $sheet->setCellValue('D' . $row, $row_data['email'] . " / " . $row_data['tlpn']);
      }
      $sheet->setCellValue('E' . $row, $row_data['alamat']);
      $sheet->setCellValue('F' . $row, $row_data['nama_produk']);
      $sheet->setCellValue('G' . $row, $row_data['kategori_produk']);
      $sheet->setCellValue('H' . $row, $row_data['jumlah_produk']);
      $sheet->setCellValue('I' . $row, "Rp." . number_format($row_data['harga_satuan']));
      $sheet->setCellValue('J' . $row, "Rp." . number_format($row_data['total_harga']));
      $sheet->setCellValue('K' . $row, $row_data['status_pembelian']);
      $sheet->setCellValue('L' . $row, $row_data['catatan']);
      $sheet->setCellValue('M' . $row, $tanggal_tagihan);
      $sheet->setCellValue('N' . $row, $tanggal_pembayaran);
      $row++;
      $no++;
    }
    foreach (range('A', 'N') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $filename = 'data_pembelian.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
  }
  function pembelian($conn, $data, $action, $name)
  {
    if ($action == "print") {
      $bulan = $data['bulan'];
      $tahun = $data['tahun'];
      printPembelian($conn, $bulan, $tahun, $name);
    }

    if ($action == "export") {
      $bulan = $data['bulan'];
      exportPembelian($conn, $bulan);
    }

    // mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function chat($conn, $data, $action, $id_user)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO chat (id_user, start) VALUES ('$id_user','$data[message]')";
    }

    if ($action == "update") {
      $chat = "SELECT id_user, reply FROM chat WHERE id_user='$data[id_user]' ORDER BY id_chat DESC LIMIT 1";
      $view_chat = mysqli_query($conn, $chat);
      $data_chat = mysqli_fetch_assoc($view_chat);
      $reply = $data_chat['reply'];
      if (empty($reply)) {
        $sql = "UPDATE chat SET reply = '$data[message]' WHERE id_user = '$data[id_user]' ORDER BY id_chat DESC LIMIT 1";
      } else {
        $sql = "INSERT INTO chat (id_user,reply) VALUES ('$data[id_user]','$data[message]')";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function ulasan($conn, $data, $action, $id_user)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO ulasan (id_user,id_produk,rating,ulasan) VALUES ('$id_user','$data[id_produk]','$data[rating]','$data[ulasan]')";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function __name($conn, $data, $action)
  {
    if ($action == "insert") {
    }

    if ($action == "update") {
    }

    if ($action == "delete") {
    }

    // mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }
}
