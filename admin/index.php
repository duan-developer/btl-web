<?php
    include "../dao/global.php";
    include "../dao/pdo.php";
    include "../dao/danhmuc.php";
    include "../dao/sanpham.php";

    include "view/header.php";
    if(isset($_GET['pg'])){
        $pg=$_GET['pg'];
        switch($pg){
            case 'sanphamlist':
                $sanphamlist=get_dssp_new(100);
                include 'view/sanphamlist.php';
                break;
            case 'updateproduct':
                if(isset($_POST['updateproduct'])){
                    // Lấy dữ liệu về
                    $name=$_POST['name'];
                    $price=$_POST['price'];
                    $iddm=$_POST['iddm'];
                    $id=$_POST['id'];

                    $img=$_FILES['img']['name'];
                    if($img!=""){
                        // uploads hình ảnh
                        $target_file=IMG_PATH_ADMIN.$img;
                        move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
                    }else{
                        $img="";
                    }
                    // insert into
                    sanpham_update($name, $img, $price, $iddm, $id);
                }

                // show dssp
                $sanphamlist=get_dssp_new(100);
                include 'view/sanphamlist.php';
                break;
            case 'sanphamupdate':
                if(isset($_GET['id'])&&($_GET['id']>0)){
                    $id=$_GET['id'];
                    $sp=get_sanphamchitiet($id);
                }
                // trở về trang dssp
                $danhmuclist=danhmuc_all();
                include "view/sanphamupdate.php";
                break;
            case 'delproduct':
                if(isset($_GET['id'])&&($_GET['id']>0)){
                    $id=$_GET['id'];
                    sanpham_delete($id);
                }
                // trở về trang dssp
                $danhmuclist=get_dssp_new(100);
                include "view/sanphamlist.php";
                break;
            case 'sanphamadd':
                $danhmuclist=danhmuc_all();
                include "view/sanphamadd.php";
                break;
            case 'addproduct':
                if(isset($_POST['addproduct'])){
                    // Lấy dữ liệu về
                    $name=$_POST['name'];
                    $price=$_POST['price'];
                    $iddm=$_POST['iddm'];
                    $img=$_FILES['img']['name'];
                    // insert into
                    sanpham_insert($name, $img, $price, $iddm);
                    // uploads hình ảnh
                    $target_file=IMG_PATH_ADMIN.$img;
                    move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
                    // trở về trang dssp
                    $danhmuclist=get_dssp_new(100);
                    include "view/sanphamlist.php";
                }else{
                    $danhmuclist=danhmuc_all();
                    include "view/sanphamadd.php";
                }
                break;
            default:
                include "view/home.php";
                break;
        }
    }else{
        include "view/home.php";
    }
    include "view/footer.php";
?>