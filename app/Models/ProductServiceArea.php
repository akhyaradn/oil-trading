<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductServiceArea extends Model
{
    public $fillable = [
        'id_parent',
        'order',
        'industry',
        'mining',
        'shipping'
    ];

    public $table = 'product_service_area';

    protected $guarded = ['id'];

    public $timestamp = true;
}
?>