<?php
require "../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();

    $no_hp = $_POST['no_hp'];
    $password = md5($_POST['password']);

    $cek = "SELECT * FROM nasabah WHERE no_hp='$no_hp' AND password='$password'";
    $result = mysqli_fetch_array(mysqli_query($con, $cek));

    if (isset($result)) {
        $response['value'] = 1;
        $response['id'] = $result['id'];
        $response['no_rekening'] = $result['no_rekening'];
        $response['nama'] = $result['nama'];
        $response['alamat'] = $result['alamat'];
        $response['no_hp'] = $result['no_hp'];
        $response['tgl'] = $result['tgl'];
        $response['saldo'] = $result['saldo'];
        $response['password'] = $result['password'];
        $response['status'] = $result['status'];
        $response['message'] = "Login Berhasil";
        echo json_encode($response);
    } else {
        $response['value'] = 0;
        $response['message'] = "Nomor telepon dan password tidak cocok";
        echo json_encode($response);
    }
}
