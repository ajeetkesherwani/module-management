<?php
namespace Modules\Setting\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\Setting\Models\Module;
use Modules\Setting\Models\ModuleSection;


class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $module_section = ModuleSection::where('parent_section_id',0)->get();
        $module_section1 = $module_section->map(function($data)  {
            $data->parentName=ModuleSection::where('parent_section_id',$data->section_id)->OrderBy('sort_order','ASC' )->get();
            return $data;
        });
        $module  = Module::with(['modulesection' => function ($query) 
        {
            $query->orderBy('sort_order', 'ASC')->where('parent_section_id',0);}])->OrderBy('sort_order','ASC' )->get();
        return view('Setting::moduleManagement.index',compact('module','module_section1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'module_name' => 'required',
        ]);
        $sort_order = Module::max('sort_order');
        $sort_order = $sort_order+1;

        $module = new Module();
        $module->module_name       = $request->module_name;
        if($request->module_icon == null){
            $module->module_icon == null;
        }
        else{
            $module->module_icon = $request->module_icon;
        }
        $module->sort_order        = $sort_order;
        $module->access_priviledge = $request->access_privilage;
        $module->module_slug       = Str::lower($request->module_name);
        $module->save();

        return response()->json(['status'=>1, 'success'=>'Module Added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        
    }
    public function addsection(Request $request)
   {
        $data = ModuleSection::where('module_id',$request->module_id)->max('sort_order');
        $sort_order = $data+1;

        $moduleSection = new ModuleSection();
        $moduleSection->module_id =  $request->module_id;
        $moduleSection->parent_section_id = $request->parent_section_id??0;
        $moduleSection->section_name = $request->section_name;
        $moduleSection->section_slug = Str::lower($request->section_name);

        if($request->section_icon == null){
            $moduleSection->section_icon == null;
        }
        else{
            $moduleSection->section_icon = $request->section_icon;
        }

        $moduleSection->section_url  = $request->section_url;
        $moduleSection->sort_order   = $sort_order;
        $moduleSection->save();

        return response()->json(['completion_status'=>1, 'message2'=>'Section added successfully']);
   }
   
   public function section(Request $request)
   {
        $module_id = $request->module_id;

        $moduleSection = ModuleSection::where('module_id',$module_id)->where('parent_section_id',0)->get();
         return json_encode($moduleSection);
   }
   public function changemoduleStatus(Request $request)
    {
        $changeStatus =  Module::find($request->module_id);
        $changeStatus->status = $request->status;
        $changeStatus->update();
        return response()->json(['status'=>1, 'message3'=>'Status Updated successfully']);
    }  
    public function changemoduleLiveStatus(Request $request)
    {
        $change_live_status =  Module::find($request->module_id);
        $change_live_status->completion_status = $request->completion_status;
        $change_live_status->update();
        return response()->json(['completion_status'=>1, 'message4'=>'Live status Updated successfully']);
    }  

    public function editmodule(Request $request)
    {
         
        $module =  Module::where('module_id' , $request->module_id)->first();
        return json_encode($module);
    }  
    public function updatemodule(Request $request)
    {
        $updateModule =  Module::find($request->module_id);
        $updateModule->module_name = $request->module_name;
        if($request->module_icon == null){
            $updateModule->module_icon == null;
        }
        else{
            $updateModule->module_icon = $request->section_icon;
        }
        $updateModule->access_priviledge = $request->access_priviledge;
        $updateModule->module_slug = Str::lower($request->module_name);
        $updateModule->update();
        return response()->json(['updated_status'=>1, 'message5'=>'Module Updated successfully']);
    }  

    public function editsection(Request $request)
    {
        $section =  ModuleSection::where('section_id' , $request->section_id)->first();
        $moduleId = $section->module_id;
        $moduleSection = ModuleSection::where('module_id',$moduleId)->where('parent_section_id',0)->get();
        $data['section']= $section;
        $data['module']= $moduleSection;
        return json_encode($data);
    }  

    public function changesectionStatus(Request $request)
    {
        $changes_section_status =  ModuleSection::find($request->section_id);
        $changes_section_status->status = $request->status;
        $changes_section_status->update();
        return response()->json(['status'=>1, 'message6'=>'Section status Updated successfully']);
    }  
    public function sectiondropdown(Request $request)
    {
        $module_id = $request->module_id;
        $module_section = ModuleSection::where('module_id',$module_id)->where('parent_section_id',0)->get('section_name');
         return json_encode($module_section);
    }
   public function updatesection(Request $request)
    {
        $updateSection =  ModuleSection::find($request->section_id);
        $updateSection->module_id =  $request->module_id;
        $updateSection->parent_section_id = $request->parent_section_id;
        $updateSection->section_name = $request->section_name;
        $updateSection->section_slug = Str::lower($request->section_name);
        if($request->section_icon == null){
            $updateSection->section_icon == null;
        }
        else{
            $updateSection->section_icon = $request->section_icon;
        }
        $updateSection->section_url  = $request->section_url;
        $updateSection->save();

        return response()->json(['updated_status'=>1, 'message7'=>'Section Updated successfully']);
    }  
    public function updatesectionsortorder(Request $request)
    {
        $update_section_sort_order =  ModuleSection::find($request->section_id);
        $update_section_sort_order->sort_order = $request->sort_order;
        $update_section_sort_order->update();
        return json_encode($update_section_sort_order);
    }  
    public function updatemodulesortorder(Request $request)
    {
        $update_module_sort_order =  Module::find($request->module_id);
        $update_module_sort_order->sort_order = $request->sort_order;
        $update_module_sort_order->update();
       return json_encode($update_module_sort_order);
    }
    public function changesectionLiveStatus(Request $request)
    {
        $change_live_status =  ModuleSection::find($request->section_id);
        $change_live_status->completion_status = $request->completion_status;
        $change_live_status->update();
        return response()->json(['completion_status'=>1, 'message8'=>'Live status Updated successfully']);
    }  
}
