<?php
    include 'koneksi_db.php';
    // CREATE
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $conn = mysqli_connect("localhost", "root", "", "dazaficraft");

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO users
    (nama, email, password)
    VALUES 
    ('kyyttoo', 'kyyttoo@example.com', 'contohpassword')";

    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil ditambahkan <br><br>";

    } else {
        echo "Error INSERT: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>