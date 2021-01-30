<?php
namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Log;


class ContactUsController extends Controller
{
    public function index($flag = null, Request $request) {
        if($flag != null) {
            $flag = 'trash';
        }

        $data = [
            'datatable_flag' => $flag
        ];

        return view("CMS.pages.message-list")->with($data);
    }

    public function flagMessage($type, $id, Request $request) {
        try {
            if($type && $id) {
                if($type == 'trash') {
                    $success = 'Moved to trash!';
                    $failed = 'Failed to move to trash!';
                    ContactUs::where('id', $id)->update(['flag_active' => 0]);
                } else if ($type == "delete" ){
                    $success = 'Deleted successfully!';
                    $failed = 'Delete failed!';
                    ContactUs::where('id', $id)->delete();
                } else {
                    $success = 'Restored successfully!';
                    $failed = 'Restore failed!';
                    ContactUs::where('id', $id)->update(['flag_active' => 1]);
                }
            }

            return redirect()->route("messagesList")->with(['success' => $success]);
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route("messagesList")->with(['failed' => $failed]);
        }
    }

    public function datatableContactUs(Request $request) {
        $flag = $request->flag;

        $totalData = $totalFiltered = ContactUs::where('flag_active', $flag)->count();

        $limit = $request->input('length');

        $start = $request->input('start');

        if(empty($request->input('search.value'))) {

            $news = ContactUs::where('flag_active', $flag)
                        ->orderBy('created_at', 'desc')
                        ->offset($start)
                        ->limit($limit)
                        ->get();

        } else {

        $search = $request->input('search.value'); 

        $news = ContactUs::where('nama', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%")
                    ->where('flag_active', $flag)
                    ->orderBy('created_at', 'desc')
                    ->offset($start)
                    ->limit($limit)
                    ->get();

        $totalFiltered = ContactUs::where('nama', 'like', "%{$search}%")
                        ->orWhere('company_name', 'like', "%{$search}%")
                        ->orWhere('message', 'like', "%{$search}%")
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
                $nestedData['nama'] = $k->nama;
                $nestedData['company_name'] = $k->company_name;
                $nestedData['message'] = strlen($k->message) > 100 ? substr($k->message, 0, 100) . "..." : $k->message;
                $nestedData['date'] = date("d M Y H:i", strtotime($k->created_at));
                //button modal detail channel
                $nestedData['detail'] = 
                "<a class='btn btn-xs btn-info' 
                    data-toggle='modal'
                    data-target='#message-detail'
                    data-nama='{$k->nama}'
                    data-company_name='{$k->company_name}'
                    data-company_address='{$k->company_address}'
                    data-message='{$k->message}'
                    data-created_at='". date("d M Y H:i" , strtotime($k->created_at))."'
                    data-contact='{$k->contact}'
                    data-email='{$k->email}'
                >Show detail</a>";

                // jarak button
                $nestedData['detail'] .= '<br>';

                // Move to trash
                if($flag == 1) {
                    $nestedData['detail'] .= 
                    "<a class='btn btn-xs btn-danger move-to-trash' 
                        data-id='{$k->id}'
                        data-nama='{$k->nama}'
                        data-company_nama='{$k->company_nama}'
                    >Move to trash</a>";
                }


                if($flag == 0) {
                    // Restore
                    $nestedData['detail'] .= 
                    "<a class='btn btn-xs btn-success restore' 
                        data-id='{$k->id}'
                        data-nama='{$k->nama}'
                        data-company_nama='{$k->company_nama}'
                    >Restore</a>";

                    // jarak button
                    $nestedData['detail'] .= '<br>';

                    // Delete
                    $nestedData['detail'] .= 
                    "<a class='btn btn-xs btn-danger delete' 
                        data-id='{$k->id}'
                        data-nama='{$k->nama}'
                        data-company_nama='{$k->company_nama}'
                    >Delete</a>";
                }

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