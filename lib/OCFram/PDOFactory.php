<?php
namespace OCFram;
/**
 * Use the Pattern Factory to connect to the DB with PDO
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
 class PDOFactory {
 	/**
 	 * Create a PDO instance to connect to the database.
 	 * @return PDO $db
 	 */
 	public static function getMysqlConnexion() {
 		$db = new \PDO('mysql:host=localhost;dbname=news', 'root', '');
 		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO:ERRMODE_EXCEPTION);
 		return $db;
 	}
 }