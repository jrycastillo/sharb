@extends('layouts.app')


@section('style')
    <style>
        TD {
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
    <div id="book">
            <div class="container">
                <div class="card-body">
                    <div class="card-header">
                        <i class="fa fa-table">ETW List</i>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Booking Number</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($loadings as $loading)
                                    <tr>
                                        <td>{{$loading->BL_no}}</td>
                                        <td>{{$loading->created_at}}</td>
                                        <td><a href="{{route('booking.show', ['id'=>$loading->id])}}" type="button"
                                               class="btn-add" style="text-decoration: none">View
                                                Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>



@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('#dataTables').DataTable();
        })

    </script>
@endsection