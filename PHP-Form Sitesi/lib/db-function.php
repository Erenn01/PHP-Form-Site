<?php
class Database{
    public static function db(){
        $ini = dirname(__FILE__)."/config.ini";
        $con = parse_ini_file($ini, true);
        if($con === false){
            echo "İNİ DOSYASI OKUNMADI";
        }
        else{
           
            $host = $con["hostname"];
            $data = $con["datanm"];
            $user = $con["user"];
            $pass = $con["pass"];
            $dsn = "mysql: host={$host}; dbname={$data}";
            try{
                $pdo = new PDO($dsn, $user, $pass, array(PDO:: MYSQL_ATTR_INIT_COMMAND =>"set names utf8"));
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            }
            catch(PDOException $x){
                die("veritabanı bağlantı hatası! ".$x->getMessage());
            }
        }
    }
}

function getItem($table){
$pdo = Database::db();
$sql = "SELECT * FROM $table";
$stmt = $pdo->prepare($sql);
$stmt ->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $res;
}


function getItemRow($table, $id){
    $pdo = Database::db();
    $sql = "SELECT * FROM $table WHERE id=$id";
    $stmt = $pdo->prepare($sql);
    $stmt ->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res;
}

function getItemRowuserk($table, $userkadi){
    $pdo = Database::db();
    $sql = "SELECT * FROM $table WHERE kadi=$userkadi";
    $stmt = $pdo->prepare($sql);
    $stmt ->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res;
}

function getItemRowuser($table, $userkadi){
    $pdo = Database::db();
    $sql = "SELECT * FROM $table WHERE kadi=:userkadi"; // SQL sorgusunda yer tutucu kullanımı
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userkadi', $userkadi); // Kullanıcı adını bağlama
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC); // Tüm sonuçları almak için fetchAll kullanıldı
    return $res;
}


?>