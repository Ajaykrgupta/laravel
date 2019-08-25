<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\WorkReport\ProjectTbModel;
use Validator,Redirect,Response;
use Session;

class ProjectController extends Controller
{


	protected $title_name;
    protected $page_name;
    public function __construct()
    {
       $this->project_name = 'Project List';
       $this->page_name    = 'Project';
    }


    public function GetProjectList(Request $request)
    {
        $title = $this->project_name;
        $search_text = '';
        
        if(!empty($request->search_text))
        {
            $search_text = $request->search_text;
            $data = ProjectTbModel::select('*')->where('name', 'LIKE', '%'.$search_text.'%')->orderby('id','desc')->paginate(10);
        }
        else if(isset($_GET['name']))
        {
            $search_text = $_GET['name'];
            $data = ProjectTbModel::select('*')->where('name', 'LIKE', '%'.$search_text.'%')->orderby('id','desc')->paginate(10);
        }
        else
        {
    			
    		$data = ProjectTbModel::select('*')->orderby('id','desc')->paginate(10);
    		
        }
        return view('view_project', compact('title', 'data', 'search_text'));
    }

    public function StoreProject(Request $request)
    {
    	request()->validate([
			        'catelog' => 'required|max:10',
			        'name' => 'required',
			        'active' => 'required'
			    ]);
        $project_name=$request->name;
        $sql= ProjectTbModel::where('name',$project_name)->exists();
        if($sql) 
        {
           Session::flash('warning','<div class="alert alert-warning"><strong>Warning !</strong> Project is already Exist </div>');
        }
        else
        {
                $start_date = ($request->start_date) ? implode('-',array_reverse(explode('/',$request->start_date))) : '';
                $end_date   = ($request->end_date) ? implode('-',array_reverse(explode('/',$request->end_date))) : '';
                $obj        = new ProjectTbModel;
                $obj->catelog     = trim($request->catelog);
                $obj->name        = trim($request->name);
                $obj->start_date  = $start_date;
                $obj->end_date    = $end_date;
                $obj->status      = trim($request->active);
                $obj->created_at  = date('Y-m-d H:i:s');
                $obj->save();
                Session::flash('success','<div class="alert alert-success"><strong>Success!</strong> Insert Successfully.</div>');

        }
    	
    	return redirect('WorkReport/viewprojectlist');
    }


    public function editproject(Request $request)
    {
    	$id = $request->id;
    	$data = ProjectTbModel::where('id', $id)->first()->toarray();
    	return response()->json($data);
    }


    public function UpdateProject(Request $request)
    {
        $start_date = ($request->start_date) ? implode('-',array_reverse(explode('/',$request->start_date))) : '';
        $end_date   = ($request->end_date) ? implode('-',array_reverse(explode('/',$request->end_date))) : '';

    	$obj = array();
    	$id   = $request->project_id;
    	$obj['catelog']    = trim($request->Catelog);
    	$obj['name']       = trim($request->project_name);
        $obj['start_date'] = $start_date;
        $obj['end_date']   = $end_date;
    	$obj['status']     = trim($request->active);
    	$obj['updated_at'] = date('Y-m-d H:i:s');

        ProjectTbModel::where('id',$id)->update($obj);

    	Session::flash('success','<div class="alert alert-success"><strong>Success!</strong> Update Successfully.</div>');
    	 

    }


}
