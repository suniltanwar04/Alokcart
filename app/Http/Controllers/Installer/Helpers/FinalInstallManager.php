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
 namespace App\Http\Controllers\Installer\Helpers; use Exception; use Illuminate\Support\Facades\Artisan; use Symfony\Component\Console\Output\BufferedOutput; class FinalInstallManager { public function runFinal() { $outputLog = new BufferedOutput(); $this->generateKey($outputLog); $this->publishVendorAssets($outputLog); return $outputLog->fetch(); } private static function generateKey($outputLog) { try { if (!config("\151\156\163\x74\141\154\x6c\145\x72\x2e\146\151\156\x61\154\56\153\145\171")) { goto djfzd; } Artisan::call("\153\x65\x79\x3a\147\145\156\x65\162\x61\x74\145", ["\x2d\55\x66\x6f\162\143\x65" => true], $outputLog); djfzd: } catch (Exception $e) { return static::response($e->getMessage(), $outputLog); } return $outputLog; } private static function publishVendorAssets($outputLog) { try { if (!config("\x69\156\x73\x74\x61\x6c\x6c\145\x72\x2e\x66\x69\156\141\x6c\56\x70\165\x62\x6c\x69\163\150")) { goto ZL5cE; } Artisan::call("\x76\145\x6e\144\x6f\162\72\160\x75\x62\x6c\151\163\150", ["\55\x2d\141\154\x6c" => true], $outputLog); ZL5cE: } catch (Exception $e) { return static::response($e->getMessage(), $outputLog); } return $outputLog; } private static function response($message, $outputLog) { return ["\x73\x74\x61\164\x75\163" => "\145\162\162\157\x72", "\x6d\145\163\x73\141\x67\145" => $message, "\144\142\x4f\165\x74\160\165\x74\114\x6f\147" => $outputLog->fetch()]; } }
