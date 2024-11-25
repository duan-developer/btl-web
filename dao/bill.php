<?php 
require_once 'dao/pdo.php';

function bill_insert($madh, $iduser , $nguoidat_ten, $nguoidat_email, $nguoidat_tel, $nguoidat_diachi, $nguoinhan_ten, $nguoinhan_diachi, $nguoinhan_tel, $total, $ship, $voucher, $tongthanhtoan, $pttt){
    $sql = "INSERT INTO bill(madh, iduser , nguoidat_ten, nguoidat_email, nguoidat_tel, nguoidat_diachi, nguoinhan_ten, nguoinhan_diachi, nguoinhan_tel, total, ship, voucher, tongthanhtoan, pttt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    return pdo_execute_returnid($sql, $madh, $iduser , $nguoidat_ten, $nguoidat_email, $nguoidat_tel, $nguoidat_diachi, $nguoinhan_ten, $nguoinhan_diachi, $nguoinhan_tel, $total, $ship, $voucher, $tongthanhtoan, $pttt);
}
