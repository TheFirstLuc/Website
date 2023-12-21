<?php
checkPassword();

getName();
checkForEmailError();
//checkForRueckfragenError(); //WIP
@ratingInhalt();
@ratingAussehen();
getDatum();

saveToXML();

function saveToXML(): void
{
    //get filename
    $filename = "../Feedbacks/Feedback" . date("d_m_Y") . "_" . date("H_i") . ".xml";

    // create a dom document with encoding utf8
    $domtree = new DOMDocument('1.0', 'UTF-8');

    // create the root element of the xml tree
    $xmlRoot = $domtree->createElement("Feedback");

    // loop through POST data
    foreach ($_POST as $key => $value) {
        // create an element for each POST key-value pair
        $xmlElement = $domtree->createElement($key, $value);

        // append the element to the root
        $xmlRoot->appendChild($xmlElement);
    }

    //xml add time
    $xmlRoot -> appendChild($domtree->createElement("datum", date("d.m.Y") . "_". date("H:i")));

    //xml right indent / format
    $domtree->formatOutput = true;

    // append the root element to the document
    $domtree->appendChild($xmlRoot);

    // DTD Definition hinzufügen
    $dtd = $domtree->createProcessingInstruction(
        'xml-stylesheet',
        'type="text/xml" href="Feedback.dtd"'
    );
    $domtree->insertBefore($dtd, $domtree->firstChild);

    // save to xml file
    $domtree->save($filename);
}

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

//function checkForRueckfragenError(): void
//{
//    if (!(isset($_POST['rueckfragen']) && (!empty($_POST['telefon']) || !empty($_POST['website']) ))) {
//        echo("<p>Error: Data provided but not Rückfragen selected</p>");
//        exit();
//    }
//
//    if (empty($_POST['telefon']) && empty($_POST['website']) && empty($_POST['email'])) {
//        echo("<p>Error: Rückfragen selected but no data provided</p>");
//        exit();
//    }
//}

function checkForRueckfragenError(): void
{
    if (!(isset($_POST['rueckfragen']) && ( (!empty($_POST['telefon'] && $_POST['telefon'] != '')) || (!empty($_POST['website'])  && $_POST['website'] != '')))) {
        echo("<p>Error: Data provided but not Rückfragen selected</p>");
        exit();
    }

    if (empty($_POST['telefon']) && empty($_POST['website']) && $_POST['telefon'] == '' && $_POST['website'] == '' && empty($_POST['email'])  && $_POST['email'] == '') {
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
    $anrede = $_POST['anrede'];
    switch ($anrede) {
        case 'Herr':
            echo("<p> Sehr geehrter Herr " . $_POST['vorname'] . "</p>");
            break;
        case 'Frau':
            echo("<p> Sehr geehrte Frau " . $_POST['vorname'] . "</p>");
            break;
        case 'Dr.':
            echo("<p> Dr. " . $_POST['vorname'] . "</p>");
            break;
        case 'Prof.':
            echo("<p> Prof. " . $_POST['vorname'] . "</p>");
        break;
    }
}

?>