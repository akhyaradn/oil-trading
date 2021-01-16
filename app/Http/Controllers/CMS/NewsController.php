<?php
namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use Log;

class NewsController extends Controller 
{
    public function submitNews($id = null, Request $request) {

        try {
            $data = [
                'judul' => $request->judul,
                'img' => $request->file('img')->getClientOriginalName(),
                'konten' => $request->news,
                'flag_active' => $request->flag_active == 'on' ? 1 : 0,
                'id_penulis' => 1
            ];
            
            $data = array_filter($data, function($v, $x){
                if($v || $x == 'flag_active') return $x;
            }, ARRAY_FILTER_USE_BOTH);

            if($id) {
                News::where('id', $id)
                    ->update($data);
            } else {
                News::create($data);
            }

            if($data['img'])
                $request->file('img')->move('img_cover', $data['img']);

        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
?>