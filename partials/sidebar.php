<aside class="side-nav">
  <div class="dropdown">
    <button class="dropbtn" onclick="toggleDropdown()">Article ▼</button>
    <div class="dropdown-content" id="myDropdown">
      <?php
        $articles = [
          "Skincare Tips" => "tips.php",
          "Makeup Tutorial" => "tutorial.php", // Tambahkan .php
          "Beauty Trends" => "trends.php"     // Tambahkan .php
        ];

        foreach ($articles as $title => $link) {
          echo "<a href='$link'>$title</a>";
        }
      ?>
    </div>
  </div>
  <a href="event.php">Event</a>
  <a href="gallery.php">Gallery</a>
  <a href="client.php">Client</a>
  <a href="login.php">Login</a>
</aside>

<!-- Tambahkan JavaScript -->
<script>
function toggleDropdown() {
    var dropdown = document.getElementById("myDropdown");
    dropdown.classList.toggle("show");
}

// Tutup dropdown jika mengklik di luar
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
</script>