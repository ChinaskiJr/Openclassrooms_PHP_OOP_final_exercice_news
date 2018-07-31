<?php
namespace OCFram;
/**
 * Generate a dynamic page in order to add it to the layout.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
class Page extends ApplicationComponent {
	protected $contentFile;
	protected $vars = [];

	/**
	 * Add a a variable to the page.
	 * @param string $var
	 * @param mixed $value
	 * @return void
	 */
	public function addVar($var, $value) {
		if (!is_string($var) || is_numeric($var) || empty($var)) {
			throw new \InvalidArgumentException('The name of the variable must be a non-empty string');
		}
		$this->vars[$var] = $value;
	}
	/**
	 * Generate the page with the layout with output bufferisation. 
	 * @return string
	 */
	public function getGeneratedPage() {
	    if (!file_exists($this->contentFile)) {
	        throw new \RuntimeException('The specified view does not exist');
        }
        $user = $this->app->user();
	    extract($this->vars);
		ob_start();
		require $this->contentFile;
		$content = ob_get_clean();

		ob_start();
		require __DIR__ . '/../../App/' . $this->app->name() . '/Templates/layout.php';
		return ob_get_clean();
	}
	/**
	 * Setter for $contentFile.
	 * @param string $contentFile
	 * @return void
	 */
	public function setContentFile($contentFile) {
		if (!is_string($contentFile) || empty($contentFile)) {
			throw new \InvalidArgumentException('The view specified is invalid');
		}
		$this->contentFile = $contentFile;
	}
}