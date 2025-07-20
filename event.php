<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Event | Beautypoof</title>
  <link rel="stylesheet" href="assets/event.css" />
</head>
<body>
  <?php include_once 'partials/header.php'; ?>
<?php include_once 'partials/sidebar.php'; ?>
</body>

<main class="main-content">
  <section class="event-section">
    <h2>Our Events</h2>
    
    <div class="event-grid">
      <?php
      // Data event sebagai array dengan validasi
      $events = [
        [
          "title" => "BeautyPoof Grand Launch",
          "image" => "assets/images/event1.jpg",
          "alt" => "BeautyPoof Grand Launch Event - New product unveiling",
          "date" => "2025-08-15",
          "location" => "Jakarta Convention Center",
          "description" => "Join us for the grand launch of our latest beauty collection with exclusive offers and makeup tutorials."
        ],
        [
          "title" => "Beauty Workshop & Masterclass",
          "image" => "assets/images/event2.jpg",
          "alt" => "BeautyPoof Workshop - Professional makeup techniques",
          "date" => "2025-08-22",
          "location" => "Beautypoof Studio",
          "description" => "Learn professional makeup techniques from our expert beauty artists in this hands-on workshop."
        ],
        [
          "title" => "Makeup Competition 2025",
          "image" => "assets/images/event3.jpg",
          "alt" => "BeautyPoof Makeup Competition - Creative makeup contest",
          "date" => "2025-09-05",
          "location" => "Surabaya Mall",
          "description" => "Show off your creativity in our annual makeup competition with amazing prizes to be won."
        ],
        [
          "title" => "Beauty Expo & Pop-up Store",
          "image" => "assets/images/event4.jpg",
          "alt" => "BeautyPoof Beauty Expo - Product showcase and demonstration",
          "date" => "2025-09-18",
          "location" => "Bandung Trade Center",
          "description" => "Experience our complete product range at our pop-up store with special discounts and free consultations."
        ],
        [
          "title" => "Influencer Meetup",
          "image" => "assets/images/event5.jpg",
          "alt" => "BeautyPoof Influencer Event - Beauty collaboration meetup",
          "date" => "2025-10-02",
          "location" => "Bali Resort & Spa",
          "description" => "Connect with top beauty influencers and discover the latest trends in an exclusive tropical setting."
        ]
      ];

      // Fungsi untuk mengecek apakah file gambar ada
      function imageExists($imagePath) {
        return file_exists($imagePath) && is_readable($imagePath);
      }

      // Fungsi untuk format tanggal
      function formatEventDate($dateString) {
        $date = DateTime::createFromFormat('Y-m-d', $dateString);
        if ($date) {
          return $date->format('F j, Y');
        }
        return $dateString;
      }

      // Menampilkan event dengan error handling
      if (!empty($events)) {
        foreach ($events as $index => $event) {
          // Sanitize dan validasi data
          $title = isset($event["title"]) ? htmlspecialchars(trim($event["title"]), ENT_QUOTES, 'UTF-8') : "Event " . ($index + 1);
          $image = isset($event["image"]) ? trim($event["image"]) : "";
          $alt = isset($event["alt"]) ? htmlspecialchars(trim($event["alt"]), ENT_QUOTES, 'UTF-8') : $title;
          $date = isset($event["date"]) ? htmlspecialchars(trim($event["date"]), ENT_QUOTES, 'UTF-8') : "";
          $location = isset($event["location"]) ? htmlspecialchars(trim($event["location"]), ENT_QUOTES, 'UTF-8') : "";
          $description = isset($event["description"]) ? htmlspecialchars(trim($event["description"]), ENT_QUOTES, 'UTF-8') : "";
          
          // Default image jika gambar tidak ada
          $defaultImage = "assets/images/event-placeholder.jpg";
          $finalImage = (!empty($image) && imageExists($image)) ? $image : $defaultImage;
          
          echo '<div class="event-card">';
          
          // Tampilkan gambar dengan lazy loading
          echo '<div class="event-image">';
          echo '<img src="' . htmlspecialchars($finalImage, ENT_QUOTES, 'UTF-8') . '" ';
          echo 'alt="' . $alt . '" ';
          echo 'loading="lazy" ';
          echo 'onerror="this.src=\'' . $defaultImage . '\'; this.onerror=null;">';
          echo '</div>';
          
          // Konten event
          echo '<div class="event-content">';
          
          // Judul event
          echo '<h3>' . $title . '</h3>';
          
          // Tanggal event
          if (!empty($date)) {
            echo '<div class="event-date">';
            echo '<i class="date-icon">📅</i>';
            echo '<span>' . formatEventDate($date) . '</span>';
            echo '</div>';
          }
          
          // Lokasi event
          if (!empty($location)) {
            echo '<div class="event-location">';
            echo '<i class="location-icon">📍</i>';
            echo '<span>' . $location . '</span>';
            echo '</div>';
          }
          
          // Deskripsi event
          if (!empty($description)) {
            echo '<p class="event-description">' . $description . '</p>';
          }
          
          // Tombol detail
          echo '<div class="event-actions">';
          echo '<button class="btn-detail" onclick="showEventDetail(' . $index . ')">View Details</button>';
          echo '<button class="btn-register">Register Now</button>';
          echo '</div>';
          
          echo '</div>'; // end event-content
          echo '</div>'; // end event-card
        }
      } else {
        // Jika tidak ada event
        echo '<div class="no-events">';
        echo '<p>No events scheduled at the moment. Please check back later for exciting upcoming events!</p>';
        echo '</div>';
      }
      ?>
    </div>
  </section>
</main>

<script>
// JavaScript untuk interaksi event
function showEventDetail(index) {
  alert('Event detail will be shown here. Event index: ' + index);
  // Di sini bisa ditambahkan modal atau redirect ke halaman detail
}

// Smooth scroll effect
document.addEventListener('DOMContentLoaded', function() {
  const eventCards = document.querySelectorAll('.event-card');
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  });
  
  eventCards.forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'all 0.6s ease';
    observer.observe(card);
  });
});
</script>

<?php include_once 'partials/footer.php'; ?>