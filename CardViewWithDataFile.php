<!--File für ZUgriff über ein JSON File, bevor Datenbankanbindung genutzt wurde -->
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
            error_reporting(E_ALL ^ E_WARNING);
            $headline = 'Herrzlich Willkommen';
            $cards = [];

            
           
            


            if (file_exists('word_pair.json')) {

                $text = file_get_contents('word_pair.json', true);
                $cards = json_decode($text, true); /* from JSON to array */
           }


            if (isset($_POST['question']) && isset($_POST['answer'])) {

                $newCard = [
                    'question' => $_POST['question'],
                    'answer' => $_POST['answer'],
                ];
                array_push($cards, $newCard);
                file_put_contents('word_pair.json', json_encode($cards, JSON_PRETTY_PRINT)); /* from array into JSON (text) */
                echo 'Wortpaar <b>' . $_POST['question'] . '</b> wurde hinzugefügt';
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
            // Eintrag anzeigen
            
            if ($_GET['page'] == 'card') {

                foreach ($cards as $key => $row) {
                    $question = $row['question'];
                    $answer = $row['answer'];
                    echo "<div class= 'card'>
                       <img class='book_icon' src = 'img/book2.png'>
                        <b>$question</b><br>
                        $answer
                    
                        <a class= 'submit-button' href= 'card_View.php?page=card'>Bestätigen</a>
                        <a class= 'delete-button' name='delete_btn' href='?page=delete&delete=$key'>Löschen</a>
                    </div>
                    ";
                }
            }
            
            // Eintrag löschen
            if ($_GET['page'] == 'delete') {
                echo  'Dein <b>Karte</b> wurde gelöscht';

                $key = $_GET['delete']; //Index holen
                unset($cards[$key]); // Eintrag löschen
                file_put_contents('word_pair.json', json_encode($cards,  JSON_PRETTY_PRINT));
            }
         
            // Abfrage starten

            elseif ($_GET['page'] == 'start') {

                $random_cards = $cards;
                shuffle($random_cards); 
                echo "<div class='control_Modul'>Hier ist das Control-Modul
                <a class= '' href= 'card_View.php?page=start'>Lösung</a>
                <a class= '' name='next' href= 'card_View.php?page=start&next=true&start=$JSON_Index'>Nächste</a>
                <a class= '' href= 'card_View.php?page=start'>Zurück</a>
               
                <form action = '?page=start&next=true&start=1' method = 'POST'>
                <button type='button' name='next_btn'>Next !</button>
                </form>
                <button id='btn' onclick='nextCard()'>Next Card !</button>
                </div>
                ";
            }
                print_r($cards);
                function nextCard ($arr, $index) {
                   
                        echo $arr[$index]['question'] . '<br><br>';
                        echo  $index . ' = index <br><br>';
                        echo count($arr);
                        echo "<div id='debug'></div>";
                      
                } 
                nextCard($cards, $JSON_Index);
                $JSON_Index = $JSON_Index + 1;
                //echo $cards[1]['answer'];
                

                
/*
                foreach ($cards as $row) {
                    
                    $question = $row['question'];
                    $answer = $row['answer'];
                    echo "
                    <div class='pair'>
                    <div class= 'quest_View'>
                        <b>Frage: </b> <br>    
                        $question<br>
                        
                    </div>
                    <div class= 'answer_View'>
                        <b>Antwort: </b> <br>  
                        $answer<br>
                        
                    </div>
                    </div>
                    ";
                }
                */                 
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
            echo "<script src='script.js'></script>";
            ?>
        </div>
    </div>
    <div class="footer">
        (C) 2022 Developer Basler
    </div>

</body>

</html>