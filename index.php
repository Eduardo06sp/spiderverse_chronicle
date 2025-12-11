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

$decades_sql = "SELECT * FROM eras";
$decades_result = $conn->query($decades_sql);
// Fetch 1960s Data for the MVP
$decade_sql = "SELECT * FROM eras WHERE decade = '1960s'";
$decade_result = $conn->query($decade_sql);
$decade_data = $decade_result->fetch_assoc();

// Fetch Comics for that decade
/*
if ($decade_data) {
  $comics_sql = "SELECT * FROM comic_covers WHERE era_id = " . $decade_data['era_id'];
  $comics_result = $conn->query($comics_sql);
}
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="stylesheets/index.css" rel="stylesheet">
  <link rel="icon" href="assets/images/spiderman_mask_icon.jpg" type="image/x-icon">
  <title>Spider-Verse Chronicle</title>
  <script src="scripts/index.js" defer></script>
</head>

<body>
  <div id="intro-gradient">
    <h1>The Spider-Verse Chronicle</h1>
    <p>IST 4310</p>
  </div>

  <div class="timeline">

    <?php 
    /* Loop through decades */
    while($decade = $decades_result->fetch_assoc()):

      /* Variable Declarations */
      $characters_sql = "SELECT * FROM characters WHERE era_id = " . $decade['era_id'];
      $characters_result = $conn->query($characters_sql);
      $comics_sql = "SELECT * FROM comic_covers WHERE era_id = " . $decade['era_id'];
      $comics_result = $conn->query($comics_sql);

    echo '
    <div class="decade expanded">
      <div class="decade-nav">
        <button class="arrow left-arrow"><</button>
        <select name="decades" id="decade-select">
          <option value="1960s">The 1960s</option>
          <option value="1970s">The 1970s</option>
          <option value="1980s">The 1980s</option>
          <option value="1990s">The 1990s</option>
          <option value="2000s">The 2000s</option>
          <option value="2010s">The 2010s</option>
        </select>
        <button class="arrow right-arrow">></button>
      </div>
      <div class="comic-covers">
      ';

      /* Loop through images */
      while($comic = $comics_result->fetch_assoc()):
        echo '<img class="comic" src="' . $comic['image_url'] . '" alt="' . $comic['title'] . '">';
      endwhile;

      echo '
      </div>
      <button class="expand-contract-toggle">See More</button>
      <div class="expanded-info">
        <h3 class="summary-heading">Summary</h3>
        ';

        echo '<p class="decade-summary">' . $decade['summary'] . '</p>';
        
        echo '
        <h3 class="characters-heading">Key Characters</h3>
        ';

      /* Loop through characters */
     while($character = $characters_result->fetch_assoc()):
        /* echo "{$character['name']} is one of em";*/
        echo '<p class="key-characters">' . $character['name'] . '</p>';
        echo '<p class="character-description">' . $character['description'] . '</p>';
     endwhile;


        echo '
      </div>
    </div>
    ';
    endwhile;
    ?>

  <!-- End Timeline -->
  </div>
  <?php $conn->close(); ?>

  <div id="footer">
    <p>Made for class project - IST 4310 - CSUSB</p>
    <p><a href="">Source code on GitHub</a></p>
  </div>
</body>
</html>
