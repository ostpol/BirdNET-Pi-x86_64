<title>BirdNET-Pi</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body::-webkit-scrollbar {
  display:none
}
</style>
<link rel="stylesheet" href="style.css">
<body>
<div class="banner">
  <div class="logo">
<?php if(isset($_GET['logo'])) {
echo "<a href=\"https://github.com/mcguirepr89/BirdNET-Pi.git\" target=\"_blank\"><img style=\"width:60;height:60;\" src=\"images/bird.png\"></a>";
} else {
echo "<a href=\"https://github.com/mcguirepr89/BirdNET-Pi.git\" target=\"_blank\"><img src=\"images/bird.png\"></a>";
}?>
  </div>
  <div class="stream">
<?php
if(isset($_GET['stream'])){
  if (file_exists('/home/pi/BirdNET-Pi/thisrun.txt')) {
    $config = parse_ini_file('/home/pi/BirdNET-Pi/thisrun.txt');
  } elseif (file_exists('/home/pi/BirdNET-Pi/firstrun.ini')) {
    $config = parse_ini_file('/home/pi/BirdNET-Pi/firstrun.ini');
  }
  $caddypwd = $config['CADDY_PWD'];
  if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'You cannot listen to the live audio stream';
    exit;
  } else {
    $submittedpwd = $_SERVER['PHP_AUTH_PW'];
    $submitteduser = $_SERVER['PHP_AUTH_USER'];
    if($submittedpwd == $caddypwd && $submitteduser == 'birdnet'){
      echo "
  <audio controls autoplay><source src=\"/stream\"></audio>
  </div>
  <h1><a href=\"\">BirdNET-Pi</a><img src=\"images/version.svg\"></h1>
  </div>";
    } else {
      header('WWW-Authenticate: Basic realm="My Realm"');
      header('HTTP/1.0 401 Unauthorized');
      echo 'You cannot listen to the live audio stream';
      exit;
    }
  }
} else {
  echo "
  <form action=\"\" method=\"GET\">
    <button type=\"submit\" name=\"stream\" value=\"play\">Live Audio</button>
  </form>
  </div>
  <h1><a href=\"\">BirdNET-Pi</a><img src=\"images/version.svg\"></h1>
</div>";
}
if(isset($_GET['log'])) {
  if (file_exists('/home/pi/BirdNET-Pi/thisrun.txt')) {
    header("Location: /log");}
} elseif(isset($_GET['spectrogram'])){
    header("Location: /spectrogram.php");
} else {
    echo "
<iframe src=\"/views.php\">
</div>";
}