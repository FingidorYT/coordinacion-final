<?php
    $conn = new mysqli("localhost", "root", "", "coordinacion" );
    if( $conn->connect_errno ) {
        echo "Falla al conectarse a Mysql ( ". $conn->connect_errno . ") " .
                $conn->connect_error ;
    }