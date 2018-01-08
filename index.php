<?php
session_start();
require_once ('./lib/File.php');
require(File::build_path(array('lib','Util.php')));
require(File::build_path(array('lib','Security.php')));
require(File::build_path(array('lib','Session.php')));
require(File::build_path(array('controller','routeur.php')));

?>