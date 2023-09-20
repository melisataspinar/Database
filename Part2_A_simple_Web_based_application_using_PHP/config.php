<?php

if( !defined('username') ) define( 'username', 'melisa.taspinar' );
if( !defined('dbname') ) define( 'dbname', 'melisa_taspinar' );
if( !defined('passwd') ) define( 'passwd', 'mBYLLLVW' );
if( !defined('host') ) define( 'host', 'dijkstra.ug.bcc.bilkent.edu.tr' );

$mysqli = new mysqli( host, username, passwd, dbname );

if ( $mysqli->connect_errno ) 
{
	echo "COULD NOT CONNECT TO MySQL". $mysqli->connect_error; 
}

?>