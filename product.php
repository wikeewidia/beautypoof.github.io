<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Product| Beautypoof</title>
  <link rel="stylesheet" href="assets/product.css" />
</head>
<body></body>

<?php include_once 'partials/header.php'; ?>
<?php include_once 'partials/sidebar.php'; ?>

<main class="main-content">
  <section class="product-section">
    <h2>Our Products</h2>
    
    <div class="product-grid">
      <?php
      // Data produk sebagai array dengan validasi
      $products = [
        [
          "name" => "Glass Lipstick",
          "image" => "assets/images/lipstickk.jpg",
          "alt" => "BeautyPoof Glass Lipstick - Long lasting glossy finish"
        ],
        [
          "name" => "Glow Foundation",
          "image" => "assets/images/foundation.jpg",
          "alt" => "BeautyPoof Glow Foundation - Full coverage liquid foundation"
        ],
        [
          "name" => "Natural Blush",
          "image" => "assets/images/blush.jpg", 
          "alt" => "BeautyPoof Natural Blush - Soft rosy glow for cheeks"
        ],
        [
          "name" => "Eyeshadow Palette",
          "image" => "assets/images/eyeshadow.jpg",
          "alt" => "BeautyPoof Eyeshadow Palette - 12 stunning eye colors"
        ],
        [
          "name" => "Flawless Compact Powder",
          "image" => "assets/images/powder.jpg",
          "alt" => "BeautyPoof Compact Powder - Oil control and matte finish"
        ]
      ];

      // Fungsi untuk mengecek apakah file gambar ada
      function imageExists($imagePath) {
        return file_exists($imagePath) && is_readable($imagePath);
      }

      // Menampilkan produk dengan error handling
      if (!empty($products)) {
        foreach ($products as $index => $product) {
          // Sanitize dan validasi data
          $name = isset($product["name"]) ? htmlspecialchars(trim($product["name"]), ENT_QUOTES, 'UTF-8') : "Product " . ($index + 1);
          $image = isset($product["image"]) ? trim($product["image"]) : "";
          $alt = isset($product["alt"]) ? htmlspecialchars(trim($product["alt"]), ENT_QUOTES, 'UTF-8') : $name;
          
          // Default image jika gambar tidak ada
          $defaultImage = "assets/images/placeholder.jpg";
          $finalImage = (!empty($image) && imageExists($image)) ? $image : $defaultImage;
          
          echo '<div class="product-card">';
          
          // Tampilkan gambar dengan lazy loading
          echo '<img src="' . htmlspecialchars($finalImage, ENT_QUOTES, 'UTF-8') . '" ';
          echo 'alt="' . $alt . '" ';
          echo 'loading="lazy" ';
          echo 'onerror="this.src=\'' . $defaultImage . '\'; this.onerror=null;">';
          
          // Nama produk
          echo '<h3>' . $name . '</h3>';
          
          echo '</div>';
        }
      } else {
        // Jika tidak ada produk
        echo '<div class="no-products">';
        echo '<p>Produk sedang dalam tahap pengembangan. Silakan kembali lagi nanti!</p>';
        echo '</div>';
      }
      ?>
    </div>
  </section>
</main>



<?php include_once 'partials/footer.php'; ?>