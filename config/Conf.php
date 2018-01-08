<?php

class Conf {

  private static $database = array(
    'hostname'  => 'toutdeaaqesg.mysql.db',
    'database'  => 'toutdeaaqesg',
    'login'     => 'toutdeaaqesg',
    'password'  => 'Ezua6qkl'
  );

  static public function getLogin() {
    return self::$database['login'];
  }

  static public function getHostname() {
    return self::$database['hostname'];
  }

  static public function getDatabase() {
    return self::$database['database'];
  }

  static public function getPassword() {
    return self::$database['password'];
  }

}