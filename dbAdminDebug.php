<?php 
//Warna Untuk Teks
  $greenT = "\e[0;32m";
  $redT = "\e[0;31m";
  $yellowT = "\033[0;33m";
  $whiteT = "\033[0;37m";
  $blueT = "\033[0;34m";
  $purpleT = "\033[0;35m";
  $cyanT = "\033[0;36m";
#----------------
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
class DatabasesAdmin {
    public $koneksi;
    private $server = "localhost:3306"; //"z50.h.filess.io:3307";//"sql12.freemysqlhosting.net";
    private $user = "root"; //"simaster19_bestdateor"; //"sql12579584";
    private $pass = "root"; //"fd25542f537ba3a16c91d1f75c38fc5444afcea4"; //"tjFFvMVt26";
    private $dbname = "simaster"; //"simaster19_bestdateor"; //"sql12579584";
    
    //Constructor Function
    function __construct ()
    {
      $this->koneksi = mysqli_connect($this->server,$this->user,$this->pass,$this->dbname);  
    }
    
    
    #Table User 
    //Edit Data User By Id 
    public function editUser($id,$id_versi,$id_shortlink,$username,$ip,$userAgent,$expiredToken,$count)
    {
    
      $sqlA = mysqli_query($this->koneksi, "SELECT * FROM tableUser WHERE id = '$id'");
      $data = mysqli_fetch_assoc($sqlA);
      
      $created_at = $data['created_at'];
      
      $sql = mysqli_query($this->koneksi, "UPDATE tableUser SET id_versi = '$id_versi', id_shortlink = '$id_shortlink', username = '$username', ip = '$ip', userAgent = '$userAgent', expiredToken = '$expiredToken', count = '$count', created_at = '$created_at' WHERE id = '$id'");
      
      return $sql;
    }
    
    //Delete Data User By Id 
    public function deleteUserById($id)
    {
      $sql = mysqli_query($this->koneksi,"DELETE FROM tableUser WHERE id = $id");
      return mysqli_affected_rows($this->koneksi);
    } 
    
    //Delete Data User By Multi Id 
    public function deleteUserMultiId(array $id)
    {
      $data = [];
      foreach ($id as $value)
      {
        $sql = mysqli_query($this->koneksi,"DELETE FROM tableUser WHERE id = $value");
        sleep(2);
        if ($sql) 
        {
          $data[] = $value;
        }
      }
      
      return $data;
    }
    
    //Query Data User 
    public function queryDataUser()
    {
      $sql = mysqli_query($this->koneksi,"SELECT tableUser.*, tableVersi.versi FROM tableUser INNER JOIN tableVersi ON tableUser.id_versi = tableVersi.id ");
      $data = [];
      while($dataField = mysqli_fetch_assoc($sql)){
        $data[] = $dataField;
        
      }
      return $data;
    }
    
    //Query Data User By Id 
    public function queryDataUserById($id)
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableUser WHERE id = $id");
      $data = mysqli_fetch_assoc($sql);
      
      return $data;
    }
    
    
    
    #Table User Premium 
    //Add New Data User Premium 
    public function addUserPremium($id_versi,$username,$pass,$expired_at)
    {
      
       $created_at = date("Y-m-d H:i:s");
       
       //Create ID
       $sqlID = "SELECT max(id) as newId FROM tableUserPremium";
       $query = mysqli_query($this->koneksi,$sqlID);
       $data = mysqli_fetch_assoc($query);
       $id = $data['newId'] + 1;
       
       $sql = "INSERT INTO tableUserPremium VALUES('$id','$id_versi','$username','$pass','$created_at','$expired_at')";
       $datax =  mysqli_query($this->koneksi,$sql);
      
       return $datax;
    }
    
    //Edit Data User Premium 
    public function editUserPremium($id,$id_versi,$username,$pass,$created_at,$expired_at)
    {
      $sql = mysqli_query($this->koneksi, "UPDATE tableUserPremium SET id_versi = '$id_versi', username = '$username', pass = '$pass', created_at = '$created_at', expired_at = '$expired_at' WHERE id = '$id'");
      return $sql;
    }
    
    //Delete Data User Premium 
    public function deleteUserPremiumById($id)
    {
      $sql = mysqli_query($this->koneksi,"DELETE FROM tableUserPremium WHERE id = $id");
      return mysqli_affected_rows($this->koneksi);
    } 
    
    //Delete Data User Premium Multi Id 
    public function deleteUserPremiumMultiId(array $id)
    {
      $data = [];
      foreach ($id as $value)
      {
        $sql = mysqli_query($this->koneksi,"DELETE FROM tableUserPremium WHERE id = $value");
        sleep(2);
        if ($sql) 
        {
          $data[] = $value;
        }
      }
      
      return $data;
    }
    
    //Query Data User Premium 
    public function queryDataUserPremium()
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableUserPremium");
      $data = [];
      while($dataField = mysqli_fetch_assoc($sql)){
        $data[] = $dataField;
        
      }
      return $data;
    }
    
    //Query Data User Premium By Id 
    public function queryDataUserPremiumById($id)
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableUserPremium WHERE id = $id");
      $data = mysqli_fetch_assoc($sql);
      
      return $data;
    }
    
    
    
    #Table Versi 
    //Add New Data Versi 
    public function addVersi($namaSc,$versi,$link,$message,$status)
    {
       //Create ID Versi
       $sqlID = "SELECT max(id) as newId FROM tableVersi";
       $query = mysqli_query($this->koneksi,$sqlID);
       $data = mysqli_fetch_assoc($query);
       $id = $data['newId'] + 1;
     
       $sql = "INSERT INTO tableVersi VALUES('$id','$namaSc','$versi','$link','$message','$status')";
       $datax =  mysqli_query($this->koneksi,$sql);
      
       return $datax;
    }
    
    //Edit Data Versi 
    public function editVersi($id,$namaSc,$versi,$link,$message,$status)
    {
      
      $sql = mysqli_query($this->koneksi, "UPDATE tableVersi SET namaSc = '$namaSc', versi = '$versi', link = '$link', message = '$message', status = '$status' WHERE id = '$id'");
      
      return $sql;
    }
    
    //Delete Data Versi By Id 
    public function deleteVersiById($id)
    {
      $sql = mysqli_query($this->koneksi,"DELETE FROM tableVersi WHERE id = '$id'");
      return mysqli_affected_rows($this->koneksi);
    } 
    
    //Delete Data Versi Multi Id 
    public function deleteVersiMultiId(array $id)
    {
      $data = [];
      foreach ($id as $value)
      {
        $sql = mysqli_query($this->koneksi,"DELETE FROM tableVersi WHERE id = $value");
        sleep(2);
        if ($sql) 
        {
          $data[] = $value;
        }
      }
      
      return $data;
    }
    
    //Query Data Versi 
    public function queryDataVersi()
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableVersi");
      $data = [];
      while($dataField = mysqli_fetch_assoc($sql)){
        $data[] = $dataField;
        
      }
      return $data;
    }
    
    //Query Data Versi By Id 
    public function queryDataVersiById($id)
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableVersi WHERE id = $id");
      $data = mysqli_fetch_assoc($sql);
      
      return $data;
    }
    
    
    
    #Table Shortlink 
    //Add New Data Shortlink
    public function addShortlink($short,$token)
    {
      
       $date = date("d-m-Y",time());
       
       //Create ID SHORT 
       $sqlID = "SELECT max(id) as newId FROM tableShortlink";
       $query = mysqli_query($this->koneksi,$sqlID);
       $data = mysqli_fetch_assoc($query);
       $id = $data['newId'] + 1;
       
       $sql = "INSERT INTO tableShortlink VALUES('$id','$short','$token','$date')";
       $dataA =  mysqli_query($this->koneksi,$sql);
      
       return $dataA;
    }
    
    //Edit Data Shortlink 
    public function editShortlink($id,$short,$token)
    {
      
      $sqlA = mysqli_query($this->koneksi, "SELECT * FROM tableShortlink WHERE id = '$id'");
      $data = mysqli_fetch_assoc($sqlA);
      
      $created_at = $data['created_at'];
      
      
      $sql = mysqli_query($this->koneksi, "UPDATE tableShortlink SET short = '$short', token = '$token', created_at = '$created_at' WHERE id = '$id'");
      
      return $sql;
    }
    
    //Delete Data Shortlink By Id 
    public function deleteShortlinkById($id)
    {
      $sql = mysqli_query($this->koneksi,"DELETE FROM tableShortlink WHERE id = $id");
      return mysqli_affected_rows($this->koneksi);
    } 
    
    //Delete Data Shortlink Multi Id 
    public function deleteShortlinkMultiId(array $id)
    {
      $data = [];
      foreach ($id as $value)
      {
        $sql = mysqli_query($this->koneksi,"DELETE FROM tableShortlink WHERE id = $value");
        sleep(2);
        if ($sql) 
        {
          $data[] = $value;
        }
      }
      
      return $data;
    }
    
    //Query Data Shortlink 
    public function queryDataShortlink()
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableShortlink");
      $data = [];
      while($dataField = mysqli_fetch_assoc($sql)){
        $data[] = $dataField;
        
      }
      return $data;
    }
    
    //Query Data Shortlink By Id 
    public function queryDataShortlinkById($id)
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableShortlink WHERE id = $id");
      $data = mysqli_fetch_assoc($sql);
      
      return $data;
    }
    
    
    #Table SourceCode 
    //Add New Data SourceCode 
    public function addSourcecode($namaSc,$namaTarget,$linkYt)
    {
      $created_at = date("d-m-Y", time());
      
      //Create ID
      $sqlID = "SELECT max(id) as newId FROM tableSourcecode";
      $query = mysqli_query($this->koneksi,$sqlID);
      $data = mysqli_fetch_assoc($query);
      $id = $data['newId'] + 1;
   
    
      $sql = "INSERT INTO tableSourcecode VALUES('$id','$namaSc','$namaTarget','$linkYt','$created_at')";
      $datax =  mysqli_query($this->koneksi,$sql);
    
      return $datax;
    }
    
    //Edit Data Sourcecode 
    public function EditSourcecode($id,$namaSc,$namaTarget,$linkYt)
    {
      
      $sqlA = mysqli_query($this->koneksi, "SELECT * FROM tableSourcecode WHERE id = '$id'");
      $data = mysqli_fetch_assoc($sqlA);
      
      $created_at = $data['created_at'];
      
      $sql = mysqli_query($this->koneksi, "UPDATE tableSourcecode SET namaSc = '$namaSc', namaApkWeb = '$namaTarget', linkYt = '$linkYt', created_at = '$created_at' WHERE id = '$id'");
      
      return $sql;
    }
    
    //Delete Data Sourcecode By Id
    public function DeleteSourcecodeById($id)
    {
      $sql = mysqli_query($this->koneksi,"DELETE FROM tableSourcecode WHERE id = '$id'");
      return mysqli_affected_rows($this->koneksi);
    } 
    
    //Delete Data Sourcecode Multi Id 
    public function deleteSourcecodeMultiId(array $id)
    {
      $data = [];
      foreach ($id as $value)
      {
        $sql = mysqli_query($this->koneksi,"DELETE FROM tableSourcecode WHERE id = $value");
        sleep(2);
        if ($sql) 
        {
          $data[] = $value;
        }
      }
      
      return $data;
    }
    
    //Query Data Sourcecode 
    public function queryDataSourcecode()
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableSourcecode");
      $data = [];
      while($dataField = mysqli_fetch_assoc($sql)){
        $data[] = $dataField;
        
      }
      return $data;
    }
    
    //Query Data Sourcecode By Id 
    public function queryDataSourcecodeById($id)
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableSourcecode WHERE id = $id");
      $data = mysqli_fetch_assoc($sql);
      
      return $data;
    }
    
    
    
    #Table Ua 
    //Delete Data UA By Id
    public function DeleteUaById($id)
    {
      $sql = mysqli_query($this->koneksi,"DELETE FROM tableUa WHERE id = '$id'");
      return mysqli_affected_rows($this->koneksi);
    } 
    
    //Delete Data UA Multi Id 
    public function deleteUaMultiId(array $id)
    {
      $data = [];
      foreach ($id as $value)
      {
        $sql = mysqli_query($this->koneksi,"DELETE FROM tableUa WHERE id = $value");
        sleep(2);
        if ($sql) 
        {
          $data[] = $value;
        }
      }
      
      return $data;
    }
    
    //Query Data Ua 
    public function queryDataUa()
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableUa");
      $data = [];
      while($dataField = mysqli_fetch_assoc($sql)){
        $data[] = $dataField;
        
      }
      return $data;
    }
    
    //Query Data Ua By Id 
    public function queryDataUaById($id)
    {
      $sql = mysqli_query($this->koneksi,"SELECT * FROM tableUa WHERE id = $id");
      $data = mysqli_fetch_assoc($sql);
      
      return $data;
    }
    
    
}
$database = new DatabasesAdmin;

function headerApp()
{
  global $greenB,$yellowB,$cyanB;
  echo $greenB."
  _____        _        _                    
 |  __ \      | |      | |                   
 | |  | | __ _| |_ __ _| |__   __ _ ___  ___ 
 | |  | |/ _` | __/ _` | '_ \ / _` / __|/ _ \
 | |__| | (_| | || (_| | |_) | (_| \__ \  __/
 |_____/ \__,_|\__\__,_|_.__/ \__,_|___/\___|
 ============================================                   
              $cyanB MANAGE YOUR DATA $greenB              
 ============================================                                           
";
}

Awal:
  system('clear');
  headerApp();
  echo $cyanB."[1] Data User\n";
  echo "[2] Data User Premium\n";
  echo "[3] Data Versi\n";
  echo "[4] Data Shortlink\n";
  echo "[5] Data Sourcecode\n";
  echo "[6] Data User Agent\n\n";
  
  echo $greenB."Input Number : ".$whiteB;
  $inputNumber = trim(fgets(STDIN));
  
  switch ($inputNumber) 
  {
    case 1:
      system('clear');
      goto DATAUSER;
      break;
    case 2:
      system('clear');
      goto DATAUSERPREMIUM;
      break;
    case 3:
      system('clear');
      goto DATAVERSI;
      break;
    case 4:
      system('clear');
      goto DATASHORTLINK;
      break;
    case 5:
      system('clear');
      goto DATASOURCECODE;
      break;
    case 6:
      system('clear');
      goto DATAUSERAGENT;
      break;
    default:
      die();
      break;
  }


DATAUSER:
  headerApp();
  $queryDataUser = $database->queryDataUser();
  print_r($queryDataUser);
  $i = 1;
  foreach ($queryDataUser as $valueUser) 
  {
    echo $yellowB.$i++." [Id> ".$whiteB.$valueUser['id'].$yellowB." [IP> ".$whiteB.$valueUser['ip'].$yellowB."  [VERSI> ".$whiteB.$valueUser['versi'].$yellowB."  [SISA TOKEN> ".$whiteB.$valueUser['expiredToken'];
    echo "\n";
  }
  echo "\n";
  echo $yellowB."[e] Edit - [d] Delete - [dm] Delete Multi - [dd] Detail - [0] Back\n\n";
  
  echo $greenB."Input Huruf : ".$whiteB;
  $inputMenu = trim(fgets(STDIN));
  
  switch ($inputMenu) 
  {
    case "e":
      goto EditUser;
      break;
    case "d":
      goto DeleteUser;
      break;
    case "dm":
      goto DeleteUserMulti;
      break;
    case "dd":
      goto DetailUser;
      break;
    case "0":
      system('clear');
      goto Awal;
      break;
    default:
      die();
      break;
 
  }

    
  EditUser:
    echo $greenB."Input ID : ".$whiteB;
    $idUser = trim(fgets(STDIN));
    
    $queryDataUserById = $database->queryDataUserById($idUser);
    
    echo $greenU."Data Lama \n".$greenT;
    echo $greenT."Id Versi     : ".$queryDataUserById['id_versi']."\n";
    echo $greenT."Id Shortlink : ".$queryDataUserById['id_shortlink']."\n";
    echo $greenT."Username     : ".$queryDataUserById['username']."\n";
    echo $greenT."IP           : ".$queryDataUserById['ip']."\n";
    echo $greenT."User Agent   : ".$queryDataUserById['userAgent']."\n";
    echo $greenT."Expired Token: ".$queryDataUserById['expiredToken']."\n";
    echo $greenT."Count        : ".$queryDataUserById['count']."\n";
    echo $greenT."Created At   : ".$queryDataUserById['created_at']."\n";
    
    $id_versi     = $queryDataUserById['id_versi'];
    $id_shortlink = $queryDataUserById['id_shortlink'];
    $username     = $queryDataUserById['username'];
    $ip           = $queryDataUserById['ip'];
    $userAgent    = $queryDataUserById['userAgent'];
    $count        = $queryDataUserById['count'];
    $created_at   = $queryDataUserById['created_at'];
    
    echo $yellowB."Ubah Expired Token : ".$whiteB;
    $expiredToken = trim(fgets(STDIN));
    
    if ($expiredToken == NULL) 
    {
      echo $redB."[X] Salah Masukkan Data!";
      die();
    }else{
      $editUser = $database->editUser($idUser,$id_versi,$id_shortlink,$username,$ip,$userAgent,$expiredToken,$count,$created_at);
      echo $greenB."Data Berhasil Di Ubah!";
      sleep(2);
      system('clear');
      goto DATAUSER;
    }
  
  DetailUser:
    echo $greenB."Input ID : ".$whiteB;
    $idUser = trim(fgets(STDIN));
    
    $queryDataUserById = $database->queryDataUserById($idUser);
    
    echo $greenU."Detail Data $idUser \n".$greenT;
    echo $greenT."Id Versi     : ".$queryDataUserById['id_versi']."\n";
    echo $greenT."Id Shortlink : ".$queryDataUserById['id_shortlink']."\n";
    echo $greenT."Username     : ".$queryDataUserById['username']."\n";
    echo $greenT."IP           : ".$queryDataUserById['ip']."\n";
    echo $greenT."User Agent   : ".$queryDataUserById['userAgent']."\n";
    echo $greenT."Expired Token: ".$queryDataUserById['expiredToken']."\n";
    echo $greenT."Count        : ".$queryDataUserById['count']."\n";
    echo $greenT."Created At   : ".$queryDataUserById['created_at']."\n";
      
    $input = trim(fgets(STDIN));
    
    if ($input == NULL) 
    {
      system('clear');
      goto DATAUSER;
    
    }

  DeleteUser:
    echo $greenB."Input ID : ".$whiteB;
    $idUser = trim(fgets(STDIN));
    
    $deleteUserById = $database->deleteUserById($idUser);
    
    if ($deleteUserById > 0) 
    {
      echo $greenB."[✓] Data dengan ID ".$yellowB.$idUser.$greenB." Berhasil Dihapus!";
      sleep(2);
      system('clear');
      goto DATAUSER;
    }else {
      system('clear');
      goto DATAUSER;
    }

  DeleteUserMulti:
    echo $greenB."Input ID : ".$whiteB;
    $idUser = trim(fgets(STDIN));
    
    $idUserA = explode(",",$idUser);
    
    $deleteUserMultiId = $database->deleteUserMultiId($idUserA);
   
    if ($deleteUserMultiId > 0) 
    {
      echo $greenB."[✓] Data dengan ID ".$yellowB.$idUser.$greenB." Berhasil Dihapus!";
      sleep(2);
      system('clear');
      goto DATAUSER;
    }else {
      system('clear');
      goto DATAUSER;
    }
  
  
DATAUSERPREMIUM:
  headerApp();
  $queryDataUserPremium = $database->queryDataUserPremium();
  $i = 1;
  foreach ($queryDataUserPremium as $valuePremium) 
  {
    echo $yellowB.$i++." [Id> ".$whiteB.$valuePremium['id'].$yellowB." [ID VERSI> ".$whiteB.$valuePremium['id_versi'].$yellowB." [USERNAME> ".$whiteB.$valuePremium['username'].$yellowB."  [PASSWORD> ".$whiteB.$valuePremium['pass'].$yellowB."  [CREATED> ".$whiteB.$valuePremium['created_at'].$yellowB." [EXPIRED> ".$whiteB.$valuePremium['expired_at'];
    echo "\n";
  }
  echo "\n";
  echo $yellowB."[a] Add - [e] Edit - [d] Delete - [dm] Delete Multi - [dd] Detail - [0] Back\n\n";
  
  echo $greenB."Input Huruf : ".$whiteB;
  $inputMenu = trim(fgets(STDIN));
  
  switch ($inputMenu) 
  {
    case "a":
      goto AddUserPremium;
      break;
    case "e":
      goto EditUserPremium;
      break;
    case "d":
      goto DeleteUserPremium;
      break;
    case "dm":
      goto DeleteUserPremiumMultiId;
      break;
    case "dd":
      goto DetailUserPremium;
      break;
    case "0":
      system('clear');
      goto Awal;
      break;
    default:
      die();
      break;
 
  }

  AddUserPremium:
    echo $yellowB."Input Id Versi : ".$whiteB;
    $id_versi = trim(fgets(STDIN));
    
    echo $yellowB."Input Username : ".$whiteB;
    $username = trim(fgets(STDIN));
    
    echo $yellowB."Input Password : ".$whiteB;
    $password = trim(fgets(STDIN));
    
    echo $yellowB."Input Expired (ex: 2022-12-2 01:50:01) : ".$whiteB;
    $expired_at = trim(fgets(STDIN));
    
    
    if ($username == NULL || $id_versi == NULL ) 
    {
      echo $redB."[X] Salah Masukkan Data!";
      die();
    }else{
      
      $addUserPremium = $database->addUserPremium($id_versi,$username,$password,$expired_at);
      if ($addUserPremium > 0) 
      {
        echo $greenB."Data Berhasil Di Tambahkan!";
        sleep(2);
        system('clear');
        goto DATAUSERPREMIUM;
      }
  
    }
  
  EditUserPremium:
    echo $greenB."Input ID : ".$whiteB;
    $idUserPremium = trim(fgets(STDIN));
    
    $queryDataUserPremiumById = $database->queryDataUserPremiumById($idUserPremium);
  
    echo $greenU."Data Lama \n".$greenT;
    echo $greenT."Id Versi        : ".$queryDataUserPremiumById['id_versi']."\n";
    echo $greenT."Username        : ".$queryDataUserPremiumById['username']."\n";
    echo $greenT."Password        : ".$queryDataUserPremiumById['pass']."\n";
    echo $greenT."Tanggal Member  : ".$queryDataUserPremiumById['created_at']."\n";
    echo $greenT."Expired Member  : ".$queryDataUserPremiumById['expired_at']."\n";
    
    $id_versi = $queryDataUserPremiumById['id_versi'];
       
    echo $yellowB."Ubah Username : ".$whiteB;
    $username = trim(fgets(STDIN));
    
    echo $yellowB."Ubah Password : ".$whiteB;
    $pass = trim(fgets(STDIN));
    
    echo $yellowB."Ubah Tanggal Awal : ".$whiteB;
    $created_at = trim(fgets(STDIN));
    
    echo $yellowB."Ubah Tanggal Expired : ".$whiteB;
    $expired_at = trim(fgets(STDIN));
    
  
    
    if ($username == NULL) 
    {
      echo $redB."[X] Salah Masukkan Data!";
      die();
    }else{
      $editUserPremium = $database->editUserPremium($idUserPremium,$id_versi,$username,$pass,$created_at,$expired_at);
      echo $greenB."Data Berhasil Di Ubah!";
      sleep(2);
      system('clear');
      goto DATAUSERPREMIUM;
    }
    
  DetailUserPremium:
    echo $greenB."Input ID : ".$whiteB;
    $idUserPremium = trim(fgets(STDIN));
    
    $queryDataUserPremiumById = $database->queryDataUserPremiumById($idUserPremium);
    
    echo $greenU."Detail Data $idUserPremium \n".$greenT;
    echo $greenT."Id Versi     : ".$queryDataUserPremiumById['id_versi']."\n";
    echo $greenT."Username     : ".$queryDataUserPremiumById['username']."\n";
    echo $greenT."Password     : ".$queryDataUserPremiumById['pass']."\n";
    echo $greenT."Created At   : ".$queryDataUserPremiumById['created_at']."\n";
    echo $greenT."Expired At   : ".$queryDataUserPremiumById['expired_at']."\n";
          
    $input = trim(fgets(STDIN));
    
    if ($input == NULL) 
    {
      system('clear');
      goto DATAUSERPREMIUM;
    
    }

  DeleteUserPremium:
    echo $greenB."Input ID : ".$whiteB;
    $idUserPremium = trim(fgets(STDIN));
    
    $deleteUserPremiumById = $database->deleteUserPremiumById($idUserPremium);
    
    if ($deleteUserPremiumById > 0) 
    {
      echo $greenB."[✓] Data dengan ID ".
      $yellowB.$idUserPremium.$greenB." Berhasil Dihapus!";
      sleep(2);
      system('clear');
      goto DATAUSERPREMIUM;
    }else {
      system('clear');
      goto DATAUSERPREMIUM;
    }

  DeleteUserPremiumMultiId:
    echo $greenB."Input ID : ".$whiteB;
    $idUserPremium = trim(fgets(STDIN));
    
    $idUserPremiumA = explode(",",$idUserPremium);
    
    $deleteUserPremiumMultiId = $database->deleteUserPremiumMultiId($idUserPremiumA);
    
    if ($deleteUserPremiumMultiId > 0) 
    {
      echo $greenB."[✓] Data dengan ID ".
      $yellowB.$idUserPremium.$greenB." Berhasil Dihapus!";
      sleep(2);
      system('clear');
      goto DATAUSERPREMIUM;
    }else {
      system('clear');
      goto DATAUSERPREMIUM;
    }


DATASHORTLINK:
  headerApp();
  $queryDataShortlink = $database->queryDataShortlink();
  $i = 1;
  foreach ($queryDataShortlink as $valueShortlink) 
  {
    echo $yellowB.$i++." [Id> ".$whiteB.$valueShortlink['id'].$yellowB." [LINK> ".$whiteB.$valueShortlink['short'].$yellowB."  [PASS> ".$whiteB.$valueShortlink['token'];
    echo "\n";
  }
  echo "\n";
  echo $yellowB."[a] Add - [e] Edit - [d] Delete - [dm] Delete Multi - [dd] Detail - [0] Back\n\n";
  
  echo $greenB."Input Huruf : ".$whiteB;
  $inputMenu = trim(fgets(STDIN));
  
  switch ($inputMenu) 
  {
    case "a":
      goto AddShortlink;
      break;
    case "e":
      goto EditShortlink;
      break;
    case "d":
      goto DeleteShortlink;
      break;
    case "dm":
      goto DeleteShortlinkMultiId;
      break;
    case "dd":
      goto DetailShortlink;
      break;
    case "0":
      system('clear');
      goto Awal;
      break;
    default:
      die();
      break;
 
  }

  AddShortlink:
    echo $yellowB."Input Shortlink : ".$whiteB;
    $short = trim(fgets(STDIN));
    
    echo $yellowB."Input Token : ".$whiteB;
    $token = trim(fgets(STDIN));
    
    if ($short == NULL || $token == NULL) 
    {
      echo $redB."[X] Salah Masukkan Data!";
      die();
    }else{
      $addShortlink = $database->addShortlink($short,$token);
      if ($addShortlink > 0) {
        echo $greenB."Data Berhasil Di Tambahkan!";
        sleep(2);
        system('clear');
        goto DATASHORTLINK;
      }
  
    }
  
  EditShortlink:
    echo $greenB."Input ID : ".$whiteB;
    $idShortlink = trim(fgets(STDIN));
    
    $queryDataShortlinkById = $database->queryDataShortlinkById($idShortlink);
  
    
    echo $greenU."Data Lama \n".$greenT;
    echo $greenT."Shortlink : ".$queryDataShortlinkById['short']."\n";
    echo $greenT."Token     : ".$queryDataShortlinkById['token']."\n";
    
    echo $yellowB."Ubah Shortlink : ".$whiteB;
    $short = trim(fgets(STDIN));
    
    echo $yellowB."Ubah Token      : ".$whiteB;
    $token = trim(fgets(STDIN));
    
    if ($short == NULL || $token == NULL) {
      echo $redB."[X] Salah Masukkan Data!";
      die();
    }else{
      $editShortlink = $database->editShortlink($idShortlink,$short,$token);
      echo $greenB."Data Berhasil Di Ubah!";
      sleep(2);
      system('clear');
      goto DATASHORTLINK;
    }
  
  DetailShortlink:
    echo $greenB."Input ID : ".$whiteB;
    $idShortlink = trim(fgets(STDIN));
    
    $queryDataShortlinkById = $database->queryDataShortlinkById($idShortlink);
    
    echo $greenU."Detail Data $idShortlink \n".$greenT;
    echo $greenT."Shortlink    : ".$queryDataShortlinkById['short']."\n";
    echo $greenT."Token     : ".$queryDataShortlinkById['token']."\n";
    echo $greenT."Created At   : ".$queryDataShortlinkById['created_at']."\n";
              
    $input = trim(fgets(STDIN));
    
    if ($input == NULL) 
    {
      system('clear');
      goto DATASHORTLINK;
    
    }
    
    
  DeleteShortlink:
    echo $greenB."Input ID : ".$whiteB;
    $idShortlink = trim(fgets(STDIN));
    
    $deleteShortlinkById = $database->deleteShortlinkById($idShortlink);
    
    if ($deleteShortlinkById > 0) {
      echo $greenB."[✓] Data dengan ID ".
      $yellowB.$idShortlink.$greenB." Berhasil Dihapus!";
      sleep(2);
      system('clear');
      goto DATASHORTLINK;
    }else{
      system('clear');
      goto DATASHORTLINK;
    }
  
  DeleteShortlinkMultiId:
    echo $greenB."Input ID : ".$whiteB;
    $idShortlink = trim(fgets(STDIN));
    
    $idShortlinkA = explode(",",$idShortlink);
    
    $deleteShortlinkMultiId = $database->deleteShortlinkMultiId($idShortlinkA);
    
    if ($deleteShortlinkMultiId > 0) 
    {
      echo $greenB."[✓] Data dengan ID ".
      $yellowB.$idShortlink.$greenB." Berhasil Dihapus!";
      sleep(2);
      system('clear');
      goto DATASHORTLINK;
    }else {
      system('clear');
      goto DATASHORTLINK;
    }



DATAVERSI:
  headerApp();
  $queryDataVersi = $database->queryDataVersi();
  $i = 1;
  foreach ($queryDataVersi as $valueVersi) 
  {
    echo $yellowB.$i++." [Id> ".$whiteB.$valueVersi['id'].$yellowB." [NAMA SC> ".$whiteB.$valueVersi['namaSc'].$yellowB."  [VERSI> ".$whiteB.$valueVersi['versi'].$yellowB."  [LINK> ".$whiteB.$valueVersi['link'];
    echo "\n";
  }
  echo "\n";
  echo $yellowB."[a] Add - [e] Edit - [d] Delete - [dm] Delete Multi - [dd] Detail - [0] Back\n\n";
  
  echo $greenB."Input Huruf : ".$whiteB;
  $inputMenu = trim(fgets(STDIN));
  
  switch ($inputMenu) 
  {
    case "a":
      goto AddVersi;
      break;
    case "e":
      goto EditVersi;
      break;
    case "d":
      goto DeleteVersi;
      break;
    case "dm":
      goto DeleteVersiMultiId;
      break;
    case "dd":
      goto DetailVersi;
      break;
    case "0":
      system('clear');
      goto Awal;
      break;
    default:
      die();
      break;
 
  }

  AddVersi:
    echo $yellowB."Input Nama SC : ".$whiteB;
    $namaSc = trim(fgets(STDIN));
    
    echo $yellowB."Input Versi SC : ".$whiteB;
    $versi = trim(fgets(STDIN));
    
    echo $yellowB."Input Link SC : ".$whiteB;
    $link = trim(fgets(STDIN));
    
    echo $yellowB."Input Message : ".$whiteB;
    $message = trim(fgets(STDIN));
    
    echo $yellowB."Input Status : ".$whiteB;
    $status = trim(fgets(STDIN));
    
    if ($namaSc == NULL || $versi == NULL) {
      echo $redB."[X] Salah Masukkan Data!";
      die();
    }else{
      
    $addVersi = $database->addVersi($namaSc,$versi,$link,$message,$status);
    
      if ($addVersi > 0) 
      {
        echo $greenB."Data Berhasil Di Tambahkan!";
        sleep(2);
        system('clear');
        goto DATAVERSI;
      }else{
        system('clear');
        goto DATAVERSI;
      }
  
    }
  
  EditVersi:
    echo $greenB."Input ID : ".$whiteB;
    $idVersi = trim(fgets(STDIN));
    
    $queryDataVersiById = $database->queryDataVersiById($idVersi);
  
    
    echo $greenU."Data Lama \n".$greenT;
    echo $greenT."Nama SC   : ".$queryDataVersiById['namaSc']."\n";
    echo $greenT."Versi SC  : ".$queryDataVersiById['versi']."\n";
    echo $greenT."Link      : ".$queryDataVersiById['link']."\n";
    echo $greenT."Message   : ".$queryDataVersiById['message']."\n";
    echo $greenT."Status    : ".$queryDataVersiById['status']."\n";
    
    echo $yellowB."Ubah Nama SC   : ".$whiteB;
    $namaSc = trim(fgets(STDIN));
    
    echo $yellowB."Ubah Versi SC  : ".$whiteB;
    $versi = trim(fgets(STDIN));
    
    echo $yellowB."Ubah Link      : ".$whiteB;
    $link = trim(fgets(STDIN));
    
    echo $yellowB."Ubah Message   : ".$whiteB;
    $message = trim(fgets(STDIN));
    
    echo $yellowB."Ubah Status    : ".$whiteB;
    $status = trim(fgets(STDIN));
    
    if ($namaSc == NULL || $versi == NULL) 
    {
      echo $redB."[X] Salah Masukkan Data!";
      die();
    }else{
      $editVersi = $database->editVersi($idVersi,$namaSc,$versi,$link,$message,$status);
      echo $greenB."Data Berhasil Di Ubah!";
      sleep(2);
      system('clear');
      goto DATAVERSI;
    }
  
  DetailVersi:
    echo $greenB."Input ID : ".$whiteB;
    $idVersi = trim(fgets(STDIN));
    
    $queryDataVersiById = $database->queryDataVersiById($idVersi);
    
    echo $greenU."Detail Data $idVersi \n".$greenT;
    echo $greenT."Nama SC    : ".$queryDataVersiById['namaSc']."\n";
    echo $greenT."Versi SC   : ".$queryDataVersiById['versi']."\n";
    echo $greenT."Link       : ".$queryDataVersiById['link']."\n";
    echo $greenT."Message    : ".$queryDataVersiById['message']."\n";
    echo $greenT."Status     : ".$queryDataVersiById['status']."\n";
              
    $input = trim(fgets(STDIN));
    
    if ($input == NULL) 
    {
      system('clear');
      goto DATAVERSI;
    
    }

  DeleteVersi:
    echo $greenB."Input ID : ".$whiteB;
    $idVersi = trim(fgets(STDIN));
    
    $deleteVersiById = $database->deleteVersiById($idVersi);
    
    if ($deleteVersiById > 0) {
      echo $greenB."[✓] Data dengan ID ".
      $yellowB.$idVersi.$greenB." Berhasil Dihapus!";
      sleep(2);
      system('clear');
      goto DATAVERSI;
    }else {
      system('clear');
      goto DATAVERSI;
    }
    
  DeleteVersiMultiId:
    echo $greenB."Input ID : ".$whiteB;
    $idVersi = trim(fgets(STDIN));
    
    $idVersiA = explode(",",$idVersi);
    
    $deleteVersiMultiId = $database->deleteVersiMultiId($idVersiA);
    
    if ($deleteVersiMultiId > 0) 
    {
      echo $greenB."[✓] Data dengan ID ".
      $yellowB.$idVersi.$greenB." Berhasil Dihapus!";
      sleep(2);
      system('clear');
      goto DATAVERSI;
    }else {
      system('clear');
      goto DATAVERSI;
    }
  
DATASOURCECODE:
  headerApp();
  $queryDataSourcecode = $database->queryDataSourcecode();
  $i = 1;
  foreach ($queryDataSourcecode as $valueSourcecode) {
    echo $yellowB.$i++." [Id> ".$whiteB.$valueSourcecode['id'].$yellowB." [NAMA SC> ".$whiteB.$valueSourcecode['namaSc'].$yellowB."  [NAMA TARGET> ".$whiteB.$valueSourcecode['namaApkWeb'].$yellowB."  [LINK YT> ".$whiteB.$valueSourcecode['linkYt'].$yellowB." [CREATED AT> ".$whiteB.$valueSourcecode['created_at'];
    echo "\n";
  }
  echo "\n";
  echo $yellowB."[a] Add - [e] Edit - [d] Delete - [dm] Delete Multi - [dd] Detail - [0] Back\n\n";
  
  echo $greenB."Input Huruf : ".$whiteB;
  $inputMenu = trim(fgets(STDIN));
  
  switch ($inputMenu) 
  {
    case "a":
      goto AddSourcecode;
      break;
    case "e":
      goto EditSourcecode;
      break;
    case "d":
      goto DeleteSourcecode;
      break;
    case "dm":
      goto DeleteSourcecodeMultiId;
      break;
    case "dd":
      goto DetailSourcecode;
      break;
    case "0":
      system('clear');
      goto Awal;
      break;
    default:
      die();
      break;
 
  }

  AddSourcecode:
    echo $yellowB."Input Nama Sc : ".$whiteB;
    $namaSc = trim(fgets(STDIN));
    
    echo $yellowB."Input Nama Target Apk/Web : ".$whiteB;
    $namaTarget = trim(fgets(STDIN));
    
    echo $yellowB."Input Link YT : ".$whiteB;
    $linkYt = trim(fgets(STDIN));
    
    if ($namaTarget == NULL || $linkYt == NULL) 
    {
      echo $redB."[X] Salah Masukkan Data!";
      die();
    }else{
      
      $addSourcecode = $database->addsourcecode($namaSc,$namaTarget,$linkYt);
      if ($addSourcecode > 0) {
        echo $greenB."Data Berhasil Di Tambahkan!";
        sleep(2);
        system('clear');
        goto DATASOURCECODE;
      }
  
    }
    
  EditSourcecode:
    echo $greenB."Input ID : ".$whiteB;
    $idSourcecode = trim(fgets(STDIN));
    
    $queryDataSourcecodeById = $database->queryDataSourcecodeById($idSourcecode);
  
    echo $greenU."Data Lama \n".$greenT;
    echo $greenT."Nama SC     : ".$queryDataSourcecodeById['namaSc']."\n";
    echo $greenT."Nama Target : ".$queryDataSourcecodeById['namaApkWeb']."\n";
    echo $greenT."Link Yt     : ".$queryDataSourcecodeById['linkYt']."\n";
    echo $greenT."Created At  : ".$queryDataSourcecodeById['created_at']."\n";
    
    echo $yellowB."Ubah Nama Sc             : ".$whiteB;
    $namaSc = trim(fgets(STDIN));
    
    echo $yellowB."Ubah Nama Target Apk/Web : ".$whiteB;
    $namaTarget = trim(fgets(STDIN));
    
    echo $yellowB."Ubah Link Youtube        : ".$whiteB;
    $linkYt = trim(fgets(STDIN));
  
    if ($namaSc == NULL || $namaTarget == NULL) {
      echo $redB."[X] Salah Masukkan Data!";
      die();
    }else{
      $editSourcecode = $database->editSourcecode($idSourcecode,$namaSc,$namaTarget,$linkYt);
      echo $greenB."Data Berhasil Di Ubah!";
      sleep(2);
      system('clear');
      goto DATASOURCECODE;
    }
    
  DetailSourcecode:
    echo $greenB."Input ID : ".$whiteB;
    $idSourcecode = trim(fgets(STDIN));
    
    $queryDataSourcecodeById = $database->queryDataSourcecodeById($idSourcecode);
    
    echo $greenU."Detail Data $idSourcecode \n".$greenT;
    echo $greenT."Nama SC       : ".$queryDataSourcecodeById['namaSc']."\n";
    echo $greenT."Nama Target   : ".$queryDataSourcecodeById['namaApkWeb']."\n";
    echo $greenT."Link Youtube  : ".$queryDataSourcecodeById['linkYt']."\n";
    echo $greenT."Created At    : ".$queryDataSourcecodeById['created_at']."\n";
              
    $input = trim(fgets(STDIN));
    
    if ($input == NULL) 
    {
      system('clear');
      goto DATASOURCECODE;
    
    }

  DeleteSourcecode:
    echo $greenB."Input ID : ".$whiteB;
    $idSourcecode = trim(fgets(STDIN));
    
    $deleteSourcecodeById = $database->deleteSourcecodeById($idSourcecode);
    
    if ($deleteSourcecodeById > 0) {
      echo $greenB."[✓] Data dengan ID ".
      $yellowB.$idSourcecode.$greenB." Berhasil Dihapus!";
      sleep(2);
      system('clear');
      goto DATASOURCECODE;
    }else {
      system('clear');
      goto DATASOURCECODE;
    }
  
  
  DeleteSourcecodeMultiId:
    echo $greenB."Input ID : ".$whiteB;
    $idSourcecode = trim(fgets(STDIN));
    
    $idSourcecodeA = explode(",",$idSourcecode);
    
    $deleteSourcecodeMultiId = $database->deleteSourcecodeMultiId($idSourcecodeA);
    
    if ($deleteSourcecodeMultiId > 0) 
    {
      echo $greenB."[✓] Data dengan ID ".
      $yellowB.$idSourcecode.$greenB." Berhasil Dihapus!";
      sleep(2);
      system('clear');
      goto DATASOURCECODE;
    }else {
      system('clear');
      goto DATASOURCECODE;
    }

DATAUSERAGENT:
  headerApp();
  $queryDataUa= $database->queryDataUa();
  $i = 1;
  foreach ($queryDataUa as $valueUa) {
    echo $yellowB.$i++." [Id> ".$whiteB.$valueUa['id'].$yellowB." [User Agent> ".$whiteB.$valueUa['ua'].$yellowB."  [Date> ".$whiteB.$valueUa['tanggal'];
    echo "\n";
  }
  echo "\n";
  echo $yellowB."[d] Delete - [dm] Delete Multi - [dd] Detail - [0] Back\n\n";
  
  echo $greenB."Input Huruf : ".$whiteB;
  $inputMenu = trim(fgets(STDIN));
  
  switch ($inputMenu) 
  {
    case "d":
      goto DeleteUa;
      break;
    case "dm":
      goto DeleteUaMultiId;
      break;
    case "dd":
      goto DetailUa;
      break;
    case "0":
      system('clear');
      goto Awal;
      break;
    default:
      die();
      break;
 
  }

    
  DetailUa:
    echo $greenB."Input ID : ".$whiteB;
    $idUa = trim(fgets(STDIN));
    
    $queryDataUaById = $database->queryDataUaById($idUa);
    
    echo $greenU."Detail Data $idUa \n".$greenT;
    echo $greenT."User Agent : ".$queryDataUaById['ua']."\n";
    echo $greenT."Tanggal    : ".$queryDataUaById['tanggal']."\n";
                
    $input = trim(fgets(STDIN));
    
    if ($input == NULL) 
    {
      system('clear');
      goto DATAUSERAGENT;
    
    }

  DeleteUa:
    echo $greenB."Input ID : ".$whiteB;
    $idUa = trim(fgets(STDIN));
    
    $deleteUaById = $database->deleteUaById($idUa);
    
    if ($deleteUaById > 0) {
      echo $greenB."[✓] Data dengan ID ".
      $yellowB.$idUa.$greenB." Berhasil Dihapus!";
      sleep(2);
      system('clear');
      goto DATAUSERAGENT;
    }else {
      system('clear');
      goto DATAUSERAGENT;
    }
  
  
  DeleteUaMultiId:
    echo $greenB."Input ID : ".$whiteB;
    $idUa = trim(fgets(STDIN));
    
    $idUaA = explode(",",$idUa);
    
    $deleteUaMultiId = $database->deleteUaMultiId($idUaA);
    
    if ($deleteUaMultiId > 0) 
    {
      echo $greenB."[✓] Data dengan ID ".
      $yellowB.$idUa.$greenB." Berhasil Dihapus!";
      sleep(2);
      system('clear');
      goto DATAUSERAGENT;
    }else {
      system('clear');
      DATAUSERAGENT;
    }