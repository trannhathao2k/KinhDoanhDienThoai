<?php
    $sql_chitiet = "SELECT * FROM dienthoai WHERE dienthoai.MaDT = '".$_GET["id"]."'";
    $query_chitiet = mysqli_query($mysqli, $sql_chitiet);
    $row_chitiet = mysqli_fetch_array($query_chitiet);
?>

<section id="productDetails" class="pb-5">
    <div class="row mt-5" style="width: 100%">
        <div class="col-sm-1"></div>
        <div class="col-sm-3">
            <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails mb-5 pb-4" data-ride="carousel">
                <div class="carousel-inner text-center text-md-left" role="listbox">
                        <?php
                            $sql_anhchitiet = "SELECT * FROM dienthoai, hinhanh WHERE dienthoai.MaDT = hinhanh.MaDT AND dienthoai.MaDT = '".$_GET["id"]."'";
                            $query_anhchitiet = mysqli_query($mysqli, $sql_anhchitiet);

                            $sql_anhmin = "SELECT MIN(hinhanh.MaHinh) manhonhat FROM dienthoai, hinhanh WHERE dienthoai.MaDT = hinhanh.MaDT AND hinhanh.Hinh_index != 1 AND dienthoai.MaDT = '".$_GET["id"]."'";
                            $query_anhmin = mysqli_query($mysqli, $sql_anhmin);
                            $row_anhmin = mysqli_fetch_array($query_anhmin);

                            while ($row_anhchitiet = mysqli_fetch_array($query_anhchitiet)) {
                                if ($row_anhchitiet['Hinh_index'] == 0 && $row_anhchitiet['MaHinh'] == $row_anhmin['manhonhat']) {
                                    ?>
                                        <div class="carousel-item active">
                                            <figure>
                                                <a href="./Images/AnhDT/<?php echo $row_anhchitiet['TenHinh'] ?>" data-size="1600x1067" target="_blank">
                                                    <img src="./Images/AnhDT/<?php echo $row_anhchitiet['TenHinh'] ?>" alt="First slide" class="img-fluid">
                                                </a>
                                            </figure>  
                                        </div>
                                    <?php
                                }
                                else if ($row_anhchitiet['Hinh_index'] == 0 && $row_anhchitiet['MaHinh'] != $row_anhmin['manhonhat']) {
                                    ?>
                                        <div class="carousel-item">
                                            <figure>
                                                <a href="./Images/AnhDT/<?php echo $row_anhchitiet['TenHinh'] ?>" data-size="1600x1067" target="_blank">
                                                    <img src="./Images/AnhDT/<?php echo $row_anhchitiet['TenHinh'] ?>" alt="First slide" class="img-fluid">
                                                </a>
                                            </figure>  
                                        </div>
                                    <?php
                                }
                            }
                        ?>

                    
                        <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                            <span class="pre-anh" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>

                        <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                            <span class="next-anh" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                </div>
            </div>
            <ul class="rating" style="position:relative;margin-top: -50px">
                <?php
                    $sql_diemdg02 = "SELECT ROUND(AVG(DiemDG)) diem FROM danhgia WHERE MaDT = ".$_GET["id"]."";
                    $query_diemdg02 = mysqli_query($mysqli, $sql_diemdg02);
                    $row_diemdg02 = mysqli_fetch_array($query_diemdg02);
                    // echo '<p> '.$row_diemdg02['diem'].' </p>';
                    for ($i = 1; $i <= $row_diemdg02['diem']; $i++) {
                        ?>
                            <li><i class="fas fa-star yellow-text"></i></li>
                        <?php
                        }
                            $khongdg = 5 - $row_diemdg02['diem'];
                        for ($i = 1; $i <= $khongdg; $i++) {
                        ?>
                                <li><i class="fas fa-star grey-text"></i></li>
                            <?php
                    }
                        $sql_diemdg03 = "SELECT ROUND(AVG(DiemDG),1) diemtb FROM danhgia WHERE MaDT = ".$_GET["id"]."";
                        $query_diemdg03 = mysqli_query($mysqli, $sql_diemdg03);
                        $row_diemdg03 = mysqli_fetch_array($query_diemdg03);
                        ?>
                                <p style="position:absolute; right: 172px; top: 2px;font-weight:bold;font-size: 16px">
                                    <?php echo $row_diemdg03['diemtb'] ?>
                                </p>
                                <p style="position:absolute; right: 55px; top: 3px;color:black">(<?php
                                    $sql_luotdg02 = "SELECT COUNT(MaDG) luotdg FROM danhgia WHERE MaDT = ".$_GET["id"]."";
                                    $query_luotdg02 = mysqli_query($mysqli, $sql_luotdg02);
                                    $row_luotdg02 = mysqli_fetch_array($query_luotdg02);
                                    echo $row_luotdg02['luotdg'];
                                ?> l?????t ????nh gi??)</p>
                        <?php
                ?>
            </ul>
            <p style="position:relative; font-size: 14px; color: black; font-weight:bold">???? b??n: <b style="color: red">
                <?php echo $row_chitiet['DaBan'] ?>
            </b></p>
            <p style="position:absolute;right: 14px; top: 284px; font-size: 14px; color: MediumSeaGreen;font-weight:bold">C??n l???i: <b style="color: red">
                <?php
                $conlai = $row_chitiet['SoLuong'] - $row_chitiet['DaBan'];
                echo $conlai ?>
            </b></p>
            <br>
            <div class="card">
                <p class="tieudenho" style="text-align: center">????NH GI??</p>
                <p style="text-align:center;margin-top: -12px">B???n ch???m s???n ph???m n??y bao nhi??u sao?</p>
                <?php
                    $sql_danhgia = "SELECT COUNT(DiemDG) danhgia FROM danhgia WHERE MaDT = ".$_GET["id"]."";
                    $query_danhgia = mysqli_query($mysqli, $sql_danhgia);
                    $row_danhgia = mysqli_fetch_array($query_danhgia);
                ?>
                
                    <ul class="rating" style="position:relative;margin-top: -6px;margin-left: 21px;font-size: 20px">
                        <div id="danhgiasp">
                            <div style="text-align: center; margin-right: 21px">
                            <?php
                                $sql_ktra = "SELECT * FROM danhgia WHERE MaKH = 1 AND MaDT = ".$_GET["id"]."";
                                $query_ktra = mysqli_query($mysqli, $sql_ktra);
                                $row_ktra = mysqli_fetch_array($query_ktra);
                                if (mysqli_num_rows($query_ktra) == 0) {
                                    $ktra = 0;
                                }
                                else {
                                    $ktra = $row_ktra['DiemDG'];
                                }

                                for ($i = 0; $i < $ktra; $i ++) {
                                    ?>
                                        <li onclick="danhgia('<?php echo $row_chitiet['MaDT'] ?>')">
                                            <input type="radio" id="<?php echo $i + 1 ?>" name="danhgia" value="<?php echo $i + 1 ?>" style="opacity: 0">
                                            <label for="<?php echo $i + 1 ?>">
                                                <i class="fas fa-star yellow-text"></i>
                                            </label>
                                        </li>
                                    <?php
                                }
                                for ($i = $ktra; $i < 5; $i++){
                                    ?>
                                        <li onclick="danhgia('<?php echo $row_chitiet['MaDT'] ?>')">
                                            <input type="radio" id="<?php echo $i + 1 ?>" name="danhgia" value="<?php echo $i + 1 ?>" style="opacity: 0">
                                            <label for="<?php echo $i + 1 ?>">
                                                <i class="fas fa-star grey-text"></i>
                                            </label>
                                        </li>
                                    <?php
                                }
                            ?>
                                
                                <!-- <li onclick="danhgia('')">
                                    <input type="radio" id="2" name="danhgia" value="2" style="opacity: 0">
                                    <label for="2">
                                        <i class="fas fa-star grey-text"></i>
                                    </label>
                                </li>
                                <li onclick="danhgia('')">
                                    <input type="radio" id="3" name="danhgia" value="3" style="opacity: 0">
                                    <label for="3">
                                        <i class="fas fa-star grey-text"></i>
                                    </label>
                                </li>
                                <li onclick="danhgia('')">
                                    <input type="radio" id="4" name="danhgia" value="4" style="opacity: 0">
                                    <label for="4">
                                        <i class="fas fa-star grey-text"></i>
                                    </label>
                                </li>
                                <li onclick="danhgia('')">
                                    <input type="radio" id="5" name="danhgia" value="5" style="opacity: 0">
                                    <label for="5">
                                        <i class="fas fa-star grey-text"></i>
                                    </label>
                                </li> -->
                            </div>
                        </div>
                    </ul>
                    <ul style="list-style:none;margin-top: 0px;margin-bottom: -15px">
                        <li style="color: orange; margin-left: 16px;font-size: 14px">5 <i class="fas fa-star orange-text" style="display:inline-block"></i>
                            <div class="timeline-star" style="display:inline-block">
                                <p class="timing" style="width: <?php
                                    $sql_danhgia5sao = "SELECT COUNT(DiemDG) danhgia FROM danhgia WHERE MaDT = ".$_GET["id"]." AND DiemDG = 5";
                                    $query_danhgia5sao = mysqli_query($mysqli, $sql_danhgia5sao);
                                    $row_danhgia5sao = mysqli_fetch_array($query_danhgia5sao);
                                    
                                    $ptram5sao = round(($row_danhgia5sao['danhgia'] / $row_danhgia['danhgia']) * 100);
                                    if ($ptram5sao == 0) {
                                        echo "0";
                                    }
                                    else {
                                        echo $ptram5sao;
                                    }
                                ?>%"></p>
                            </div>
                            <p style="display:inline-block;margin-left: 12px"><?php
                                if ($ptram5sao === NAN) {
                                    echo "0";
                                }
                                else {
                                    echo $ptram5sao;
                                }
                            ?> %</p>
                        </li>
                        <li style="color: orange; margin-left: 16px;font-size: 14px">4 <i class="fas fa-star orange-text" style="display:inline-block"></i>
                            <div class="timeline-star" style="display:inline-block">
                                <p class="timing" style="width: <?php
                                    $sql_danhgia4sao = "SELECT COUNT(DiemDG) danhgia FROM danhgia WHERE MaDT = ".$_GET["id"]." AND DiemDG = 4";
                                    $query_danhgia4sao = mysqli_query($mysqli, $sql_danhgia4sao);
                                    $row_danhgia4sao = mysqli_fetch_array($query_danhgia4sao);
                                    
                                    $ptram4sao = round(($row_danhgia4sao['danhgia'] / $row_danhgia['danhgia']) * 100);
                                    if ($ptram4sao == NAN) {
                                        echo "0";
                                    }
                                    else {
                                        echo $ptram4sao;
                                    }         
                                ?>%"></p>
                            </div>
                            <p style="display:inline-block;margin-left: 12px"><?php
                                if ($ptram4sao == NAN) {
                                    echo "0";
                                }
                                else {
                                    echo $ptram4sao;
                                }
                            ?> %</p>
                        </li>
                        <li style="color: orange; margin-left: 16px;font-size: 14px">3 <i class="fas fa-star orange-text" style="display:inline-block"></i>
                            <div class="timeline-star" style="display:inline-block">
                                <p class="timing" style="width: <?php
                                    $sql_danhgia3sao = "SELECT COUNT(DiemDG) danhgia FROM danhgia WHERE MaDT = ".$_GET["id"]." AND DiemDG = 3";
                                    $query_danhgia3sao = mysqli_query($mysqli, $sql_danhgia3sao);
                                    $row_danhgia3sao = mysqli_fetch_array($query_danhgia3sao);
                                    
                                    $ptram3sao = round(($row_danhgia3sao['danhgia'] / $row_danhgia['danhgia']) * 100);
                                    echo $ptram3sao;
                                ?>%"></p>
                            </div>
                            <p style="display:inline-block;margin-left: 12px"><?php
                                echo $ptram3sao;
                            ?> %</p>
                        </li>
                        <li style="color: orange; margin-left: 16px;font-size: 14px">2 <i class="fas fa-star orange-text" style="display:inline-block"></i>
                            <div class="timeline-star" style="display:inline-block">
                                <p class="timing" style="width: <?php
                                    $sql_danhgia2sao = "SELECT COUNT(DiemDG) danhgia FROM danhgia WHERE MaDT = ".$_GET["id"]." AND DiemDG = 2";
                                    $query_danhgia2sao = mysqli_query($mysqli, $sql_danhgia2sao);
                                    $row_danhgia2sao = mysqli_fetch_array($query_danhgia2sao);
                                    
                                    $ptram2sao = round(($row_danhgia2sao['danhgia'] / $row_danhgia['danhgia']) * 100);
                                    echo $ptram2sao;
                                ?>%"></p>
                            </div>
                            <p style="display:inline-block;margin-left: 12px"><?php
                                echo $ptram2sao;
                            ?> %</p>
                        </li>
                        <li style="color: orange; margin-left: 16px;font-size: 14px">1 <i class="fas fa-star orange-text" style="display:inline-block"></i>
                            <div class="timeline-star" style="display:inline-block">
                                <p class="timing" style="width: <?php
                                    $sql_danhgia1sao = "SELECT COUNT(DiemDG) danhgia FROM danhgia WHERE MaDT = ".$_GET["id"]." AND DiemDG = 1";
                                    $query_danhgia1sao = mysqli_query($mysqli, $sql_danhgia1sao);
                                    $row_danhgia1sao = mysqli_fetch_array($query_danhgia1sao);
                                    
                                    $ptram1sao = round(($row_danhgia1sao['danhgia'] / $row_danhgia['danhgia']) * 100);
                                    echo $ptram1sao;
                                ?>%"></p>
                            </div>
                            <p style="display:inline-block;margin-left: 12px"><?php
                                echo $ptram1sao;
                            ?> %</p>
                        </li>
                    </ul>
                <br>
            </div>
        </div>
        <div class="col-sm-4" style="margin-left: 20px;">
            
            <p class="tendt" style="position:relative;display:inline-block;margin-top: -5px"><?php echo $row_chitiet['TenDT'] ?></p>
            <?php
                if ($row_chitiet['TrangThaiKM'] == 1) {
                    ?>
                    <span class="badge badge-danger mb-2 ml-3" style="display:inline-block;"><?php echo $row_chitiet['TenTTKM'] ?></span>
                <?php
                }
                else if ($row_chitiet['TrangThaiKM'] == 2) {
                    ?>
                    <span class="badge badge-info mb-2 ml-3" style="display:inline-block;"><?php echo $row_chitiet['TenTTKM'] ?></span>
                    <?php
                }
                else if ($row_chitiet['TrangThaiKM'] == 3) {
                    ?>
                    <span class="badge badge-warning mb-2 ml-3" style="display:inline-block;"><?php echo $row_chitiet['TenTTKM'] ?></span>
                    <?php
                }
            ?>
            <p class="gia-dt-chitiet"><?php echo number_format($row_chitiet['GiaKhuyenMai'],0,"",".") ?>??</p>
            <?php
                if ($row_chitiet['TrangThaiKM'] == 1 || $row_chitiet['TrangThaiKM'] == 3) {
                    ?>
                        <p class="giagoc-dt-chitiet"><del><?php echo number_format($row_chitiet['GiaGoc'],0,"",".") ?>??</del></p>
                    <?php
                }
            ?>

            <p style="font-weight:bold; font-size: 16px">M?? t???</p>
            <p>
                <?php echo $row_chitiet['MoTa'] ?>
            </p>
            <p style="font-weight:bold; font-size: 16px">??u ??i???m n???i b???t</p>
            <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true"
            style="margin-top: -12px">
                <!-- Ch???c n??ng 1 -->
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne1">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="false"
                                aria-controls="collapseOne1">
                            <p class="mb-0" style="color: black">D??? d??ng n???i b???t gi???a ????m ????ng.
                                <i class="fas fa-angle-down rotate-icon"></i>
                            </p>
                        </a>
                    </div>
                    <div id="collapseOne1" class="collapse" role="tabpanel" aria-labelledby="headingOne1"
                            data-parent="#accordionEx">
                        <div class="card-body">
                            <p>??i???n tho???i OPPO Reno7 Z 5G c?? khung vi????n v??t ph???ng,
                            vu??ng v???c trendy l??m cho m??y to??t l??n n??t hi???n ?????i v?? n??ng ?????ng.
                            B???n g??c ???????c bo cong m???m m???i t???o c???m gi??c tho???i m??i v?? nh??? nh??ng (ch??? 173 g).
                            V???i thi???t k??? nguy??n kh???i l??m t???ng th??? m??y tr??? n??n c???c k??? ch???c ch???n,
                            kh??ng ch??? ?????p m?? c??n t??ng ????? b???n.</p>
                        </div>
                    </div>
                </div>

                <!-- Ch???c n??ng 2 -->
                <div class="card">
                    <div class="card-header" role="tab" id="headingTwo2">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
                            aria-expanded="false" aria-controls="collapseTwo2">
                            <p class="mb-0" style="color: black">
                                B???t m??? ch??n dung v?? h???n
                                <i class="fas fa-angle-down rotate-icon"></i>
                            </p>
                        </a>
                    </div>

                    <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
                  data-parent="#accordionEx">
                        <div class="card-body">
                            <p>?????i v???i d??ng Reno Series, OPPO ????nh m???nh v??o ph???n tr???i nghi???m camera,
                            Reno7 Z trang b??? c???m 3 camera sau v???i c???m bi???n ch??nh ????? ph??n gi???i 64 MP,
                            ???ng k??nh macro 2 MP v?? camera ch???p ???nh xo?? ph??ng 2 MP.
                            ????nh gi?? chung c??c b???c h??nh ???????c ch???p b???i Reno7 Z 5G c?? ????? chi ti???t t???t,
                            d???i nh???y s??ng ???n, m??u s???c ch??n th???c n??n b???n c?? th??? ch???p v?? ????ng t???i l??n c??c m???ng x?? h???i ngay l???p t???c m?? kh??ng c???n ph???i qua c??c b?????c ch???nh s???a.
                            C??c t???m ???nh ch???p ????m c??ng c?? ch???t l?????ng r???t ???n, ??nh ????n r???c r??? kh??ng b??? ch??i,
                            ????? ph??i s??ng t???t v?? ??t b??? nhi???u h???t.</p>
                        </div>
                    </div>
                </div>

                <!-- Ch???c n??ng 3 -->
                <div class="card">
                    <div class="card-header" role="tab" id="headingTwo3">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo3"
                            aria-expanded="false" aria-controls="collapseTwo3">
                            <p class="mb-0" style="color: black">
                                Hi???u n??ng v?????t b???t, ph???n h???i t???c th???i
                                <i class="fas fa-angle-down rotate-icon"></i>
                            </p>
                        </a>
                    </div>

                    <div id="collapseTwo3" class="collapse" role="tabpanel" aria-labelledby="headingTwo3"
                  data-parent="#accordionEx">
                        <div class="card-body">
                            <p>Reno7 Z s??? h???u b??? nh??? RAM l??n ?????n 13 GB (8 GB m???c ?????nh + 5 GB m??? r???ng),
                                ROM 128 GB, ????y c??ng l?? m???t con s??? kh?? ???n ??? th???i ??i???m hi???n t???i (3/2022)
                                v?? c?? th??? ????p ???ng t???t nhu c???u s??? d???ng c???a h???u h???t m???i ?????i t?????ng ng?????i d??ng.<br>
                                C??c t??c v??? h???ng ng??y nh?? l?????t web, m???ng x?? h???i, h???c, h???p online th?? Reno7 Z cho m???t t???c ????? r???t ???n ?????nh,
                                c??c thao t??c ch???m, m??? ???ng d???ng ???????c ph???n h???i nhanh. V???i m???t con chip hi???u n??ng cao,
                                ph???n m???m ???????c t???i ??u m???nh m??? n??n kh??? n??ng ch??i game tr??n OPPO Reno7 Z 5G c??ng r???t tuy???t v???i.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Ch???c n??ng 4 -->
                <div class="card">
                    <div class="card-header" role="tab" id="headingTwo4">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo4"
                            aria-expanded="false" aria-controls="collapseTwo4">
                            <p class="mb-0" style="color: black">
                                N??ng cao tr???i nghi???m nghe nh??n
                                <i class="fas fa-angle-down rotate-icon"></i>
                            </p>
                        </a>
                    </div>

                    <div id="collapseTwo4" class="collapse" role="tabpanel" aria-labelledby="headingTwo4"
                  data-parent="#accordionEx">
                        <div class="card-body">
                            <p>M??n h??nh Reno7 Z 5G trang b??? t???m n???n AMOLED,
                            k??ch th?????c 6.43 inch, ????? ph??n gi???i Full HD+ (1080 x 2400 pixel),
                            t???n s??? qu??t 60 Hz v?? ???????c b???o v??? b???i l???p k??nh c?????ng l???c Schott Xensation UP.

                            V??? m??n h??nh th?? c??c th??ng s??? tr??n kh?? c?? b???n v?? kh??ng c?? nhi???u n???i b???t khi so v???i th??? h??? tr?????c,
                            m??y v???n cho ch???t l?????ng hi???n th??? r???t t???t v???i m??u s???c t????i t???n, trong tr???o,
                            kh??ng b??? ??m m??u v?? hi???n th??? kh?? s???ng ?????ng. ????? s??ng m??n h??nh t???i ??a ?????t 600 nits,
                            ????? d??ng trong ??i???u ki???n s??ng v???a ph???i.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <p style="font-weight:bold; font-size: 16px;margin-top: 25px; display: inline-block;">M??u s???c:</p>
            <div style="display: inline-block">         
                    <?php
                        $sql_mausac = "SELECT * FROM dienthoai, mausacdt WHERE dienthoai.MaDT = mausacdt.MaDT AND dienthoai.MaDT = ".' '.$row_chitiet['MaDT'];
                        $query_mausac = mysqli_query($mysqli, $sql_mausac);
                        while ($row_mausac = mysqli_fetch_array($query_mausac)) {
                            ?>
                                <div class="form-group" style="display: inline-block">
                                    <input class="form-check-input" name="mausac" type="radio" id="ms-<?php echo $row_mausac['MaMS'] ?>" value="<?php echo $row_mausac['MaMS'] ?>">
                                    <label for="ms-<?php echo $row_mausac['MaMS'] ?>" class="form-check-label dark-grey-text">
                                        <?php echo $row_mausac['TenMS'] ?>
                                    </label>
                                </div>
                            <?php
                        }
                    ?>             
            </div>
            <br>

            <div id="themgiohang"></div>
            <button class="btn btn-danger btn-rounded canhgiua" style="margin-top: 5px" onclick="themgiohang('<?php echo $row_chitiet['MaDT'] ?>')">MUA NGAY</button>

        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="p-3">
                    <?php
                        $sql_cauhinh = "SELECT * FROM cauhinhdt WHERE MaDT = ".$_GET["id"]."";
                        $query_cauhinh = mysqli_query($mysqli, $sql_cauhinh);
                        $row_cauhinh = mysqli_fetch_array($query_cauhinh);
                    ?>
                    <ul class="cauhinh-list" style="display:block">
                        <li>
                            <p style="width: 100px;color: red;font-weight:bold">M??n h??nh</p>
                            <p><?php echo $row_cauhinh['ManHinh'] ?></p>
                        </li>
                        <li>
                            <p style="width: 115px;color: red;font-weight:bold">Camera Sau</p>
                            <p><?php echo $row_cauhinh['CameraSau'] ?></p>
                        </li>
                        <li>
                            <p style="width: 100px;color: red;font-weight:bold">Camera Tr?????c</p>
                            <p><?php echo $row_cauhinh['CameraTruoc'] ?></p>
                        </li>
                        <li>
                            <p style="width: 100px;color: red;font-weight:bold">RAM</p>
                            <p><?php echo $row_cauhinh['RAM'] ?></p>
                        </li>
                        <li>
                            <p style="width: 100px;color: red;font-weight:bold">B??? nh??? trong</p>
                            <p><?php echo $row_cauhinh['BoNhoTrong'] ?></p>
                        </li>
                        <li>
                            <p style="width: 100px;color: red;font-weight:bold">CPU</p>
                            <p><?php echo $row_cauhinh['CPU'] ?></p>
                        </li>
                        <li>
                            <p style="width: 100px;color: red;font-weight:bold">GPU</p>
                            <p><?php echo $row_cauhinh['GPU'] ?></p>
                        </li>
                        <li>
                            <p style="width: 100px;color: red;font-weight:bold">Pin</p>
                            <p><?php echo $row_cauhinh['Pin'] ?></p>
                        </li>
                        <li>
                            <p style="width: 100px;color: red;font-weight:bold">H??? ??i???u h??nh</p>
                            <p><?php echo $row_cauhinh['HDH'] ?></p>
                        </li>
                        <li>
                            <p style="width: 142px;color: red;font-weight:bold">Sim</p>
                            <p><?php echo $row_cauhinh['Sim'] ?></p>
                        </li>
                        <li>
                            <p style="width: 100px;color: red;font-weight:bold">N??m Ra M???t</p>
                            <p><?php echo $row_cauhinh['NamRaMat'] ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</section>

<div class="row" style="background-color: #dfdfdf;width: 100%; margin: 0; padding: 0">
    <div class="col-sm-1"></div>
    <div class="col-sm-10 p-0 ">
        <!-- ?? nh???p b??nh lu???n -->
        
        <div class="obinhluan" style="background-color:white;padding: 3px">
            <p class="tieudenho" style="margin: 5px 0 5px 10px">B??nh lu???n ????nh gi?? ??i???n tho???i <?php echo $row_chitiet['TenDT']?></p>
            <?php
                $maKH = $_SESSION['khachhang']['MaKH'];
                if(isset($_SESSION['khachhang'])){
                ?>
                <form action="./comment.php" method='POST'>
                    <div class="md-form mb-0" style="margin: 15px 15px 10px 15px"> 
                        <input type='hidden' name='maDT' value='<?php echo $_GET['id'] ?>'>
                        <textarea type="text" name='comment' id="form76" class="md-textarea form-control" rows="1"></textarea>
                        <label for="contact-message">B??nh lu???n</label>
                    </div>
                    <div class="text-center text-md-right mt-4" style="margin-right: 20px">
                        <button type="button" name="btnComment" class="btn btn-rounded btn-outline-red waves-effect ">G???I</button>
                    </div>
                </form>
                <?php
            } 
                else {
                    ?>
                    <p style="font-weight: bold;margin-left: 11px;margin-bottom: 40px">B???n ph???i ????ng nh???p ????? c?? th??? b??nh lu???n v??? s???n ph???m n??y.</p>
                <?php
                }
            ?>
            

            <div id="binhluan">
                <p class="tieudenho" style="margin: 5px 0 5px 10px;">T???t c??? <?php
                    $sql_sobl = "SELECT COUNT(MaBL) sobl FROM comment WHERE MaDT = ".$_GET["id"]."";
                    $query_sobl = mysqli_query($mysqli, $sql_sobl);
                    $row_sobl = mysqli_fetch_array($query_sobl);
                    echo $row_sobl['sobl'];
                ?> b??nh lu???n</p>

                <?php
                    if(isset($_SESSION['khachhang'])) {
                        $sql_blcuatoi = "SELECT * FROM comment, khachhang WHERE comment.MaKH = khachhang.MaKH AND comment.MaKH = $maKH AND comment.MaDT = ".$_GET["id"]."";
                        $query_blcuatoi = mysqli_query($mysqli, $sql_blcuatoi);
                        if(mysqli_num_rows($query_blcuatoi)==0) {
                            echo "";
                        }
                        else {
                            while($row_blcuatoi = mysqli_fetch_array($query_blcuatoi)) {
                                echo '
                                 <div class="card-body">
                                     <ul class="list-unstyled">
                                         <li class="media">
                                             <img class="d-flex mr-3 z-depth-1" alt="???nh ?????i di???n" src="./Images/AnhDaiDien/'.$row_blcuatoi['AnhDaiDien'].'" height="70px" width="70px">
                                             <div class="media-body">
                                                 <h5 class="mt-0 mb-1" style="font-weight:bold">'.$row_blcuatoi['HoTenKH'].'</h5>
                                                 '.$row_blcuatoi['NoiDung'].'
                                                 <br>
                                                <a href="" style="font-size: 12px" onclick="editCmt(\'sua\')">S???a</a>
                                                <a href="" style="font-size: 12px;margin-left: 5px" onclick="editCmt(\'xoa\')">X??a</a>
                                             </div>
                                             
                                         </li>
                                     </ul>
                                 </div>
                             '; 
                             }
                        }
                    }
                ?>

            
                
                <div class="card-body">
                    <ul class="list-unstyled" style="margin-top: -65px">
                        <?php
                            $sql_bl = "SELECT * FROM comment, khachhang WHERE comment.MaKH = khachhang.MaKH AND comment.MaKH != $maKH AND comment.MaDT = ".$_GET["id"]."";
                            $query_bl = mysqli_query($mysqli, $sql_bl);
                            while($row_bl = mysqli_fetch_array($query_bl)){
                                ?>
                                    <li class="media" style="margin-top: 30px">
                                        <img class="d-flex mr-3 z-depth-1" alt="???nh ?????i di???n" src="./Images/AnhDaiDien/<?php echo $row_bl['AnhDaiDien'] ?>" height="70px" width="70px">
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-1" style="font-weight:bold"><?php echo $row_bl['HoTenKH'] ?></h5>
                                            <?php echo $row_bl['NoiDung'] ?>
                                            
                                        </div>
                                        
                                    </li>
                                <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ?? hi???n th??? b??nh lu???n -->
        
    </div>
</div>

<script>
    function danhgia(madt) {
        var checkbox = document.getElementsByName("danhgia");
        for (var i=0; i < checkbox.length; i++) {
            if (checkbox[i].checked === true) {
                var sosao = checkbox[i].value;
            }
        }
        

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("danhgiasp").innerHTML =(this.responseText); //=>k???t qu??? tr??? v??? th??m v??o element n??y, c?? html v???n hi???n ???????c
            }
        };
    xmlhttp.open("GET", "danhgia.php?sosao=" + sosao + "&madt=" + madt, true);
    xmlhttp.send();
    }

    function themgiohang(madt02) {
        var checkbox = document.getElementsByName("mausac");
        mausac = 0;
        for (var i=0; i < checkbox.length; i++) {
            if (checkbox[i].checked === true) {
                var mausac = checkbox[i].value;
            }
        }

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("themgiohang").innerHTML =(this.responseText); //=>k???t qu??? tr??? v??? th??m v??o element n??y, c?? html v???n hi???n ???????c
            }
        };
        xmlhttp.open("GET", "themvaogiohang.php?mausac=" + mausac + "&madt=" + madt02, true);
        xmlhttp.send();
    }

    function editCmt(sukien) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("binhluan").innerHTML =(this.responseText); //=>k???t qu??? tr??? v??? th??m v??o element n??y, c?? html v???n hi???n ???????c
            }
        };
        xmlhttp.open("GET", "editComment.php?sukien=" + sukien, true);
        xmlhttp.send();
    }
    
</script>

