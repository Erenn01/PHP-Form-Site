<?php 
    include_once('lib/db-function.php');
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $user = getItemRow('uyeler', $id);  
    }else{
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row p-3 justify-content-end">
            <div class="col-3">
                <a href="index.php" class="btn btn-primary">Yazılar <i class="fa-solid fa-house"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3><?php echo $user['kadi']; ?>, kullanıcısının yazısı:</h3>
            </div>
            <div class="col-12">
                <?php 
                    if($user['text']){
                        echo '<p>'.$user['text'].'</p>';
                    }else{
                        echo '<div class="alert alert-warning">Bu kullanıcının yazısı yok.</div>';
                    }
                ?>
            </div>
        </div>
        
    </div>
</body>
</html>