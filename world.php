<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = isset($_GET['country']) ? $_GET['country']:"";
$lookup = isset($_GET['lookup']) ? $_GET['lookup']:"";


 
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if($lookup === "cities"){
  
  if($country !==""){
    $stmt = $conn->prepare("
      SELECT cities.name, cities.district, cities.population
      FROM cities
      JOIN countries ON cities.country_code = countries.code
      WHERE countries.name LIKE  :country
    ");
    $stmt->bindValue(':country', "%$country%");
    $stmt->execute();
  
  } else {
    $stmt = $conn->query("
    SELECT cities.name, cities.district, cities.population
    FROM cities
    ORDER BY name ASC
    "
    );
  }

  $cities = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>
<table border="1" cellpadding ="8">
  <thead>
    <tr>
      <th>City</th>
      <th>District</th>
      <th>Population</th>
    </tr>
</thead>

  <tbody>
    <?php foreach ($cities as $city): ?>
    <tr>
        <td><?=$city['name']; ?></td>
        <td><?=$city['district']; ?></td>
        <td><?=$city['population']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<?php exit; }







if($country !== ""){
  $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
  $stmt->bindValue(':country', "%$country%");
  $stmt->execute();
} else{
$stmt = $conn->query("SELECT * FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<table border="1" cellpadding ="8">
  <thead>
    <tr>
      <th>Country Name</th>
      <th>Continent</th>
      <th>Independence Year</th>
      <th>Head of State</th>
    </tr>
</thead>
  <tbody>
    <?php foreach ($results as $row): ?>
    <tr>
        <td><?=$row['name']; ?></td>
        <td><?=$row['continent']; ?></td>
        <td><?=$row['independence_year']; ?></td>
        <td><?=$row['head_of_state']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>


