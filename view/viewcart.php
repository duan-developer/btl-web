<?php
// Đảm bảo rằng giỏ hàng đã được khởi tạo trong session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Tải các chức năng xử lý giỏ hàng (hàm viewcart(), get_tongdonhang(), xóa sản phẩm, v.v.)
//include_once "../dao/giohang.php";
include_once $_SERVER['DOCUMENT_ROOT'] . '/coffehouse/dao/giohang.php';

// Kiểm tra nếu có hành động xóa sản phẩm hoặc giỏ hàng
if (isset($_GET['delitem'])) {
    $delitem = $_GET['delitem'];
    unset($_SESSION['giohang'][$delitem]); // Xóa sản phẩm theo key
} elseif (isset($_GET['del']) && $_GET['del'] == 1) {
    unset($_SESSION['giohang']); // Xóa toàn bộ giỏ hàng
}
$total = get_tongdonhang();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="../layout/styles.css"> <!-- Đảm bảo link đúng đường dẫn tới file CSS -->
    
</head>
<body>
    <div class="containerfull">
        <div class="bgbanner">GIỎ HÀNG</div>
    </div>

    <section class="containerfull">
        <div class="container">
            <!-- Hiển thị giỏ hàng -->
            <div class="col9 viewcart">
                <h2>ĐƠN HÀNG</h2>
                <table border="1" cellspacing="0" cellpadding="10">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hình Ảnh</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Đơn Giá</th>
                            <th>Số Lượng</th>
                            <th>Thành Tiền</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Hiển thị danh sách sản phẩm trong giỏ hàng -->
                        <?php echo viewcart(); ?>
                    </tbody>
                </table>
                <!-- Nút xóa toàn bộ giỏ hàng -->
                <a href="index.php?pg=viewcart&del=1">Xóa rỗng đơn hàng</a>
            </div>

            <!-- Tổng tiền và thanh toán -->
            <div class="col3">
                <h2>THÔNG TIN THANH TOÁN</h2>
                <div class="total">
                    <h3>Tổng: <?php echo number_format(get_tongdonhang(), 0, ',', '.') . ' VND'; ?></h3>
                </div>

                <!-- Nhập mã giảm giá -->
                <div class="coupon">
                    <form action="index.php?pg=viewcart&voucher=1" method="post">
                        <input type="hidden" name="tongdonhang" value="<?php echo get_tongdonhang(); ?>">
                        <input type="text" name="mavoucher" placeholder="Nhập voucher">
                        <button type="submit">Áp mã</button>
                    </form>
                </div>

                <!-- Tổng thanh toán sau giảm giá (giả định biến $thanhtoan được xử lý ở phía server) -->
                <div class="total">
                 <h3>Tổng: <?php echo number_format(get_tongdonhang(), 0, ',', '.') . ' VND'; ?></h3>
            </div>

                <!-- Tiếp tục đặt hàng -->
                <a href="index.php?pg=donhang">
                    <button>Tiếp tục đặt hàng</button>
                </a>
            </div>
        </div>
    </section>
    
</body>
</html>
