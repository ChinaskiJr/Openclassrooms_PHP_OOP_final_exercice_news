<?php
namespace OCFram;
/**
 * Implements a constructor wick ask the DAO
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
 abstract class Manager {
 	protected $dao;

 	public function __construct($dao) {
 		$this->dao = $dao;
 	}
 }