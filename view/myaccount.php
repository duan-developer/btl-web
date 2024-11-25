<?php
   if(isset($_SESSION['s_user'])&&(count($_SESSION['s_user'])>0)){
   extract($_SESSION['s_user']);
   }
?>
<div class="containerfull">
   <div class="bgbanner">TRANG CÁ NHÂN</div>
</div>

<section class="containerfull">
   <div class="container">
      <div class="boxleft mr2pt menutrai">
            <h1>DÀNH CHO BẠN</h1><br><br>
            <a href="admin">Trang quản trị</a>
            <a href="#">Cập nhật thông tin</a>
            <a href="#">Lịch sử mua hàng</a>
            <a href="#">Thoát hệ thống</a>
      </div>
      <div class="boxright">
            <h1>TÀI KHOẢN</h1><br>
            <div class="containerfull mr30">
            <form action="index.php?pg=updateuser" method="post">
               <div class="row">
                  <div class="col-25">
                     <label for="username">Tên đăng nhập</label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="username" value="<?=$username?>" name="username" placeholder="Nhập tên">
                  </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <label for="password">Mật khẩu</label>
                  </div>
                  <div class="col-75">
                     <input type="password" id="password" value="<?=$password?>" name="password" placeholder="Nhập mật khẩu">
                  </div>
               </div>
               
               <div class="row">
                  <div class="col-25">
                     <label for="email">Email</label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="email" value="<?=$email?>" name="email" placeholder="Nhập email">
                  </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <label for="email">Địa chỉ</label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="diachi" value="<?=$diachi?>" name="diachi" placeholder="Nhập địa chỉ">
                  </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <label for="email">Điện thoại</label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="dienthoai" value="<?=$dienthoai?>" name="dienthoai" placeholder="Nhập số điện thoại">
                  </div>
               </div>
               
               <br>
               <div class="row">
                  <input type="hidden" name="id" value="<?=$id?>">
                  <input type="submit" name="capnhat" value="Cập nhật">
               </div>
               </form>
               
            </div>
      </div>
   </div>
</section>