<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\softDeletes;

class LeadHandelling extends Model
{
    //

    public $incrementing =true;
    public $timestamps = true;

    protected $softDelete = true;

    protected $primaryKey= 'leadId';

    use SoftDeletes;

    const SUPER_ADMIN   = 1; //Dont change it
    const ADMIN         = 2; //Dont change it
    const MERCHANT      = 3; //Dont change it

    protected $table = 'leads';

    protected $fillable  = ['leadId', 'leadEmail',
                 'leadContact', 'leadName',
                 'leadProduct','leadGeneratedFrom',
                'leadProductQty','leadStatus',
                'leadOwner'
                ];

    
}
