<?php

require_once(File::build_path(array('config','Conf.php')));

class Model {

	public static $pdo;

	public static function Init() {
		$hostname   = Conf::getHostname();
		$dbname 	= Conf::getDatabase();
		$login  	= Conf::getLogin();
		$password   = Conf::getPassword();
		try {
			// Connexion à la base de données
			// Le dernier argument sert à ce que toutes les chaines de caractères
			// en entrée et sortie de MySql soit dans le codage UTF-8
			self::$pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $login, $password,
                     array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

			// On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			if (Conf::getDebug()) {
    			echo $e->getMessage(); // affiche un message d'erreur
  			} else {
    			echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
  			}
  			die();
		}
	}

	// getter generique
  	public function get($attribut) {
    	return $this->$attribut;
  	}

  	// setter generique
  	public function set($attribut, $valeur) {
    	$this->$attribut = $valeur;
  	}

	public static function selectAll() {
	    $table_name = static::$object;
	    $class_name = 'Model'.ucfirst($table_name);
	    $rep = Model::$pdo->query("SELECT * FROM $table_name;");
	    $rep->setFetchMode(PDO::FETCH_CLASS,$class_name);
	    $tab = $rep->fetchAll();
	    return $tab;
	}

	public static function select($primary_value) {
	    $table_name = static::$object;
	    $class_name = 'Model'.ucfirst($table_name);
	    $primary_key = static::$primary;
	    $sql = "SELECT *
	    		FROM $table_name
	    		WHERE $primary_key = :nom_tag;";
	    // Préparation de la requête
	   	//echo "<br>requete = $sql";
	    $req_prep = Model::$pdo->prepare($sql);
	    $values = array(
	        "nom_tag" => $primary_value
	    );
	    // On donne les valeurs et on exécute la requête
	    $req_prep->execute($values);
	    // On récupère les résultats comme précédemment
	    $req_prep->setFetchMode(PDO::FETCH_CLASS,$class_name);
	    $tab = $req_prep->fetchAll();
	    // Attention, si il n'y a pas de résultats, on renvoie false
	    //Util::disp("tab = ",$tab);
	    if (empty($tab)) return false;
	    return $tab[0];
	}

	public static function save($data) {
		$table_name = static::$object;
	    $class_name = 'Model'.ucfirst($table_name);
	    $primary_key = static::$primary;
		// récupération des champs
		$champs = array_keys($data);
		try {
			$sql = "INSERT INTO $table_name(";
			foreach ($data as $champ => $valeur) {
				$sql .= "`".$champ."`,";
			}
			$sql = rtrim($sql,',');
			$sql .= ") VALUES(";
			foreach ($data as $champ => $valeur) {
				$sql .= ":".$champ."_tag,";
			}
			$sql = rtrim($sql,',');
			$sql .= ");";
			//Util::disp('SQL',$sql);
			$req_prep = Model::$pdo->prepare($sql);
			$values = array();
			foreach ($data as $champ => $valeur) {
				$values[$champ."_tag"] = $valeur;
			}
			//Util::disp('values',$values);	
			$req_prep->execute($values);
			return true;
		} catch(PDOexception $e) {
			//echo "<pre>";print_r($e->errorInfo);echo "</pre>";
			if ($e->errorInfo[1] == 1062) return false;
			// echo "<pre>";print_r($e->errorInfo[0]);echo "</pre>";
		}
	}

	public static function update($data, $table_name, $primary_key) {
		//Util::disp('data',$data);
		//$table_name = 'page';
	    //$primary_key = 'nomPage';
	    try {
	    	$sql = "UPDATE $table_name SET ";
			foreach ($data as $key => $value) {
				if ($key != $primary_key) {
					$sql .= "$key = :".$key."_tag,";
				}
			}
			$sql = rtrim($sql,',');
			$sql .= " WHERE $primary_key = :pk_tag;";
			//Util::disp('SQL',$sql);
			$req_prep = Model::$pdo->prepare($sql);
			$values = array();
			foreach ($data as $key => $value) {
				if ($key != $primary_key) {
					$values[$key."_tag"] = $value;
				} else {
					$values["pk_tag"] = $value;
				}
			}
			//Util::disp('VALUES',$values);
			$req_prep->execute($values);
			return true;
		} catch(PDOexception $e) {
			//echo "<pre>";print_r($e->errorInfo);echo "</pre>";
			if ($e->errorInfo[1] == 1062) return false;
			// echo "<pre>";print_r($e->errorInfo[0]);echo "</pre>";
		}
	}

	public static function delete($primary) {
		$table_name = static::$object;
	    $class_name = 'Model'.ucfirst($table_name);
	    $primary_key = static::$primary;
		try {
			$sql = "DELETE
					FROM $table_name
					WHERE $primary_key = :pk_tag;";
			$req_prep = Model::$pdo->prepare($sql);
			$values = array(
				"pk_tag"   => $primary
			);
			$req_prep->execute($values);
			return true;
		} catch(PDOexception $e) {
			echo "<pre>";print_r($e->errorInfo);echo "</pre>";
			return false;
			// if ($e->errorInfo[1] == 1062) return false;
			// echo "<pre>";print_r($e->errorInfo[0]);echo "</pre>";
		}
	}

}

Model::Init();

?>
