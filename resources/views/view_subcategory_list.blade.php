@extends('WorkReport.layouts.layout')

@section("title",$title)

@section("content")
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Subcategory Project List</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="search_bar" style="margin-bottom: 14px;">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#InsertDataModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Subcategory</button>
                     <form class="form-inline" method="POST" action="{{ url('WorkReport/viewsubcategory') }}" style="float:right">
                         @csrf
                           <input type="text" id="search_text" name="search_text" class="form-control" required="" value="<?php echo $search_text; ?>" placeholder="Search Subcategory...">
                           <input type="submit" class="btn btn-primary" value="Get Data">
                           <a href="{{ url('WorkReport/viewsubcategory') }}" class="btn btn-primary">Reset</a>
                       </form>
                     </div>
                 
   <div class="x_content" >
                 @if(Session::has('success'))

              @php echo Session::get('success') @endphp

            @endif 
                    <div class="table-responsive ">
                      <table class="table table-striped jambo_table bulk_action table-bordered">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">S.NO.</th>
                            <th class="column-title">Subcategory Name</th>
                            <th class="column-title">Project Name</th>
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
                                   <td class=" " class=" ">{{ $row['subcategory_name'] }}</td>
                                   <td class=" ">{{ $row['name'] }}</td>
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
                     @php $querystringArray = ['subcategory_name' => $search_text] @endphp
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
                <h4 class="modal-title">Add Category</h4>
            </div>
                   <div class="modal-body">
                             <form class="form-horizontal" method="POST" action="{{ url('WorkReport/subcategorystore') }}" enctype="multipart/form-data">
                              @csrf
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Category Name</label>
                                    <div class="col-sm-9">
                                      <input type="text"  name="subcategory_name" class="form-control" id="subcategory_name" placeholder="Category name" required >
                                    </div>
                                </div>
                                  <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-3 control-label">Project Name</label>
                                      <div class="col-sm-9">
                                        <select name="project_id" id="project_id" class="form-control" required>
                                          @php echo $projectList @endphp
                                        </select>
                                        
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
            <h4 class="modal-title"><i class="fa fa-pencil info_header" aria-hidden="true"></i> Edit Sub Category</h4>
          </div>
           <div class="modal-body">
                              <input type="hidden" id="sub_cat_id" value="" placeholder="" class="form-control" name="sub_cat_id"/>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Caterory Name</label>
                                    <div class="col-sm-9">
                                      <input type="text"  name="category" class="form-control" id="category" placeholder="Category Name" required >
                                    </div>
                                </div>
                                  <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-3 control-label">Project Name</label>
                                      <div class="col-sm-9">
                                        <select name="project_edit_id" id="project_edit_id" class="form-control" required>
                                       @php echo $projectList @endphp
                                       </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-9">
                                             <select name="status" class="form-control" id="status" required>
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
                       url: "{{ URL::to('WorkReport/editsubproject') }}",
                       data: {id:id},
                       success: function(data)
                       {
                           var obj = data;
                           $("#sub_cat_id").val(obj.id);
                           $('#category').val(obj.subcategory_name);
                           $('#project_edit_id').val(obj.project_id);
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
             url: "{{ URL::to('WorkReport/updatesubproject') }}",
             success: function(data)
             {

              location.reload();
             }
         
          });

    }

  </script>
@endsection