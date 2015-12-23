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

class Model_DeviceTree
{
    public $features;
    public $gpios;
    public $dtsi;
    public $requiredLines;
    
    public function disableEverything()
    {
        foreach ($this->features as $feature) {
            $feature->disabled = true;
        }
        
        foreach ($this->gpios->gpios as $n => $gpio) {
            $this->gpios->enable($n);
        }
    }
    
    public function setFeatures(array $features)
    {
        $this->features = $features;
    }
    
    public function setGpios(Model_Gpios $gpios)
    {
        $this->gpios = $gpios;
    }
    
    public function setDtsi(array $dtsi)
    {
        $this->dtsi = $dtsi;
    }
    
    public function setRequiredLines(array $requiredLines)
    {
        $this->requiredLines = $requiredLines;
    }
    
    public function getFeature($name)
    {
        foreach ($this->features as $feature) {
            if ($feature->name == $name) {
                return $feature;
            }
        }
    }
    
    public function enableFeature($name)
    {
        $feature = $this->getFeature($name);
        $feature->disabled = false;
        
        if (array_key_exists($name, $this->requiredLines)) {
            foreach ($this->requiredLines[$name] as $lineToUncomment) {
                $row = substr($this->dtsi[$lineToUncomment], 2);
                $this->dtsi[$lineToUncomment] = $row;
            }
        }
    }
    
    public function disableGpios(array $pins)
    {
        foreach ($pins as $pin) {
            $this->gpios->disable($pin);
        }
    }
}
