<!-- struktur kontrol switch -->
<?php
$role = 'admin';
switch ($role) {
    case 'admin':
        echo 'welcome admin';
        break;
    case 'user':
        echo 'welcome user';
        break;
    default:
        echo 'akses ditolak';
    }

$role = 'user';
$message = match ($role) {
    'admin' => 'welcome admin',
    'user' => 'welcome user',
    default => 'akses ditolak',
};
echo $message;

// looping
for ($i = 0; $i < 5; $i++) {
    echo "Perulangan ke-$i <br>";
    }

// array
$fruits = ['apel', 'jeruk', 'pisang'];
foreach ($fruits as $fruit) {
    echo "Buah: $fruit <br>"; }

$asc_array = ['nama' => 'Alice', 'umur' => 30];
echo $asc_array['nama'] . ' - ' . $asc_array['umur'];

// function
function myMassage($name) {
    return "Hello, $name!";
    }
    echo myMassage("Alice");

// class
class Person {
    public $name;
    public function __construct($name) {
        $this->name = $name;
    }
}

?>