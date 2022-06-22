<?php 
define("DB_SERVERNAME","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD", "");
define("DB_NAME","university");
define("DB_PORT", 3306);

$connectDB = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

if($connectDB && $connectDB->connect_error) {
    // ERRORE nella connessione al DB 
    echo "Error in DataBase connection" . $connectDB->connect_error;
    die();
}

$sql = "SELECT * FROM `departments`;";
$result = $connectDB->query($sql);

$departments = [];

if($result && $result->num_rows > 0) {
    // Ci sono risultati dalla query
    while($row = $result->fetch_assoc()) {
        $departments[] = $row;
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
            <?php echo $department["name"]?>
        </h2>
        <a href="">Informazioni dipartimento</a>
        <br>
        <p class="phone">
            Numero di telefono: <em> <?php echo $department["phone"]?> </em>
        </p>
    </section>
    <?php
    }
    ?>


</body>
</html>