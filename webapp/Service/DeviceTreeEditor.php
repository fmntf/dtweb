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

class Service_DeviceTreeEditor
{
    public $deviceTree;
    private $boardType;
    
    public function __construct(Model_DeviceTree $deviceTree)
    {
        $this->deviceTree = $deviceTree;
    }
    
    public function setBoardType($boardType)
    {
        $this->boardType = $boardType;
    }
    
    public function disableEverything() {
        $this->deviceTree->disableEverything();
    }
    
    public function applyConfiguration(Model_Configuration $config)
    {
        foreach ($config->features as $name => $pinConfig) {
            $this->deviceTree->enableFeature($name);
            // UDOO Neo has I2C-2 on a fake #48 GPIO, so we do not disable it.
            if (!($this->boardType === "neo" && $name === "i2c2")) {
                $this->deviceTree->disableGpios($pinConfig);
            }
        }
    }
    
    public function generate()
    {
        foreach ($this->deviceTree->gpios->gpios as $gpio) {
            $this->deviceTree->dtsi[$gpio['atLine']] = $gpio['value'];
        }
        
        foreach ($this->deviceTree->features as $feature) {
            $row = $this->deviceTree->dtsi[$feature->atLine];
            if ($feature->disabled) {
                $row = str_replace('"okay"', '"disabled"', $row);
            } else {
                $row = str_replace('"disabled"', '"okay"', $row);
            }
            
            $this->deviceTree->dtsi[$feature->atLine] = $row;
        }
        
        return implode(PHP_EOL, $this->deviceTree->dtsi);
    }
}
