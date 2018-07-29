@extends('layouts.app')

@section('style')

<style type="text/css">
	
</style>
@endsection

@section('content')






<div class="container">
	

	<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Ports Of Discharge</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead align="center">
		<tr>
			<th align="center">
				ID:
			</th>
			<th align="center" colspan="1">
				City:
			</th>
			<th align="center" colspan="1">
				Actions:
			</th>
		</tr>
	</thead>
         <tbody style="font-weight: bold;">
		@foreach($portofdischarges as $portofdischarge)
		<tr>
			<td height="40" align="center">
				{{$portofdischarge->id}}
			</td>
			<td height="40" align="center">
				{{$portofdischarge->city}}
			</td height="40" align="center">
			<td align="center">
				<button id="{{$portofdischarge->id}}" class="btn btn-primary col-sm-4 editButton" data-toggle="modal" data-target="#exampleModalCenter_edit">Edit</button>&emsp;
         <button id="{{$portofdischarge->id}}" type="button" class="btn btn-danger col-sm-4 delete-data" data-toggle="modal" data-target="#exampleModalCenter_delete">Delete</button>
			</td>
		</tr>
		@endforeach
	</tbody>
            </table>
            <br>
    <button style="float: right;" type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModalCenter">
 		 Add Port
	</button>

          </div>
        </div>
      </div>

    </div>

</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5 class="modal-title" id="exampleModalCenterTitle">Add New Destination</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p style="font-weight: bold;">Name </p>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="newDestination"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="add_port_of_discharge">Add</button>
      </div>
    </div>
  </div>
</div> 



<!-- Modal sa Update -->
<div class="modal fade" id="exampleModalCenter_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Destination </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p style="font-weight: bold;">Name </p>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="updateDestination"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="edit_port_of_discharge">Update</button>
      </div>
    </div>
  </div>
</div> 


<!-- delete modal -->
<div class="modal fade bd-example-modal-sm" id="exampleModalCenter_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <p style="font-weight: bold; text-align: center;"> Do you want to delete the selected Destination? </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
        <button type="button" class="btn btn-danger" id="delete-button">Delete</button>
      </div>
    </div>
  </div>
</div>



@endsection

@section('scripts')


<script type="text/javascript">
		$(document).ready(function() {
 			 //$('#dataTable').DataTable();

 			 $('#add_port_of_discharge').click(function(e){

 			 	e.preventDefault();
 			 	var input = $('#newDestination').val();
 			 	// console.log(input);

 			 	$.ajaxSetup({
 			 		headers:{
 			 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 			 		}
 			 	});

 			 	$.ajax({
 			 		url: "{{ url('/portofdischarge') }}",
 			 		method: 'post',
 			 		data: {
 			 			city: input
 			 		},
 			 		success: function(res){
 			 			//console.log(res);
 			 			window.location.href='{{route("portofdischarge.index")}}';
 			 		}
 			 	})

 			 });

 			 $('.editButton').click(function(e) {
 			 	e.preventDefault();
 			 	const myValue = $(this).attr('id');
 			 	let city = $(this).closest('tr').find('td:eq(1)').text();

 			 	$('#updateDestination').val(city.trim());
 			 


 			 	 $('#edit_port_of_discharge').click(function(e) {
 			 	 	e.preventDefault();
 			 	 	
 			 	 	let editInput = $('#updateDestination').val();
 			 	 	//console.log("{{ url('/supplier') }}" + '/'+ myValue);
 			 	 	$.ajaxSetup({
 			 		headers:{
 			 				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 			 			}
 			 		});

 			 		$.ajax({
 			 			url: "{{ url('/portofdischarge') }}" + '/'+ myValue,
 			 			method: 'put',
 			 			data: {
 			 				city: editInput
 			 			},
 			 			success: function(res){
 			 				 window.location.href='{{route("portofdischarge.index")}}';
 			 			}
 			 		})

 			 	 });
 			 });


        $('.delete-data').click(function(e) {
        e.preventDefault();
        const myValue = $(this).attr('id');


        $('#delete-button').click(function(e) {
            $.ajaxSetup({
              headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
             });

             $.ajax({
              url: "{{ url('/portofloading') }}" + '/'+ myValue,
              type: 'DELETE',
              data: {},
              success: function(res){
                 window.location.href='{{route("portofloading.index")}}';
                }
               });
          });
        
       });

		});
</script>







@endsection


