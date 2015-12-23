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

class Service_DeviceTreeEditorTest extends PHPUnit_Framework_TestCase
{
    public function testAddsAudioDevices()
    {
        $generated = $this->configureDeviceTree('{"sound_dac":[25,26,27],"dac-codec":[],"ssi1":[],"sound_spdif":[30],"spdif":[],"i2c4":[34,35],"uart1":[46,47],"i2c2":[48]}');
        $expected = file_get_contents(__DIR__ . '/../fixtures/neo-audio.dtsi');
        
        $this->assertEquals($expected, $generated);
    }
    
    public function testDisablesAllDevices()
    {
        $generated = $this->configureDeviceTree('{}');
        $expected = file_get_contents(__DIR__ . '/../fixtures/neo-all-disabled.dtsi');
        
        $this->assertEquals($expected, $generated);
    }
    
    public function testConfiguresAComplexExample()
    {
        $generated = $this->configureDeviceTree('{"onewire16":[16],"onewire17":[17],"sound_dac":[25,26,27],"dac-codec":[],"ssi1":[],"uart6":[30,31,32,33],"onewire34":[34],"pwm2":[35],"flexcan1":[40,41],"uart2":[44,45],"uart1":[46,47],"i2c2":[48]}');
        $expected = file_get_contents(__DIR__ . '/../fixtures/neo-complex.dtsi');
        
        $this->assertEquals($expected, $generated);
    }
    
    private function configureDeviceTree($configuration)
    {
        $dist =  __DIR__ . '/../fixtures/imx6sx-udoo-neo-externalpins.dtsi';
        
        $dtreader = new Service_DeviceTreeReader();
        $dt = $dtreader->parse($dist);
        
        $conf = json_decode($configuration, true);
        $config = new Model_Configuration();
        foreach ($conf as $name => $pins) {
            $config->add($name, $pins);
        }

        $dteditor = new Service_DeviceTreeEditor($dt);
        $dteditor->setBoardType('neo');
        $dteditor->disableEverything();
        $dteditor->applyConfiguration($config);

        return $dteditor->generate();
    }
}