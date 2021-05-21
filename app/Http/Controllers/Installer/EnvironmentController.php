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
 namespace App\Http\Controllers\Installer; use Illuminate\Routing\Controller; use Illuminate\Http\Request; use Illuminate\Routing\Redirector; use App\Http\Controllers\Installer\Helpers\EnvironmentManager; use Validator; class EnvironmentController extends Controller { protected $EnvironmentManager; public function __construct(EnvironmentManager $environmentManager) { $this->EnvironmentManager = $environmentManager; } public function environmentMenu() { return view("\151\x6e\x73\x74\141\x6c\x6c\145\x72\x2e\x65\156\x76\151\162\157\156\x6d\145\x6e\164"); } public function environmentWizard() { } public function environmentClassic() { $envConfig = $this->EnvironmentManager->getEnvContent(); return view("\151\x6e\x73\164\141\x6c\x6c\x65\x72\56\x65\156\x76\151\x72\157\x6e\155\145\x6e\x74\55\143\154\x61\x73\163\x69\143", compact("\145\x6e\166\x43\157\156\146\151\x67")); } public function saveClassic(Request $input, Redirector $redirect) { $message = $this->EnvironmentManager->saveFileClassic($input); return $redirect->route("\x49\156\163\x74\x61\154\x6c\145\162\x2e\x65\156\166\x69\162\x6f\156\155\145\x6e\164\x43\x6c\141\x73\x73\151\143")->with(["\x6d\145\163\x73\x61\147\145" => $message]); } }
