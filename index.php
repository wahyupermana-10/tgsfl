<?php
session_start();

if(!isset($_SESSION["jawaban"])) {
    $_SESSION["jawaban"] = array();

}

$page= 1;
if(isset($_GET["page"])) {
    $page = $_GET["page"];
}

$lastpage = get("select halaman_ke from soal order by halaman_ke desc limit 1")[0][0];

if (isset($_POST["next"])) {
    if($page == (int) $lastpage) {
        unset($_POST["next"]);
    
        foreach ($_POST as $key=>$item) {
            $_SESSION["jawaban"][$key] = $item;
        }
        header("Location: result.php");
    } else {

        unset($_POST["next"]);
    
        foreach ($_POST as $key=>$item) {
            $_SESSION["jawaban"][$key] = $item;
        }
        header("Location: index.php?page=".$page+1);
    }

}

if (isset($_POST["previous"])) {
    unset($_POST["previous"]);
    foreach ($_POST as $item) {
        $_SESSION["jawaban"][$key] = $item;
    }
    header("Location: index.php?page=".$page-1);
}

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
<html>
<head>
	<meta charset="utf-8">
	<title>Quiz</title>
	<style type="text/css">
    *{
        box-sizing: border-box;
    }

    body{
        line-height: 1.6;
        min-height: 100hv;
        display: grid;
        place-items: center;
        background-image: url("https://image.freepik.com/free-photo/overhead-view-laptop-with-stationeries-study-text-white-background_23-2147875675.jpg");
    }

    .card{
        width: 600px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        background-color: rgba(0, 0, 0, 0.65);
        color: white;
        padding: 2em;
    }

    .buttonNext {
        display: inline-block;
        padding: 5px 10px;
        font-size: 15px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: #4CAF50;
        border: none;
        border-radius: 15px;
        box-shadow: 0 3px #999;
    }

    .buttonNext:hover {
        background-color: #3e8e41;
    }

    .buttonNext:active {
        background-color: #3e8e41;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }

    .buttonPrev {
        display: inline-block;
        padding: 5px 10px;
        font-size: 15px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: #FF0000;
        border: none;
        border-radius: 15px;
        box-shadow: 0 3px #999;
        float: right;
    }

    .buttonPrev:hover {
        background-color: #B22222;
    }

    .buttonPrev:active {
        background-color: #3e8e41;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }

    h2{
        color: white;
        text-align: center;
    }
	</style>
</head>
<body>
    <form action="" method="POST">
	<div class="card">
        <h2>Soal</h2>
    <?php foreach (get("select * from soal where halaman_ke = ".$page) as $soal) :?>
        <p><?= $soal[2]; ?></p>
            <?php foreach(get("select * from jawaban where idsoal='$soal[0]' order by rand()") as $jawaban) :?>
                <input type="radio" id="<?=$jawaban[2]?>" name="<?= $jawaban[1] ?>" value="<?= $jawaban[2] ?>" <?= isset($_SESSION["jawaban"][$jawaban[1]]) && $_SESSION["jawaban"][$jawaban[1]] == $jawaban[2] ? "checked" : "" ?> require>
                <label for="<?= $jawaban[2] ?>"><?= $jawaban[2] ?></label>
                <br>
            <?php endforeach; ?>
            <?php endforeach; ?>
            <?php if($page == 1):?>
                <br><input class="buttonNext" type="submit" name="next" value="next">
                <?php else : ?>
                    <br><input class="buttonNext" type="submit" name="next" value="next">
                    <input class="buttonPrev" type="submit" name="previous" value="previous">
                
            <?php endif;?>
	</div>
    </form>
</body>
</html>