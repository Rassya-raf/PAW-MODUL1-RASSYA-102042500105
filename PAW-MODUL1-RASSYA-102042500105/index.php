<?php
// Data produk disimpan dalam array PHP (array of array)
$products = [
    ["nama" => "Monitor 24 Inch",       "kategori" => "Monitor",    "harga" => 1800000, "stok" => 4],
    ["nama" => "Asus Vivobook",   "kategori" => "Laptop",     "harga" => 12500000, "stok" => 3],
    ["nama" => "SSamsung S24", "kategori" => "Smartphone", "harga" => 12000000, "stok" => 6],
    ["nama" => "RK Royal Kludge RK R87Pro",   "kategori" => "Aksesoris",  "harga" => 620000,  "stok" => 10],
    ["nama" => "Redragon FYZU M995 Wireless Mouse",        "kategori" => "Aksesoris",  "harga" => 150000,  "stok" => 15],
    ["nama" => "Earfun Air 4i",        "kategori" => "Audio",      "harga" => 600000,  "stok" => 0],
];

// Fungsi sederhana untuk format Rupiah
function formatRupiah($angka) {
    return "Rp" . number_format($angka, 0, ",", ".");
}

$totalProduk = count($products);
$batasDiskon = 1000000;   
$persenDiskon = 10;       
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cia Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="container navbar-inner">
            <span class="brand">Cia Store</span>
            <nav class="nav-menu">
                <a href="#home">Home</a>
                <a href="#products">Products</a>
                <a href="#about">About</a>
            </nav>
        </div>
    </header>

    <main class="container">

        <!-- HERO -->
        <section class="hero" id="home">
            <span class="hero-label">Cia Store</span>
            <h1>Simple Tech Store.</h1>
            <p>Temukan berbagai perangkat dan aksesoris teknologi untuk kebutuhanmu.</p>
            <a href="#products" class="hero-button">Lihat Produk</a>
        </section>

        <!-- INFORMASI JUMLAH PRODUK -->
        <section class="catalog-head" id="products">
            <div>
                <span class="section-label">Our Products</span>
                <h2>Katalog Produk</h2>
            </div>
            <div class="total-box">Total Produk: <strong><?php echo $totalProduk; ?></strong></div>
        </section>

        <!-- KATALOG PRODUK (perulangan PHP) -->
        <section class="product-grid">
            <?php foreach ($products as $produk) { ?>

                <?php
                // Percabangan: status stok
                if ($produk["stok"] > 0) {
                    $status = "Tersedia";
                    $kelasStatus = "status-ready";
                } else {
                    $status = "Stok Habis";
                    $kelasStatus = "status-empty";
                }

                // Percabangan: diskon (challenge)
                $adaDiskon = $produk["harga"] >= $batasDiskon;
                if ($adaDiskon) {
                    $hargaAkhir = $produk["harga"] - ($produk["harga"] * $persenDiskon / 100);
                } else {
                    $hargaAkhir = $produk["harga"];
                }
                ?>

                <article class="product-card">
                    <div class="card-top">
                        <span class="category"><?php echo $produk["kategori"]; ?></span>
                        <?php if ($adaDiskon) { ?>
                            <span class="discount-badge">DISKON <?php echo $persenDiskon; ?>%</span>
                        <?php } ?>
                    </div>

                    <h3><?php echo $produk["nama"]; ?></h3>

                    <div class="price-area">
                        <?php if ($adaDiskon) { ?>
                            <span class="price-old"><?php echo formatRupiah($produk["harga"]); ?></span>
                        <?php } ?>
                        <span class="price"><?php echo formatRupiah($hargaAkhir); ?></span>
                    </div>

                    <div class="stock-row">
                        <span>Stok: <?php echo $produk["stok"]; ?></span>
                        <span class="status <?php echo $kelasStatus; ?>"><?php echo $status; ?></span>
                    </div>

                    <?php if ($produk["stok"] > 0) { ?>
                        <button class="buy-button">Beli Sekarang</button>
                    <?php } else { ?>
                        <button class="buy-button" disabled>Beli Sekarang</button>
                    <?php } ?>
                </article>

            <?php } ?>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer" id="about">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Cia Store. Toko perangkat dan aksesoris teknologi.</p>
        </div>
    </footer>

</body>
</html>