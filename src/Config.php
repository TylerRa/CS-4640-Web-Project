<?php
/**
 * Configuration information
 * CS4640 Spring 2024
 *
 * Contains connection information for the local Docker
 * PostgresSQL database.  When uploading your code to the
 * CS4640 server, you can replace this file with another
 * configuration containing connection information found
 * on our course Canvas site.
 */


class Config {
    public static $db = [
        "host" => "localhost",
        "port" => "5432",
        "database" => "qh8cz",
        "user" => "qh8cz",
        "pass" => "KAzB0hn7oqzL"
        /*cRZawg3Nj4UY
        "host" => "db",
        "port" => 5432,
        "user" => "localuser",
        "pass" => "cs4640LocalUser!",
        "database" => "example"*/
    ];
}
