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

class Controller_Save extends Controller
{
    public function run()
	{
		$conf = json_decode($_POST['conf'], true);
        $kernelDir = realpath(__DIR__ . '/../../dtbkernel');
        $dist = "$kernelDir/arch/arm/boot/dts/imx6qdl-udoo-externalpins-dist.dtsi";
        $dtsi = "$kernelDir/arch/arm/boot/dts/imx6qdl-udoo-externalpins.dtsi";
        $target = "imx6q-udoo.dtb";
        
        $dtreader = new Service_DeviceTreeReader();
        $dt = $dtreader->parse($dist);

        $config = new Model_Configuration();
        foreach ($conf as $name => $pins) {
            $config->add($name, $pins);
        }

        $dteditor = new Service_DeviceTreeEditor($dt);
        $dteditor->applyConfiguration($config);

        file_put_contents($dtsi, $dteditor->generate());
        unlink("$kernelDir/arch/arm/boot/dts/$target");
        if (file_exists("$kernelDir/arch/arm/boot/dts/$target")) {
            $this->json(array('success' => false, 'message' => 'Cannot delete DTB.'));
        }
        
        exec("make $target");
        if (file_exists("$kernelDir/arch/arm/boot/dts/$target")) {
            $this->json(array('success' => true));
        } else {
            $this->json(array('success' => false, 'message' => 'DTB not built!'));
        }
	}
}