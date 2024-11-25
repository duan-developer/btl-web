<div class="containerfull">
        <div class="bgbanner">ĐƠN HÀNG</div>
    </div>

<section class="containerfull">
        <div class="container">
            <form action="index.php?pg=donhangsubmit" method="post">
            <div class="col9 viewcart">
                <div class="ttdathang">
                    <h2>Thông tin người đặt hàng</h2>
                  
                      <label for="hoten"><b>Họ và tên</b></label>
                      <input type="text" placeholder="Nhập họ tên đầy đủ" name="hoten" id="hoten" required>
                  
                      <label for="diachi"><b>Địa chỉ</b></label>
                      <input type="text" placeholder="Nhập địa chỉ" name="diachi" id="diachi" required>
                  
                      <label for="email"><b>Email</b></label>
                      <input type="text" placeholder="Nhập email" name="email" id="email" required>

                      <label for="dienthoai"><b>Điện thoại</b></label>
                      <input type="text" placeholder="Nhập điện thoại" name="dienthoai" id="dienthoai" required>
                </div>
                <div class="ttdathang">
                    <a onclick="showttnhanhang()" style="cursor: pointer;">
                    &rArr; Thay đổi thông tin nhận hàng
                    </a>
                </div>
                <div class="ttdathang" id="ttnhanhang">
                    <h2>Thông tin người nhận hàng</h2>
                  
                      <label for="hoten"><b>Họ và tên</b></label>
                      <input type="text" placeholder="Nhập họ tên đầy đủ" name="hoten_nguoinhan" id="hoten_nguoinhan">
                  
                      <label for="diachi"><b>Địa chỉ</b></label>
                      <input type="text" placeholder="Nhập địa chỉ" name="diachi_nguoinhan" id="diachi_nguoinhan">
                  
                      <label for="dienthoai"><b>Điện thoại</b></label>
                      <input type="text" placeholder="Nhập điện thoại" name="dienthoai_nguoinhan" id="dienthoai_nguoinhan">
                </div>
                      
                  
                    
        </div>
        <div class="col3">
            <h2>ĐƠN HÀNG</h2>
            <div class="total">
        <div class="boxcart">
            <!-- Hiển thị sản phẩm trong giỏ hàng -->
            <?php
            $total = 0;
            if (isset($_SESSION['giohang']) && !empty($_SESSION['giohang'])) {
                foreach ($_SESSION['giohang'] as $key => $sp) { // Duyệt qua các sản phẩm trong giỏ
                    extract($sp); // Lấy thông tin sản phẩm từ giỏ
                    $tt = (int)$price * (int)$soluong; // Tính tổng tiền cho sản phẩm này
                    echo '<li>' . $name . ' x ' . $soluong . ' - ' . number_format($tt) . ' VNĐ</li>';
                    $total += $tt; // Cộng vào tổng đơn hàng
                }
            } else {
                echo "<li>Không có sản phẩm trong giỏ hàng.</li>"; // Hiển thị nếu giỏ hàng trống
            }
            ?>
        
        <!-- Hiển thị tổng giá tiền -->
        <h3>Tổng: <?php echo get_tongdonhang(); ?></h3>
    </div>
</div>
            
            <div class="coupon">
                <div class="boxcart">
                <h3>Voucher: </h3>
                </div>
            </div>
            <div class="pttt">
                <div class="boxcart">
                <h3>Phương thức thanh toán: </h3>
                <input type="radio" name="pttt" value="1" id="" checked> Tiền mặt<br>
                <input type="radio" name="pttt" value="2" id=""> Ví điện tử<br>
                <input type="radio" name="pttt" value="3" id=""> Chuyển khoản<br>
                <input type="radio" name="pttt" value="4" id=""> Thanh toán online<br>
                </div>
            </div>
            <div class="total">
    <div class="boxcart bggray">
        <!-- Display the dynamic total payment -->
        <h3>Tổng thanh toán: <?php echo get_tongdonhang(); ?></h3>
    </div>
</div>
<button type="submit" name="donhangsubmit">Thanh toán</button>


        </div>
</form>
        </div>
    </section>
    <script>
        var ttnhanhang=document.getElementById("ttnhanhang");
        ttnhanhang.style.display="none";
        function showttnhanhang(){
            if(ttnhanhang.style.display=="none"){
                ttnhanhang.style.display="block";
            }else{
                ttnhanhang.style.display="none";
            }
        }
    </script>