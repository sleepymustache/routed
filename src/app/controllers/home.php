<?php
	/**
	 * The default controller
	 */
	class Home {
		/**
		 * Loads the view based on controller-action.php pattern
		 */
		public function index($route) {
			$controller = $route->params['controller'];
			$action = $route->params['action'];
			$id = $route->params['id'];
			$view = "app/views/{$controller}-{$action}.php";

			if (file_exists($view)) {
				$page = new \Sleepy\Template('homepage');
				$page->bind('id', $id);
				require_once($view);
				$page->show();
			} else {
				throw new \Exception("Controller: View ($view) does not exist.");
				echo nothere();
			}
		}

		/**
		 * Page not found
		 */
		public function pageNotFound($route) {
			$createPage = false;
			$error =  $route->params['error']->getMessage();

			if (strpos($error, "Controller: View (") !== false && $createPage) {
				$start = strpos($error, "(") + 1;
				$stop = strpos($error, ")") - $start;
				$view = substr($error, $start, $stop) . ".php";
				$directory = $_SERVER['DOCUMENT_ROOT'] . "/app/views/";
				$template = $directory . "template.php";
				echo "<h1>Creating View: $view</h1>";
				copy($template, $directory . $view);
			}

			// Show 404
			$page = new \Sleepy\Template('global');
			require('app/views/home-404.php');
			$page->show();
		}

		/**
		 * Oops, there is an error of some kind.
		 */
		public function error($route) {
			$page = new \Sleepy\Template('global');
			$page->bind('error', $route->params['error']->getMessage());
			require_once('app/views/home-500.php');
			$page->show();
		}
	}