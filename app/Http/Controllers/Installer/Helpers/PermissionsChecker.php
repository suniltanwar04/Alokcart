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
 namespace App\Http\Controllers\Installer\Helpers; class PermissionsChecker { protected $results = []; public function __construct() { $this->results["\x70\x65\x72\155\x69\x73\x73\151\157\156\163"] = []; $this->results["\145\162\162\x6f\162\163"] = null; } public function check(array $folders) { foreach ($folders as $folder => $permission) { if (!($this->getPermission($folder) >= $permission)) { goto jzU0l; } $this->addFile($folder, $permission, true); goto BSNj3; jzU0l: $this->addFileAndSetErrors($folder, $permission, false); BSNj3: oWEXI: } keOmP: return $this->results; } private function getPermission($folder) { return substr(sprintf("\45\157", fileperms(base_path($folder))), -4); } private function addFile($folder, $permission, $isSet) { array_push($this->results["\160\x65\x72\x6d\151\163\x73\x69\157\156\163"], ["\x66\157\154\144\x65\162" => $folder, "\160\x65\162\x6d\151\163\163\x69\x6f\156" => $permission, "\x69\x73\123\145\x74" => $isSet]); } private function addFileAndSetErrors($folder, $permission, $isSet) { $this->addFile($folder, $permission, $isSet); $this->results["\145\162\x72\157\162\163"] = true; } }
