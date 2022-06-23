<?php
require_once __DIR__ . "/connectDB.php"; 
require_once __DIR__ . "/Department.php";
require_once __DIR__ . "/Degree.php";

$sql = "SELECT * FROM `departments`;";
$result = $connectDB->query($sql);

$departments = [];

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
    echo "Query error";
    die();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dipartimenti Boolean University</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>
        Lista dei dipartimenti
    </h1>

    <?php
    foreach($departments as $department) {
    ?>
    <section>
        <h2>
            <?php echo $department->name;?>
        </h2>
        <a href="department_model.php?id=<?php echo $department->id; ?>">Informazioni dipartimento</a>
        <br>
        <p class="phone">
            Numero di telefono: <em> <?php echo $department->phone;?> </em>
        </p>
    </section>
    <?php
    }
    ?>


</body>
</html>