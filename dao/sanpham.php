<?php
require_once 'pdo.php';

function sanpham_insert($name, $img, $price, $iddm){
    $sql = "INSERT INTO sanpham(name, img, price, iddm) VALUES (?,?,?,?)";
    pdo_execute($sql, $name, $img, $price, $iddm);
}

function sanpham_update($name, $img, $price, $iddm, $id){
    if($img!=""){
        $sql = "UPDATE sanpham SET name=?,img=?,price=?,iddm=? WHERE id=?";
        pdo_execute($sql, $name, $img, $price, $iddm, $id);
    }else{
        $sql = "UPDATE sanpham SET name=?,price=?,iddm=? WHERE id=?";
        pdo_execute($sql, $name, $price, $iddm, $id);
    }
}

function sanpham_delete($id){
    $sql = "DELETE FROM sanpham WHERE  id=?";
    
}

function get_dssp_new($limi){
    $sql = "SELECT * FROM sanpham ORDER BY id DESC limit ".$limi;
    return pdo_query($sql);
}

function get_dssp_best($limi){
    $sql = "SELECT * FROM sanpham WHERE bestseller=1 ORDER BY id DESC limit ".$limi;
    return pdo_query($sql);
}

function get_dssp_view($limi){
    $sql = "SELECT * FROM sanpham ORDER BY view DESC limit ".$limi;
    return pdo_query($sql);
}

function get_dssp($kyw,$iddm,$limi){
    $sql = "SELECT * FROM sanpham WHERE 1";
    if($iddm>0){
        $sql .=" AND iddm=".$iddm;
    }
    if($kyw!=""){
        $sql .=" AND name like '%".$kyw."%'";
    }

    $sql .= " ORDER BY id DESC limit ".$limi;
    return pdo_query($sql);
}

function get_sanphamchitiet($id){
    $sql = "SELECT * FROM sanpham WHERE id=?";
    return pdo_query_one($sql,$id);
}

function get_img($id){
    $sql = "SELECT * FROM sanpham WHERE id=?";
    return pdo_query_one($sql,$id);
}

function get_dssp_lienquan($iddm,$id,$limi){
    $sql = "SELECT * FROM sanpham WHERE iddm=? AND id<>? ORDER BY id DESC limit ".$limi;
    return pdo_query($sql,$iddm,$id);
}

function get_iddm($id){
    $sql = "SELECT iddm FROM sanpham WHERE id=?";
    return pdo_query_value($sql,$id);
}

function showsp($dssp){
    $html_dssp='';
    foreach ($dssp as $sp) {
        extract($sp);
        if($bestseller==1){
            $best='<div class="best"></div>';
        }else{
            $best='';
        }
        $html_dssp.='<div class="box25 mr15">
            '.$best.'
            <a href="index.php?pg=sanphamchitiet&id='.$id.'">
                <img src="layout/images/'.$img.'" alt="">
                <input type="name" name="name" value="'.$name.'">
            </a>
            <span class="price">'.$price.' đ</span>
            <form action="index.php?pg=addcart" method="post">
                <input type="hidden" name="idpro" value="'.$id.'">
                <input type="hidden" name="name" value="'.$name.'">
                <input type="hidden" name="img" value="'.$img.'">
                <input type="hidden" name="price" value="'.$price.'">
                <input type="hidden" name="soluong" value="1">
                <button type="submit" name="addcart">Đặt hàng</button>
            </form>
            
        </div>';
    }
    return $html_dssp;
}

// admin
function showsp_admin($dssp){
    $html_dssp='';
    $i=1;
    foreach ($dssp as $sp) {
        extract($sp);
        if($bestseller==1){
            $best='<div class="best"></div>';
        }else{
            $best='';
        }
        $html_dssp.='<tr>
                        <td>'.$i.'</td>
                        <td><img src="'.IMG_PATH_ADMIN.$img.'" alt="'.$name.'" width="80px" /></td>
                        <td>'.$name.'</td>
                        <td>'.$price.'</td>
                        <td>'.$view.'</td>
                        <td>
                        <a href="index.php?pg=sanphamupdate&id='.$id.'" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                        <a href="index.php?pg=delproduct&id='.$id.'" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa</a>
                        </td>
                    </tr>';
    $i++;
    }
    return $html_dssp;
}

