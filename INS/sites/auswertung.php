<?php
checkPassword();
checkForEmailError();
checkForRueckfragenError();
@ratingInhalt();
@ratingAussehen();
getDatum();
getName();

function checkPassword(): void
{
    if (!($_POST["passwort"] == 'Internetsprachen')) {
        echo("Password is incorrect");
        exit();
    }
}

function checkForEmailError(): void
{
    if (empty($_POST['kopie']) && !empty($_POST['email'])) {
        echo("Error: E-Mail set but checkbox isn't selected" . PHP_EOL);
        exit();
    }
}

function checkForRueckfragenError(): void
{
    if (!(isset($_POST['rueckfragen']) && (($_POST['telefon'] != "") || ($_POST['website'] != "")))) {
        echo("<p>Error: Data provided but not Rückfragen selected</p>");
        exit();
    }

    if (empty($_POST['email']) && empty($_POST['telefon']) && empty($_POST['website'])) {
        echo("<p>Error: Rückfragen selected but no data provided</p>");
        exit();
    }
}

# rating Inhalt
function ratingInhalt(): void
{
    $rating = $_POST['note_inhalt'];
    if ($rating == 1 || $rating == 2)
        echo "<p>Ich freue mich das Ihnen der Inhalt der gefallen hat.</p>";
    elseif ($rating == 3)
        echo "<p>Ich werde mich bemühen in Zukunft den Inhalt der Seite zu optimieren.</p>";
    else
        echo "<p>Tut mir leid :,(</p>";
}

function ratingAussehen(): void
{
    echo("<p>Danke dass Sie das Aussehen mit " . $_POST['note_aussehen'] . " bewertet haben.</p>");
}

function getDatum(): void
{
    echo("<p>Ihre Feedbackwerte wurden am " . date("d.m.Y") . " um " . date("H:i") . " Uhr angenommen</p>");
}

function getName(): void
{
    echo("<p>" . $_POST['vorname'] . "</p>");
}
?>