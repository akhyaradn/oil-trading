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
    public function formData($id = null, Request $request) {
        $data = [
            'area' => null,
            'product_service' => null
        ];

        if($id) {
            $product_service = ProductService::where('id', $id)->first();
            $area = ProductServiceArea::where('id_parent', $id)->orderBy('order')->get();

            $data = [
                'product_service' => $product_service ? $product_service->toArray() : null,
                'area' => $area ? $area->toArray() : null
            ];
        }

        return view('CMS.pages.productservice')->with($data);
    }

    public function submitProductService($id = null, Request $request) {
        try {
            $data = [
                'judul' => $request->judul,
                'paragraf_awal' => $request->paragraf_awal,
                'paragraf_akhir' => $request->paragraf_akhir
            ];

            // Remove array key jika value tidak ada. Mencegah kolom di DB tdk terupdate dgn null
            $data = array_filter($data, function($v){
                if($v) return $v;
            }, ARRAY_FILTER_USE_BOTH);

            $detail = [
                'industry' => $request->industry,
                'mining' => $request->mining,
                'shipping' => $request->shipping,
                'id_area' => $request->id_area
            ];

            // Remove array key jika value tidak ada. Mencegah kolom di DB tdk terupdate dgn null
            $detail = array_filter($detail, function($v){
                if($v) return $v;
            }, ARRAY_FILTER_USE_BOTH);

            if(!$id) {
                // tambah field created_at & updated_at hanya utk insertgetid
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                // tambah field flag_active
                $data['flag_active'] = empty($request->flag_active) ? 0 : 1;

                $id = DB::table('product_service')
                            ->insertGetId($data);

                for($i = 0; $i < 4; $i++) {
                    ProductServiceArea::create([
                        'id_parent' => $id,
                        'order' => ((int)$i + 1),
                        'industry' => $detail['industry'][$i],
                        'mining' => $detail['mining'][$i],
                        'shipping' => $detail['shipping'][$i]
                    ]);
                }
            } else {
                // tambah field created_at & updated_at hanya utk insertgetid
                $data['updated_at'] = date("Y-m-d H:i:s");
                // tambah field flag_active
                $data['flag_active'] = empty($request->flag_active) ? 0 : 1;

                ProductService::where('id', $id)
                ->update($data);
                
                for($i = 0; $i < 4; $i++) {
                    ProductServiceArea::where('id', $detail['id_area'][$i])
                    ->update([
                        'id_parent' => $id,
                        'order' => ((int)$i + 1),
                        'industry' => $detail['industry'][$i],
                        'mining' => $detail['mining'][$i],
                        'shipping' => $detail['shipping'][$i]
                    ]);
                }
            }

            return redirect()->route("formProductService", ['id' => $id])->with(['success' => $data['judul'] . ' saved successfully!']);

        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route("formProductService", ['id' => $id])->with(['failed' => 'Failed to save '. $data['judul'] .'!']);
        }
    }
}
?>