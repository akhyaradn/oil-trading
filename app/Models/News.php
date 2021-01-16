<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model 
{
    public $fillable = [
        'judul',
        'img',
        'konten',
        'id_penulis',
        'flag_active'
    ];

    public $table = 'news';

    protected $guarded = ['id'];

    public $timestamp = true;
}

?>