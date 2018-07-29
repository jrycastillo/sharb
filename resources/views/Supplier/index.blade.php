@extends('layouts.app')

@section('style')

<style type="text/css">
	
</style>
@endsection

@section('content')


<!-- <div class="container">
	
<table>
	<thead>
		<tr>
			<th>
				ID:
			</th>
			<th>
				Name:
			</th>
			<th>

			</th>
		</tr>
	</thead>

	<tbody>
		@foreach($suppliers as $supplier)
		<tr>
			<td>
				{{$supplier->id}}
			</td>
			<td>
				{{$supplier->name}}
			</td>
			<td>
				<a href="{{route('supplier.show', ['id' => $supplier->id ])}}" class="btn"> view</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

</div> -->



<div class="container">
	

	<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>	Supplier List</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead align="center">
		<tr>
			<th align="center">
				ID:
			</th>
			<th align="center" colspan="1">
				Name:
			</th>
			<th align="center" colspan="1">
				Actions:
			</th>
		</tr>
	</thead>
         <tbody style="font-weight: bold;">
		@foreach($suppliers as $supplier)
		<tr>
			<td height="40" align="center">
				{{$supplier->id}}
			</td>
			<td height="40" align="center">
				{{$supplier->name}}
			</td height="40" align="center">
			<td align="center">
				<button id="{{$supplier->id}}" class="btn btn-primary col-sm-4 editButton" data-toggle="modal" data-target="#exampleModalCenter_edit">Edit</button> &emsp;
				 <button id="{{$supplier->id}}" type="button" class="btn btn-danger col-sm-4 delete-data" data-toggle="modal" data-target="#exampleModalCenter_delete">Delete</button>

			</td>
		</tr>
		@endforeach
	</tbody>
            </table>
            <br>
             <button style="float: right;" type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModalCenter">
 		 Add Supplier
	</button>
          </div>
        </div>
      </div>
    </div>
</div>



<!-- Modal sa create -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5 class="modal-title" id="exampleModalCenterTitle">Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p style="font-weight: bold;">Name </p>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="supplier"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="add_supplier">Add</button>
      </div>
    </div>
  </div>
</div> 



<!-- Modal sa Update -->
<div class="modal fade" id="exampleModalCenter_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p style="font-weight: bold;">Name </p>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="update_supplier"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="edit_supplier">Update</button>
      </div>
    </div>
  </div>
</div> 


<!-- Modal delets-->
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
    <p style="font-weight: bold; text-align: center;"> Do you want to delete the selected supplier? </p>
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

 			 $('#add_supplier').click(function(e){

 			 	e.preventDefault();
 			 	var input = $('#supplier').val();
 			 	// console.log(input);

 			 	$.ajaxSetup({
 			 		headers:{
 			 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 			 		}
 			 	});

 			 	$.ajax({
 			 		url: "{{ url('/supplier') }}",
 			 		method: 'post',
 			 		data: {
 			 			name: input
 			 		},
 			 		success: function(res){
 			 			//console.log(res);
 			 			window.location.href='{{route("supplier.index")}}';
 			 		}
 			 	})

 			 });

 			 $('.editButton').on('click', function(e) {
 			 	const myValue = $(this).attr('id');
 			 	let name = $(this).closest('tr').find('td:eq(1)').text();

 			 	$('#update_supplier').val(name.trim());

 			 	


 			 	 $('#edit_supplier').click(function(e) {
 			 	 	e.preventDefault();
 			 	 	
 			 	 	let editInput = $('#update_supplier').val();
 			 	 	//console.log("{{ url('/supplier') }}" + '/'+ myValue);
 			 	 	$.ajaxSetup({
 			 		headers:{
 			 				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 			 			}
 			 		});

 			 		$.ajax({
 			 			url: "{{ url('/supplier') }}" + '/'+ myValue,
 			 			method: 'put',
 			 			data: {
 			 				name: editInput
 			 			},
 			 			success: function(res){
 			 				 window.location.href='{{route("supplier.index")}}';
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
              url: "{{ url('/supplier') }}" + '/'+ myValue,
              type: 'DELETE',
              data: {},
              success: function(res){
                 window.location.href='{{route("supplier.index")}}';
                }
               });
          });
        
       });

		});
</script>


@endsection