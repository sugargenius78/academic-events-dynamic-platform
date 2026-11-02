<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ACADEMIC EVENTS</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="cards">
            <?php
                $conn = new mysqli("localhost", "root", "Reem1234@", "website");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT * FROM events ORDER BY event_date DESC");

                while ($row = $result->fetch_assoc()):
                ?>
                    <div class="card">
                        <h2><?= htmlspecialchars($row['title']) ?></h2>
                        <p><strong>Date:</strong> <?= htmlspecialchars($row['event_date']) ?></p>
                        <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                    </div>
                <?php endwhile;

                $conn->close();
            ?>
            <a href="science.html"><div class="card" id="card1">science Innovation Fair<br>April 25, 2025</div></a>
            <a href="cultur.html"><div class="card" id="card2">Cultural Day Festival<br>May 3, 2025</div></a>
            <a href="guest.html"><div class="card" id="card3">Guest Lecture: AI & the Future<br>May 10, 2025</div></a>
            <a href="academic.html"><div class="card" id="card4">🎓 Academic & Educational Events</div></a>
            <a href="cultural.html"><div class="card" id="card5">🌍 Cultural & Social Events</div></a>
            <a href="career.html"><div class="card" id="card6" >💼 Career & Professional Development</div></a>
            <a href="sport.html"><div class="card" id="card7">⚽ Sports & Wellness Events</div></a>
            <a href="clubs.html"><div class="card" id="card8">🤝 Clubs & Student Life</div></a>
        </div>  
    </body>
</html>