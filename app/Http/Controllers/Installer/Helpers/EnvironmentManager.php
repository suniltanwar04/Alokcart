<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.1   |
    |              on 2020-07-14 08:37:20              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
/*
* Copyright (C) Incevio Systems, Inc - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Munna Khan <help.zcart@gmail.com>, September 2018
*/
 namespace App\Http\Controllers\Installer\Helpers; use Exception; use Illuminate\Http\Request; class EnvironmentManager { private $envPath; private $envExamplePath; public function __construct() { $this->envPath = base_path("\x2e\x65\156\166"); $this->envExamplePath = base_path("\x2e\x65\x6e\x76\x2e\x65\170\x61\x6d\x70\x6c\x65"); } public function getEnvContent() { if (file_exists($this->envPath)) { goto ZUALC; } if (file_exists($this->envExamplePath)) { goto YChU5; } touch($this->envPath); goto JO_Dh; YChU5: copy($this->envExamplePath, $this->envPath); JO_Dh: ZUALC: return file_get_contents($this->envPath); } public function getEnvPath() { return $this->envPath; } public function getEnvExamplePath() { return $this->envExamplePath; } public function saveFileClassic(Request $input) { $message = trans("\151\x6e\163\164\141\154\x6c\x65\x72\137\155\145\163\163\141\147\145\x73\x2e\145\156\x76\151\x72\x6f\156\155\145\x6e\164\56\163\x75\x63\143\x65\163\x73"); try { file_put_contents($this->envPath, $input->get("\x65\x6e\x76\103\x6f\156\x66\151\147")); } catch (Exception $e) { $message = trans("\151\x6e\163\x74\141\x6c\154\145\x72\x5f\x6d\x65\x73\163\x61\x67\145\x73\56\x65\156\x76\151\x72\x6f\156\x6d\145\x6e\x74\x2e\x65\x72\x72\157\x72\163"); } return $message; } }
