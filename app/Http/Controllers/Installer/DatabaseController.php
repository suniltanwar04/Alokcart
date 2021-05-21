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
 namespace App\Http\Controllers\Installer; use Exception; use Illuminate\Support\Facades\DB; use Illuminate\Routing\Controller; use App\Http\Controllers\Installer\Helpers\DatabaseManager; class DatabaseController extends Controller { private $databaseManager; public function __construct(DatabaseManager $databaseManager) { $this->databaseManager = $databaseManager; } public function database() { if ($this->checkDatabaseConnection()) { goto qBmhp; } return redirect()->back()->withErrors(["\x64\x61\164\x61\x62\x61\x73\x65\137\143\x6f\x6e\156\x65\x63\164\x69\x6f\x6e" => trans("\x69\156\x73\x74\141\154\154\x65\162\137\155\x65\163\x73\x61\x67\145\x73\x2e\145\x6e\x76\151\162\x6f\x6e\155\x65\156\164\x2e\x77\x69\x7a\x61\x72\x64\x2e\x66\157\x72\155\56\x64\142\x5f\x63\x6f\x6e\x6e\x65\143\x74\151\157\156\137\x66\141\151\x6c\x65\x64")]); qBmhp: ini_set("\x6d\x61\x78\137\145\x78\x65\143\165\164\x69\157\156\x5f\164\151\155\145", 600); $response = $this->databaseManager->migrateAndSeed(); return redirect()->route("\x49\x6e\x73\164\141\154\154\x65\162\56\x66\x69\x6e\x61\x6c")->with(["\x6d\x65\163\x73\141\147\145" => $response]); } private function checkDatabaseConnection() { try { DB::connection()->getPdo(); return true; } catch (Exception $e) { return false; } } }
