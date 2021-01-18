<?php
namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use Log;

class NewsController extends Controller 
{
    public function formData($id = null, Request $request) {
        $news = null;

        if($id) {
            $news = News::where('id', $id)->first();
        }

        return view('CMS.pages.news')->with(['news' => $news]);
    }

    public function submitNews($id = null, Request $request) {

        try {
            $data = [
                'judul' => $request->judul,
                'img' => $request->file('img')->getClientOriginalName(),
                'konten' => $request->news,
                'id_penulis' => 1
            ];
            
            $data = array_filter($data, function($v, $k){
                if($v || $k == 'flag_active') return $v;
            }, ARRAY_FILTER_USE_BOTH);

            if($id) {
                // tambah field flag_active
                $data['flag_active'] = empty($request->flag_active) ? 0 : 1;

                News::where('id', $id)
                    ->update($data);
            } else {
                // tambah field flag_active
                $data['flag_active'] = empty($request->flag_active) ? 0 : 1;

                News::create($data);
            }

            if($data['img'])
                $request->file('img')->move('img_cover', $data['img']);

            return redirect()->route("formNews", ['id' => $id])->with(['success' => $data['judul'] . ' saved successfully!']);
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route("formNews", ['id' => $id])->with(['failed' => 'Failed to save '. $data['judul'] .'!']);
        }
    }
}
?>