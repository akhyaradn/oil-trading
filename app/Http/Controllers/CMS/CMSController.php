<?php
namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductService;
use App\Models\ContactUs;
use App\Models\News;


class CMSController extends Controller
{
    public function index(Request $request) {
        $data['news'] = News::where('flag_active', 1)
                ->orderBy('updated_at', 'desc')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

        $data['productservice'] = ProductService::where('flag_active', 1)
                ->orderBy('updated_at', 'desc')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

        $data['messages'] = ContactUs::where('flag_active', 1)
                ->orderBy('updated_at', 'desc')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

        return view("CMS.pages.dashboard")->with($data);
    }
}
?>