<?php 
/*
Created By Simaster19
YT Simaster19 or Republik Channel
IG simaster19

Free Decrypt , sertakan My Youtube or author simaster19
*/
session_start();
error_reporting(0);
include "config.php";
system("xdg-open https://youtube.com/channel/UC-yfGYYOOce-DoFoIt_a9tQ");
date_default_timezone_set("Asia/Jakarta");

//JSON
$data = file_get_contents("https://pastebin.com/raw/Wn0jwQDa");
$parse = json_decode($data);
//Ganti Sesuai SC
$typeSource = "FREE";

//FOR PREMIUM USER
$username = "";
$versiAppPremium = "";

$yourFilePremium = file_get_contents('tokenPremium');

//For FREE USER
$token = file_get_contents('token');
$hidden = file_get_contents('.hidden');

$versiApp = "2.1.3"; //Db.nodb.fixbux
$countToken = 20;

//Create IP 
$yourIP = trim(file_get_contents("https://ip.jaranguda.com"));

//Nama SC 
$namaSc = strtolower($_SERVER["PHP_SELF"]);

$date = date("D", time());
system("clear");
//Warna Untuk Teks
  $greenT = "\e[0;32m";
  $redT = "\e[0;31m";
  $yellowT = "\033[0;33m";
  $whiteT = "\033[0;37m";
  $blueT = "\033[0;34m";
  $purpleT = "\033[0;35m";
  $cyanT = "\033[0;36m";
#--------------------
//Warna Teks Tebal
  $greenB = "\033[1;32m";
  $redB = "\033[1;31m";
  $yellowB = "\033[1;33m";
  $whiteB = "\033[1;37m";
  $blueB = "\033[1;34m";
  $purpleB = "\033[1;35m";
  $cyanB = "\033[1;36m";
#---------------------
//Warna Teks Garis Bawah
  $greenU = "\033[4;32m";
  $redU = "\033[4;31m";
  $yellowU = "\033[4;33m";
  $whiteU = "\033[4;37m";
  $blueU = "\033[4;34m";
  $purpleU = "\033[4;35m";
  $cyanU = "\033[4;36m";
  $blackU = "\033[4;30m";
#---------------------------
//Warna Background
  $greenBg = "\033[42m";
  $redBg = "\033[41m";
  $yellowBg = "\033[43m";
  $whiteBg = "\033[47m";
  $blueBg = "\033[44m";
  $purpleBg = "\033[45m";
  $cyanBg = "\033[46m";
  $blackBg = "\033[40m";
#---------------------------
$warna = [$purpleB,$cyanB,$greenB];

class User {
  public function queryShortlink()
  {
    global $parse;
    $dataShortlink = $parse->data->dataShortlink;
    
    return $dataShortlink;
  }
  
  public function querySourcecode()
  {
    global $parse;
    $dataSourcecode = $parse->data->dataSourcecode->sourcecode;
    
    return $dataSourcecode;
  }
  
  public function queryUserPremium()
  {
    global $parse;
    $dataUserPremium = $parse->data->dataUserPremium;
    
    return $dataUserPremium;
  }
  
  public function queryDataUser()
  {
    global $parse;
    $dataUser = $parse->data->dataUser;
    
    return $dataUser;
  }
  
  public function info()
  {
    global $parse;
    
    $info = $parse->info;
    
    return $info;
  }
}

$user = new User;

$shortlink = $user->queryShortlink();
$dataShort = $shortlink->short;
$dataToken = $shortlink->token;

$dataUser = $user->queryDataUser();
$aplikasi = $dataUser->aplikasi;

$dataUserPremium = $user->queryUserPremium();
$aplikasiPremium = $dataUserPremium->userPremium;

$info = $user->info();
$sourcecode = $user->querySourcecode();

//Cek File Token For Free
if ($typeSource == "FREE") 
{
  //Cek Menu 
  if ($simasterScript == "ON") 
  {
    headerMenu();
    $i = 1;
    foreach ($sourcecode as $valueSourcecode)
    {
      $valueSourcecode->status=="UPLOADED" ? $warna = $greenB : $warna = $yellowB;
      
      echo $yellowB."[".$i++."]".$yellowB."  [NAMA APK/WEB - YOUTUBE]  : ".$whiteB.$valueSourcecode->namaApkWeb." - ".$cyanB.$valueSourcecode->linkYt."  ".$warna.$valueSourcecode->status;
      echo "\n";
    }
    echo $yellowB."\n[0]  FOR SKIP!";
    echo "\n\n";
    echo $cyanB."[>] Input Number For Access : ".$whiteB;
    $inputNumber = trim(fgets(STDIN));
    
    if (!is_numeric($inputNumber) || $inputNumber == "") 
    {
      die();
    }elseif ($inputNumber == 0) {
      system("clear");
      true;
    }elseif (is_numeric($inputNumber)) {
      
      $sourcecodeByNumber = sourcesodeByNumber($inputNumber);
      if ($sourcecodeByNumber) 
      {
        system("xdg-open ".$sourcecodeByNumber);
        system("clear");
        true;
      }
    }
  }elseif($simasterScript == "OFF")
  {
    true;
  }else{
    echo $yellowB.'[!] Open config.php, Fill in Varibel $simasterScript';
    echo $greenB."\n    ON".$yellowB." for Active Menu\n".$greenB."    OFF".$yellowB." for Non Active Menu\n\n";
    die();
  }
  
  //Cek Versi 
  $cekAplikasi = aplikasiFree($namaSc,$versiApp);
  if ($cekAplikasi[0]->versiApp > $versiApp && $cekAplikasi[0]->namaSc == $namaSc) 
  {
    echo $yellowB."[✓] Versi Terbaru ".$greenB.$cekAplikasi[0]->versiApp.$yellowB." Tersedia! Silahkan Update!\n\n";
    echo $yellowB."[✓] Link : ".$whiteB.$cekAplikasi[0]->link;
    echo $greenT."\nWhat's News : \n";
    echo $cyanT.$cekAplikasi[0]->message;
    echo "\n\n";
    die();
  }elseif ($cekAplikasi[0]->versiApp == $versiApp && $cekAplikasi[0]->namaSc == $namaSc) {
    //Success
    true;
  }
  
  //Cek userAgent 
  if (preg_match("/NULL/", $userAgent) || !preg_match("/\bMozilla\/5.0/", $userAgent) || strlen($userAgent) < 110) 
  {
    echo $redB."[X] Your User Agent Undefined!\n";
    echo $yellowB."[!] Search On Google and Write My User Agent on Input Box!\n";
    die();
  }elseif(preg_match("/\bMozilla\/5.0/", $userAgent))
  {
    true;
  }
  
  //Cek Keaktifan Script
  if ($cekAplikasi[0]->status == "Non Active") 
  {
    echo $redB."[X] This script OFF / NON ACTIVE\n\n";
    die();
  }else
  {
    true;
  }
  
  
  if (!file_exists('token') || file_get_contents('token') == "") 
  {
    $link = $dataShort[array_rand($dataShort)];
    //$link = $dataShort[1];
    
    echo $greenB."[✓] Link TOKEN : ".$yellowB.$link;
    echo "\n";
    echo $greenB."[!] Please Klik Any Key Button, For Visit WEB TOKEN!      ";
   
    readline();
    system("xdg-open ".$link);
    system("clear");
   
    echo $yellowB."[>] Input Token : ".$whiteB;
    $inputToken = trim(fgets(STDIN));
  
    //Fungsi Cek Validasi 
    $validasi = takeShortlink($link,$inputToken);
    
    if ($validasi == true) 
    {
      //Save File 
      saveFileUser($inputToken);
      
      echo $greenB."[✓] Successfully Saved Your Token!\n[!] Please Re-run Script\n";
      die();
    }else{
      echo $redB."[X] Wrong Token, Please Re-run!";
      sleep(2);
      system("rm -f token");
         
      die();
    }
      
  }elseif (file_exists('token') || file_get_contents('token') !== "") 
  {
    // kurangi Count Token 
    $yourCount = explode("#",$hidden)[1];
    $yourToken = explode("#",$hidden)[0];
 
    //cek Token Tersimpan 
    if ($date !== "Sun") {
      if (password_verify($hidden,$token)) 
      {
        //simpan Data Count 
        $sisaCount = saveFileCount($yourToken,$yourCount);
        
        //Cek Token count
        if ($sisaCount < 1) 
        {
          echo $redB."[X] Token Expired, Please Taking Token Again\n";
          sleep(2);
          system("rm -f token");
          system("rm -f .hidden");
          die();
        }
      }else{
        echo $yellowB."[!] Data Not Correct!\n";
          sleep(2);
          die();
      }
    }else{
      if (password_verify($hidden,$token)) 
      {
        true;
      }
    }
    
  }
}
if ($typeSource == "PREMIUM") 
{
  $cekAplikasiPremium = aplikasiPremium($namaSc,$versiAppPremium);
   
    //Cek Versi premium
  if ($cekAplikasiPremium[0]->versiApp > $versiApp && $cekAplikasiPremium[0]->namaSc == $namaSc) 
  {
    echo $yellowB."[✓] Versi Terbaru ".$greenB.$cekAplikasiPremium[0]->versiApp.$yellowB." Tersedia! Silahkan Update!\n\n";
    echo $yellowB."[✓] Link : ".$whiteB.$cekAplikasiPremium[0]->link;
    echo $greenT."\nWhat's News : \n";
    echo $cyanT.$cekAplikasiPremium[0]->message;
    echo "\n\n";
    die();
  }elseif ($cekAplikasiPremium[0]->versiApp == $versiApp && $cekAplikasiPremium[0]->namaSc == $namaSc) {
    //Success
    true;
  }
  
  //Cek userAgent 
  if (preg_match("/NULL/", $userAgent) || !preg_match("/\bMozilla\/5.0/", $userAgent) || strlen($userAgent) < 110) 
  {
    echo $redB."[X] Your User Agent Undefined!\n";
    echo $yellowB."[!] Search On Google and Write My User Agent on Input Box!\n";
    die();
  }elseif(preg_match("/\bMozilla\/5.0/", $userAgent))
  {
    true;
  }
  
  if ($username == "") 
  {
    //Buat Token
    $yourToken = createTokenPremium();
    echo $greenB."[✓] This Script Premium!\n";
    echo "[-] Your Token Is : ".$yellowB.$yourToken;
    echo "\n\n";
        
    echo $cyanB."[>] Please Calling Admin/Script Maker : \n";
    echo $cyanB."[IG] Instagram : ".$greenB."simaster19\n\n";
      
    echo $greenB."[>] Input IG/ig For Visit : ";
        $inputText = trim(fgets(STDIN));
      
    if ($inputText == "IG" || $inputText == "ig") 
    {
      system("xdg-open https://instagram.com/simaster19");
      die();
    }else{
      echo $redB."[X] Wrong Input!\n\n";
      die();
    }
  }elseif (file_exists('tokenPremium') || $username !== "") 
  {
     
    //Login 
    $pass = $cekAplikasiPremium[0]->password;
    if (password_verify($pass,$yourFilePremium)) 
    {
      echo "Success Login";
    }else {
      //Cek Premium Password 
      if ($cekAplikasiPremium[0]->password !== "") 
      {
        echo $greenB."Input Token : ".$whiteB;
        $inputPassword = trim(fgets(STDIN));
        
        saveFileUserPremium($inputPassword);
        
        echo $greenB."[✓] Token Successfully!\n";
        echo $greenB."[✓] Please re-run\n\n";
        die();
      }
      
    }
  }
  
}


//function For Cek Token By CountToken
function takeShortlink($link,$token)
{
  global $dataShort,$dataToken;
  
  for ($i = 0; $i < count($dataShort); $i++) 
  {
    //var_dump($dataShort[$i]);
     if ($dataShort[$i] == $link && $dataToken[$i] == $token) 
     {
       return true;
       //sleep(1);
       //break;
     }
  }
}

function sourcesodeByNumber($number)
{
  global $sourcecode;
  
  //$output = [];
  for ($i = 1; $i < count($sourcecode); $i++) 
  {
    if ($number) {
      $new = ($number-1);
      return $sourcecode[$new]->linkYt;
    }
    
  }
}


//function Save File User 
function saveFileUser($token)
{
  global $countToken;
  
  $encrypt = password_hash($token."#".$countToken, PASSWORD_DEFAULT);
  
  $fileId = fopen("token", "w");
         fwrite($fileId,$encrypt);
  
  $md5 = $token."#".$countToken;
  $fileHidden = fopen(".hidden","w");
     fwrite($fileHidden,$md5);
}

//function save file Premium
function saveFileUserPremium($token)
{
  
  $encrypt = password_hash($token, PASSWORD_DEFAULT);
  
  $fileId = fopen("tokenPremium", "w");
         fwrite($fileId,$encrypt);
}

//Function Save File User Count 
function saveFileCount($token,$count)
{
  $countMin = ($count-1);
  
  $encrypt = password_hash($token."#".$countMin, PASSWORD_DEFAULT);
  
  $fileId = fopen("token", "w");
         fwrite($fileId,$encrypt);
  
  $md5 = $token."#".$countMin;
  $fileHidden = fopen(".hidden","w");
     fwrite($fileHidden,$md5);
     
  return $countMin;
}

//Function Versi Aplikasi
function aplikasiFree($namaSc,$versiApp)
{
  global $aplikasi,$namaSc;
  
  $output = [];
  for ($i = 0; $i < count($aplikasi); $i++) 
  {
     if (strtolower($aplikasi[$i]->namaSc) == $namaSc && $aplikasi[$i]->versiApp == $versiApp) 
     {
       $output[] = $aplikasi[$i];
     }elseif (strtolower($aplikasi[$i]->namaSc) == $namaSc && $aplikasi[$i]->versiApp > $versiApp) 
     {
       $output[] = $aplikasi[$i];
     }
  }
  
  return array_filter($output);
}

//Function Versi Aplikasi
function aplikasiPremium($namaSc,$versiAppPremium)
{
  global $aplikasiPremium,$namaSc;
  
  $output = [];
  for ($i = 0; $i < count($aplikasiPremium); $i++) 
  {
     if (strtolower($aplikasiPremium[$i]->namaSc) == $namaSc && $aplikasiPremium[$i]->versiApp == $versiAppPremium) 
     {
       $output[] = $aplikasiPremium[$i];
     }elseif (strtolower($aplikasiPremium[$i]->namaSc) == $namaSc && $aplikasiPremium[$i]->versiApp > $versiApp) 
     {
       $output[] = $aplikasiPremium[$i];
     }
  }
  
  return array_filter($output);
}

//Function For Token Premium 
function createTokenPremium()
{
  $length = 50;

  $character = '0123456789';
  $character .= 'abcdefghijklmnopqrstuvwxyz';
  $character .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

  $quantity_character = strlen($character);
  $quantity_character--;
  $Hash = NULL;

  for ($x = 1; $x <= $length; $x++) {
      $position = rand(0, $quantity_character);
      $Hash .= substr($character, $position, 1);
  }
  return $Hash;
}


#-------------------------------------------------------------#
#------------------Function HTTP SERVER-----------------------#
#-------------------------------------------------------------#
//function Get Data
function getCURL($url, $header) 
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  return $result;
}

//Function post Data
function postCURL($url, $data, $header) 
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  return $result;
}

//function parsing JSON
function parseJSON($dataGetPost) 
{
  $json = json_decode($dataGetPost);
  return $json;
}


#-------------------------------------------------------------#
#---------------------Function View App-----------------------#
#-------------------------------------------------------------#
//Function Auto Write
function teksKetik($myString)
{
  $string = str_split($myString);
  for ($i = 0; $i <= count($string); $i++) {
     print_r($string[$i]);
     usleep(4000);  
  }
}

//function header Menu 
function headerMenu()
{
  global $greenB,$whiteB,$purpleB;

  echo $purpleB."
 _____ _  ___  ___          _            __   _____ 
/  ___(_) |  \/  |         | |          /  | |  _  | ".$greenB."LIST SCRIPT CHANNEL YT".$purpleB."
\ `--. _  | .  . | __ _ ___| |_ ___ _ __`| | | |_| | 
 `--. \ | | |\/| |/ _` / __| __/ _ \ '__|| | \____ | 
/\__/ / | | |  | | (_| \__ \ ||  __/ |  _| |_.___/ /
\____/|_| \_|  |_/\__,_|___/\__\___|_|  \___/\____/ 
";
  //system("figlet Si Master19");
  echo $whiteB."=======================================================\n";
}
//function Header Premium
function headerAppPremium()
{
  global $yellowB,$greenB,$whiteB,$purpleB,$cyanB;
  global $versiAppPremium;

  echo $purpleB."
 _____ _  ___  ___          _            __   _____ 
/  ___(_) |  \/  |         | |          /  | |  _  | ".$greenB."Versi: ".$versiAppPremium.$purpleB."
\ `--. _  | .  . | __ _ ___| |_ ___ _ __`| | | |_| | 
 `--. \ | | |\/| |/ _` / __| __/ _ \ '__|| | \____ | 
/\__/ / | | |  | | (_| \__ \ ||  __/ |  _| |_.___/ /
\____/|_| \_|  |_/\__,_|___/\__\___|_|  \___/\____/ 
";
  //system("figlet Si Master19");
  echo $whiteB."=======================================================\n";
  echo teksKetik($yellowB."Created By SiMaster19 ".$whiteB."     |           ".$yellowB." IG: @simaster19\n");
  echo $whiteB."=======================================================\n";
  echo teksKetik("------------------------{$cyanB}PREMIUM{$whiteB}------------------------\n");
  echo $whiteB."=======================================================\n\n";
}

//function Header 
function headerApp()
{
  global $yellowB,$greenB,$whiteB,$purpleB;
  global $versiApp,$yourIP,$yourCount,$info;

  echo $purpleB."
 _____ _  ___  ___          _            __   _____ 
/  ___(_) |  \/  |         | |          /  | |  _  | ".$greenB."Versi: ".$versiApp.$purpleB."
\ `--. _  | .  . | __ _ ___| |_ ___ _ __`| | | |_| | ".$greenB."What's New :".$purpleB."
 `--. \ | | |\/| |/ _` / __| __/ _ \ '__|| | \____ | ".$greenB."1. Optimation Code".$purpleB."
/\__/ / | | |  | | (_| \__ \ ||  __/ |  _| |_.___/ / ".$greenB."2. Add Features".$purpleB."
\____/|_| \_|  |_/\__,_|___/\__\___|_|  \___/\____/ 
";
  //system("figlet Si Master19");
  echo $whiteB."=======================================================\n";
  echo teksKetik($yellowB."Created By SiMaster19 ".$whiteB."|".$yellowB." Not For Sell ".$whiteB."|".$yellowB." IG: @simaster19\n");
  echo $whiteB."=======================================================\n";
  echo teksKetik($yellowB."Your IP : ".$yourIP.$whiteB." |".$yellowB." Remaining : ".($yourCount-1)." |".$yellowB." Info : ".$info.$whiteB."\n");
  echo $whiteB."=======================================================\n\n";
}
awal:
headerApp();
