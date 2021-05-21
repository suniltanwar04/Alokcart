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
 namespace App\Http\Controllers\Installer; use Illuminate\Routing\Controller; use App\Http\Controllers\Installer\Helpers\RequirementsChecker; class RequirementsController extends Controller { protected $requirements; public function __construct(RequirementsChecker $checker) { $this->requirements = $checker; } public function requirements() { $phpSupportInfo = $this->requirements->checkPHPversion(config("\x69\x6e\x73\164\141\x6c\x6c\145\x72\56\x63\157\x72\x65\x2e\x6d\151\156\120\150\x70\126\145\162\x73\151\157\156"), config("\151\156\x73\164\141\x6c\154\145\x72\56\143\x6f\162\145\56\155\141\x78\120\150\x70\126\x65\x72\163\x69\157\156")); $requirements = $this->requirements->check(config("\151\x6e\x73\x74\141\x6c\154\x65\x72\56\x72\x65\161\x75\151\162\145\x6d\145\156\x74\x73")); return view("\151\156\x73\x74\x61\x6c\x6c\x65\x72\x2e\x72\x65\161\165\151\162\145\155\145\x6e\164\x73", compact("\x72\x65\x71\165\151\162\145\x6d\145\156\164\x73", "\x70\x68\160\123\165\x70\x70\x6f\x72\x74\x49\x6e\x66\157")); } }
