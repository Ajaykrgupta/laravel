@extends('WorkReport.layouts.layout')

@section("title",$title)

@section("content")
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>User List</small></h2>
                  
                    <div class="clearfix"></div>
                  </div>
                    <form class="form-inline" method="POST" action="{{ url('WorkReport/userlist') }}" style="float:right">
		                     @csrf
		                       <input type="text" id="search_text" name="search_text" class="form-control" required="" value="<?php echo $search_text ?>"  placeholder="Search Username...">
		                       <input type="submit" class="btn btn-primary" value="Get Data">
		                       <a href="{{ url('WorkReport/userlist') }}" class="btn btn-primary">Reset</a>
		                   </form>
             <div class="x_content">
 					<br/>
                    @if(Session::has('success'))
				    	{{ Session::get('success') }}
				    @endif 
                    <div class="table-responsive ">
                      <table class="table table-striped jambo_table bulk_action table-bordered">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">S.No</th>
							<th class="column-title">First name</th>
							<th class="column-title">Middle Name</th>
							<th class="column-title">Last Name</th>
							<th class="column-title">Email</th>
							<th class="column-title">Phone</th> 
							<th class="column-title">Address</th>
						    <th class="column-title">Status</th>
						  </tr>
                        </thead>
                        <tbody>
                          <?php $i = $data->perPage() * ($data->currentPage() -1) + 1; ?>
                              @if(!empty($data))	
							  @foreach($data as $index => $row)
									      <tr class="even pointer">
									  	  	<td class=" "><?php echo $i ?></td>
									  	  	<td class=" "><?php echo $row['fname'];?></td>
									  	  	<td class=" "><?php echo $row['mname'];?></td>
									  	  	<td class=" "><?php echo $row['lname'];?></td>
									  	  	<td class=" "><?php echo $row['email'];?></td>
									  	  	<td class=" "><?php echo $row['mobile_no_sms'];?></td> 
									  	  	<td class=" "><?php echo $row['address'];?></td>
									  	  	<td class=" ">
									  	  		@if($row['status'] == 'Active')
									  	  			<span class="label label-success"><?php  echo $row['status']; ?></span>
									  	  		@endif
									  	  		@if($row['status'] == 'Inactive')
									  	  		<span class="label label-danger"><?php  echo $row['status']; ?></span>
									  	  		@endif
									  	  		</td>
									  	  </tr>
								  	<?php $i++ ?>
								 @endforeach
								 @endif
								 @if(count($data)==0)
				                   <tr><td colspan="8" class="text-center">No Recored</td></tr>
				                 @endif  
				</tbody>
                </table>
                	  @php $querystringArray = ['fname' => $search_text] @endphp
                      {{ $data->appends($querystringArray)->links() }}
                    </div>
					</div>
			</div>
			</div>		


@endsection


