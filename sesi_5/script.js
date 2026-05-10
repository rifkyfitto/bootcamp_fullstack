// =========================
// DATA PRODUK
// =========================

const products = [

{
nama: "iPhone 15 Pro",
harga: 21000000,
deskripsi: "Smartphone flagship Apple terbaru.",
gambar: "https://picsum.photos/300?1",
kategori: "Elektronik"
},

{
nama: "Samsung S24 Ultra",
harga: 19000000,
deskripsi: "HP Android premium kamera canggih.",
gambar: "https://picsum.photos/300?2",
kategori: "Elektronik"
},

{
nama: "MacBook Pro M3",
harga: 32000000,
deskripsi: "Laptop powerful untuk editing.",
gambar: "https://picsum.photos/300?3",
kategori: "Elektronik"
},

{
nama: "ASUS ROG Laptop",
harga: 25000000,
deskripsi: "Laptop gaming performa tinggi.",
gambar: "https://picsum.photos/300?4",
kategori: "Gaming"
},

{
nama: "PlayStation 5",
harga: 8500000,
deskripsi: "Console gaming generasi terbaru.",
gambar: "https://picsum.photos/300?5",
kategori: "Gaming"
},

{
nama: "Mechanical Keyboard",
harga: 950000,
deskripsi: "Keyboard RGB untuk gaming.",
gambar: "https://picsum.photos/300?6",
kategori: "Gaming"
},

{
nama: "Hoodie Oversize",
harga: 250000,
deskripsi: "Hoodie nyaman dan stylish.",
gambar: "https://picsum.photos/300?7",
kategori: "Fashion"
},

{
nama: "Kaos Streetwear",
harga: 180000,
deskripsi: "Kaos trend anak muda.",
gambar: "https://picsum.photos/300?8",
kategori: "Fashion"
},

{
nama: "Sepatu Sneakers",
harga: 650000,
deskripsi: "Sneakers casual keren.",
gambar: "https://picsum.photos/300?9",
kategori: "Fashion"
},

{
nama: "Jam Tangan Digital",
harga: 350000,
deskripsi: "Jam sporty multifungsi.",
gambar: "https://picsum.photos/300?10",
kategori: "Aksesoris"
},

{
nama: "Headset Bluetooth",
harga: 550000,
deskripsi: "Audio jernih dan bass mantap.",
gambar: "https://picsum.photos/300?11",
kategori: "Elektronik"
},

{
nama: "Mouse Wireless",
harga: 200000,
deskripsi: "Mouse nyaman untuk kerja.",
gambar: "https://picsum.photos/300?12",
kategori: "Aksesoris"
},

{
nama: "Smartwatch",
harga: 1200000,
deskripsi: "Jam pintar dengan fitur kesehatan.",
gambar: "https://picsum.photos/300?13",
kategori: "Elektronik"
},

{
nama: "Tas Backpack",
harga: 400000,
deskripsi: "Tas multifungsi stylish.",
gambar: "https://picsum.photos/300?14",
kategori: "Fashion"
},

{
nama: "Monitor Gaming",
harga: 3200000,
deskripsi: "Monitor 144Hz ultra smooth.",
gambar: "https://picsum.photos/300?15",
kategori: "Gaming"
},

{
nama: "Kacamata Fashion",
harga: 175000,
deskripsi: "Kacamata modern kekinian.",
gambar: "https://picsum.photos/300?16",
kategori: "Aksesoris"
},

{
nama: "Speaker Portable",
harga: 480000,
deskripsi: "Speaker mini suara nendang.",
gambar: "https://picsum.photos/300?17",
kategori: "Elektronik"
},

{
nama: "Gaming Chair",
harga: 2100000,
deskripsi: "Kursi gaming nyaman dipakai lama.",
gambar: "https://picsum.photos/300?18",
kategori: "Gaming"
},

{
nama: "Topi Casual",
harga: 120000,
deskripsi: "Topi santai buat nongkrong.",
gambar: "https://picsum.photos/300?19",
kategori: "Fashion"
},

{
nama: "Power Bank 20000mAh",
harga: 375000,
deskripsi: "Baterai cadangan kapasitas besar.",
gambar: "https://picsum.photos/300?20",
kategori: "Aksesoris"
}

];

// =========================
// TAMPILKAN PRODUK
// =========================

const productContainer =
document.getElementById("productContainer");

function tampilkanProduk(data){

productContainer.innerHTML = "";

if(data.length === 0){
productContainer.innerHTML = `
<div class="text-center">
<h4>Produk tidak ditemukan 😵</h4>
</div>
`;
return;
}

data.forEach(produk => {

productContainer.innerHTML += `

<div class="col-md-3 mb-4">

<div class="card h-100 shadow-sm">

<img
src="${produk.gambar}"
class="card-img-top"
alt="${produk.nama}"
>

<div class="card-body d-flex flex-column">

<span
class="badge badge-category mb-2"
>
${produk.kategori}
</span>

<h5 class="card-title">
${produk.nama}
</h5>

<h6 class="text-success fw-bold">
Rp ${produk.harga.toLocaleString()}
</h6>

<p class="card-text">
${produk.deskripsi}
</p>

<button class="btn btn-primary mt-auto">
Beli Sekarang
</button>

</div>

</div>

</div>

`;
});
}

// =========================
// FILTER + SEARCH
// =========================

const filterKategori =
document.getElementById("filterKategori");

const searchProduk =
document.getElementById("searchProduk");

function filterDanSearch(){

const kategori =
filterKategori.value;

const keyword =
searchProduk.value.toLowerCase();

let hasil = products;

// FILTER KATEGORI
if(kategori !== "Semua"){

hasil = hasil.filter(produk =>
produk.kategori === kategori
);
}

// SEARCH NAMA
hasil = hasil.filter(produk =>
produk.nama.toLowerCase()
.includes(keyword)
);

tampilkanProduk(hasil);
}

// EVENT
filterKategori.addEventListener(
"change",
filterDanSearch
);

searchProduk.addEventListener(
"keyup",
filterDanSearch
);

// LOAD AWAL
tampilkanProduk(products);