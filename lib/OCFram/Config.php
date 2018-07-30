<?php
namespace OCFram;
/**
 * Parse the XML config file.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
class Config extends ApplicationComponent {
	protected $vars = [];

	/**
	 * Parse and stock the config values.
	 * @param string $var
	 * @return string
	 */
	public function get($var) {
		if (!$this->vars) {
			$xml = new \DOMDocument;
			$xml->load(__DIR__ . '/../../App/' . $this->app->name() . '/Config/app.xml');
			// The config elements are in <define /> tag
			$elements = $xml->getElementsByTagName('define');
			foreach ($elements as $element) {
				$this->vars[$element->getAttribute('var')] = $element->getAttribute('value');
			}
		}
		if (isset($this->vars[$var])) {
			return $this->$vars[$var];
		} else {
			return null;
		}
	}
}