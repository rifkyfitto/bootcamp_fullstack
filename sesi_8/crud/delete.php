<?php
    // delete
    include 'koneksi_db.php';

    $sql = "DELETE FROM users WHERE id = 1";

    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error DELETE: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>