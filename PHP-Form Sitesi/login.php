<?php
require("lib/db-function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GİRİŞ YAP</title>
    <link rel="stylesheet" href="stylelogin.css">
    <link rel="stylesheet" href="buton.css">

</head>
<body>
    <div class="container">
        <form action="login.php" method="post">
            <h2>GİRİŞ YAP</h2>
            <div class="input-group">
                <label for="username">Kullanıcı Adı</label>
                <input type="text" id="username" name="username" placeholder="Lütfen kullanıcı adınızı giriniz..." required>
            </div>
            <div class="input-group">
                <label for="password">Şifre</label>
                <input type="password" id="password" name="password" placeholder="Lütfen parolanızı giriniz..." required>
            </div>
            <button type="submit" name = "giris">GİRİŞ YAP</button>
            <a href="kayit.php" class="button" >KAYIT OLMAK İÇİN TIKLA</a>
        </form>
        <?php
        // bu benim baştan yazdıgım kod 
            // session_start();
            // if(isset($_POST["giris"])){
            //     if(isset($_POST["username"]) && isset($_POST["password"])){
            //         $login_user = $_POST["username"];
            //         $login_pass = $_POST["password"];
            //         $pdo = Database::db();
            //         $sql = "SELECT * FROM `uyeler` WHERE kadi = :ad";
            //         $stmt = $pdo->prepare($sql);
            //         $stmt->bindParam(":ad",$login_user);
            //         $stmt->execute();
            //         $res = $stmt->fetch(PDO::FETCH_ASSOC);
            //         if($res){
            //             if(password_verify($login_pass,$res["pass"])){
            //                 $_SESSION["userid"]= $res["id"];
            //                 echo "giriş başarılı";
            //                 header("location: anasayfa.php");
            //             }
            //             else{
            //                 echo "giriş başarısız";
            //             }
            //         }
            //         else{
            //             echo "kullanıcı adı veya parola hatalı";
            //         }
            //     }
            //     else{
            //         echo "lütfen boş alanları giriniz";
            //     }
            // }

            session_start();
            if(isset($_POST["giris"])){
                if(isset($_POST["username"]) && isset($_POST["password"])){
                    $giris_user = $_POST["username"];
                    $giris_pass = $_POST["password"];
                    $pdo = Database::db();
                    $sql = "SELECT * FROM `uyeler` WHERE kadi = :ad";   
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(":ad",$giris_user);
                    $stmt->execute();
                    $res = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($res){
                        if(password_verify($giris_pass,$res["pass"])){
                            $_SESSION["userid"] = $res['id'];
                            echo   "giriş başarılı";
                            header("location: anasayfa.php");
                            exit;
                        }
                        else{
                            echo "kullanıcıadı veya parola hatalı !";
                        }   
                    }
                    else{
                        echo "Kullanıcı Bulunamadı!";
                    }
                }
                else{
                    echo "lütfen alanları doldurunuz !";
                }
            }
        ?>
    </div>
</body>
</html>
