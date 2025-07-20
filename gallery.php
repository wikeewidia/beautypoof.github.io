<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gallery | Beautypoof</title>
  <link rel="stylesheet" href="assets/gallery.css" />
</head>
<body>
  <?php include_once 'partials/header.php'; ?>
  <?php include_once 'partials/sidebar.php'; ?>

<main class="main-content">
  <section class="gallery-section">
    <h2>Our Gallery</h2>
    <p class="gallery-subtitle">Discover the beautiful moments and activities at Beautypoof</p>
    
    <!-- Gallery Filter Tabs -->
    <div class="gallery-filter">
      <button class="filter-btn active" data-filter="all">All Activities</button>
      <button class="filter-btn" data-filter="workshop">Workshops</button>
      <button class="filter-btn" data-filter="event">Events</button>
      <button class="filter-btn" data-filter="tutorial">Tutorials</button>
      <button class="filter-btn" data-filter="behind-scenes">Behind the Scenes</button>
    </div>
    
    <div class="gallery-grid">
      <?php
      // Gallery data as array with validation
      $galleryItems = [
        [
          "title" => "Professional Makeup Workshop",
          "image" => "assets/images/gallery1.jpg",
          "alt" => "Professional makeup workshop session with expert artist",
          "category" => "workshop",
          "date" => "2025-07-15",
          "description" => "Our professional makeup artist teaching advanced contouring techniques to enthusiastic participants."
        ],
        [
          "title" => "Grand Launch Event",
          "image" => "assets/images/gallery2.jpg",
          "alt" => "Beautypoof grand launch event with attendees",
          "category" => "event",
          "date" => "2025-06-20",
          "description" => "The spectacular grand launch of our newest beauty collection with hundreds of beauty enthusiasts."
        ],
        [
          "title" => "Skincare Tutorial Session",
          "image" => "assets/images/gallery3.jpg",
          "alt" => "Skincare tutorial demonstration for healthy glowing skin",
          "category" => "tutorial",
          "date" => "2025-07-10",
          "description" => "Step-by-step skincare routine tutorial focusing on achieving that perfect glass skin effect."
        ],
        [
          "title" => "Behind the Scenes - Photoshoot",
          "image" => "assets/images/gallery4.jpg",
          "alt" => "Behind the scenes of Beautypoof product photoshoot",
          "category" => "behind-scenes",
          "date" => "2025-07-05",
          "description" => "Exclusive behind-the-scenes moments from our latest product photography session."
        ],
        [
          "title" => "Beauty Masterclass",
          "image" => "assets/images/gallery5.jpg",
          "alt" => "Beauty masterclass with celebrity makeup artist",
          "category" => "workshop",
          "date" => "2025-06-28",
          "description" => "Intensive masterclass featuring celebrity makeup artist sharing industry secrets and techniques."
        ],
        [
          "title" => "Product Launch Presentation",
          "image" => "assets/images/gallery6.jpg",
          "alt" => "New product launch presentation at beauty expo",
          "category" => "event",
          "date" => "2025-06-15",
          "description" => "Exciting presentation of our revolutionary new makeup line at the international beauty expo."
        ]
        ];

      // Function to check if image file exists
      function imageExists($imagePath) {
        return file_exists($imagePath) && is_readable($imagePath);
      }

      // Function to format date
      function formatGalleryDate($dateString) {
        $date = DateTime::createFromFormat('Y-m-d', $dateString);
        if ($date) {
          return $date->format('M j, Y');
        }
        return $dateString;
      }

      // Display gallery items with error handling
      if (!empty($galleryItems)) {
        foreach ($galleryItems as $index => $item) {
          // Sanitize and validate data
          $title = isset($item["title"]) ? htmlspecialchars(trim($item["title"]), ENT_QUOTES, 'UTF-8') : "Gallery Item " . ($index + 1);
          $image = isset($item["image"]) ? trim($item["image"]) : "";
          $alt = isset($item["alt"]) ? htmlspecialchars(trim($item["alt"]), ENT_QUOTES, 'UTF-8') : $title;
          $category = isset($item["category"]) ? htmlspecialchars(trim($item["category"]), ENT_QUOTES, 'UTF-8') : "general";
          $date = isset($item["date"]) ? htmlspecialchars(trim($item["date"]), ENT_QUOTES, 'UTF-8') : "";
          $description = isset($item["description"]) ? htmlspecialchars(trim($item["description"]), ENT_QUOTES, 'UTF-8') : "";
          
          // Default image if image doesn't exist
          $defaultImage = "assets/images/gallery-placeholder.jpg";
          $finalImage = (!empty($image) && imageExists($image)) ? $image : $defaultImage;
          
          echo '<div class="gallery-item" data-category="' . $category . '">';
          
          // Display image with lazy loading
          echo '<div class="gallery-image">';
          echo '<img src="' . htmlspecialchars($finalImage, ENT_QUOTES, 'UTF-8') . '" ';
          echo 'alt="' . $alt . '" ';
          echo 'loading="lazy" ';
          echo 'onerror="this.src=\'' . $defaultImage . '\'; this.onerror=null;">';
          
          // Image overlay
          echo '<div class="image-overlay">';
          echo '<div class="overlay-content">';
          echo '<button class="view-btn" onclick="openLightbox(' . $index . ')">👁️ View</button>';
          echo '<button class="download-btn" onclick="downloadImage(\'' . $finalImage . '\', \'' . $title . '\')">📁 Save</button>';
          echo '</div>';
          echo '</div>';
          
          echo '</div>'; // end gallery-image
          
          // Gallery item content
          echo '<div class="gallery-content">';
          
          // Category badge
          echo '<span class="category-badge category-' . $category . '">' . ucfirst(str_replace('-', ' ', $category)) . '</span>';
          
          // Title
          echo '<h3>' . $title . '</h3>';
          
          // Date
          if (!empty($date)) {
            echo '<div class="gallery-date">';
            echo '<i class="date-icon">📅</i>';
            echo '<span>' . formatGalleryDate($date) . '</span>';
            echo '</div>';
          }
          
          // Description
          if (!empty($description)) {
            echo '<p class="gallery-description">' . $description . '</p>';
          }
          
          echo '</div>'; // end gallery-content
          echo '</div>'; // end gallery-item
        }
      } else {
        // If no gallery items
        echo '<div class="no-gallery">';
        echo '<p>No gallery items available at the moment. Please check back later for amazing photos and moments!</p>';
        echo '</div>';
      }
      ?>
    </div>
  </section>
</main>

<!-- Lightbox Modal -->
<div id="lightboxModal" class="lightbox-modal">
  <div class="lightbox-content">
    <span class="close-lightbox">&times;</span>
    <img id="lightboxImage" src="" alt="">
    <div class="lightbox-info">
      <h3 id="lightboxTitle"></h3>
      <p id="lightboxDescription"></p>
      <div class="lightbox-nav">
        <button id="prevBtn" class="nav-btn">❮ Previous</button>
        <button id="nextBtn" class="nav-btn">Next ❯</button>
      </div>
    </div>
  </div>
</div>

<script>
// Gallery filter functionality
document.addEventListener('DOMContentLoaded', function() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const galleryItems = document.querySelectorAll('.gallery-item');
  
  filterBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      // Remove active class from all buttons
      filterBtns.forEach(b => b.classList.remove('active'));
      // Add active class to clicked button
      this.classList.add('active');
      
      const filter = this.getAttribute('data-filter');
      
      galleryItems.forEach(item => {
        if (filter === 'all' || item.getAttribute('data-category') === filter) {
          item.style.display = 'block';
          item.style.opacity = '0';
          item.style.transform = 'scale(0.8)';
          
          setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'scale(1)';
          }, 100);
        } else {
          item.style.opacity = '0';
          item.style.transform = 'scale(0.8)';
          setTimeout(() => {
            item.style.display = 'none';
          }, 300);
        }
      });
    });
  });
  
  // Smooth scroll effect for gallery items
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  });
  
  galleryItems.forEach(item => {
    item.style.opacity = '0';
    item.style.transform = 'translateY(30px)';
    item.style.transition = 'all 0.6s ease';
    observer.observe(item);
  });
});

// Lightbox functionality
let currentImageIndex = 0;
const galleryData = <?php echo json_encode($galleryItems); ?>;

function openLightbox(index) {
  currentImageIndex = index;
  const modal = document.getElementById('lightboxModal');
  const lightboxImage = document.getElementById('lightboxImage');
  const lightboxTitle = document.getElementById('lightboxTitle');
  const lightboxDescription = document.getElementById('lightboxDescription');
  
  const item = galleryData[index];
  lightboxImage.src = item.image || 'assets/images/gallery-placeholder.jpg';
  lightboxImage.alt = item.alt || item.title;
  lightboxTitle.textContent = item.title;
  lightboxDescription.textContent = item.description;
  
  modal.style.display = 'block';
  document.body.style.overflow = 'hidden';
}

function closeLightbox() {
  const modal = document.getElementById('lightboxModal');
  modal.style.display = 'none';
  document.body.style.overflow = 'auto';
}

function navigateImage(direction) {
  if (direction === 'next') {
    currentImageIndex = (currentImageIndex + 1) % galleryData.length;
  } else {
    currentImageIndex = (currentImageIndex - 1 + galleryData.length) % galleryData.length;
  }
  openLightbox(currentImageIndex);
}

// Event listeners for lightbox
document.addEventListener('DOMContentLoaded', function() {
  const closeBtn = document.querySelector('.close-lightbox');
  const modal = document.getElementById('lightboxModal');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  
  closeBtn.addEventListener('click', closeLightbox);
  
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      closeLightbox();
    }
  });
  
  prevBtn.addEventListener('click', () => navigateImage('prev'));
  nextBtn.addEventListener('click', () => navigateImage('next'));
  
  // Keyboard navigation
  document.addEventListener('keydown', function(e) {
    if (modal.style.display === 'block') {
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowLeft') navigateImage('prev');
      if (e.key === 'ArrowRight') navigateImage('next');
    }
  });
});

// Download image function
function downloadImage(imageUrl, filename) {
  const link = document.createElement('a');
  link.href = imageUrl;
  link.download = filename.replace(/[^a-z0-9]/gi, '_').toLowerCase() + '.jpg';
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}
</script>

<?php include_once 'partials/footer.php'; ?>
</body>
</html>