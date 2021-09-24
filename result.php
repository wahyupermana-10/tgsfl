<?php
session_start();

if(isset($_POST["slese"])) {
    session_destroy();
    echo "<script>location.href='index.php';</script>";
}
$score = 0;
function get($string) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_tgs1";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $s = mysqli_query($conn, $string);
    $p = mysqli_fetch_all($s);
    return $p;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach (get("select * from soal") as $key => $value) : ?>
        <p><?= $value[2]?></p>
        <?php 
            $t = $_SESSION["jawaban"][$value[0]]; 
            $flag = get("select * from jawaban where idsoal=".$value[0]." and isi_jawaban='$t'")[0];
            if($flag[3] == "1") {
                $score += 10;
            }
        ?>
        <p>Jawaban user : <?= $_SESSION["jawaban"][$value[0]] ?> <?= $flag[3] == "1" ? "<strong>Benar</strong>" : "<strong>Salah</strong><br><p>jawaban benar: <strong>".$flag[2]."</strong></p>" ?></p>
    <?php endforeach; ?>
    <h1>Score : <?= $score?></h1>
    <form method="POST" action="">
        <input type="submit" name="slese" value="Play Again">
    </form>
</body>
</html>