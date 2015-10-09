<?php
	class Sitemap {
		/**
		 * JSON Sitemap data
		 * @var string
		 */
		public static $data = '{
			"pages": [
				{
					"id": "1.0",
					"link": "",
					"title": "Homepage",
					"pages": [
						{
							"id": "1.1",
							"title": "Link 1",
							"target": "",
							"link": "#link1"
						}, {
							"id": "1.2",
							"title": "Link 2",
							"link": "#link2"
						}, {
							"id": "1.3",
							"title": "Link 3",
							"link": "#link3"
						}
					]
				}
			]
		}';

		/**
		 * Decoded self::$data
		 * @var object
		 */
		private static $_data;

		/**
		 * Helper variable for storing search results
		 * @var object
		 */
		private static $_result;

		/**
		 * Initialized the sitemap
		 * @return void
		 */
		private static function _initialize() {
			if (empty(self::$_data)) {
				self::$_data = json_decode(self::$data);
			}
		}

		/**
		 * Helper method to traverse the self::$_data tree
		 * @param  object $tree A JSON tree
		 * @param  string $id   The sitemap ID
		 * @return object       A JSON tree
		 */
		private static function _getPageHelper($tree, $id) {
			$leaf = array_pop($tree);

			if ($leaf === null || isset(self::$_result)) {
				return;
			}

			if ($leaf->id == $id) {
				self::$_result = $leaf;
				return;
			}

			if (isset($leaf->pages)) {
				self::_getPageHelper($leaf->pages, $id);
			}

			return self::_getPageHelper($tree, $id);
		}

		/**
		 * Gets a page and children based on it's ID
		 * @param  string $id The page ID
		 * @return object     A JSON tree
		 */
		private static function _getPage($id) {
			self::$_result = null;

			self::_getPageHelper(self::$_data->pages, $id);

			if (!isset(self::$_result)) {
				throw new \Exception('Sitemap: Page not found.');
			}

			return self::$_result;
		}

		/**
		 * Returns a link from a page in the JSON tree
		 * @param  string $id The sitemap ID
		 * @return string     The link for the page
		 */
		public static function link($id) {
			self::_initialize();
			$page = self::_getPage($id);
			return $page->link;
		}

		/**
		 * Returns a target from a page in the JSON tree
		 * @param  string $id The sitemap ID
		 * @return string     The target for the page
		 */
		public static function target($id) {
			self::_initialize();
			$page = self::_getPage($id);
			return $page->target;
		}

		/**
		 * Returns a title from a page in the JSON tree
		 * @param  string $id The sitemap ID
		 * @return string     The title for the page
		 */
		public static function title($id) {
			self::_initialize();
			$page = self::_getPage($id);
			return $page->title;
		}

		/**
		 * Returns a page and its children fromn the JSON tree
		 * @param  string $id The sitemap ID
		 * @return string     A JSON tree
		 */
		public static function getNav($id) {
			self::_initialize();
			$page = self::_getPage($id);
			return $page;
		}
	}