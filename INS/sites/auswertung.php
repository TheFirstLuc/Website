<?php
# check password
//if(!($_POST["passwort"] == 'Internetsprachen'))
//    return;

# check for email error
if (empty($_POST['kopie']) && !empty($_POST['email'])) {
    echo("Error: E-Mail set but checkbox isn't selected" . PHP_EOL);
    return;
}

# check for Rückfragen error
if (!(isset($_POST['rueckfragen']) && (($_POST['email'] != "") || ($_POST['telefon'] != "") || ($_POST['website'] != "")))) {
    echo ("<p>Error: Rückfragen selected but no data provided</p>");
    return;
}

# rating Inhalt
$rating = $_POST['note_inhalt'];
if($rating == 1 || $rating == 2)
    echo "<p>Ich freue mich das Ihnen der Inhalt der gefallen hat.</p>";
elseif ($rating == 3)
    echo "<p>Ich werde mich bemühen in Zukunft den Inhalt der Seite zu optimieren.</p>";
else
    echo "<p>Tut mir leid :,(</p>";

# rating Aussehen
echo ("<p>Danke dass Sie das Aussehen mit ". $_POST['note_aussehen']. " bewertet haben.</p>");

# date
echo ("<p>Ihre Feedbackwerte wurden am ".date("d.m.Y")." um ".date("H:i")." Uhr angenommen</p>");

echo("<p>". $_POST['vorname']."</p>");
?>