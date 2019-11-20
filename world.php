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
  // echo $country;
  // print_R($_GET);
  if ($country===0) {
    ?>
    <h3>NOT FOUND</h3>
    <?php
  }
  if($country!=="") {
      
      $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
    <table>
      <thead>
	    	<tr class="heading">
	    		<th>Name</th>
	    		<th>Continent</th>
	    		<th>Independence Year</th>
	    		<th>Head of State</th>
	    	</tr>
    	</thead>

	    <tbody>
	      <?php foreach ($results as $row): ?><tr>
        <td><?= $row['name'];?></td>
        <td><?= $row['continent'];?></td>
        <td><?= $row['independence_year'];?></td>
        <td><?= $row['head_of_state'];?></td></tr>
      <?php endforeach; ?>
	    </tbody>
    </table>
    
    
    <?php
  } else {
      $stmt = $conn->query("SELECT * FROM countries");
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
    <table>
      <thead>
	    	<tr class="heading">
	    		<th>Name</th>
	    		<th>Continent</th>
	    		<th>Independence Year</th>
	    		<th>Head of State</th>
	    	</tr>
    	</thead>

	    <tbody>
	      <?php foreach ($results as $row): ?><tr>
        <td><?= $row['name'];?></td>
        <td><?= $row['continent'];?></td>
        <td><?= $row['independence_year'];?></td>
        <td><?= $row['head_of_state'];?></td></tr>
      <?php endforeach; ?>
	    </tbody>
    </table>
    
    
    <?php
  }
}
?>

