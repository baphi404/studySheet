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

            $con = new mysqli($severname, $user, $pw);
            if ($con ->connect_error) {
                die('ACHTUNG FEHLER !!!' . $con->connect_error);
            }
            echo 'Connection successfull';

            if (file_exists('subjects.json')) {

                $text = file_get_contents('subjects.json', true);
                $subjects = json_decode($text, true); /* from text to array */
            }

            if (isset($_POST['name']) && isset($_POST['sws'])) {

                $newSubject = [
                    'name' => $_POST['name'],
                    'sws' => $_POST['sws'],
                ];
                array_push($subjects, $newSubject);
                file_put_contents('subjects.json', json_encode($subjects, JSON_PRETTY_PRINT)); /* from array into text */
                echo 'Fach <b>' . $_POST['name'] . '</b> wurde hinzugefügt';
            }
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
            if ($_GET['page'] == 'delete') {
                echo  'Dein <b>Kontakt</b> wurde gelöscht';

                $key = $_GET['delete']; //Index holen
                unset($subjects[$key]); // Eintrag löschen
                file_put_contents('subjects.json',json_encode($subjects,  JSON_PRETTY_PRINT));
            }
            // Eintrag anzeigen
            elseif ($_GET['page'] == 'subject') {
                echo "Hier hast du einen Überblick über deine Fächer ";

                foreach ($subjects as $key => $row) {
                    $name = $row['name'];
                    $sws = $row['sws'];
                    echo "<div class= 'card'>
                       <img class='book_icon' src = 'img/book2.png'>
                        <b>$name</b><br>
                        $sws
                    
                        <a class= 'submit-button' href= 'card_View.php?page=card'>Bestätigen</a>
                        <a class= 'delete-button' href='?page=delete&delete=$key'>Löschen</a>";
                        
               /*
               <a class= 'delete-button' href='?page=delete&delete=$key'><img class='dustbin' src='img/dustbin_bw.svg'></a>";
                   */ 
                  echo"
                    </div>
                    ";
                }
            } elseif ($_GET['page'] == 'impressum') {
                echo 'Hier steht das Impressum';
            } elseif ($_GET['page'] == 'addsubject') {
                echo "
                <div>
                Hier kannst du weitere Fächer hinzufügen
                </div>

                <form action = '?page=subject' method = 'POST'>
                <div>
                <input placeholder = 'Name eingeben' name = 'name'> 
                </div>
                <div>
                <input placeholder = 'SWS eingeben' name = 'sws'>
                </div>

                <button type = 'submit'> Absenden </button>
                </form>
                ";
            } else {
                echo 'Du bist auf der Startseite !';
            }

            echo "<script src='script.js'></script>";
            ?>
        </div>
    </div>
    <div class="footer">
        (C) 2022 Developer Basler
    </div>

</body>

</html>