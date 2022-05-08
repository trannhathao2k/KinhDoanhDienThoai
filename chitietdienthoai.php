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
            <p style="position:absolute;right: 66px; top: 284px; font-size: 14px; color: MediumSeaGreen;font-weight:bold">Còn lại: <b style="color: red">
                <?php
                $conlai = $row_chitiet['SoLuong'] - $row_chitiet['DaBan'];
                echo $conlai ?>
            </b></p>
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
            <p style="font-weight:bold; font-size: 16px">Chi tiết</p>
            <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
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
            </div>

            <button class="btn btn-danger btn-rounded canhgiua">MUA NGAY</button>

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
                            <p style="width: 100px;color: red;font-weight:bold">NamRaMat</p>
                            <p><?php echo $row_cauhinh['NamRaMat'] ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</section>
