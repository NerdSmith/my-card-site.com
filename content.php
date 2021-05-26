<?php

switch ($_POST["page"]) {
    case "./":
        include ("templates/idx.php");
    break;

    case "./projects":
        include ("templates/projects.php");
    break;

    case "./contacts":
        include ("templates/contacts.php");
    break;

    case "./about":
        include ("templates/about.php");
    break;

    case "./comments":
        include ("templates/comments.php");
    break;
}

?>