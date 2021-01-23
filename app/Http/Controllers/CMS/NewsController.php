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

    public function deleteNews($id, Request $request) {
        try {
            News::where('id', $id)->delete();
            return redirect()->route("newsList")->with(['success' => 'Deleted successfully!']);
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route("newsList")->with(['failed' => 'Delete failed!']);
        }
    }

    public function newsList($flag = null, Request $request) {
        if($flag != null) {
            $flag = 'draft';
        }

        $data = [
            'datatable_flag' => $flag
        ];

        return view('CMS.pages.news-list')->with($data);
    }

    public function datatableNews(Request $request) {
        $flag = $_POST['flag'];

        $totalData = $totalFiltered = News::where('flag_active', $flag)->count();

        $limit = $request->input('length');

        $start = $request->input('start');

        if(empty($request->input('search.value'))) {

            $news = News::where('flag_active', $flag)
                        ->orderBy('created_at', 'desc')
                        ->offset($start)
                        ->limit($limit)
                        ->get();

        } else {

        $search = $request->input('search.value'); 

        $news = News::where('judul', 'like', "%{$search}%")
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

        if(!empty($news))
        {
            $i = $start + 1;

            foreach ($news as $k)
            {
                $nestedData['no'] = $i;
                $nestedData['judul'] = $k->judul;
                //button modal detail channel
                $nestedData['detail'] = 
                '<a class="btn btn-xs btn-info" 
                    href="'. route('formNews', ['id' => $k->id]) .'"
                    target="_blank"
                >Edit</a>';
                // jarak button
                $nestedData['detail'] .= 
                '&nbsp;';
                // button modal delete channel
                $nestedData['detail'] .= "
                    <a class='btn btn-xs btn-danger delete-news'
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