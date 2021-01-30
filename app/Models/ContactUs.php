<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model 
{
    public $fillable = [
        'nama',
        'email',
        'company_name',
        'company_address',
        'contact',
        'message'
    ];

    public $table = 'contact_us';

    protected $guarded = ['id'];

    public $timestamp = true;
}

?>