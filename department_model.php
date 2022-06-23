<?php
require_once __DIR__ . "/connectDB.php";
require_once __DIR__ . "/Department.php";
require_once __DIR__ . "/Degree.php";


$degrees = [];
$departments = [];
$single_depart;

$id = $_GET["id"];

$sql =
"SELECT `degrees`.`id`, `degrees`.`name`, `degrees`.`level` 
FROM `degrees` 
WHERE `department_id`=?;
";
//preparazione
$stmt = $connectDB->prepare($sql);
$stmt->bind_param("d", $id);
//esequzione
$stmt->execute();
$result = $stmt->get_result();

// $result = $connectDB->query($sql);
if($result && $result->num_rows > 0) {
    // Ci sono risultati dalla query
    while($row = $result->fetch_assoc()) {
        $degree_single = new Degree($row["id"], $row["name"], $row["level"]);
        $degrees[] = $degree_single;
    }
    
}
elseif($result) {
    // La query ha funzionato ma con nessun risultato
    echo "no result";
}
else {
    // La quari ha dato problemi (ci sono errori nella sintassi)
    echo "Query error";
    die();
}

$sql = 
"SELECT * 
FROM `departments`  
WHERE `id` = $id;";

//preparazione
$stmt = $connectDB->prepare($sql);
//esequzione
$stmt->execute();
$result = $stmt->get_result();


if($result && $result->num_rows > 0) {
    // Ci sono risultati dalla query
    while($row = $result->fetch_assoc()) {
        $depart = new Department($row["id"],$row["name"]);
        $depart->setContactData($row["address"],$row["phone"], $row["email"],$row["website"]);
        $depart->head_of_department = $row["head_of_department"];
        $departments[] = $depart;
    }
    
}
elseif($result) {
    // La query ha funzionato ma con nessun risultato
    echo "no result";
}
else {
    // La quari ha dato problemi (ci sono errori nella sintassi)
    echo "Query error2";
    die();
}
$single_depart = $departments[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato querys</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>
        <?php
            echo $single_depart->name;
        ?>
    </h1>
    <p>
        ID dipartimento: 
        <?php
            echo $single_depart->id;
        ?>
    </p>
    <p>
        Emeil dipartimento: 
        <?php
            echo $single_depart->email;
        ?>
    </p>
    <p class="phone">
        Telefono del dipartimento: <em> <?php echo $single_depart->phone?> </em>
    </p>
    <p>
        Sito dipartimento: <em> <?php echo $single_depart->website?> </em>
    </p>
    <p>
        Docente di riferimento: <strong> <?php echo $single_depart->head_of_department?> </strong>
    </p>
    <h2>
        Corsi
    </h2>
    <ul>
        <?php
            foreach($degrees as $degree) {
        ?>
        <li>
            <?php echo $degree->name . ", " . $degree->level ?>
        </li>
        <?php
            }
        ?>
    </ul>
</body>
</html>