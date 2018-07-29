@extends('layouts.app')

@section('style')

<style type="text/css">
	
</style>
@endsection

@section('content')






<div class="container">
	

	<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Consignees</div>
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
				Postal:
			</th>
        <th align="center" colspan="1">
        Address:
      </th>
       <th align="center" colspan="1">
        City:
      </th>
        <th align="center" colspan="1">
        Country:
      </th>
        <th align="center" colspan="1">
        Contact:
      </th>
        <th align="center" colspan="1" width="200px;">
        Actions:
      </th>
		</tr>
	</thead>
         <tbody style="font-weight: bold;">
		@foreach($consignees as $consignee)
		<tr>
			<td height="40" align="center">
				{{$consignee->id}}
			</td>
			<td height="40" align="center">
				{{$consignee->name}}
			</td>
      <td height="40" align="center">
        {{$consignee->postal}}
      </td>
      <td height="40" align="center">
        {{$consignee->address}}
      </td>
       <td height="40" align="center">
        {{$consignee->city}}
      </td>
      <td height="40" align="center">
        {{$consignee->country}}
      </td>
      <td height="40" align="center">
        {{$consignee->contact}}
      </td>
			<td align="center" colspan="2">
				<button id="{{$consignee->id}}" class="btn btn-primary col-sm-5 editButton" data-toggle="modal" data-target="#exampleModalCenter_edit">Edit</button> &emsp;
         <button id="{{$consignee->id}}" type="button" class="btn btn-danger col-sm-5 delete-data" data-toggle="modal" data-target="#exampleModalCenter_delete">Delete</button>
			</td>
		</tr>
		@endforeach
	</tbody>
            </table>
            <br>
    <button style="float: right;" type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModalCenter">
 		 Add
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Consignee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h6 style="font-weight: bold;">Name </h6>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="consigneeName"/><br>
         <h6 style="font-weight: bold;">Postal </h6>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="consigneePostal"/><br>
         <h6 style="font-weight: bold;">Address </h6>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="consigneeAddress"/><br>
         <h6 style="font-weight: bold;">City </h6>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="cosnigneeCity"/><br>
         <h6 style="font-weight: bold;">Country </h6>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="consigneeCountry"/><br>
         <h6 style="font-weight: bold;">Contact </h6>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="consigneeContact"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="add_consignee">Add</button>
      </div>
    </div>
  </div>
</div> 



<!-- Modal sa Update -->
<div class="modal fade" id="exampleModalCenter_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Consignee </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h6 style="font-weight: bold;">Name </h6>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="update_consigneeName"/><br>
         <h6 style="font-weight: bold;">Postal </h6>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="update_consigneePostal"/><br>
         <h6 style="font-weight: bold;">Address </h6>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="update_consigneeAddress"/><br>
         <h6 style="font-weight: bold;">City </h6>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="update_cosnigneeCity"/><br>
         <h6 style="font-weight: bold;">Country </h6>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="update_consigneeCountry"/><br>
         <h6 style="font-weight: bold;">Contact </h6>
        <input  style="text-transform:uppercase"  type="text" class="form-control" id="update_consigneeContact"/>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_consignee_details">Update</button>
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

 			 $('#add_consignee').click(function(e){

 			 	e.preventDefault();
 			 	var name = $('#consigneeName').val();
        var postal = $('#consigneePostal').val();
        var address = $('#consigneeAddress').val();
        var city = $('#cosnigneeCity').val();
        var country = $('#consigneeCountry').val();
        var contact = $('#consigneeContact').val();
 			 	// console.log(input);

 			 	$.ajaxSetup({
 			 		headers:{
 			 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 			 		}
 			 	});

 			 	$.ajax({
 			 		url: "{{ url('/consignee') }}",
 			 		method: 'post',
 			 		data: {
 			 			name: name,
            postal: postal,
            address: address,
            city: city,
            country: country,
            contact: contact

 			 		},
 			 		success: function(res){
 			 			//console.log(res);
 			 			window.location.href='{{route("consignee.index")}}';
 			 		}
 			 	})

 			 });

 			 $('.editButton').click(function(e) {
 			 	e.preventDefault();
 			 	const myValue = $(this).attr('id');
 			 	let name = $(this).closest('tr').find('td:eq(1)').text();
        let postal = $(this).closest('tr').find('td:eq(2)').text();
        let address = $(this).closest('tr').find('td:eq(3)').text();
        let city = $(this).closest('tr').find('td:eq(4)').text();
        let country = $(this).closest('tr').find('td:eq(5)').text();
        let contact = $(this).closest('tr').find('td:eq(6)').text();

 			 	$('#update_consigneeName').val(name.trim());
 			  $('#update_consigneePostal').val(postal.trim());
        $('#update_consigneeAddress').val(address.trim());
        $('#update_cosnigneeCity').val(city.trim());
        $('#update_consigneeCountry').val(country.trim());
        $('#update_consigneeContact').val(contact.trim());


 			 	 $('#update_consignee_details').click(function(e) {
 			 	 	e.preventDefault();
 			 	 	
 			 	 	let name = $('#update_consigneeName').val();
          let postal = $('#update_consigneePostal').val();
          let address = $('#update_consigneeAddress').val();
          let city = $('#update_cosnigneeCity').val();
          let country = $('#update_consigneeCountry').val();
          let contact = $('#update_consigneeContact').val();
 			 	 	//console.log("{{ url('/supplier') }}" + '/'+ myValue);
 			 	 	$.ajaxSetup({
 			 		headers:{
 			 				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 			 			}
 			 		});

 			 		$.ajax({
 			 			url: "{{ url('/consignee') }}" + '/'+ myValue,
 			 			method: 'put',
 			 			data: {
 			 			name: name,
            postal: postal,
            address: address,
            city: city,
            country: country,
            contact: contact
 			 			},
 			 			success: function(res){
 			 				 window.location.href='{{route("consignee.index")}}';
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
              url: "{{ url('/consignee') }}" + '/'+ myValue,
              type: 'DELETE',
              data: {},
              success: function(res){
                 window.location.href='{{route("consignee.index")}}';
                }
               });
          });
        
       });

		});
</script>







@endsection


