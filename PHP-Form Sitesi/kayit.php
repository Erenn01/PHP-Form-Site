<?php
require("lib/db-function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="stylelogin.css">
    <link rel="stylesheet" href="buton.css">
</head>
<body>

    <div class="container">
        <form action="kayit.php" method="POST">
            <h2>Kayıt Ol</h2>
            <div class="input-group">
                <label for="username">Kullanıcı Adı</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="email">E-posta</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Şifre</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name = "kayit">KAYIT OL</button>
            <a href="login.php" class ="button" >GİRİŞ SAYFASINA GİT</a>
        </form>

    <?php
        if(isset($_POST["kayit"])){
            $kadi = isset($_POST["username"]) ? $_POST["username"] : null;
            $mail = isset($_POST["email"]) ? $_POST["email"] : null;
            $pass = isset($_POST["password"]) ? $_POST["password"] : null;
                if(!$kadi || !$mail || !$pass){
                    echo "lütfen boş alanları doldurunuz!";
                }
                else{
                    try{
                        if(filter_var($mail,FILTER_VALIDATE_EMAIL)){
                            $pdo = Database::db();
                            $sql = "SELECT * FROM `uyeler` WHERE mail =:email or kadi =:kuadi";
                            $sttmnt = $pdo->prepare($sql);
                            $sttmnt->bindParam(":email",$mail);
                            $sttmnt->bindParam(":kuadi",$kadi);
                            $sttmnt->execute();
                            $res = $sttmnt->rowCount();
                                if($res == 0){
                                    $hash_pass = password_hash($pass,PASSWORD_DEFAULT);
                                    $sttmnt = $pdo->prepare("INSERT INTO `uyeler`(kadi,mail,pass) VALUES (?,?,?)");
                                    $sttmnt->execute([$kadi,$mail,$hash_pass]);
                                    $result = $sttmnt->rowCount();
                                        if($result > 0){
                                            echo "kayıt başarılı bir şekilde oluşturuldu";
                                        }
                                        else{
                                            echo "kayıt oluşturulurken bir hata meydana geldi!";
                                        }
                                }
                                else{
                                    echo "kayıt sistemde ekli";
                                }
                        }
                    }
                    catch(PDOException $e){
                        die("baglantı hatası oluştu".$e->getMessage());
                    }
                }
        }
    ?>
    </div>
</body>
</html>
<?php
    //    if(isset($_POST["kayit"])){
    //     $kullaniciadi = isset($_POST["username"]) ? $_POST["username"] : null;
    //     $mail = isset($_POST["email"]) ? $_POST["email"] : null;
    //     $pass = isset($_POST["password"]) ? $_POST["password"] : null;
    //         if(!$kullaniciadi || !$mail || !$pass){
    //             echo "lütfen boş alanları doldurunuz !";
    //         }
    //         else{
    //             try{
    //                 if(filter_var($mail,FILTER_VALIDATE_EMAIL)){
    //                     $pdo = Database::db();
    //                     $query = "SELECT * FROM uyeler WHERE kadi = :user or mail = :mail";
    //                     $stmt = $pdo->prepare($query);
    //                     $stmt->bindParam(":user",$kullaniciadi);
    //                     $stmt->bindParam(":mail",$mail);
    //                     $stmt->execute();
    //                     $res = $stmt->rowCount();
    //                     if($res == 0){
    //                         $hash_pass = password_hash($pass,PASSWORD_DEFAULT);
    //                         $sql = "INSERT INTO `uyeler` (kadi,mail,pass) VALUES (?,?,?)";
    //                         $stmt = $pdo->prepare($sql);
    //                         $stmt->execute([$kullaniciadi,$mail,$hash_pass]);
    //                         $result = $stmt->rowCount();
    //                         if($result > 0){
    //                             echo "kayıt başarılı";
    //                         }
    //                         else{
    //                             echo "kayıt başarısız";
    //                         }
    //                     }
    //                     else{
    //                         echo "Kullanıcı sistemde kayıtlı";
    //                     }
    //                 }
    //                 else{
    //                     echo "kullanıcıadı veya mail hatalı";
    //                 }
    //             }
    //             catch(PDOException $i){
    //                 die("baglantı hatası !".$i->getMessage());
    //             }
    //         }
    //    }
    ?>
