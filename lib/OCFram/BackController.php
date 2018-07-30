<?php
namespace OCFram;
/**
 * Class from whom every back controllers will herit.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
abstract class BackController extends ApplicationComponent {
	protected $action = ' ';
	protected $module = ' ';
	/**
	 * @var Page
	 */
	protected $page = null;
	protected $managers = null;
	protected $view = ' ';
	/**
	 * Constructor of the class.
	 * @param Application $app
	 * @param string $module
	 * @param string $action
	 * @return void
	 */
	public function __construct(Application $app, $module, $action) {
		parent::__construct($app);
		$this->page = new Page($app);
		$this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
		$this->setModule($module);
		$this->setAction($action);
		$this->setView($action);
	}
	/**
	 * Invoke the method that corresponds to the action assignated to the object.
	 * Method will be named executeNameOfAction() (e.g. for action show method will be executeShow()).
	 * @return void
	 */
	public function execute() {
		$method = 'execute' . ucfirst($this->action);
		if (!is_callable([$this, $method])) {
			throw new \RuntimeException('The action ' . $this->action . 'is not defined on the module');
		}
		$this->$method($this->app->httpRequest());
		
	}
	/**
	 * Getter of $page.
	 * @return Page
	 */
	public function page() {
		return $this->page;
	}
	/**
	 * Setter for $module.
	 * @param string $module
	 * @return void
	 */
	public function setModule($module) {
		if (!is_string($module) || empty($module)) {
			throw new \InvalidArgumentException('The module must be a non-empty string');
		}
		$this->module = $module;
	}
	/**
	 * Setter for $action.
	 * @param string $action
	 * @return void
	 */
	public function setAction($action) {
		if (!is_string($action) || empty($action)) {
			throw new \InvalidArgumentException('The action must be a non-empty string');
		}
		$this->action = $action;
	}
	/**
	 * Setter for $view.
	 * @param string $view
	 * @return void
	 */
	public function setView($view) {
		if (!is_string($view) || empty($view)) {
			throw new \InvalidArgumentException('The view myst be a non-empty string');
		}
		$this->view = $view;
	}
}