<?php
    $html_dssp_new=showsp($dssp_new);
    $html_dssp_best=showsp($dssp_best);
    $html_dssp_view=showsp($dssp_view);
?>




  <!-- code phần banner  -->
<div class="containerfull">
    <img src="layout/images/banner.webp" alt="">
</div>
<section class="containerfull">
    <div class="container">
        <h1>SẢN PHẨM BÁN CHẠY</h1><br>
        <div class="containerfull">
            <div class="box50 mr15">
                <img src="layout/images/banner2.webp" alt="">
            </div>
          <?=$html_dssp_best?> 
        </div>
        
        <div class="containerfull mr30">
            <h1>SẢN PHẨM MỚI NHẤT</h1><br>
            <?=$html_dssp_new;?>
        </div>
        <div class="containerfull mr30">
            <h1>SẢN PHẨM NHIỀU NGƯỜI XEM</h1><br>
            <?=$html_dssp_view?>
        </div>

    </div>
</section>


