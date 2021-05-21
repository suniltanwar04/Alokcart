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
 namespace App\Http\Controllers\Installer; use Illuminate\Routing\Controller; use App\Http\Controllers\Installer\Helpers\InstalledFileManager; use App\Http\Controllers\Installer\Helpers\DatabaseManager; class UpdateController extends Controller { use \App\Http\Controllers\Installer\Helpers\MigrationsHelper; public function welcome() { return view("\x69\x6e\x73\x74\x61\154\154\145\x72\x2e\x75\x70\x64\141\x74\x65\56\167\145\154\x63\157\x6d\x65"); } public function overview() { $migrations = $this->getMigrations(); $dbMigrations = $this->getExecutedMigrations(); return view("\151\x6e\163\x74\141\x6c\154\145\162\56\165\160\x64\141\164\145\x2e\x6f\x76\x65\x72\166\151\145\x77", ["\156\165\x6d\x62\x65\x72\x4f\146\x55\x70\144\x61\x74\145\163\x50\x65\156\x64\151\156\147" => count($migrations) - count($dbMigrations)]); } public function database() { $databaseManager = new DatabaseManager(); $response = $databaseManager->migrateAndSeed(); return redirect()->route("\114\x61\162\x61\166\145\x6c\125\x70\144\x61\164\145\162\72\x3a\x66\151\156\141\154")->with(["\x6d\145\163\x73\141\147\145" => $response]); } public function finish(InstalledFileManager $fileManager) { $fileManager->update(); return view("\151\156\x73\164\x61\x6c\154\x65\x72\x2e\165\x70\144\x61\x74\145\x2e\146\151\x6e\x69\x73\x68\145\x64"); } }
