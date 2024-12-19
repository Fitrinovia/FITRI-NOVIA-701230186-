<?php
// Proses form jika dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adult = htmlspecialchars($_POST['adult']);
    $checkin = htmlspecialchars($_POST['checkin']);
    $checkout = htmlspecialchars($_POST['checkout']);
    $message = "Booking berhasil untuk $adult orang. Check-in: $checkin, Check-out: $checkout.";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Hotel</title>
    <style>
        /* CSS Styling */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        header { background-color: #ffb84d; padding: 10px 20px; color: white; display: flex; justify-content: space-between; }
        header a { text-decoration: none; color: white; margin-right: 15px; font-weight: bold; }
        header .login { background-color: #ff6600; padding: 5px 10px; border-radius: 5px; }

        .hero { background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRssj3Dj3envK5KN8AtAcf0YeFBeyyHCDIJxw&s') center/cover; color: white; text-align: center; padding: 50px 20px; }
        .hero h1 { font-size: 2.5rem; margin-bottom: 10px; }
        .hero form input, .hero form button {
            padding: 10px; margin: 5px; border: none; border-radius: 5px;
        }
        
        .hero button { background-color: #ff6600; color: white; font-weight: bold; cursor: pointer; }

        .featured-hotels { padding: 20px; }
        .featured-hotels h2 { text-align: center; color: #333; }
        .hotel-card { display: flex; margin: 20px auto; border: 1px solid #ddd; border-radius: 10px; overflow: hidden; width: 80%; }
        .hotel-card img { width: 200px; height: 150px; object-fit: cover; }
        .hotel-details { padding: 10px; flex: 1; }
        .hotel-details h3 { margin: 0; color: #333; }
        .hotel-details p { font-size: 0.9rem; color: #666; }
        .book-now-btn { background-color: #ff6600; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; }

        .message { text-align: center; margin-top: 20px; color: green; font-weight: bold; }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <h2>REST<span style="color: #ff6600;">ER</span></h2>
        </div>
        <nav>
            <a href="login.php" class="login">Log in</a>
        </nav>
    </header>
            
    <!-- Hero Section -->
    <section class="hero">
        <h1>Reservasi Hotel</h1>
        <p>Rencanakan liburan Anda dengan hotel terbaik dan nikmati diskon spesial akhir tahun!</p>

        <form method="POST" action="">
            <input type="text" name="adult" placeholder="Jumlah Tamu (contoh: 1 Adult)" required>
            <input type="date" name="checkin" required>
            <input type="date" name="checkout" required>
            <button type="submit">Book Now</button>
        </form>
    </section>

    <!-- Pesan Jika Ada -->
    <?php if (isset($message)): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <!-- Featured Hotels -->
    <section class="featured-hotels">
        <h2>Pilihan Hotel</h2>
        <div class="hotel-card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQI0qJxlG2hdvNJtLm2Z_8Yc5w_5BCkZejDyw&s" alt="Shangri-La Hotel">
            <div class="hotel-details">
                <h3>Luminor Hotel</h3>
                <p>Terletak di pusat kota Jambi dengan fasilitas lengkap termasuk Spa, restoran, dan kolam renang.</p>
                <button class="book-now-btn">Book Now</button>
            </div>
        </div>
        <div class="hotel-card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR6sfSg3oUdW2QVA7f6YZCUaz1m4IJD4xOMdg&s" alt="Hotel Mulia">
            <div class="hotel-details">
                <h3>Swiss-BelHotel</h3>
                <p>Pengalaman menginap mewah dengan pemandangan yang mempesona dan pelayanan terbaik.</p>
                <button class="book-now-btn">Book Now</button>
            </div>
        </div>
    </section>
</body>
</html>
