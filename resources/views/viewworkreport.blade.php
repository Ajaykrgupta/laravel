@extends('WorkReport.layouts.layout')

@section("title",$title)

@section("content")
<script type="text/javascript">
  function getRandomizer(bottom, top) {
    return Math.floor( Math.random() * ( 1 + top - bottom ) ) + bottom;
    
}
</script>
<style>
#tableToExcel {
  text-align: center;
}
.search_form {
  width: 100%;
}
.search_form tr td {
  padding: 3px;
}
.search_form .form-control {
  width: 100%;
}
.btn {
  float: left;
}
#tableToExcel {
  width: 100%;
}

#tableToExcel td {
  border-collapse: collapse;
}

#tableToExcel thead {
  display: table; /* to take the same width as tr */
  width: calc(100% - 17px); /* - 17px because of the scrollbar width */
}

#tableToExcel tbody {
  display: block; /* to enable vertical scrolling */
  max-height: 500px; /* e.g. */
  overflow-y: scroll; /* keeps the scrollbar even if it doesn't need it; display purpose */
}

#tableToExcel th, td {
  width: 12.33%; /* to enable "word-break: break-all" */
  padding: 5px;
  word-break: break-all; /* 4. */
}
input[type=date]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    display: none;
}

</style>
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2><small>View Work Report</small></h2>
                    <div class="clearfix"></div>
                   <!--<div class='col-sm-4'>
                    Linked Picker Parent
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker6'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>-->
           </div>
           <div class="x_content">
            <?php
             /*echo $rtd;
             echo  $rfd;*/
            ?>

              <form class="form-inline" method="POST" action="{{ url('WorkReport/viewworkreport') }}">
                  @csrf
                    <table class="table-bordered table-striped table-responsive search_form">
                       @if(Session::get('is_manager'))
                      <tr>
                          <td>Team Members</td>
                          <td>
                               <select id="team"  class="form-control" name="team[]">
                                  @php echo $empList @endphp
                               </select>
                          </td>
                          <td>From Date</td>
                          <td>
                            <div class='input-group date datetimepicker'>
                                <input type='text' class="form-control"  id="from_date" name="from_date" value="{{ $rfd }}"/>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                           </div>
                            <!--<input type="date" id="from_date" name="from_date" class="form-control" required="">  -->
                            <!--<input type="text" id="datepicker"> -->
                          </td>
                          <td>To Date</td>
                          <td>
                          <div class='input-group date datetimepicker'>
                                <input type="text" id="to_date" name="to_date" class="form-control" required="" value="{{ $rtd }}">
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                           </div>
                          <!--<input type="date" id="to_date" name="to_date" class="form-control" required=""> -->
                      </td>
                      </tr>
                      <tr>
                        <td colspan="5"></td>
                          <td><span style="float:right">
                             <button type="submit" class="btn btn-primary">Get Data</button> 
                              <a href="{{ url('WorkReport/excel') }}" class="btn btn-danger">Download</a></span>
                         </td>
                      </tr>
                      @else
                       <tr>
                          <td>From Date</td>
                          <td>
                            <div class='input-group date datetimepicker'>
                                <input type='text' class="form-control"  id="from_date" name="from_date" required="" value="{{ $rfd }}"/>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                           </div>
                             <!--<input type="date" id="from_date" name="from_date" class="form-control" required="">  -->
                             <!--<input type="text" id="datepicker"> -->
                          </td>
                          <td>To Date</td>
                          <td>
                          <div class='input-group date datetimepicker'>
                                <input type="text" id="to_date" name="to_date" class="form-control" required="" value="{{ $rtd }}">
                                <span class="input-group-addon">
                                   <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                           </div>
                          <!--<input type="date" id="to_date" name="to_date" class="form-control" required=""> -->
                      </td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                          <td><span style="float:right">
                             <button type="submit" class="btn btn-primary">Get Data</button> 
                              <a href="{{ url('WorkReport/excel') }}" class="btn btn-danger">Download</a></span>
                         </td>
                      </tr>
                       @endif

                    </table>
                </form>
                <br/>
                        @if(Session::has('success'))
                            @php echo Session::get('success') @endphp
                        @endif 
                        
                 <br/>
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action table-bordered" id="tableToExcel">
                        <thead>
                          <tr class="headings">
                                    <th class="column-title text-center">Name</th>
                                    <th class="column-title text-center">Project Class<br/>(Use the names given in the "Project List" tab)</th>
                                    <th class="column-title text-center">Subcategory project</th>
                                    <th class="column-title text-center">Task<br/>(For example: brief creation, UI review)</th>
                                    <th class="column-title text-center">Working Hours<br/>(Numbered values ONLY.. e.g.1 hr) </th>
                                    <th class="column-title text-center">Total Working Hours<br/>(Numbered values ONLY.. e.g.1 hr)</th>
                                    <th class="column-title text-center">Task Date</th>
                                    <th class="column-title text-center">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                          @php echo $html @endphp
                         <!--@if(count($data) > 0)
                          @php $i = $data->perPage() * ($data->currentPage() -1) + 1; @endphp
                             @foreach($data as $row)
                                 <tr>
                                    <td>{{ $i }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                 </tr>
                                 @php $i++ @endphp
                             @endforeach
                           @endif
                           @if(count($data)==0)
                            <tr><td colspan="7" class="text-center">No data available in table</td></tr>
                           @endif--> 
                     </tbody>
                </table>
             </div>
          </div>
        </div>
      </div>

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
 