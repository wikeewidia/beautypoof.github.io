<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Our Clients | Beautypoof</title>
  <link rel="stylesheet" href="assets/client.css" />
</head>
<body>
  <?php include_once 'partials/header.php'; ?>
  <?php include_once 'partials/sidebar.php'; ?>

  <main class="main-content">
    <section class="client-section">
      <h2>Our Clients</h2>
      <p class="client-subtitle">Trusted by beauty enthusiasts, influencers, and professionals</p>

      <div class="client-grid" id="clientGrid">
        <!-- Clients will be injected here -->
      </div>
    </section>
  </main>

  <!-- Lightbox Modal (optional) -->
  <div id="lightboxModal" class="lightbox-modal" style="display: none;">
    <div class="lightbox-content">
      <span class="close-lightbox">&times;</span>
      <img id="lightboxImage" src="" alt="">
      <div class="lightbox-info">
        <h3 id="lightboxTitle"></h3>
        <p id="lightboxDescription"></p>
      </div>
    </div>
  </div>

  <!-- Inline JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const clientData = [
        {
          name: "Alina Grace",
          role: "Beauty Influencer",
          image: "assets/images/client1.jpg",
          quote: "Beautypoof has elevated my brand presence. Their attention to detail is unmatched!"
        },
        {
          name: "Yuki Asano",
          role: "Professional Makeup Artist",
          image: "assets/images/client2.jpg",
          quote: "I love how their services make my clients glow naturally. Always satisfied!"
        },
        {
          name: "Maya Dinar",
          role: "Wedding Client",
          image: "assets/images/client3.jpg",
          quote: "They made my big day extra special with flawless makeup and friendly staff!"
        },
        {
          name: "Kevin Widjaya",
          role: "Photographer",
          image: "assets/images/client4.jpg",
          quote: "Working with Beautypoof is a dream! Every model looks stunning and shoot-ready."
        }
      ];

      const clientGrid = document.getElementById('clientGrid');

      clientData.forEach(client => {
        const card = document.createElement('div');
        card.className = 'client-card';

        card.innerHTML = `
          <div class="client-image">
            <img src="${client.image}" alt="${client.name}" onerror="this.src='assets/images/client-placeholder.jpg'">
          </div>
          <div class="client-name">${client.name}</div>
          <div class="client-role">${client.role}</div>
          <div class="client-quote">"${client.quote}"</div>
        `;

        clientGrid.appendChild(card);
      });
    });
  </script>
   <?php include_once 'partials/footer.php'; ?>
</body>
</html>
