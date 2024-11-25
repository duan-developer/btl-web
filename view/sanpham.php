<?php
    $html_dm=showdm($dsdm);
    $html_dssp=showsp($dssp);

    // echo "iuyiuyuiyu - ".var_dump(get_name_dm(1));

    if($titlepage!="") $title=$titlepage;
    else $title="SẢN PHẨM";
?>
<div class="containerfull">
        <div class="bgbanner"><?=$title?></div>
    </div>

    <section class="containerfull">
        <div class="container">
            <div class="boxleft mr2pt menutrai">
                <h1>DANH MỤC</h1><br><br>
                <?=$html_dm;?>
                
            </div>
            <div class="boxright">
                <h1><?=$title?></h1><br>
                <div class="containerfull mr30">
                    <?=$html_dssp;?>
                    
                </div>
            </div>


        </div>
    </section>