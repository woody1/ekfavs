<?php

    if ($_SERVER["SERVER_NAME"] == "ekfavs.co.uk"){
        define("OUTOFROOT", '/home/sites/ekfavs.co.uk/');}
    else {
        define("OUTOFROOT", $_SERVER["DOCUMENT_ROOT"] . '/../');}