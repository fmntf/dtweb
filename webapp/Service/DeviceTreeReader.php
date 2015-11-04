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

class Service_DeviceTreeReader
{
    public function parse($dtsiFile)
    {
        $dtsi = file_get_contents($dtsiFile);
        $rows = explode(PHP_EOL, $dtsi);
        
        $gpios = [];
        $pwms = [];
        $features = [];
        
        foreach ($rows as $lineNumber => $row) {
            if (strpos($row, '{{external-gpio')) {
                preg_match("/\s*(\/\/)?\s*(MX6[A-Z0-9_]*).+(0[xX][0-9a-fA-F]+).+external\-gpio\-(\d+).*/", $row, $matches);
                $gpios[$matches[4]] = array(
                    'atLine' => $lineNumber,
                    'value' => $matches[0],
                    'disabled' => $matches[1] === '//'
                );
            }
            
            if (strpos($row, 'status')) {
                preg_match("/\s*status\s*=\s*\"(disabled|okay)\";/", $row, $matches);
                $features[] = new Model_Feature($this->locateDevice($rows, $lineNumber, $matches[1]=='disabled'));
            }
        }
        
        $_gpios = new Model_Gpios($gpios);
        
        $dt = new Model_DeviceTree();
        $dt->setFeatures($features);
        $dt->setGpios($_gpios);
        $dt->setDtsi($rows);
        
        return $dt;
    }
    
    private function locateDevice(array $rows, $aroundLine, $disabled)
    {
        for ($i=$aroundLine-1; $i>1; $i--) {
            preg_match("/&?([A-Za-z0-9]+)(@(\d+))?\s*{/", $rows[$i], $matches);
            if (count($matches)>0) {
                $alias = '';
                if (count($matches)>3) {
                    $alias = $matches[3];
                }
                return array(
                    'atLine' => $aroundLine,
                    'name' => $matches[1] . $alias,
                    'disabled' => $disabled,
                );
            }
        }
    }
}
