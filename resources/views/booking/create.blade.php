@extends('layouts.app')

@section('style')
    <style>
        .bg {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-row-gap: 1rem;
            grid-gap: 1rem;
        }

        .bx-sw {
            border: 0;
            box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
        }

        .label {
            font-weight: bold;
            margin: 0;
            align-items: center;
            display: flex;
            font-size: 16px;
        }

        .label label {
            align-items: center;
        }

        .ATW-button {
            grid-column: 1 / 5;
            font-weight: bold;
            font-size: 20px;
        }

        .card-header h3, h4, h5 {
            margin: 0;
        }

        .grid-full {
            grid-column: 1 / 5;
        }

        .flex {
            display: flex;
            flex-wrap: wrap;
        }

        .w90 {
            width: 90%;
        }

        .j-cont {
            justify-content: space-between;
        }

        .w40 {
            width: 40%;
        }

        .ht {
            height: 200px;
            overflow-y: auto;
        }
    </style>
@endsection


@section('content')
    <div class="container">
        <div class="card mb-5 bx-sw">
            <div class="card-header">
                <h3>
                    <i class="fa fa-table"> Create Booking / ATW</i>
                </h3>
            </div>
            <div class="card-body">
                {!! Form::open(['method' => 'POST', 'action' => 'Booking\BookingController@store','id' => 'myForm' ]) !!}
                <div class="bg mb-3">
                    {!! Form::label('carrier_id', 'Carrier:', ['class' => 'label']) !!}
                    {!! Form::select('carrier_id',['' => 'Choose options'] + $carriers ,null , ['class' => 'form-control', 'required' => 'required']) !!}

                    {!! Form::label('BL_no', 'Booking No:', ['class' => 'label']) !!}
                    {!! Form::text('BL_no', null, ['class' => 'form-control', 'required' => 'required']) !!}

                    {!! Form::label('vessel', 'Vessel Name:', ['class' => 'label']) !!}
                    {!! Form::text('vessel', null, ['class' => 'form-control', 'required' => 'required']) !!}

                    {!! Form::label('voyage_no', 'Voyage No:', ['class' => 'label']) !!}
                    {!! Form::text('voyage_no', null, ['class' => 'form-control', 'required' => 'required']) !!}

                    {!! Form::label('ETD', 'ETD:', ['class' => 'label']) !!}
                    {!! Form::date('ETD', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'required']) !!}

                    {!! Form::label('ETA', 'ETA:', ['class' => 'label']) !!}
                    {!! Form::date('ETA', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'required']) !!}

                    {!! Form::label('portOfDischarge_id', 'Port of Discharge:', ['class' => 'label']) !!}
                    {!! Form::select('portOfDischarge_id',['' => 'Choose options'] + $portOfDischarges ,null , ['class' => 'form-control', 'required' => 'required']) !!}

                    {!! Form::label('portOfLoading_id', 'Port of Loading:', ['class' => 'label']) !!}
                    {!! Form::select('portOfLoading_id',['' => 'Choose options'] + $portOfLoadings ,null , ['class' => 'form-control', 'required' => 'required']) !!}

                    {!! Form::label('exporter_id', 'Exporter:', ['class' => 'label']) !!}
                    {!! Form::select('exporter_id',['' => 'Choose options'] + $exporters ,null , ['class' => 'form-control', 'required' => 'required']) !!}


                    <div class="card border-success mb-3 grid-full">
                        <div class="card-header">
                            <h5><i class="fa fa-truck"> Container</i></h5>
                        </div>
                        <div class="card-body flex j-cont">
                            <div class="mb-3 flex w-100 j-cont">
                                <div class="w90">
                                    <input type="text" class="form-control w-100" id="van" placeholder="Van no"/>
                                </div>
                                <button class="btn btn-success add_fields">Enter</button>
                            </div>
                            <ul class="list-group w40">
                                <li class="list-group-item">fsfa</li>
                            </ul>
                            <div class="w-50 ht">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Van no</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody class="wrapper">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    {!! Form::submit('Create Booking', ['class' => 'btn btn-primary ATW-button', 'id' => 'submit', 'disabled' => 'true']) !!}
                </div>
                {!! Form::close() !!}


            </div>
        </div>
    </div>



@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var state = {
                'containers': []
            };

            var wrapper = $(".wrapper");
            var add_button = $(".add_fields");


            $(add_button).click(function (e) {
                e.preventDefault();

                if ($('#van').val() !== '') {
                    $(wrapper).empty();
                    const van_no = $('#van').val();

                    const product = {
                        'van_no': ''
                    };
                    product.van_no = van_no;


                    const container = [...state.containers, product];
                    state.containers = container;

                    state.containers.map((value, index) => {
                        return $(wrapper).append('<tr id="' + index + '"><td>' + value.van_no + '</td><td><a href="javascript:void(0);" class="btn btn-danger remove_field">Remove</a></td></tr>');
                    });
                    $('#van').val("");

                    // state.containers.forEach((value) => {
                    //     console.log(value);
                    // });
                    dis();
                }
            });


            $(wrapper).on("click", ".remove_field", function (e) {
                e.preventDefault();
                var id = $(this).parent('td').parent('tr').attr('id');
                state.containers.splice(id, 1);
                //$(this).parent('td').parent('tr').remove();
                $(wrapper).empty();
                state.containers.map((value, index) => {
                    return $(wrapper).append('<tr id="' + index + '"><td>' + value.van_no + '</td><td><a href="javascript:void(0);" class="btn btn-danger remove_field">Remove</a></td></tr>');
                });
                dis();

            });

            const dis = () => {
                if (state.containers.length === 0) {
                    $('#submit').prop('disabled', true);
                } else {
                    $('#submit').prop('disabled', false);
                }
            };

            $('#myForm').submit(function (e) {
                e.preventDefault();
                var inputs = $('#myForm :input');
                inputs.splice(0, 1);
                var formData = {};

                inputs.each(function () {
                    formData[this.name] = $(this).val();
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                var data = {
                    formData: formData,
                    containers: state.containers
                };

                $.ajax({
                    url: "{{ url('/booking') }}",
                    method: 'post',
                    data: data,
                    success: function (res) {
                        //console.log(res);
                        window.location.href = '{{route("booking.index")}}';
                    }
                });


            });


        });
    </script>
@endsection