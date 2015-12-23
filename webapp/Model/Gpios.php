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

class Model_Gpios
{
    public $gpios;
    
    public function __construct(array $gpios)
    {
        $this->gpios = $gpios;
    }
    
    public function disable($pin)
    {
        if ($this->gpios[$pin]['disabled']) {
            return ;
        }
        
        $this->gpios[$pin]['disabled'] = true;
        $row = $this->gpios[$pin]['value'];
        $this->gpios[$pin]['value'] = "//" . $row;
    }
    
    public function enable($pin)
    {
        if (!$this->gpios[$pin]['disabled']) {
            return ;
        }
        
        $this->gpios[$pin]['disabled'] = false;
        $row = $this->gpios[$pin]['value'];
        $parts = explode("MX6", $row);
        if (count($parts) != 2) {
            throw new UnexpectedValueException("Unexpected value: $row");
        }
        
        $row = str_replace("//", "", $parts[0]) . 'MX6' . $parts[1];
        $this->gpios[$pin]['value'] = $row;
    }
}
