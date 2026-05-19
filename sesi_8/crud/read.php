<?php
    // read
    include 'koneksi_db.php';

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query Error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "ID: " . $row["id"]. 
            " - Name: " . $row["nama"]. 
            " - Email: " . $row["email"].
            "<br>";
        }
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
?>