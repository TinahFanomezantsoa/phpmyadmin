<?php
/* $Id$ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Gets some core libraries
 */
if (!defined('PMA_GRAB_GLOBALS_INCLUDED')) {
    include('./libraries/grab_globals.lib.php3');
}
if (!defined('PMA_COMMON_LIB_INCLUDED')) {
    include('./libraries/common.lib.php3');
}

/**
 * Handles some variables that may have been sent by the calling script
 */
if (isset($db)) {
    unset($db);
}
if (isset($table)) {
    unset($table);
}

/**
 * Set parameters for links
 */
$url_query = PMA_generate_common_url();

/**
 * Defines the urls to return to in case of error in a sql statement
 */
$err_url = 'main.php3' . $url_query;

/**
 * Displays the headers
 */
require('./header.inc.php3');

/**
 * Checks for superuser privileges
 */
// We were checking privileges with 'USE mysql' but users with the global
// priv CREATE TEMPORARY TABLES or LOCK TABLES can do a 'USE mysql'
// (even if they cannot see the tables)

$is_superuser = @PMA_mysql_query('SELECT COUNT(*) FROM mysql.user', $userlink);

// now, select the mysql db
if ($is_superuser) {
    @PMA_mysql_query('USE mysql', $userlink);
}
?>
