<?php
    // update
    include 'koneksi_db.php';
    $sql = "UPDATE users SET nama='kyyttoo_updated' WHERE id=2";
    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil diupdate";
    } else {
        echo "Error UPDATE: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>