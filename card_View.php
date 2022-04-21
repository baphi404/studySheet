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
            <a href="card_View.php?page=start"><img class="play_button" src="img/play_button.svg"> Karten starten</a>
            <a href="card_View.php?page=card"><img src="img/book.svg"> Karteikarten</a>
            <a href="card_View.php?page=addcard"><img src="img/add.svg"> Karte hinzufügen</a>
            <a href="card_View.php?page=impressum"><img src="img/legal.svg"> Impressum</a>
        </div>
        <div class="content">
            <?php

use function PHPSTORM_META\elementType;

            error_reporting(E_ALL ^ E_WARNING);
            $headline = 'Herrzlich Willkommen';
            $cards = [];

            
            $severname = 'localhost';
            $user = 'root';
            $pw = '';
            $db_name = 'dateikarten';

            function saveCard($severname, $user, $pw, $db_name){

            if ($_POST['question'] != Null && $_POST['answer'] != Null ) {
         
                $con = new mysqli($severname, $user, $pw, $db_name);

                $question = $_POST['question'];
                $answer  = $_POST['answer'];

                $sql = "INSERT INTO wortpaare (Question, Answer) VALUES ('$question', '$answer')";
                $con->query($sql);

                $con->close();
            }
        }

        function showAllCards ($severname, $user, $pw, $db_name) {

            $con = new mysqli($severname, $user, $pw, $db_name);

            $sql = "SELECT * From wortpaare";
            $ret = $con->query($sql);
            if ($ret->num_rows > 0) {
                while ($i  = $ret->fetch_assoc()) {
                    echo "<div class= 'card'>
                       <img class='book_icon' src = 'img/book2.png'>
                        <b>" . $i['Question'] . "</b><br>"
                        . $i['Answer'] . "</b><br>
                        
                        <a class= 'submit-button' href= 'card_View.php?page=card'>Bestätigen</a>
                        <a class= 'delete-button' name='delete_btn' href='?page=delete&delete=". $i['ID'] ."'>Löschen</a>
                    </div>
                    ";
                }
            }
            else {
                echo 'Da ist etwas schief gelaufen' .$con->error;
            }
            $con->close();
        }
        function showCards ($severname, $user, $pw, $db_name) {

            $con = new mysqli($severname, $user, $pw, $db_name);

            $sql = "SELECT * From wortpaare";
            //$sql = "SELECT * From wortpaare ORDER BY RAND()";     
            $ret = $con->query($sql);
            $con->close();
            return $ret;
        }
        function size ($severname, $user, $pw, $db_name) {

            $con = new mysqli($severname, $user, $pw, $db_name);

            $sql = "SELECT Count(*) From wortpaare";
            //$sql = "SELECT * From wortpaare ORDER BY RAND()";     
            $ret = $con->query($sql);
            $con->close();
            return $ret;
        }

        function deleteCard($severname, $user, $pw, $db_name){
         
                $con = new mysqli($severname, $user, $pw, $db_name);

                $id = $_GET['delete']; //Index holen
                echo '<br>ID =' . $id;
                $sql = "DELETE FROM wortpaare WHERE ID = '". $id . "'"; // Eintrag löschen

                $con->query($sql);  // execute SQL-Command

                $con->close();   
        }
        function showFirstQuestion ($severname, $user, $pw, $db_name) {

            $con = new mysqli($severname, $user, $pw, $db_name);

            $sql = "SELECT * From wortpaare";
            //$sql = "SELECT * From wortpaare ORDER BY RAND()";
            $ret = $con->query($sql);
            if ($ret->num_rows > 0) {
                if ($i  = $ret->fetch_assoc()) {
                    echo "<div class= 'card'>
                    <img class='book_icon' src = 'img/book2.png'>
                    <b> Frage : </b></br>" . $i['Question'] . "<br>
                       
                    </div>
                    ";
                }
                
            }
            else {
                echo 'Da ist etwas schief gelaufen' .$con->error;
            }
            $con->close();
            return $ret;
        }
        function showFirstQuest ($ret) {

            if ($ret->num_rows > 0) {
                if ($i  = $ret->fetch_assoc()) {
                    echo "<div class= 'card'>
                    <img class='book_icon' src = 'img/book2.png'>
                    <b> Frage : </b></br>" . $i['Question'] . "<br>
                       
                    </div>
                    ";
                }
                
            }
            else {
                echo 'Da ist etwas schief gelaufen';
            }
            
        }

        function showAnswer ($ret) {

            if ($ret->num_rows > 0) {
                if ($i  = $ret->fetch_assoc()) {
                    echo "<div class= 'card'>
                    <b> Antwort : </b></br>" . $i['Answer'] . "<br>
                       
                    </div>
                    ";
                }
            }
            else {
                echo 'Da ist etwas schief gelaufen';
            }
        }    
            if ($_GET['page'] == 'card') {
                $headline = 'Deine Karteikarten';
                echo '<h1>' . $headline . '</h1>';
                echo 'Hier hast du einen Überblick über deine Karteikarten';
            } elseif ($_GET['page'] == 'addcard') {
                $headline = 'Karten Hinzufügen';
                echo '<h1>' . $headline . '</h1>';
                echo 'Hier kannst du Karten hinzufügen';
            } elseif ($_GET['page'] == 'impressum') {
                $headline = 'Impressum';
                echo '<h1>' . $headline . '</h1>';
                echo 'Hier steht das Impressum';
            }
            elseif ($_GET['page'] == 'start') {
                $headline = 'Abfrage starten';
                echo '<h1>' . $headline . '</h1>';
                echo 'Viel Spaß beim Lernen';
            }
            else {
                $headline = 'Herzlich Wilkommen';
                echo '<h1>' . $headline . '</h1>';
                echo 'Du bist auf der Startseite !';
            }
         
            // Abfrage starten

            if ($_GET['page'] == 'start') {

                $random_cards = $cards;
                shuffle($random_cards); 
                echo "<div class='control_Modul'>Hier ist das Control-Modul
                <a class= '' href= 'card_View.php?page=start&start=true'>Start</a>
                <a class= '' href= 'card_View.php?page=start&start=answer'>Lösung</a>
                <a class= '' name='next' href= 'card_View.php?page=start&next=true&start=$JSON_Index'>Nächste</a>
                <a class= '' href= 'card_View.php?page=start'>Zurück</a>
    
                <form action = '?page=start' method = 'POST'>
                <button type='submit' name='start_btn'>Start !</button>
                <button type='submit' name='next_btn'>Next !</button>
                <button type='submit' name='answer_btn'>Lösung</button>
                </form>

            
                </div>
                ";
            }
                
            ?>
            <?php
            if ($_GET['page'] == 'addcard') {
                echo "

                <form action = '?page=card' method = 'POST'>
                <div>
                <input placeholder = 'Frage eingeben' name = 'question'> 
                </div>
                <div>
                <input placeholder = 'Antwort eingeben' name = 'answer'>
                </div>

                <button type = 'submit' name='submit'> Absenden </button>
                </form>
                ";
            }
            //echo "<script src='script.js'></script>";
            // Funktionsaufrufe
            
            if (isset($_POST['start_btn'])) {
                $CardOutput = showCards($severname, $user, $pw, $db_name);
                echo ' Return = ' .gettype($CardOutput);
                //print_r($CardOutput);
           }
            // Post new entry
            if (isset($_POST['submit'])) {
                saveCard($severname, $user, $pw, $db_name);
            }
            // start Request
            /*
            if ($_GET['page'] == 'start' && $_GET['start'] == 'true') {
                $CardOutput =  showFirstQuestion($severname, $user, $pw, $db_name);
            }
            */
            if (isset($_POST['next_btn'])) {
            	//showFirstQuest($CardOutput);
                $size = size($severname, $user, $pw, $db_name);
                $size = mysqli_fetch_array($size);
                $counter = 0;
               // echo 'Länge = ' . $size[0];
                if ($counter < $size[0]) {
                
                //$CardOutput->fetch_array();
                echo ' Return = ' .gettype($CardOutput);
                $row = $CardOutput->fetch_assoc();
                echo '<br> Hier steht die Cards: <br> Question = ' . $row['Question'] .'<br>';
               
                echo '<br> Answer =  ' . $row['Answer'].'<br>';  
                $counter++; 
                }
            }
            // show Answer
            /*
            if ($_GET['page'] == 'start' && $_GET['start'] == 'answer') {
                showAnswer($severname, $user, $pw, $db_name);
            }
            */
            if (isset($_POST['answer_btn'])) {
                //showAnswer($severname, $user, $pw, $db_name);
                showFirstQuest($CardOutput);
                showAnswer($CardOutput);
            }
            // Einträge anzeigen
            if (($_GET['page'] == 'card')) {
               showAllCards($severname, $user, $pw, $db_name);
            }
             // Eintrag löschen
             
             if ($_GET['page'] == 'delete') {
                echo  'Dein <b>Karte</b> wurde gelöscht';
                deleteCard($severname, $user, $pw, $db_name);
            }
            
            ?>
        </div>
    </div>
    <div class="footer">
        (C) 2022 Developer Basler
    </div>

</body>

</html>