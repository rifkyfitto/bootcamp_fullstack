<?php
$text = "Hello World";
$x = 10;
$y = 20;
echo $x + $y . " " . $text;

// if
$skor = 85;
$skor = 75;
if ($skor == 85 || $skor == 75) {
    echo "Nilai Anda A";}

if (10 > 3) {
    echo "Have a nice day!";
} else {
    echo "Nice try lil dawg!";
}

// if else
$nilai_ulangan = 100;
$skor = null;
if ($nilai_ulangan >= 90) {
    $skor = "Nilai Anda A";
} elseif ($nilai_ulangan >= 80) {
    $skor = "Nilai Anda B";
} elseif ($nilai_ulangan >= 70) {
    $skor = "Nilai Anda C";
} elseif ($nilai_ulangan >= 60) {
    $skor = "Nilai Anda D";
} else {
    $skor = "Nilai Anda E";
}
echo $skor;

// shorthand if else (ternary operator)
$status = ($nilai_ulangan >= 60) ? "Lulus" : "Tidak Lulus";
echo $status;

// shorthand null coalescing operator
$username = $_GET['username'] ?? 'Guest';
echo "Hello, " . $username;

$a = 100;
$b = a < 50 ? "Kecil" : "Besar";
echo $b;
?>