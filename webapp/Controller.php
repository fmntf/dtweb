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

class Controller
{
	public function __construct($params, $thisClass)
	{
		$this->params = $params;
		$this->viewVars = array();
		$this->className = $thisClass;
	}
	
	protected function render($script, $includeLayout = true)
	{
		extract($this->viewVars);
		
		if ($includeLayout) include __DIR__ . "/View/_header.phtml";
		include __DIR__ . "/View/$script.phtml";
		if ($includeLayout) include __DIR__ . "/View/_footer.phtml";
	}
	
	protected function json(array $response)
	{
		header('Content-type: application/json');
		echo json_encode($response);
	}
}