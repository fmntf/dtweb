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

class Controller_Index extends Controller
{
    public function run()
    {
        $board = Service_BoardDetector::boardFromModel();
        if (!$board) {
            $this->render('boardunsupported', false);
            return;
        }

        $configDir = realpath(__DIR__ . '/../..');
        $defconfig = file_get_contents("$configDir/public/boards/$board/defconfig.json");
        if (file_exists("$configDir/config.json")) {
            $config = file_get_contents("$configDir/config.json");
        } else {
            $config = $defconfig;
        }
        
        $this->viewVars = array(
            'board' => $board,
            'configuration' => $config,
            'defconfig' => $defconfig,
        );
        $this->render('index');
    }
}
