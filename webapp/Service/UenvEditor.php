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

class Service_UenvEditor
{
    private $lines;
    private $items;
    private $changes;
    
    public function __construct($uenvFilePath)
    {
        if (file_exists($uenvFilePath)) {
            $uenv = file_get_contents($uenvFilePath);
            $this->lines = explode(PHP_EOL, $uenv);
        } else {
            $this->lines = array();
        }
        
        $this->items = array();
        $this->changes = array();
        
        foreach ($this->lines as $n => $line) {
            $line = trim($line);
            $commentStartingAt = strpos($line, "#");
            if ($commentStartingAt) {
                $line = trim(substr($line, 0, $commentStartingAt));
            }
            
            $equals = strpos($line, "=");
            if ($equals) {
                $k = substr($line, 0, $equals);
                $v = substr($line, $equals+1);
                
                $this->items[$k] = array(
                    'value' => $v,
                    'line' => $n,
                );
            }
        }
    }
    
    public function getEnv($varName)
    {
        if (array_key_exists($varName, $this->items)) {
            return $this->items[$varName]['value'];
        }
        
        return null;
    }
    
    public function setEnv($varName, $value)
    {
        $this->changes[] = $varName;
        
        if (!array_key_exists($varName, $this->items)) {
            $this->items[$varName] = array(
                'value' => null,
                'line' => null,
            );
        }
        
        $this->items[$varName]['value'] = $value;
    }
    
    public function toFile($destinationFile)
    {
        foreach ($this->changes as $k) {
            $change = $this->items[$k];
            if ($change['line']) {
                $line = $change['line'];
            } else {
                $line = count($this->lines);
            }
            
            $this->lines[$line] = "$k=" . $change['value'];
        }
        
        $uenv = implode(PHP_EOL, $this->lines);
        file_put_contents($destinationFile, $uenv);
    }
}
