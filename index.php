<?php
// --- DATABASE CONNECTION (Added at the very top) ---
$env = file_get_contents(".env");
$lines = explode("\n",$env);
foreach($lines as $line){
  preg_match("/([^#]+)\=(.*)/",$line,$matches);
  if(isset($matches[2])){ putenv(trim($line)); }
} 

$servername = getenv('SERVER_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

// Create connection
$conn = new mysqli('127.0.0.1', $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch 1960s Data for the MVP
$decade_sql = "SELECT * FROM decades WHERE year = 1960";
$decade_result = $conn->query($decade_sql);
$decade_data = $decade_result->fetch_assoc();

// Fetch Comics for that decade
if ($decade_data) {
  $comics_sql = "SELECT * FROM comics WHERE decade_id = " . $decade_data['id'];
  $comics_result = $conn->query($comics_sql);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="stylesheets/index.css" rel="stylesheet">
  <title>Spider-Verse Chronicle</title>
</head>

<body>
  <h1>The Spider-Verse Chronicle</h1>
  <h2>Spider-Man History Museum</h2>

  <div id="timeline">
    <button>1960s</button>
    <button>1970s</button>
    <button>1980s</button>
  </div>

  <div id="content-display">
    <?php if ($decade_data): ?>
    <h3>The <?php echo $decade_data['year']; ?>s</h3>
    <p><?php echo $decade_data['decade_summary']; ?></p>

    <div class="character-box">
      <strong>Key Characters:</strong>
      <p><?php echo $decade_data['character_summary']; ?></p>
    </div>

    <div class="comic-gallery">
      <?php while($comic = $comics_result->fetch_assoc()): ?>
      <div class="comic-item">
        <img src="<?php echo $comic['image_filepath']; ?>" alt="<?php echo $comic['title']; ?>">
        <p><strong><?php echo $comic['title']; ?></strong></p>
      </div>
      <?php endwhile; ?>
    </div>

    <?php else: ?>
      <p>Select a decade to view the history.</p>
    <?php endif; ?>
  </div>
</body>
</html>
