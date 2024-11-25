<?php
    if(isset($_SESSION['s_user'])&&(count($_SESSION['s_user'])>0)){
        extract($_SESSION['s_user']);
        $html_account='<a href="index.php?pg=myaccount">'.$username.'</a>
        <a href="index.php?pg=logout">Thoát</a>';

    }else{
        $html_account='<a href="index.php?pg=dangky">ĐĂNG KÝ</a>
        <a href="index.php?pg=dangnhap">ĐĂNG NHẬP</a>';
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffe House</title>
    <link rel="stylesheet" href="layout/css/style.css">
    <link rel="stylesheet" href="layout/css/phancodechinh.css">
    <style>
      
    </style>
</head>

<body>
        <!-- phần chìnhr sửa -->
        <div class="navbar">
    <div class="container">
        <div class="logo">
            <a href="index.php"><img src="layout/images/Logo Caffee.png" height="40" alt="Coffee House"></a>
        </div>
        <div class="menu">
            <a href="index.php">TRANG CHỦ</a>
            <a href="index.php?pg=sanpham">SẢN PHẨM</a>
            <?=$html_account;?>
        </div>
        <div class="search">
            <form action="index.php?pg=sanpham" method="post">
                <input type="text" name="kyw" placeholder="Nhập từ khóa tìm kiếm">
                <button type="submit" name="timkiem">Tìm kiếm</button>
            </form>
        </div>
    </div>
</div>




   
