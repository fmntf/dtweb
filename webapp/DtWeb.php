<?php
/**
 * dtweb - Device Tree editor for UDOO boards
 * Copyright (C) 2015 Francesco Montefoschi <francesco.monte@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package dtweb
 * @author  Francesco Montefoschi
 * @license http://www.gnu.org/licenses/gpl-3.0.html  GNU GPL 3.0
 */

class DtWeb
{
    public function run()
	{
		if (array_key_exists('REQUEST_URI', $_SERVER)) {
			$parts = explode('/', $_SERVER['REQUEST_URI']);
			array_shift($parts);

			$controller = array_shift($parts);
			if ($controller == '') {
				$controller = 'index';
			}
		} else {
			$controller = 'index';
			$parts = array();
		}
		
		$controllerClass = 'Controller_' . ucfirst($controller);
		
		$front = new $controllerClass($parts, $controller);
		$front->run();
	}
}