<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us | Beautypoof</title>
  <link rel="stylesheet" href="assets/contact.css" />
</head>
<body>

<?php include_once 'partials/header.php'; ?>
<?php include_once 'partials/sidebar.php'; ?>

<main class="main-content">
  <section class="contact-section">
    <h2>Contact Us</h2>

    <p>If you have questions, feedback, or just want to say hello, feel free to reach out. We’d love to hear from you!</p>

    <div class="contact-info">
      <div class="contact-box">
        <h3>Email</h3>
        <p>support@beautypoof.id</p>
      </div>
      <div class="contact-box">
        <h3>Phone</h3>
        <p>+62 812-3456-7890</p>
      </div>
      <div class="contact-box">
        <h3>Address</h3>
        <p>Jl. Anggrek No. 21, Jakarta, Indonesia</p>
      </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $message = htmlspecialchars($_POST['message']);

      echo "<div class='success-message'>
              <p><strong>Thank you, $name!</strong> Your message has been received.</p>
              <p>We will respond to <strong>$email</strong> as soon as possible.</p>
            </div>";
    }
    ?>

    <form class="contact-form" action="contact.php" method="POST">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Message</label>
      <textarea id="message" name="message" rows="5" required></textarea>

      <button type="submit">Send Message</button>
    </form>
  </section>
</main>

<?php include 'partials/footer.php'; ?>

</body>
</html>
