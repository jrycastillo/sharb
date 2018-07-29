@extends('layouts.app')

@section('style')

    <style>
        .loading-container {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            padding: 1rem 1rem;
            font-size: 12px;
        }

        .table-container {
            grid-column: 1 / 13;
            text-align: center;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        td {
            font-size: 10.5pt;
        }

        .btn-add {
            align-self: center;
            background-color: #129987; /* Green */
            border: none;
            color: white;
            padding: 3px 30px;
            text-align: center;
            text-decoration: none;
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
            display: block;
            margin: auto;
        }

        .btn-add:hover {
            background-color: #16af16;

        }

    </style>

@endsection


@section('content')


    <div class="loading-container">
        <div class="card mb-3 table-container">
            <div class="card-header">
                <i class="fa fa-table"></i>Product List/Description
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTables" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Unit</th>
                            <th>Class</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class='selection' align="center">
                        @foreach($products as $product)
                            <tr>
                                <td id="name{{$product->id}}">{{$product->name}}</td>
                                <td id="unit{{$product->id}}">{{$product->unit->value}} kg</td>
                                <td id="class{{$product->id}}">{{$product->class}}</td>
                                <td>
                                    <button type="button" class="btn btn-add buttons" id='{{$product->id}}'>Add</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="card mb-3 table-container">
            <div class="card-header" align="center" style="font-weight: bold">
                Container Details
            </div>
            <form>
                <table class="table table-bordered" width="70%" id="buy">
                    <thead>
                    <tr>
                        <td style="font-weight: bold" colspan="2">Van No:</td>
                        <td colspan="1">fsdfsdfweew</td>
                        <td style="font-weight: bold" colspan="2">Seal No:</td>
                        <td colspan="1">
                            <input class="form-control" name="seal_no" id="seal_no" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="15"></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Products</td>
                        <td style="font-weight: bold">Name</td>
                        <td style="font-weight: bold">Unit</td>
                        <td style="font-weight: bold">Class</td>
                        <td style="font-weight: bold">Quantity</td>
                        <td style="font-weight: bold">Actions</td>
                    </tr>
                    </thead>
                    <tbody class="add_here">

                    </tbody>
                </table>
                <button type="submit" class="btn btn-add" id="add_container">Add Container</button>
            </form>

        </div>


    </div>




@endsection


@section('scripts')

    <script>
        $(document).ready(function () {
            $('#dataTables').DataTable();
            $('.buttons').click(function () {
                const myValue = $(this).attr('id');
                let name = $(this).closest('tr').find('td:eq(0)').text();
                let unit = $(this).closest('tr').find('td:eq(1)').text();
                let c = $(this).closest('tr').find('td:eq(2)').text();

                $("#" + this.id).prop("disabled", true);
                $('#' + this.id).removeClass("btn-add");
                $('#' + this.id).addClass("btn-info");


                $('.add_here').append(
                    '<tr class = ' + myValue + '>' +
                    '<td></td>' +
                    '<td>' + name + '</td>' +
                    '<td>' + unit + '</td>' +
                    '<td>' + c + '</td>' +
                    '<td><input class="form-control" id=' + myValue + '  required></td>' +
                    '<td><button type="button" class="btn btn-danger" id="btn"' + myValue + '>Remove</button></td>' +
                    '</tr>'
                );

            });


            $('#add_container').click(function (e) {
                var id = {{$id}}
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $('#buy tbody tr').each(function () {
                    if (!this.rowIndex) return;
                    var value = $(this).find("td").eq(4).find("input").val();
                    var p_id = $(this).find("td").eq(4).find("input").attr('id');
                    $.ajax({
                        url: "{{ url('/api/container') }}",
                        method: 'post',
                        data: {
                            van_id: id,
                            product_id: p_id,
                            quantity: value
                        },
                        success: function(){
                            window.location.href = '{{route("loadings.show", ["id"=>$loading->id])}}'
                        }
                    });

                });


            });

        });


    </script>
@endsection