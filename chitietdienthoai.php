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
                                ?> lượt đánh giá)</p>
                        <?php
                ?>
            </ul>
            <p style="position:relative; font-size: 14px; color: black; font-weight:bold">Đã bán: <b style="color: red">
                <?php echo $row_chitiet['DaBan'] ?>
            </b></p>
            <p style="position:absolute;right: 14px; top: 284px; font-size: 14px; color: MediumSeaGreen;font-weight:bold">Còn lại: <b style="color: red">
                <?php
                $conlai = $row_chitiet['SoLuong'] - $row_chitiet['DaBan'];
                echo $conlai ?>
            </b></p>
            <br>
            <div class="card">
                <p class="tieudenho" style="text-align: center">ĐÁNH GIÁ</p>
                <p style="text-align:center;margin-top: -12px">Bạn chấm sản phẩm này bao nhiêu sao?</p>
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
            <p class="gia-dt-chitiet"><?php echo $row_chitiet['GiaKhuyenMai'] ?>đ</p>
            <?php
                if ($row_chitiet['TrangThaiKM'] == 1 || $row_chitiet['TrangThaiKM'] == 3) {
                    ?>
                        <p class="giagoc-dt-chitiet"><del><?php echo $row_chitiet['GiaGoc'] ?>đ</del></p>
                    <?php
                }
            ?>

            <p style="font-weight:bold; font-size: 16px">Mô tả</p>
            <p>
                <?php echo $row_chitiet['MoTa'] ?>
            </p>
            <p style="font-weight:bold; font-size: 16px">Ưu điểm nổi bật</p>
            <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true"
            style="margin-top: -12px">
                <!-- Chức năng 1 -->
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne1">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="false"
                                aria-controls="collapseOne1">
                            <p class="mb-0" style="color: black">Dễ dàng nổi bật giữa đám đông.
                                <i class="fas fa-angle-down rotate-icon"></i>
                            </p>
                        </a>
                    </div>
                    <div id="collapseOne1" class="collapse" role="tabpanel" aria-labelledby="headingOne1"
                            data-parent="#accordionEx">
                        <div class="card-body">
                            <p>Điện thoại OPPO Reno7 Z 5G có khung viền vát phẳng,
                            vuông vức trendy làm cho máy toát lên nét hiện đại và năng động.
                            Bốn góc được bo cong mềm mại tạo cảm giác thoải mái và nhẹ nhàng (chỉ 173 g).
                            Với thiết kế nguyên khối làm tổng thể máy trở nên cực kỳ chắc chắn,
                            không chỉ đẹp mà còn tăng độ bền.</p>
                        </div>
                    </div>
                </div>

                <!-- Chức năng 2 -->
                <div class="card">
                    <div class="card-header" role="tab" id="headingTwo2">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
                            aria-expanded="false" aria-controls="collapseTwo2">
                            <p class="mb-0" style="color: black">
                                Bật mở chân dung vô hạn
                                <i class="fas fa-angle-down rotate-icon"></i>
                            </p>
                        </a>
                    </div>

                    <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
                  data-parent="#accordionEx">
                        <div class="card-body">
                            <p>Đối với dòng Reno Series, OPPO đánh mạnh vào phần trải nghiệm camera,
                            Reno7 Z trang bị cụm 3 camera sau với cảm biến chính độ phân giải 64 MP,
                            ống kính macro 2 MP và camera chụp ảnh xoá phông 2 MP.
                            Đánh giá chung các bức hình được chụp bởi Reno7 Z 5G có độ chi tiết tốt,
                            dải nhạy sáng ổn, màu sắc chân thực nên bạn có thể chụp và đăng tải lên các mạng xã hội ngay lập tức mà không cần phải qua các bước chỉnh sửa.
                            Các tấm ảnh chụp đêm cũng có chất lượng rất ổn, ánh đèn rực rỡ không bị chói,
                            độ phơi sáng tốt và ít bị nhiễu hạt.</p>
                        </div>
                    </div>
                </div>

                <!-- Chức năng 3 -->
                <div class="card">
                    <div class="card-header" role="tab" id="headingTwo3">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo3"
                            aria-expanded="false" aria-controls="collapseTwo3">
                            <p class="mb-0" style="color: black">
                                Hiệu năng vượt bật, phản hồi tức thời
                                <i class="fas fa-angle-down rotate-icon"></i>
                            </p>
                        </a>
                    </div>

                    <div id="collapseTwo3" class="collapse" role="tabpanel" aria-labelledby="headingTwo3"
                  data-parent="#accordionEx">
                        <div class="card-body">
                            <p>Reno7 Z sở hữu bộ nhớ RAM lên đến 13 GB (8 GB mặc định + 5 GB mở rộng),
                                ROM 128 GB, đây cũng là một con số khá ổn ở thời điểm hiện tại (3/2022)
                                và có thể đáp ứng tốt nhu cầu sử dụng của hầu hết mọi đối tượng người dùng.<br>
                                Các tác vụ hằng ngày như lướt web, mạng xã hội, học, họp online thì Reno7 Z cho một tốc độ rất ổn định,
                                các thao tác chạm, mở ứng dụng được phản hồi nhanh. Với một con chip hiệu năng cao,
                                phần mềm được tối ưu mạnh mẽ nên khả năng chơi game trên OPPO Reno7 Z 5G cũng rất tuyệt vời.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Chức năng 4 -->
                <div class="card">
                    <div class="card-header" role="tab" id="headingTwo4">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo4"
                            aria-expanded="false" aria-controls="collapseTwo4">
                            <p class="mb-0" style="color: black">
                                Nâng cao trải nghiệm nghe nhìn
                                <i class="fas fa-angle-down rotate-icon"></i>
                            </p>
                        </a>
                    </div>

                    <div id="collapseTwo4" class="collapse" role="tabpanel" aria-labelledby="headingTwo4"
                  data-parent="#accordionEx">
                        <div class="card-body">
                            <p>Màn hình Reno7 Z 5G trang bị tấm nền AMOLED,
                            kích thước 6.43 inch, độ phân giải Full HD+ (1080 x 2400 pixel),
                            tần số quét 60 Hz và được bảo vệ bởi lớp kính cường lực Schott Xensation UP.

                            Về màn hình thì các thông số trên khá cơ bản và không có nhiều nổi bật khi so với thế hệ trước,
                            máy vẫn cho chất lượng hiển thị rất tốt với màu sắc tươi tắn, trong trẻo,
                            không bị ám màu và hiển thị khá sống động. Độ sáng màn hình tối đa đạt 600 nits,
                            đủ dùng trong điều kiện sáng vừa phải.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-danger btn-rounded canhgiua" style="margin-top: 25px">MUA NGAY</button>

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
                            <p style="width: 100px;color: red;font-weight:bold">Màn hình</p>
                            <p><?php echo $row_cauhinh['ManHinh'] ?></p>
                        </li>
                        <li>
                            <p style="width: 115px;color: red;font-weight:bold">Camera Sau</p>
                            <p><?php echo $row_cauhinh['CameraSau'] ?></p>
                        </li>
                        <li>
                            <p style="width: 100px;color: red;font-weight:bold">Camera Trước</p>
                            <p><?php echo $row_cauhinh['CameraTruoc'] ?></p>
                        </li>
                        <li>
                            <p style="width: 100px;color: red;font-weight:bold">RAM</p>
                            <p><?php echo $row_cauhinh['RAM'] ?></p>
                        </li>
                        <li>
                            <p style="width: 100px;color: red;font-weight:bold">Bộ nhớ trong</p>
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
                            <p style="width: 100px;color: red;font-weight:bold">Hệ điều hành</p>
                            <p><?php echo $row_cauhinh['HDH'] ?></p>
                        </li>
                        <li>
                            <p style="width: 142px;color: red;font-weight:bold">Sim</p>
                            <p><?php echo $row_cauhinh['Sim'] ?></p>
                        </li>
                        <li>
                            <p style="width: 100px;color: red;font-weight:bold">Năm Ra Mắt</p>
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
        <!-- Ô nhập bình luận -->
        <div class="obinhluan" style="background-color:white;padding: 3px">
            <p class="tieudenho" style="margin: 5px 0 5px 10px">Bình luận đánh giá điện thoại <?php echo $row_chitiet['TenDT']?></p>
            <div class="md-form mb-0" style="margin: 15px 15px 10px 15px">
                <textarea type="text" id="form76" class="md-textarea form-control" rows="1"></textarea>
                <label for="contact-message">Bình luận</label>
            </div>
            <div class="text-center text-md-right mt-4" style="margin-right: 20px">
                <a class="btn btn-rounded btn-outline-red waves-effect ">GỬI</a>
            </div>

            <div>
                <p class="tieudenho" style="margin: 5px 0 5px 10px;">Tất cả <?php
                    $sql_sobl = "SELECT COUNT(MaBL) sobl FROM comment WHERE MaDT = ".$_GET["id"]."";
                    $query_sobl = mysqli_query($mysqli, $sql_sobl);
                    $row_sobl = mysqli_fetch_array($query_sobl);
                    echo $row_sobl['sobl'];
                ?> bình luận</p>

                <?php
                    $sql_bl = "SELECT * FROM comment, khachhang WHERE comment.MaKH = khachhang.MaKH AND MaDT = ".$_GET["id"]."";
                    $query_bl = mysqli_query($mysqli, $sql_bl);
                    $row_bl = mysqli_fetch_array($query_bl);
                ?>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="media">
                            <img class="d-flex mr-3 z-depth-1" alt="Ảnh đại diện" src="./Images/KhachHang/photo-1-15998880606521810343834.jpg" height="70px" width="70px">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1" style="font-weight:bold"><?php echo $row_bl['HoTenKH'] ?></h5>
                                <?php echo $row_bl['NoiDung'] ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Ô hiển thị bình luận -->
        
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
            document.getElementById("danhgiasp").innerHTML =(this.responseText); //=>kết quả trả về thêm vào element này, có html vẫn hiện được
        }
    };
    xmlhttp.open("GET", "danhgia.php?sosao=" + sosao + "&madt=" + madt, true);
    xmlhttp.send();
    }
    
</script>

