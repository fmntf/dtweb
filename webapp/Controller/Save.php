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
        $kernelDir = realpath(__DIR__ . '/../../dtbkernel');
        
        switch ($_POST['id']) {
            case 'qdl':
                $dist = "$kernelDir/arch/arm/boot/dts/imx6qdl-udoo-externalpins-dist.dtsi";
                $dtsi = "$kernelDir/arch/arm/boot/dts/imx6qdl-udoo-externalpins.dtsi";
                $target = "imx6{q,dl}-udoo{-lvds7,-lvds15,-hdmi}.dtb";
                break;
                
            case 'neo':
                $dist = "$kernelDir/arch/arm/boot/dts/imx6sx-udoo-neo-externalpins-dist.dtsi";
                $dtsi = "$kernelDir/arch/arm/boot/dts/imx6sx-udoo-neo-externalpins.dtsi";
                $target = "imx6sx-udoo-neo-{basic,basicks,extended,full}{-hdmi,-lvds7,-lvds15,}{-m4,}.dtb";
                break;
                
            default:
                $this->json(array('success' => true, 'message' => "Invalid board model: " . $_POST['id']));
        }
        
        $this->build($dist, $dtsi, $target);
	}
    
    private function build($dist, $dtsi, $target)
    {
        $kernelDir = realpath(__DIR__ . '/../../dtbkernel');
        $configDir = realpath(__DIR__ . '/../..');
        
        $dtreader = new Service_DeviceTreeReader();
        $dt = $dtreader->parse($dist);

        $conf = json_decode($_POST['conf'], true);
        $config = new Model_Configuration();
        foreach ($conf as $name => $pins) {
            $config->add($name, $pins);
        }

        $dteditor = new Service_DeviceTreeEditor($dt);
        $dteditor->setBoardType($_POST['id']);
        $dteditor->disableEverything();
        $dteditor->applyConfiguration($config);

        file_put_contents($dtsi, $dteditor->generate());
        
        chdir("$kernelDir/arch/arm/boot/dts");
        exec("bash -c 'rm $target'");
        
        chdir($kernelDir);
        exec("bash -c 'make -j2 $target 2>&1'", $output, $returnCode);
        
        if ($returnCode != 0) {
            $this->json(array(
                'success' => false,
                'message' => 'Cannot build DTB! Error log: <br><br><code>' . implode('<br>', $output) . '</code>'
            ));
        }
        
        chdir("$kernelDir/arch/arm/boot/dts");
        exec("mkdir /boot/dts-overlay");
        exec("bash -c 'cp $target /boot/dts-overlay/'", $output, $returnCode);
        
        if ($returnCode != 0) {
            $this->json(array(
                'success' => false,
                'message' => 'Cannot build DTB! Error log: <br><br><code>' . implode('<br>', $output) . '</code>'
            ));
        }
        
        file_put_contents("$configDir/config.json", $_POST['conf']);
        
        $uenvEditor = new Service_UenvEditor();
        $uenvEditor->setEnv("use_custom_dtb", "true");
        $uenvEditor->toFile();
        
        $this->json(array('success' => true));
    }
}
