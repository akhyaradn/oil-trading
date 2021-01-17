<?php
namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductService;
use App\Models\ProductServiceArea;
use DB;
use Log;

class ProductServiceController extends Controller
{
    public function submitProductService($id = null, Request $request) {
        try {
            $data = [
                'judul' => $request->judul,
                'paragraf_awal' => $request->paragraf_awal,
                'paragraf_akhir' => $request->paragraf_akhir,
                'flag_active' => $request->flag_active == 'on' ? 1 : 0
            ];
    
            $detail = [
                'industry' => $request->industry,
                'mining' => $request->mining,
                'shipping' => $request->shipping
            ];

            if(!$id) {
                // tambah field created_at & updated_at hanya utk insertgetid
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");

                $id_area = DB::table('product_service')
                            ->insertGetId($data);

                for($i = 0; $i < 4; $i++) {
                    ProductServiceArea::create([
                        'id_parent' => $id_area,
                        'order' => ((int)$i + 1),
                        'industry' => $detail['industry'][$i],
                        'mining' => $detail['mining'][$i],
                        'shipping' => $detail['shipping'][$i]
                    ]);
                }
            }

            return $id_area;

            // return redirect()->route("")->with('success', $data['judul'] . ' saved successfully!');
        } catch (\Exception $e) {
            Log::error($e);
            // return redirect()->route("")->with('failed', 'Failed to save '. $data['judul'] .'!');
        }
    }
}
?>