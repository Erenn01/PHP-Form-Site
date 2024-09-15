<?php
require("lib/db-function.php");
session_start();
if(isset($_SESSION['userid'])){
    $user = getItemRow('uyeler', $_SESSION['userid']);
    $kadi = $user['kadi'];
}else{
    $kadi = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GÖNDERİLER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>
<body>
    <div class="container">
    <div class="row p-3 justify-content-end">
                <?php
                    if($kadi){
                        echo '<div class="col-5"><a href="anasayfa.php" class="btn btn-primary">'.$kadi.' <i class="fa-solid fa-user"></i></a>
                                <a href="yazi.php" class="btn btn-primary">Yazılarım <i class="fa-solid fa-house"></i></a>
                                <a href="exit.php" class="btn btn-primary">Çıkış yap <i class="fa-solid fa-right-from-bracket"></i></a></div>';
                    }else{
                        echo '<div class="col-3"><a href="login.php" class="btn btn-primary">Giriş Yap <i class="fa-solid fa-right-to-bracket"></i></a></div>';
                    }
                ?>
            </div>
            <h2>YAZILARIM </h2>
            <div class="row">
                <?php
                   
                    $todos = getItem("texts");
                    if($todos){
                        foreach($todos as $value){
                            $url = './detay2.php?id='.$value['id'];
                            echo '<div class="col-4">
                                    <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$value['id'].'</h5>
                                        <a href="'.$url.'" class="btn btn-primary">Yazısını oku</a>
                                    </div>
                                    </div>
                                </div>';
                        }
                    }else{
                        echo '<div class="alert alert-warning col-12">Kayıtlı kullanıcı bulunamadı...</div>';
                    }
                ?>
            </div>
    </div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>