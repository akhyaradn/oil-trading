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

    public function deleteProductService($id, Request $request) {
        try {
            ProductService::where('id', $id)->delete();
            return redirect()->route("productServiceList")->with(['success' => 'Deleted successfully!']);
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route("productServiceList")->with(['failed' => 'Delete failed!']);
        }
    }

    public function productServiceList($flag = null, Request $request) {
        if($flag != null) {
            $flag = 'draft';
        }

        $data = [
            'datatable_flag' => $flag
        ];

        return view('CMS.pages.productservice-list')->with($data);
    }

    public function datatableProductService(Request $request) {
        $flag = $_POST['flag'];

        $totalData = $totalFiltered = ProductService::where('flag_active', $flag)->count();

        $limit = $request->input('length');

        $start = $request->input('start');

        if(empty($request->input('search.value'))) {

            $productservice = ProductService::where('flag_active', $flag)
                        ->orderBy('created_at', 'desc')
                        ->offset($start)
                        ->limit($limit)
                        ->get();

        } else {

        $search = $request->input('search.value'); 

        $productservice = ProductService::where('judul', 'like', "%{$search}%")
                    ->where('flag_active', $flag)
                    ->orderBy('created_at', 'desc')
                    ->offset($start)
                    ->limit($limit)
                    ->get();

        $totalFiltered = News::where('judul', 'like', "%{$search}%")
                        ->where('flag_active', $flag)
                        ->count();
        }

        $data = array();

        if(!empty($productservice))
        {
            $i = $start + 1;

            foreach ($productservice as $k)
            {
                $nestedData['no'] = $i;
                $nestedData['judul'] = $k->judul;
                //button modal detail channel
                $nestedData['detail'] = 
                '<a class="btn btn-xs btn-info" 
                    href="'. route('formProductService', ['id' => $k->id]) .'"
                    target="_blank"
                >Edit</a>';
                // jarak button
                $nestedData['detail'] .= 
                '&nbsp;';
                // button modal delete channel
                $nestedData['detail'] .= "
                    <a class='btn btn-xs btn-danger delete-productservice'
                        data-id='{$k->id}'
                        data-judul='{$k->judul}'
                    >Delete</a>
                ";
                $data[] = $nestedData;

                $i++;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data,
            "id" => $request->id
            );

        echo json_encode($json_data);
    }
}
?>