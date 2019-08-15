<?php
// setup
include 'config.php';

$db = new SQLite3($_CONFIG['database']);
$db->exec('CREATE TABLE [images] (
[id] INTEGER  PRIMARY KEY AUTOINCREMENT NOT NULL,
[random_name] STRING(5)  NULL,
[real_name] STRING(150)  NULL,
[format] VARCHAR(30)  NULL,
[ext] VARCHAR(5)  NULL,
[time] TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL,
[views] INTEGER(10) NULL,
[last_view] TIMESTAMP  NULL
)
');
//$result = $db->query('SELECT bar FROM foo');
//var_dump($result->fetchArray());
$db->close();

echo "Database creation finished if you din't get any errors that is! That means you can edit the config.php delete this file and you are set to go!";
?>