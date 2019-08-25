@extends('layouts.layout')

@section("title",$title)

@section("content")
<style type="text/css">
  .glyphicon.glyphicon-calendar {
    margin-left: 17px;
}
.extra_margin_date{
   margin-left: 17px;
}
</style>
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Project List</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#InsertDataModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Project</button>
                        <form class="form-inline" method="POST" action="{{ url('viewprojectlist') }}" style="float:right">
                         @csrf
                           <input type="text" id="search_text" name="search_text" class="form-control" required="" value="<?php echo $search_text; ?>" placeholder="Search Project Name...">
                           <input type="submit" class="btn btn-primary" value="Get Data">
                           <a href="{{ url('viewprojectlist') }}" class="btn btn-primary">Reset</a>
                       </form>
    <div class="x_content">
                    @if(Session::has('success'))

				    	         @php echo Session::get('success') @endphp

				    @endif 
                  @if(Session::has('warning'))

                       @php echo Session::get('warning') @endphp

            @endif 
				    <br/><br/>
                    <div class="table-responsive ">
                      <table class="table table-striped jambo_table bulk_action table-bordered">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">S.NO.</th>
              							<th class="column-title">Catelog</th>
              							<th class="column-title">Project Name</th>
                            <th class="column-title">Start Date</th>
                            <th class="column-title">End Date</th>
              							<th class="column-title">Status</th>
              							<th class="column-title">Created Date</th>
              							<th class="column-title">Action</th> 
              						  </tr>
                        </thead>
                        <tbody>
               <?php $i = $data->perPage() * ($data->currentPage() -1) + 1; ?>
                  @if(!empty($data))
                  @foreach($data as $row)
                		<tr class="even pointer">
                                  <td class=" ">{{ $i }}</td>
                                   <td class=" " class=" ">{{ $row['catelog'] }}</td>
                                   <td class=" ">{{ $row['name'] }}</td>
                                   <td class=" "><?php echo ($row['start_date']!='0000-00-00 00:00:00') ? date('d-m-Y', strtotime($row['start_date'])) : '' ?></td>
                                   <td class=" "><?php echo ($row['end_date']!='0000-00-00 00:00:00') ? date('d-m-Y', strtotime($row['end_date'])) : '' ?></td>
                                   <td class=" ">
                                  	@if($row['status'] == 1)
                                  	<span class='label label-success'>Active</span>
                                  	@else
                                  	<span class='label label-warning'>Inactive</span>
                                  	@endif	
                                  </td>
                                 <td class=" "><?php echo $row['created_at'] ? date('d-m-Y H:i:s', strtotime($row['created_at'])) : '' ?></td>
                                  <td class=" ">
             <button type='button' class='btn btn-primary edit_button modal_btn  active' data-toggle='modal' onclick="edit_data({{ $row["id"] }})" data-target='#EditDataModal' id='{{ $row["id"] }}'><i class='fa fa-pencil' aria-hidden='true'></i> Edit</button></td>
                           </tr>
                        @php $i++ @endphp   	
                @endforeach
                @endif
                @if(count($data)==0)
                
                  <tr><td colspan="6" class="text-center">No Record</td></tr>
                
                @endif  


				</tbody>
                </table>
                      @php $querystringArray = ['name' => $search_text] @endphp
                      {{ $data->appends($querystringArray)->links() }}
                    </div>
					</div>

</div>
</div>


 
<div class="modal fade" id="InsertDataModal" role="dialog">
      <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Project</h4>
            </div>
                   <div class="modal-body">
                             <form class="form-horizontal" method="POST" action="{{ url('projectstore') }}" enctype="multipart/form-data">
                             	@csrf
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Catelog</label>
                                    <div class="col-sm-9">
                                      <input type="text"  name="catelog" class="form-control" id="catelog" placeholder="Catelog" maxlength="10" required >
                                    </div>
                                </div>
                                  <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-3 control-label">Project Name</label>
                                      <div class="col-sm-9">
                                        <input type="text"  name="name" class="form-control" id="name" placeholder="Project Name" required >
                                      </div>
                                  </div>
                                    <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-3 col-md-3 control-label">Start Date</label>
                                         <div class='input-group date datetimepicker col-md-8'>
                                              <input type='text' class="form-control extra_margin_date"  id="start_date" name="start_date"/>
                                              <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                        </div>
                                    </div>
                                   <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-3 col-md-3 control-label">End Date</label>
                                         <div class='input-group date datetimepicker col-md-8'>
                                              <input type='text' class="form-control extra_margin_date"  id="end_date" name="end_date"/>
                                              <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                        </div>
                                    </div>
                                  <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-9">
                                             <select name="active" class="form-control" required>
                                                  <option value="">Select Status</option>
                                                  <option value="1">Active</option>
                                                  <option value="0">Inactive</option>
                                             </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="col-sm-offset-3 col-sm-9">
                                          <input  type="submit" class="btn btn-primary" name="submit" value="Submit">
                                       </div>
                                    </div>
                             </form>
                 </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
        </div>
        
      </div>
  </div>
  <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data" id="edit_form">
   <div id="EditDataModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
      	@csrf
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><i class="fa fa-pencil info_header" aria-hidden="true"></i> Edit Project</h4>
          </div>
           <div class="modal-body">
                              <input type="hidden" id="project_id" value="" placeholder="" class="form-control" name="project_id"/>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Catelog</label>
                                    <div class="col-sm-9">
                                      <input type="text"  name="Catelog" class="form-control" id="catelog1" placeholder="catelog" required maxlength="10">
                                    </div>
                                </div>
                                  <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-3 control-label">Project Name</label>
                                      <div class="col-sm-9">
                                        <input type="text"  name="project_name" class="form-control" id="project_name" placeholder="Project Name" required >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-3 col-md-3 control-label">Start Date</label>
                                         <div class='input-group date datetimepicker col-md-8'>
                                              <input type='text' class="form-control extra_margin_date"  id="start_date1" name="start_date"/>
                                              <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                        </div>
                                    </div>
                                   <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-3 col-md-3 control-label">End Date</label>
                                         <div class='input-group date datetimepicker col-md-8'>
                                              <input type='text' class="form-control extra_margin_date"  id="end_date1" name="end_date"/>
                                              <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                        </div>
                                    </div>
                                  <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-9">
                                             <select name="active" class="form-control" id="status" required>
                                                  <option value="">Select Status</option>
                                                  <option value="1">Active</option>
                                                  <option value="0">Inactive</option>
                                             </select>
                                        </div>
                                       
                                    </div>
                                      <div class="form-group">
                                       <div class="col-sm-offset-3 col-sm-9">
                                          <button type="button" class="btn btn-primary" id="submitbtnnt" onclick="UpdateProject()">Update</button>
                                       </div>
                                     </div>
                                    
                             
          </div>
        
           <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
          </form>

  <link rel="stylesheet" href="{{ url('assets/layout/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
  <script src="{{ url('assets/layout/js/jquery.min.js') }}"></script>
  <script src="{{ url('assets/layout/js/bootstrap.min.js') }}"></script>
  <script type="text/javascript">
  	    function edit_data(id)
  			{
  				var id = id;
  				var csrfToken = '{{ csrf_token() }}';
					  $.ajax({
					             type: "POST",
					             
					             headers: {
					                        'X-CSRF-Token': csrfToken
					                    },
					             url: "{{ URL::to('editproject') }}",
					             data: {id:id},
					             success: function(data)
					             {
					                 var obj = data;
					                 $("#project_id").val(obj.id);
					                 $('#catelog1').val(obj.catelog);
					                 $('#project_name').val(obj.name);
                          
                           var datetime1 = obj.start_date;
                           var date1     = datetime1.split(' ')[0];

                           var datetime2 = obj.end_date;
                           var date2     = datetime2.split(' ')[0];

                           $("#start_date1").val(date1);
                           $("#end_date1").val(date2);
					                 $('#status').val(obj.status);

					            }

					      });
  			}

  	function UpdateProject(){
   		var formdata = $('#edit_form').serialize();
   		var csrfToken = '{{ csrf_token() }}';
		  $.ajax({
		         data:formdata,
		         type: "POST",
		         headers: {
				           'X-CSRF-Token': csrfToken
					      },
		         url: "{{ URL::to('updateproject') }}",
		         success: function(data)
		         {
		     		 location.reload();
		         }
		     
		      });

		}
  </script>
  <script>
    $.noConflict();
    jQuery(document).ready(function (e){
       $('.datetimepicker').datetimepicker({
                 format: 'DD/MM/YYYY'
           });
     /* $('.datetimepicker').datetimepicker();*/

  });
</script>
@endsection