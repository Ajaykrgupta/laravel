@extends('WorkReport.layouts.layout')

@section("title",$title)

@section("content")
<style>
#row_1 td {
  width: 373px;
}
#add_more {
  cursor: pointer;
}
</style>
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                 <div class="x_title">
                    <h2><small>Add Work Report</small></h2>
                    <div class="clearfix"></div>
                  </div>
                        @if(Session::has('warning'))
                          @php echo Session::get('warning') @endphp
                        @endif 
                  <div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left input_mask" action="{{ url('WorkReport/storeworkreport') }}" id="formSubmit" method="POST">
                      @csrf
                     <div class="panel-heading">
                         <input type="radio"  name="workreport_date"     value="today_report" checked="checked"> Today Report
                       
                         <input type="radio"  name="workreport_date"    value="yesterday_report"> Yesterday Report
                     </div>
          <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
            <div class="table-responsive">
              
                <table class="table table-bordered table-responsive">
                  <thead>
                    <tr>
                          <th class="text-center"><b><i class="fa fa-clock-o  icons_txt" aria-hidden="true"></i> Project class</b></th>
                          <th class="text-center"><b><i class="fa fa-clock-o  icons_txt" aria-hidden="true"></i> Subcategory</b></th>
                          <th class="text-center"><b><i class="fa fa-tasks icons_txt" aria-hidden="true"></i> Task</b></th>
                          <th class="text-center"><b><i class="fa fa-clock-o  icons_txt" aria-hidden="true"></i> Hours</b></th>
                          <th class="text-center" style="color:#5cb85c;"><i class="fa fa-plus-circle fa-3x" aria-hidden="true" id="add_more"></i></th>
                      </tr>
                       </thead>
                      <tbody class="input_fields_wrap">
                      <tr class="element" id="row_1">
                            <td>
                               <select class="example form-control frm_field project" name="project_class[]" id="project_class1" data-show-subtext="true" data-row_id="1" onchange="getSubList('1')" data-live-search="true" required="">
                                    @php echo $projectList @endphp
                                  </select>
                            </td>
                            <td>
                              <select class="example form-control frm_field subcategory" onchange="getTaskList('1')" name="subcategory_class[]" id="subcategory_class1" data-show-subtext="true" data-live-search="true" required="">
                                    <option value="">Select Subcategory</option>
                                  </select>
                            </td>
                            <td>
                              <select class="example form-control frm_field task" name="task_class[]" id="task_class1" data-show-subtext="true" data-live-search="true" required="">
                                    <option value="">Select Task</option>
                                  </select>

                            </td>
                            <td> 
                                <select class="form-control frm_field hours11" name="hours[]" id="hours" required="">
                                    <option value="" disabled="" selected="" hidden="">Select hours...</option>
                                    <option value="0.15">0.15</option>
                                    <option value="0.30">0.30</option>
                                    <option value="0.45">0.45</option>
                                    <option value="1">1 </option>
                                    <option value="2">2 </option>
                                    <option value="3">3 </option>
                                    <option value="4">4 </option>
                                    <option value="5">5 </option>
                                    <option value="6">6 </option>
                                    <option value="7">7 </option>
                                    <option value="8">8 </option>
                                    <option value="9">9 </option>
                                    <option value="10">10 </option>
                                    <option value="11">11</option>
                                    <option value="12">12 </option>
                                </select>
                            </td>
                      </tr>
                    </tbody>
                     
                </table>
              
              </div>
            </div>
          </div>
          </div>
         <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <input type="submit" value="Submit" class="btn btn-success" id="submit1">
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <a href="{{ url('WorkReport/viewworkreport') }}" class="btn btn-danger">Cancel</a>
                          
                        </div>
                      </div>
                      <input type="hidden" name="count" id="count">
                      <input type="hidden" name="count" id="get_hours1" class="total" value="0">
                    </form>
                  </div>
                </div>

              </div>  

              <script>
                $(document).ready(function() {
                        var max_fields    = 11; 
                        var wrapper       = $(".input_fields_wrap"); //Fields wrapper
                        var add_button    = $("#add_more"); //Add button ID
                        var projectList   = "<?php echo $projectList ?>";
                        
                        var x = 1; //initlal text box count
                        $(add_button).click(function(e){ //on add input button click
                          e.preventDefault();
                          if(x < max_fields){ //max input box allowed
                            x++; //text box increment
                            $(wrapper).append('<tr class="element" id="row_'+x+'"><td><select class="example form-control frm_field project" onchange="getSubList('+x+')" name="project_class[]" id="project_class'+x+'" data-show-subtext="true" data-row_id="'+x+'" data-live-search="true" required="">"'+projectList+'"</select></td><td><select class="example form-control frm_field subcategory" onchange="getTaskList('+x+')" name="subcategory_class[]" id="subcategory_class'+x+'" data-show-subtext="true" data-live-search="true" required=""><option value="">Select subcategory</option></select></td><td><select class="example form-control frm_field task" name="task_class[]" id="task_class'+x+'" data-show-subtext="true" data-live-search="true" required=""><option value="">Select Task</option></select></td><td><select class="form-control frm_field hours11" name="hours[]" id="hours" required=""><option value="" disabled="" selected="" hidden="">Select hours...</option><option value="0.15">0.15 </option><option value="0.30">0.30</option><option value="0.45">0.45</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select></td><td><button class="btn btn-danger remove_field" data-id="'+x+'" value="'+x+'">X</button></td></tr>'); 
                          }
                        });
                        
                        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                          e.preventDefault(); 
                          var id = $(this).val();
                          $("#row_"+id).remove();
                          x--;
                        })

                        //final submit
                        //Final Submit Cart Data
                       /*$("#formSubmit").submit(function(e){
                          var data = $("#formSubmit").serialize();
                          var csrfToken = '{{ csrf_token() }}';
                          $.ajax({
                                     method: "POST",
                                     data: data,
                                     headers: {
                                                'X-CSRF-Token': csrfToken
                                            },
                                     url: "{{ URL::to('WorkReport/storeworkreport') }}",
                                     success: function(data)
                                     {
                                          
                                          console.log(data);

                                          /*if($('#result').html("<div class='alert  msgxyz alert-dismissible' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+data+"</div>"))
                                          {

                                              window.location.href = "{{ url('Specimen/dashboard/all') }}"; 
                                          }*/
                                   // }

                              //);
                        //});*/
                      });

   function getSubList(id)
   {
     var project_id = $("#project_class"+id).val();
     var csrfToken = '{{ csrf_token() }}';
     $.ajax({
              type:"POST",
              headers:{
                          'X-CSRF-Token': csrfToken
                      },
              url:"{{ URL::to('WorkReport/projectlist') }}"+"/"+project_id,
              success:function(response){
                  $("#subcategory_class"+id).html(response);
                }
          });
     
     }
     function getTaskList(id)
     {
        var project_id  = $("#project_class"+id).val();
        var subcategory = $("#subcategory_class"+id).val();
        var csrfToken   = '{{ csrf_token() }}';
        $.ajax({
              type:"POST",
              headers:{
                          'X-CSRF-Token': csrfToken
                      },
              url:"{{ URL::to('WorkReport/tasklist') }}"+"/"+project_id+"/"+subcategory,
              success:function(response){
                  $("#task_class"+id).html(response);
                }
          });
        
     }
  </script>
<script type="text/javascript">
  $(document).ready(function(){
      $("#submit1").click(function(){
          var sum = 0;
          $(".hours11").each(function(){
              sum += +$(this).val();
          });
          $(".total").val(sum);
          var check1 = $("#get_hours1").val();
          if(check1 > 12)
          {  
             alert("Working Hours Cannot  Exceed to 12 hours");
              $("#add_more").attr("disabled", "disabled");
               return false;
          }
      });
    });
</script>
@endsection