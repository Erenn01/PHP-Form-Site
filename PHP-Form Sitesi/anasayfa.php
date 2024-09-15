<?php
session_start();
if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])){
    include_once('lib/db-function.php');
    $message = '';
    $class = 'danger';
    $userid = $_SESSION["userid"];
    // form yazı güncelleme
    if(isset($_POST["mesaj"])){
        $mesaj = trim($_POST["mesaj"]);
        if(!empty($mesaj)){
            include_once("lib/db-function.php");
            $pdo = Database::db();
            $stmt = $pdo->prepare("UPDATE `uyeler` SET text = :mesaj WHERE id = :id");
            $stmt->bindParam(':mesaj', $mesaj);
            $stmt->bindParam(':id', $userid);
            $stmt->execute();
            $Rows = $stmt->rowCount();
            if($Rows > 0){
                $message = 'Yazı güncellendi.';
                $class = 'success';
            }else{
                $message = 'Yazı güncellenirken hata oluştu.';
                $class = 'danger';
            }
        }else{
            $message = 'Lütfen mesajınızı boş bırakmayınız.!';
            $class = 'warning';
        }
        
    }

    // Giriş yapan kullanıcı
    $user = getItemRow('uyeler', $userid);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MESAJ</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body> 
    <div class="container">
        <div class="row p-3 justify-content-end">
            <div class="col-5">
                <a href="index.php" class="btn btn-primary">Gönderiler <i class="fa-solid fa-house"></i></a>
                <a href="yazi.php" class="btn btn-primary">Yazılarım <i class="fa-solid fa-house"></i></a>
                <a href="exit.php" class="btn btn-primary">Çıkış yap <i class="fa-solid fa-right-from-bracket"></i></a>
             
            </div>
        </div>
        <div class="row">
            <div class="col-12"><h2>Hoşgeldin, <?php echo $user['kadi']; ?></h2></div>
            
            <?php 
                if(!empty($message)){
                    echo '<div class="col-12"><div class="alert alert-'.$class.'">'.$message.'</div></div>';
                }
            ?>
            <div class="col-12">
                <form action="anasayfa.php" method="post">
                    <div class="form-group">
                        <textarea class="form-control" id="mesaj" rows="12" name="mesaj" placeholder="Bugün ne düşünüyorsun ?"><?php if($user['text']) echo $user['text']; ?></textarea>
                    </div>
                    <button type="submit" name = "paylas">PAYLAŞ</button>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>
<?php } 
    else{
        header("location:index.php");
    }
    if(isset($_POST["mesaj"])&& isset($_POST["paylas"])){
        $mes = trim($_POST["mesaj"]);
        if(!empty($mes)){
            include_once("lib/db-function.php");
            $pdo = Database::db();
            $query = "INSERT INTO `texts`(kullanicid,message) VALUES($userid,?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$mes]);
            $res = $stmt->rowCount();
            if($res > 0){
                $message = 'Yazı güncellendi.';
                $class = 'success';
            }
            else{
                $message = 'Yazı güncellenirken hata oluştu.';
                $class = 'danger';
            }
        }
    }

?>