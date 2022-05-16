<div class="container">
    <section class="section my-5 pb-5">
        <div class="card card-ecommerce">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table product-table table-cart-v-2">
                        <thead class="mdb-color danger-color-dark">
                            <tr style="color: white">
                                <th></th>
                                <th class="font-weight-bold">
                                    <strong>Tên sản phẩm</strong>
                                </th>
                                <th class="font-weight-bold">
                                    <strong>Màu sắc</strong>
                                </th>
                                <th class="font-weight-bold">
                                    <strong>Giá</strong>
                                </th>
                                <th class="font-weight-bold">
                                    <strong>Số lượng</strong>
                                </th>
                                <th class="font-weight-bold">
                                    <strong>Tổng</strong>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql_giohang = "SELECT * FROM giohang, dienthoai WHERE giohang.MaDT = dienthoai.MaDT AND giohang.MaKH = 1";
                                $query_giohang = mysqli_query($mysqli, $sql_giohang);
                                while ($row_giohang = mysqli_fetch_array($query_giohang)) {
                            ?>
                            <tr>
                                <th scope="row">
                                    <img src="./Images/AnhDT/<?php 
                                        $sql_anhdt = "SELECT * FROM hinhanh WHERE Hinh_index = 1 AND MaDT = ".' '.$row_giohang['MaDT'];
                                        $query_anhdt = mysqli_query($mysqli, $sql_anhdt);
                                        $row_anhdt = mysqli_fetch_array($query_anhdt);
                                        echo $row_anhdt['TenHinh'] ?>"
                                        alt="" class="img-fluid z-depth-0" width="120px" height="120px">
                                </th>
                                <td>
                                    <h5 class="mt-3">
                                        <strong><?php echo $row_giohang['TenDT'] ?></strong>
                                    </h5>
                                    <p class="text-muted"><?php
                                        $sql_hang = "SELECT * FROM dienthoai, hangsx WHERE dienthoai.MaHang = hangsx.MaHang AND MaDT = ".' '.$row_giohang['MaDT'];
                                        $query_hang = mysqli_query($mysqli, $sql_hang);
                                        $row_hang = mysqli_fetch_array($query_hang);
                                        echo $row_hang['TenHang'];
                                    ?></p>
                                </td>
                                <td><?php 
                                    $sql_mausacdt = "SELECT * FROM giohang, mausacdt WHERE giohang.MauSac = mausacdt.MaMS AND giohang.MaDT = mausacdt.MaDT AND giohang.MaGH = ".' '.$row_giohang['MaGH'];
                                    $query_mausacdt = mysqli_query($mysqli, $sql_mausacdt);
                                    $row_mausacdt = mysqli_fetch_array($query_mausacdt);
                                    echo $row_mausacdt['TenMS'];
                                ?></td>
                                <td style="color: red; font-size: 18px;font-weight:bold"><?php echo $row_giohang['GiaKhuyenMai'] ?> đ</td>
                                <td class="text-center text-md-left">
                                    <span class="qty">1 </span>
                                    <div class="btn-group radio-group ml-2" data-toggle="buttons">
                                    <label class="btn btn-sm btn-danger btn-rounded">
                                        <input type="radio" name="options" id="option1">&mdash;
                                    </label>
                                    <label class="btn btn-sm btn-danger btn-rounded">
                                        <input type="radio" name="options" id="option2">+
                                    </label>
                                    </div>
                                </td>
                                <td style="color: red; font-size: 18px;font-weight:bold"><?php echo $row_giohang['GiaKhuyenMai'] ?> đ</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                                        title="Remove item">X
                                    </button>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                            <tr>
                                <td colspan="3"></td>
                                <td>
                                    <h4 class="mt-2">
                                        <strong>Tổng tiền:</strong>
                                    </h4>
                                </td>
                                <td class="text-right">
                                    <h4 class="mt-2">
                                        <strong style="color: red">9.490.000 đ</strong>
                                    </h4>
                                </td>
                                <td colspan="3" class="text-right">
                                    <button type="button" class="btn btn-danger btn-rounded">THANH TOÁN
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="../../js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../../js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../../js/mdb.min.js"></script>
  <script type="text/javascript">
    /* WOW.js init */
    new WOW().init();

    // MDB Lightbox Init
    $(function () {
      $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
    });

    // Tooltips Initialization
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    // Material Select Initialization
    $(document).ready(function () {

      $('.mdb-select').material_select();
    });

    // SideNav Initialization
    $(".button-collapse").sideNav();

  </script>