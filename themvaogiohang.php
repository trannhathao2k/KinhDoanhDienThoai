<?php
include("./config.php");
include("./autoload.php");
session_start();

if(isset($_GET['mausac']) && isset($_GET['madt'])) {
    $mausac = $_GET['mausac'];
    $madt = $_GET['madt'];
}
else {
    $mausac = "0";
    $madt = "0";
}

$check02 = "SELECT COUNT(MaGH) ktra FROM giohang, mausacdt WHERE giohang.MauSac = mausacdt.MaMS AND giohang.MaDT = $madt AND mausacdt.TenMS = '$mausac' AND giohang.MaKH = 1";
$query_check02 = mysqli_query($mysqli, $check02);
$row_check02 = mysqli_fetch_array($query_check02);

if ($row_check02['ktra'] == 0) {
    $add_giohang = "INSERT INTO giohang VALUES (null,1,$madt,$mausac)";
    $mysqli->query($add_giohang);
    echo '<p>Mua hàng thành công</p>';
}
else {
    echo '<p>Mua hàng thất bại</p>';
}

?>