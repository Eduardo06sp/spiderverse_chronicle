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
$decade_sql = "SELECT * FROM eras WHERE decade = '1960s'";
$decade_result = $conn->query($decade_sql);
$decade_data = $decade_result->fetch_assoc();

// Fetch Comics for that decade
if ($decade_data) {
  $comics_sql = "SELECT * FROM comic_covers WHERE era_id = " . $decade_data['era_id'];
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
  <link rel="icon" href="assets/images/spiderman_mask_icon.jpg" type="image/x-icon">
  <title>Spider-Verse Chronicle</title>
  <script src="scripts/index.js" defer></script>
</head>

<body>
  <div id="intro-gradient">
    <h1>The Spider-Verse Chronicle</h1>
    <p>IST 4310</p>
  </div>

  <div id="timeline">
    <div class="decade expanded">
      <div class="decade-nav">
        <button class="arrow left-arrow"><</button>
        <select name="decades" id="decade-select">
          <option value="1960s" selected>The 1960s</option>
          <option value="1970s">The 1970s</option>
          <option value="1980s">The 1980s</option>
          <option value="1990s">The 1990s</option>
          <option value="2000s">The 2000s</option>
          <option value="2010s">The 2010s</option>
        </select>
        <button class="arrow right-arrow">></button>
      </div>
      <div class="comic-covers">
        <img class="comic" src="assets/images/03_cover.jpg">
        <img class="comic" src="assets/images/07_cover.jpg">
        <img class="comic" src="assets/images/08_cover.jpg">
      </div>
      <button class="expand-contract-toggle">See More</button>
      <div class="expanded-info">
        <h3 class="summary-heading">Summary</h3>
        <p class="decade-summary">After Norman Osborn regains his memory and becomes the Green Goblin again, he kidnaps Gwen Stacy to lure Spider-Man. He throws Gwen from the top of the George Washington (or Brooklyn) Bridge. Spider-Man shoots a web-line to save her, but the sudden stop results in a "snap" at her neck, killing her instantly. A devastated and enraged Spider-Man seeks vengeance.</p>
        <h3 class="characters-heading">Key Characters</h3>
        <p class="key-characters">Event: The Night Gwen Stacy Died. Also includes the first appearance of the Green Goblin (Norman Osborn) since his amnesia.</p>
      </div>
    </div>

  <!-- DELETE BELOW DUPLICATES -->

    <div class="decade expanded">
      <div class="decade-info">
        <h2 class="year">The 1960s</h2>
        <p class="artist-list">Stan Lee ~ Steve Ditko ~ John Romita</p>
      </div>
      <div class="comic-covers">
        <!-- DYNAMIC, CAN BE 2 OR EVEN 5 -->
        <!-- MISSING DESIGN FOR SINGLE-COMIC DECADE -->
        <!-- MISSING DESIGN FOR CONTRACTED STATE -->
        <img class="comic" src="assets/images/03_cover.jpg">
        <img class="comic" src="assets/images/07_cover.jpg">
        <img class="comic" src="assets/images/08_cover.jpg">
      </div>
      <div class="expanded-info">
        <h3 class="summary-heading">Summary</h3>
        <p class="decade-summary">After Norman Osborn regains his memory and becomes the Green Goblin again, he kidnaps Gwen Stacy to lure Spider-Man. He throws Gwen from the top of the George Washington (or Brooklyn) Bridge. Spider-Man shoots a web-line to save her, but the sudden stop results in a "snap" at her neck, killing her instantly. A devastated and enraged Spider-Man seeks vengeance.</p>
        <h3 class="characters-heading">Key Characters</h3>
        <p class="key-characters">Event: The Night Gwen Stacy Died. Also includes the first appearance of the Green Goblin (Norman Osborn) since his amnesia.</p>
      </div>
    </div>

    <div class="decade expanded">
      <div class="decade-info">
        <h2 class="year">The 1960s</h2>
        <p class="artist-list">Stan Lee ~ Steve Ditko ~ John Romita</p>
      </div>
      <div class="comic-covers">
        <!-- DYNAMIC, CAN BE 2 OR EVEN 5 -->
        <!-- MISSING DESIGN FOR SINGLE-COMIC DECADE -->
        <!-- MISSING DESIGN FOR CONTRACTED STATE -->
        <img class="comic" src="assets/images/03_cover.jpg">
        <img class="comic" src="assets/images/07_cover.jpg">
        <img class="comic" src="assets/images/08_cover.jpg">
      </div>
      <div class="expanded-info">
        <h3 class="summary-heading">Summary</h3>
        <p class="decade-summary">After Norman Osborn regains his memory and becomes the Green Goblin again, he kidnaps Gwen Stacy to lure Spider-Man. He throws Gwen from the top of the George Washington (or Brooklyn) Bridge. Spider-Man shoots a web-line to save her, but the sudden stop results in a "snap" at her neck, killing her instantly. A devastated and enraged Spider-Man seeks vengeance.</p>
        <h3 class="characters-heading">Key Characters</h3>
        <p class="key-characters">Event: The Night Gwen Stacy Died. Also includes the first appearance of the Green Goblin (Norman Osborn) since his amnesia.</p>
      </div>
    </div>




<!--- END OF TIMELINE DIV -->
  </div>

  <h1>BELOW IS DUPLICATE</h1>

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

  <div id="footer">
    <p>Made for class project - IST 4310 - CSUSB</p>
    <p><a href="">Source code on GitHub</a></p>
  </div>
</body>
</html>
