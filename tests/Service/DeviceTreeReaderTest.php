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

class Service_DeviceTreeReaderTest extends PHPUnit_Framework_TestCase
{
    public function testParsesDeviceTree()
    {
        $dist =  __DIR__ . '/../fixtures/imx6sx-udoo-neo-externalpins.dtsi';
        
        $dtreader = new Service_DeviceTreeReader();
        $dt = $dtreader->parse($dist);
        
        $features = $dt->features;
        
        $this->assertEquals("ssi1", $features[0]->name);
        $this->assertEquals("ecspi2", $features[1]->name);
        $this->assertEquals("uart1", $features[2]->name);
        $this->assertEquals("uart2", $features[3]->name);
        $this->assertEquals("uart6", $features[4]->name);
        $this->assertEquals("i2c2", $features[5]->name);
        $this->assertEquals("i2c4", $features[6]->name);
        $this->assertEquals("flexcan1", $features[7]->name);
        $this->assertEquals("flexcan2", $features[8]->name);
        $this->assertEquals("spdif", $features[9]->name);
        $this->assertEquals("pwm1", $features[10]->name);
        $this->assertEquals("pwm2", $features[11]->name);
        $this->assertEquals("pwm3", $features[12]->name);
        $this->assertEquals("pwm4", $features[13]->name);
        $this->assertEquals("pwm5", $features[14]->name);
        $this->assertEquals("pwm6", $features[15]->name);
        $this->assertEquals("codec_dac", $features[16]->name);
        $this->assertEquals("sound_dac", $features[17]->name);
        $this->assertEquals("sound_spdif", $features[18]->name);
        $this->assertEquals("onewire16", $features[19]->name);
        $this->assertEquals("onewire17", $features[20]->name);
        $this->assertEquals("onewire18", $features[21]->name);
        $this->assertEquals("onewire19", $features[22]->name);
        $this->assertEquals("onewire20", $features[23]->name);
        $this->assertEquals("onewire21", $features[24]->name);
        $this->assertEquals("onewire22", $features[25]->name);
        $this->assertEquals("onewire23", $features[26]->name);
        $this->assertEquals("onewire24", $features[27]->name);
        $this->assertEquals("onewire25", $features[28]->name);
        $this->assertEquals("onewire26", $features[29]->name);
        $this->assertEquals("onewire27", $features[30]->name);
        $this->assertEquals("onewire28", $features[31]->name);
        $this->assertEquals("onewire29", $features[32]->name);
        $this->assertEquals("onewire30", $features[33]->name);
        $this->assertEquals("onewire31", $features[34]->name);
        $this->assertEquals("onewire32", $features[35]->name);
        $this->assertEquals("onewire33", $features[36]->name);
        $this->assertEquals("onewire34", $features[37]->name);
        $this->assertEquals("onewire35", $features[38]->name);
        $this->assertEquals("onewire36", $features[39]->name);
        $this->assertEquals("onewire37", $features[40]->name);
        $this->assertEquals("onewire38", $features[41]->name);
        $this->assertEquals("onewire39", $features[42]->name);
        $this->assertEquals("onewire40", $features[43]->name);
        $this->assertEquals("onewire41", $features[44]->name);
        $this->assertEquals("onewire42", $features[45]->name);
        $this->assertEquals("onewire43", $features[46]->name);
        $this->assertEquals("onewire44", $features[47]->name);
        $this->assertEquals("onewire45", $features[48]->name);
        $this->assertEquals("onewire46", $features[49]->name);
        $this->assertEquals("onewire47", $features[50]->name);
    }
}