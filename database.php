<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktdaten</title>

    <link rel="stylesheet" href="design.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500&family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="menubar">
        <h1>Meine Karteikarten</h1>
        <div class="myname">
            <div class="avatar">PB</div> Philipp Basler
        </div>
    </div>
    <div class="flex">
        <div class="menue">
            <a href="index.php?page=home"><img src="img/home.svg"> Start</a>
            <a href="index.php?page=subject"><img src="img/book.svg"> Fächer</a>
            <a href="index.php?page=addsubject"><img src="img/add.svg"> Fächer hinzufügen</a>
            <a href="index.php?page=impressum"><img src="img/legal.svg"> Impressum</a>
        </div>
        <div class="content">
            <?php
            error_reporting(0);
            $headline = 'Herrzlich Willkommen';
            $subjects = [];
            

            $severname = 'localhost';
            $user = 'root';
            $pw = '';
            $db_name = 'dateikarten';
            $sql ;
           
                $con = new mysqli($severname, $user, $pw, $db_name);
                if ($con ->connect_error) {
                    die('ACHTUNG FEHLER !!!' . $con->connect_error);
                }
                echo '<h1>Connection successfull </h1>';
                $sql = "Select * From wortpaare";
                $ret = $con->query($sql);
                if ($ret->num_rows > 0) {
                    while ($i  = $ret->fetch_assoc()) {
                        echo "ID: " .$i['ID'] .'  Frage' . $i['Question'] . '<br>'; 
                    }
                }
                else {
                    echo 'Da ist etwas schief gelaufen' .$con->error;
                }
                
            
            $sql = "INSERT INTO wortpaare (Question, Answer) VALUES ('Wie hast du das gemacht ?', 'Schau zu und lerne')";
            if ($con->query($sql) === TRUE) {
                echo 'Das war erfolgreich';
            }
            else {
                echo 'Da ist etwas schief gelaufen' .$con->error;
            }
            $con->close();
         

        
            if ($_GET['page'] == 'delete') {
                $headline = 'Wortpaar gelöscht';
            }
            if ($_GET['page'] == 'subject') {
                $headline = 'Deine Fächer';
            } elseif ($_GET['page'] == 'addsubject') {
                $headline = 'Fächer Hinzufügen';
            } elseif ($_GET['page'] == 'impressum') {
                $headline = 'Impressum';
            } else {
                $headline = 'Herzlich Wilkommen';
            }

            echo '<h1>' . $headline . '</h1>';
            // Eintrag löschen
           
             if ($_GET['page'] == 'impressum') {
                echo 'Hier steht das Impressum';
            } else {
                echo 'Du bist auf der Startseite !';
            }

            ?>
        </div>
    </div>
    <div class="footer">
        (C) 2022 Developer Basler
    </div>

</body>

</html>