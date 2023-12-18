<!doctype html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <title>LF</title>
    <link rel="icon" type="image/x-icon" href="../imgs/icon.ico">
    <link rel="stylesheet" href="../main.css">
</head>

<body>
<header>
    <nav class="sites">
        <a class="hover-underline-animation-blue name" href="../index.html">Laurence Fishburne</a>
        <a class="hover-underline-animation-red" href="Lebenslauf.html" target="Tab2">Lebenslauf</a>
        <a class="hover-underline-animation-red" href="Kenntnisse.html" target="Tab2">Kenntnisse</a>
        <a class="hover-underline-animation-red" href="Hobbies.html" target="Tab2">Hobbies</a>
        <a class="hover-underline-animation-red" href="Kontakt.html" target="Tab2">Kontakt</a>
        <a class="hover-underline-animation-red" href="Formular.html" target="Tab2">Formular</a>
        <a class="hover-underline-animation-red" href="Feedback.html" target="Tab2">Feedback</a>
        <a class="hover-underline-animation-red" href="Auswertung_Seite.php" target="Tab2">Auswertung</a>
    </nav>
</header>

<main>

    <?php
    $xml = simplexml_load_file('../Auswertung/Auswertung.xml');

    echo '<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Tabelle</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: green;
            font-weight: bold;
            color: white;
        }

        tr:nth-child(2) {
            background-color: red;
            font-style: italic;
        }

        tr:nth-child(n+3) td {
            background-color: white;
        }

        .red-table {
            color: red;
        }
        
        .green-table{
            color: green;
        }
    </style>
</head>
<body>';

    echo '<table>';
    echo '<tr><th colspan="6">Alle Feedbacks</th></tr>';
    echo '<tr><th>Anrede</th><th>Nachname</th><th>Vorname</th><th>Alter</th><th>Email</th><th>Bewertung</th></tr>';

    foreach ($xml->feedback as $feedback) {
        $anrede = (string) $feedback->besucher['anrede'];
        $nachname = (string) $feedback->besucher['nachname'];
        $vorname = (string) $feedback->besucher['vorname'];
        $alter = (string) $feedback->besucher->alter;
        $email = (string) $feedback->besucher->kontakt->emailadresse;
        $aussehen = (string) $feedback->bewertung['note_aussehen'];
        $inhalt = (string) $feedback->bewertung['note_inhalt'];

        if($aussehen >= 5 || $inhalt >= 5)
            echo "<tr><td>$anrede</td><td>$nachname</td><td>$vorname</td><td>$alter</td><td>$email</td><td class='red-table'>$aussehen / $inhalt</td></tr>";
        else
            echo "<tr><td>$anrede</td><td>$nachname</td><td>$vorname</td><td>$alter</td><td>$email</td><td class='green-table'>$aussehen / $inhalt</td></tr>";
    }

    echo '</table>';
    echo '</body></html>';
    ?>


</main>

<footer>
    <p>E-Mail: Laurence-Fishburne@gmail.com</p>
    <p>Telefonnummer: 02509/007</p>
    <p>Anschrift: Bahnhofstraße 10, 48007 Matrix</p>
    <p>©LF</p>
    <img src="../imgs/laurence.webp" alt="laurence" class="footer-img">
</footer>

</body>

</html>
