<?php
// Thêm sản phẩm vào giỏ hàng
function cart_insert($idpro, $price, $name, $img, $soluong, $thanhtien, $idbill){
   $sql = "INSERT INTO user(idpro, price, name, img, soluong) VALUES (?, ?, ?, ?, ?, ?, ?)";
   pdo_execute($sql, $idpro, $price, $name, $img, $soluong, $thanhtien, $idbill);
}

// Xóa sản phẩm khỏi giỏ hàng
function delete_cart_item($key) {
   if (isset($_SESSION['giohang'][$key])) {
       unset($_SESSION['giohang'][$key]);
   }
}

// Hiển thị giỏ hàng
function viewcart(){
    $html_cart = '';
    $i = 1;
    foreach ($_SESSION['giohang'] as $key => $sp) { // Lấy key và value
        extract($sp);  // Lấy thông tin sản phẩm
        $tt = (int)$price * (int)$soluong; // Tính thành tiền
        $html_cart .= '
            <tr>
                <td>' . $i . '</td>
                <td><img src="layout/images/' . $img . '" alt="" style="width:100px"></td>
                <td>' . $name . '</td>
                <td>' . $price . '</td>
                <td>' . $soluong . '</td>
                <td>' . $tt . '</td>
                <td><a href="index.php?pg=viewcart&delitem=' . $key . '">Xóa</a></td>
            </tr>';
        $i++;
    }
    return $html_cart;
}

// Tính tổng giỏ hàng
function get_tongdonhang(){
   $tong = 0;
   foreach ($_SESSION['giohang'] as $sp) {
       extract($sp);
       $tt = (int)$price * (int)$soluong;
       $tong += $tt;
   }
   return $tong;
}

//Xử lý xóa sản phẩm
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['key'])) {
    $key = $_GET['key']; // Lấy key của sản phẩm
    delete_cart_item($key); // Xóa sản phẩm theo key
    header("Location: index.php?pg=viewcart"); // Quay lại trang giỏ hàng
    
    exit;
}


?>
