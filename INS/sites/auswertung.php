<?php
//check password
//if(!($_POST["passwort"] == 'Internetsprachen'))
//    return;

# check for email error
if (empty($_POST['kopie']) && !empty($_POST['email'])){
    echo ("Error: E-Mail set but checkbox isn't selected" . PHP_EOL);
    return;
}

# check for Rückfragen error
if(isset($_POST['rueckfragen']) && (isset($_POST['email']) || isset($_POST['telefon'])))

echo ($_POST['vorname']);
?>