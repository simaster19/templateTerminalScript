<?php 
/*
Created By Simaster19
YT Simaster19 or Republik Channel
IG simaster19
*/
session_start();
//error_reporting(0);
include "config.php";
//system("xdg-open https://youtube.com/channel/UC-yfGYYOOce-DoFoIt_a9tQ");
date_default_timezone_set("Asia/Jakarta");

//Ganti FREE untuk Free SC
//Ganti PREMIUM untuk Premium SC 
$typeSource = "FREE";

//FOR PREMIUM USER
$username = "premium1";
$versiAppPremium = "1.3";

$yourFilePremium = file_get_contents('dataPremiumDebug.json');
$yourDataPremium = json_decode($yourFilePremium);

//For FREE USER
$versiApp = "1.3";
$countToken = 25;
//Create IP 
$yourIP = trim(file_get_contents("https://ip.jaranguda.com"));
//Nama SC 
$scName = $_SERVER["PHP_SELF"];

$yourFile = file_get_contents('dataDebug.json');
$yourData = json_decode($yourFile);

$date = date("D", time());
system("clear");

//Kumpulan Warna Untuk Terminal
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
    
//Class Database
class Databases {
    public $koneksi;
    private $server = "localhost:3306"; //"sql.freedb.tech:3306";
    private $user = "root"; //"freedb_simaster19";
    private $pass = "root"; //'7E9Fvc*4X*6#U$C';
    private $dbname = "simaster"; //"freedb_simaster";
       
    //Constructor Function
    function __construct ()
    {
      $this->koneksi = mysqli_connect($this->server,$this->user,$this->pass,$this->dbname);  
    }
    
    #Table User 
    //Add New User
    public function addNewUser()
    {
      global $yourIP, $userAgent, $scName, $versiApp, $countToken;
      global $redB, $whiteB, $greenB, $yellowB;
      
      //Take Data Versi By Versi And Name
      $id_versi = $this->queryDataVersiByVN($scName);
      
      
      //Take Data Shortlink
      $queryDataShortlink = $this->queryDataShortlink();
      
       $link = $queryDataShortlink[array_rand($queryDataShortlink)]['short'];
       
       echo $greenB."[✓] Link TOKEN : ".$yellowB.$link;
       echo "\n";
       echo $greenB."[!] Please Klik Any Key Button, For Visit WEB TOKEN!      ";
       
       readline();
       
       system("xdg-open ".$link);
       system("clear");
       
       echo $yellowB."[>] Input Token : ".$whiteB;
       $token = trim(fgets(STDIN));
      

       //Create ID USER
       $sqlID = "SELECT max(id) as newId FROM tableUser";
       $query = mysqli_query($this->koneksi,$sqlID);
       $data = mysqli_fetch_assoc($query);
       $id = $data['newId'] + 1;
       
       //$encryptId = password_hash($id,PASSWORD_DEFAULT);
       
       //Cek Versi
       if ($id_versi['versi'] !== $versiApp) {
         
        echo $yellowB."[!] This Script Versi ".$versiApp.", Please Download New Versi ".$id_versi['versi']."\n";
        echo $yellowB."[✓] You can Call Admin On Instagram @simaster19\n\n";
        echo $yellowB."[!] This Link Script New : ".$id_versi['link']."\n\n";
   
        die();
       }
       
       $id_versiA = $id_versi['id'];
       $expiredToken = $countToken; //Remaining 
       $createUsername = createTokenPremium();
       
       //Save Data Json
       saveFileUser($id,$createUsername,$expiredToken);
       sleep(2);
       
       
       
       $yourFile = file_get_contents('dataDebug.json');
       $yourData = json_decode($yourFile);
       
       //Create Date
       $created_at = date("d-m-Y");
       
       //Count Login
       $hitungLogin = "1";

      //Request Function Login
       $id_shortlink = $this->loginUser($link,$token);
       
       if ($id_shortlink) {
         //Sql Insert Data User
         $sql = "INSERT INTO tableUser VALUES('$id','$id_versiA','$id_shortlink','$createUsername','$yourIP','$userAgent','$expiredToken','$hitungLogin','$created_at')";
         $datax =  mysqli_query($this->koneksi,$sql);
         
         sleep(2);
         
         $sqlUa = "INSERT INTO tableUa VALUES('$id','$userAgent','$created_at')";
         $dataUa = mysqli_query($this->koneksi, $sqlUa);

         echo $greenB."[✓] Successfully Token!\n";
         sleep(2);
       }else{
         echo $redB."[X] Wrong Token, Please Re-run!";
         $deleteUserById = $this->deleteUserById($yourData->id);
         sleep(2);
         system("rm -f dataDebug.json");
         
         die();
       }
    }
    
    //Login User 
    public function loginUser($link,$token)
    {
      $sql = mysqli_query($this->koneksi, "SELECT * FROM tableShortlink WHERE short = '$link' AND token = '$token'");
      $data = mysqli_fetch_assoc($sql);

      return $data['id'];

    }
    
    //Delete User By Id
    public function deleteUserById($id)
    {
      $sql = mysqli_query($this->koneksi,"DELETE FROM tableUser WHERE id = '$id'");
      
      return mysqli_affected_rows($this->koneksi);
    } 
    
    //Query Data User By ID 
    public function queryDataUserById($id)
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableUser WHERE id = '$id'");
      $data = mysqli_fetch_assoc($sql);
      
      return $data;
    }
    
    //Edit User ExpiredToken By ID 
    public function editDataUserETById($id){
      global $yourIP;
      
      $sql1 = mysqli_query($this->koneksi,"SELECT * FROM tableUser WHERE id = '$id'");
      $data = mysqli_fetch_assoc($sql1);
      
      $ip = $yourIP;
      $userAgent = $data['userAgent'];
      $id_shortlink = $data['id_shortlink'];
      $id_versi = $data['id_versi'];
      $username = $data['username'];
      $expiredToken = $data['expiredToken'] - 1;
      $count = $data['count'] + 1;
      $created_at = $data['created_at'];
      
      $sql2 = mysqli_query($this->koneksi, "SELECT * FROM tableShortlink WHERE id = '$id_shortlink'");
      $data2 = mysqli_fetch_assoc($sql2);
      $token = $data2['token'];
      
      saveFileUser($id,$username,$expiredToken);
      
      $sql = mysqli_query($this->koneksi,"UPDATE tableUser SET 
          id_versi = '$id_versi',
          id_shortlink = '$id_shortlink',
          username = '$username',
          ip = '$ip',
          userAgent = '$userAgent',
          expiredToken = '$expiredToken',
          count = '$count',
          created_at = '$created_at'
          WHERE id = $id
            ");
    
      if ($sql) {
        return $expiredToken;
      }
    }
    
    
    
    #Table Shortlink 
    //query Data Shortlink
    public function queryDataShortlink()
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableShortlink");
      $data = [];
      while($dataField = mysqli_fetch_assoc($sql)){
        $data[] = $dataField;
        
      }
      return $data;
    }
    
    //query Data Shortlink By Id_shortlink 
    public function queryDataShortlinkById($id_shortlink)
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableShortlink WHERE id = '$id_shortlink'");
      $data = mysqli_fetch_assoc($sql);
      
      return $data;
    }
    
    
    
    
    #Table Versi 
    //query Data Versi
    public function queryDataVersi()
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableVersi");
      $data = [];
      while($dataField = mysqli_fetch_assoc($sql)){
        $data[] = $dataField;
        
      }
      return $data;
    }
    
    //query Data Versi By Versi and Name
    public function queryDataVersiByVN($scName)
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableVersi WHERE namaSc = '$scName'");
      $data = mysqli_fetch_assoc($sql);
      
      return $data;
    }
    
    //query Data Versi By id_versi
    public function queryDataVersiById($id_versi)
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableVersi WHERE id = '$id_versi'");
      $data = mysqli_fetch_assoc($sql);
      
      return $data;
    }
    
    //Edit Data Versu By id_versi 
    public function editDataVersiById($id){
      global $versiApp;
      
      $sql1 = mysqli_query($this->koneksi,"SELECT * FROM tableVersi WHERE id = '$id'");
      $data = mysqli_fetch_assoc($sql1);
      
      $namaSc = $data['namaSc'];
      $versi = $versiApp;
      $link  = $data['link'];
      $message = $data['message'];
      $status = $data['status'];
      
      
      $sql = mysqli_query($this->koneksi,"UPDATE tableVersi SET 
          namaSc = '$namaSc',
          versi = '$versi',
          link = '$link',
          message = '$message',
          status = '$status'
          WHERE id = $id
            ");
    
      if ($sql) {
        return $versi;
      }
    }
    
    
    #Table User Premium 
    //query Table Premium By username 
    public function queryDataUserPremium($username)
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableUserPremium WHERE username = '$username'");
      $data = mysqli_fetch_assoc($sql);
      
      return $data;
    }
}
$database = new Databases;

//Cek Type SourceCode 
if ($typeSource == "PREMIUM") 
{

  //Query Data Premium By Username 
  $queryDataUserPremium = $database->queryDataUserPremium($username);
  
  $id_versi = $queryDataUserPremium['id_versi'];
  
  //Query Data User Premium 
  $queryDataVersiById = $database->queryDataVersiById($id_versi);
  $versiPremium = $queryDataVersiById['versi'];
  
  //Cek Keaktifan Script
  if ($queryDataVersiById['status'] == "Non Active") 
  {
    echo $redB."[X] This script OFF / NON ACTIVE\n\n";
    die();
  }else
  {
    true;
  }
  //Cek Data json 
  if (!file_exists('dataPremiumDebug.json')) 
  {
    //Save File Data premium 
    saveFilePremium();
    echo $yellowB."[!] Please Re-run!\n";
    die();
  }
  
  if (file_exists('dataPremiumDebug.json')) 
  {
    //Cek password on Data
    if ($queryDataUserPremium['pass'] !== "" && $yourDataPremium->password == "") 
    {
      $password = $queryDataUserPremium['pass'];
      saveFilePremium($password);
      echo $greenB."[✓] Successfully Saved Your Token!\n[!] Please Re-run Script\n";
      die();
      
      //Login User Premium
    }elseif ($queryDataUserPremium['username'] == $username && $queryDataUserPremium['pass'] == $yourDataPremium->password && $yourDataPremium->password !== "") 
    {
      //Cek VERSI App Premium
      $queryDataVersiById = $database->queryDataVersiById($id_versi);
      
      $versi = $queryDataVersiById['versi'];
      $namaSc = $queryDataVersiById['namaSc'];
    
      if ($queryDataVersiById['namaSc'] == $namaSc && $versi > $versiAppPremium) 
      {
        echo $yellowB."[✓] Versi Terbaru $versi Tersedia! Silahkan Update!\n\n";
        echo $yellowB."[✓] Link : ".$whiteB.$queryDataVersiById['link'];
        echo $greenU."\nWhat's News : \n";
        echo $greenT.$greenB.$cyanB.$queryDataVersiById['message'];
        echo "\n\n";
        die();
        
      }elseif ($queryDataUserPremium['username'] == $username && $queryDataVersiById['versi'] == $versiAppPremium)
      {
        goto ForPremiumUser;
      }
      
    }elseif ($queryDataUserPremium['username'] == $username) 
    {
        saveFilePremium();
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
      }
    }

}

if($typeSource == "FREE")
{
  
  //Cek USER FREE AKUN
  if (!file_exists('dataDebug.json')) 
  {
    //Create Akun 
    $addNewUser = $database->addNewUser();
    system("clear");
    echo $yellowB."[!] Please Re-run Script!\n";
    die();
  }
  //Cek User Agent
  if (preg_match("/NULL/", $userAgent) || !preg_match("/\bMozilla\/5.0/", $userAgent) || strlen($userAgent) < 110) 
  {
    echo $redB."[X] Your User Agent Undefined!\n";
    echo $yellowB."[!] Search On Google and Write My User Agent on Input Box!\n";
    die();
  }elseif(preg_match("/\bMozilla\/5.0/", $userAgent))
  {
    true;
  }
  
  
  $queryDataUserById = $database->queryDataUserById($yourData->id);

  $queryDataVersiById = $database->queryDataVersiById($queryDataUserById['id_versi']);
  
  //Cek Keaktifan Script
  if ($queryDataVersiById['status'] == "Non Active") 
  {
    echo $redB."[X] This script OFF / NON ACTIVE\n\n";
    die();
  }else
  {
    true;
  }
  
  
  //Cek User Lama
  if (file_exists('dataDebug.json')) 
  {
    
    
    //Get ID Versi and shortlink
    $id_versi = $queryDataUserById['id_versi'];
    $id_shortlink = $queryDataUserById['id_shortlink'];
    
    //Query Data Versi By ID 
    $queryDataVersiById = $database->queryDataVersiById($id_versi);
    
    //Query Data Shortlink By ID 
    $queryDataShortlinkById = $database->queryDataShortlinkById($id_shortlink);
  
    if ($queryDataUserById['id'] == $yourData->id && $queryDataUserById['username'] == $yourData->token) 
    {
      
      if ($date !== "Sun") 
      {
        //Edit Count Expired Token Token
        $editDataUserETById = $database->editDataUserETById($yourData->id);
        sleep(2);
        
        if($yourData->expiredToken <= 1 || $queryDataUserById['expiredToken'] <= 1)
        {
  
          //Delete Account User
          $id = $yourData->id;
          sleep(2);
          
          $deleteUserById = $database->deleteUserById($id);
          echo $redB."[X] Token Expired, Please Taking Token Again\n";
          sleep(3);
          system("rm -f dataDebug.json");
          die();
        }
      }
        //Update Data
        $queryDataUserById2 = $database->queryDataUserById($yourData->id);
        $use = $queryDataUserById2['count'];
        $ipx = $queryDataUserById2['ip'];
        $tkn = $queryDataUserById2['expiredToken'];
  
        
        
    }elseif($queryDataUserById2['id'] !== $yourData->id && $queryDataUserById2['username'] !== $yourData->token)
    {
     
      echo $redB."[X] Data, Not Correct!\n";
      echo $redB."[X] Please Re-run Again\n\n";
      sleep(2);
   
      system("rm -f dataDebug.json");
      die();
      
    }

    //Cek VERSI App
    $queryDataVersiById = $database->queryDataVersiById($id_versi);
    
    $versi = $queryDataVersiById['versi'];
    $namaSc = $queryDataVersiById['namaSc'];
  
    if ($queryDataVersiById['namaSc'] == $namaSc && $versi > $versiApp) 
    {
      echo $yellowB."[✓] Versi Terbaru $versi Tersedia! Silahkan Update!\n\n";
      echo $yellowB."[✓] Link : ".$whiteB.$queryDataVersiById['link'];
      echo $greenU."\nWhat's News : \n";
      echo $greenT.$greenB.$cyanB.$queryDataVersiById['message'];
      echo "\n\n";
      die();
      
    }elseif ($queryDataUserById['id'] == $yourData->id && $queryDataVersiById['versi'] == $versiApp)
    {
      goto ForFreeUser;
    }
  }
}


ForFreeUser:
//Function Save File User 
function saveFileUser($id,$token,$expiredToken)
{
  $fileId = fopen("dataDebug.json", "w");
         fwrite($fileId,'{"id":"'.$id.'","token":"'.$token.'","expiredToken":'.$expiredToken.'}');
}

//Label Premium Jika Variabel Paling Atas diganti premium dan user pass ada dan benar
ForPremiumUser:
//Function Save File Premium
function saveFilePremium($password = "")
{
  $fileId = fopen("dataPremiumDebug.json", "w");
         fwrite($fileId,'{"password":"'.$password.'"}');
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
  return md5(sha1($Hash));
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
     usleep(6000);  
  }
}

//function Header Premium
function headerAppPremium()
{
  global $yellowB,$greenB,$whiteB,$purpleB,$blueB,$cyanB;
  global $versiPremium;

  echo $purpleB."
 _____ _  ___  ___          _            __   _____ 
/  ___(_) |  \/  |         | |          /  | |  _  | ".$greenB."Versi: ".$versiPremium.$purpleB."
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
  global $yellowB,$greenB,$whiteB,$purpleB,$blueB,$cyanB;
  global $ipx,$use,$tkn,$versiApp,$queryById2;

  echo $purpleB."
 _____ _  ___  ___          _            __   _____ 
/  ___(_) |  \/  |         | |          /  | |  _  | ".$greenB."Versi:".$queryById2['versi'].$purpleB."
\ `--. _  | .  . | __ _ ___| |_ ___ _ __`| | | |_| | ".$greenB."What's New :".$purpleB."
 `--. \ | | |\/| |/ _` / __| __/ _ \ '__|| | \____ | ".$greenB."1. Optimation Code".$purpleB."
/\__/ / | | |  | | (_| \__ \ ||  __/ |  _| |_.___/ / ".$greenB."2. Add Features".$purpleB."
\____/|_| \_|  |_/\__,_|___/\__\___|_|  \___/\____/ 
";
  //system("figlet Si Master19");
  echo $whiteB."=======================================================\n";
  echo teksKetik($yellowB."Created By SiMaster19 ".$whiteB."|".$yellowB." Not For Sell ".$whiteB."|".$yellowB." IG: @simaster19\n");
  echo $whiteB."=======================================================\n";
  echo teksKetik($yellowB."Your IP : ".$ipx.$whiteB." |".$yellowB." Use to : ".$use.$whiteB." |".$yellowB." Remaining : ".$tkn."\n");
  echo $whiteB."=======================================================\n\n";
}
awal:
headerApp();
