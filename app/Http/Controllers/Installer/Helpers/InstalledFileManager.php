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
 namespace App\Http\Controllers\Installer\Helpers; class InstalledFileManager { public function create() { $installedLogFile = storage_path("\151\156\x73\x74\141\x6c\x6c\x65\144"); $dateStamp = date("\131\57\x6d\x2f\x64\x20\150\72\151\x3a\163\x61"); if (!file_exists($installedLogFile)) { goto KdUV_; } $message = trans("\x69\x6e\x73\x74\x61\154\x6c\145\x72\x5f\155\x65\x73\163\x61\x67\x65\163\x2e\x75\x70\x64\x61\x74\145\162\x2e\154\157\x67\x2e\163\165\x63\143\145\x73\163\137\x6d\x65\163\163\141\x67\145") . $dateStamp; file_put_contents($installedLogFile, $message . PHP_EOL, FILE_APPEND | LOCK_EX); goto Y5xZn; KdUV_: $message = trans("\151\x6e\x73\164\x61\154\154\145\x72\137\x6d\145\x73\163\x61\x67\x65\x73\56\151\156\163\164\141\x6c\154\x65\144\56\x73\165\143\x63\145\163\163\x5f\x6c\x6f\147\x5f\155\x65\x73\163\x61\x67\x65") . $dateStamp . "\12"; file_put_contents($installedLogFile, $message); Y5xZn: return $message; } public function update() { return $this->create(); } }
