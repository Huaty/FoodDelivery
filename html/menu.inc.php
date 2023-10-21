<?php

try {
    require_once "../asset/includePHP/dbh.inc.php";
    require_once "menu_model.inc.php";
    require_once "menu_view.inc.php";
    require_once "menu_contr.inc.php";


    if (isset($_SESSION['create_menu'])) { //// if the session is set
        create_menu($pdo);
    }


    die();
} catch (PDOEXCEPTION $e) {
    die("Query Failed: " . $e->getMessage());
}
