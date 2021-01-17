<?php
namespace App\Mode;

use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    public $fillable = [
        'judul',
        'paragraf_awal',
        'paragraf_akhir',
        'flag_active'
    ];

    public $table = 'product_service';

    protected $guarded = ['id'];

    public $timestamp = true;
}
?>