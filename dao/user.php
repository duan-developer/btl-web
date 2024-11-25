<?php
     require_once 'pdo.php';

function user_insert($username, $password, $email){
    $sql = "INSERT INTO user(username, password, email) VALUES (?, ?, ?)";
    pdo_execute($sql, $username, $password, $email);
}

function user_insert_id($username, $password, $ten, $diachi, $email, $dienthoai){
    $sql = "INSERT INTO user(username, password, ten, diachi, email, dienthoai) VALUES (?, ?, ?, ?, ?, ?)";
    return pdo_execute_id($sql, $username, $password, $ten, $diachi, $email, $dienthoai);
}

function user_update($username,$password,$email,$diachi,$dienthoai,$role,$id){
    $sql = "UPDATE user SET username=?,password=?,email=?,diachi=?,dienthoai=?,role=? WHERE id=?";
    pdo_execute($sql,$username,$password,$email,$diachi,$dienthoai,$role,$id);    
}

function checkuser($username,$password){
    $sql="Select * from user where username=? and password=?";
    return pdo_query_one($sql, $username,$password);
    
}
function get_user($id){
    $sql="Select * from user where id=? ";
    return pdo_query_one($sql, $id);
}

