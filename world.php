<?php
$host = getenv('IP');
$username = 'gabby_info';
$password = '1W1llPass!';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);


function sanitizeData($data) {
  $data = htmlspecialchars($data);
  $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
  if (preg_match("/\s||[A-Za-z\s]+/", $data)) {
    return $data;
  } else {
    return 0;
  }
}

$found = FALSE;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $country = sanitizeData($_GET["query"]);
  echo $country;
  print_R($_GET);
  if ($country===0) {
    ?>
    <h3>NOT FOUND</h3>
    <?php
  }
  if($country!=="") {
      
      $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
    <ul>
    <?php foreach ($results as $row): ?>
      <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
    <?php endforeach; ?>
    </ul><?php
    
  } else {
      $stmt = $conn->query("SELECT * FROM countries");
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
    <ul>
    <?php foreach ($results as $row): ?>
      <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
    <?php endforeach; ?>
    </ul><?php
  }
}
?>

