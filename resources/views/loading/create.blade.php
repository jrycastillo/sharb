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

        .card-header, .card-body h3, h4, h5, h6 {
            margin: 0;
        }

        .formgrid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 1rem;
        }
    </style>
@endsection
@section('content')

    <div class="container">
        <div class="card mb-5 bx-sw">
            <div class="card-header">
                <h3>
                    <i class="fa fa-table"> Create Loading</i>
                </h3>
            </div>
            <div class="card-body">
                {{--{!! Form::label('BL_no', 'BL no:', ['class' => 'label']) !!}--}}
                {{--{!! Form::select('BL_no',[1,2,3] ,null , ['class' => 'form-control', 'required' => 'required']) !!}--}}
                <label for="">BL no:</label>
                <select name="BL_no" id="BL_no" class="form-control">
                    <option value="0" disabled="true" selected="true">Select Booking Number</option>
                    @foreach($bl_no as $bl)
                        <option value="{{$bl->id}}">{{$bl->BL_no}}</option>
                    @endforeach
                </select>
                <div class="formgrid mt-5 mb-3">
                    <h5>Production Week</h5>
                    {{--<h6 id="productionWeek">: </h6>--}}
                    {!! Form::selectRange('Months', 1, 52,null, ['class' => 'form-control', 'required' => 'required', 'id'=> 'productionWeek']) !!}
                    <h5>Shipment Week</h5>
                    <h6 id="shipmentWeek">: </h6>
                    <h5>ETD</h5>
                    <h6 id="ETD">: </h6>
                    <h5>ETA</h5>
                    <h6 id="ETA">: </h6>
                    <h5>Voyage no</h5>
                    <h6 id="voyage">: </h6>
                    <h5>Vessel</h5>
                    <h6 id="vessel">: </h6>
                    <h5>Carrier</h5>
                    <h6 id="carrier">: </h6>
                    <h5>Port Of Loading</h5>
                    <h6 id="POL">: </h6>
                    <h5>Port of Discharge</h5>
                    <h6 id="POD">: </h6>
                    <h5>Exporter</h5>
                    <h6 id="exporter">: </h6>
                    <h5>Supplier</h5>
                    {{--<h6 id="supplier">: </h6>--}}
                    {!! Form::select('BL_no',['' => 'Choose options'] + $suppliers ,null , ['class' => 'form-control', 'required' => 'required', 'id' => 'supplier']) !!}
                </div>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="createLoading">Create Loading
                </button>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script>

        $(document).ready(function () {
            var state = {
                id: ''
            };


            $('#BL_no').on('change', function (e) {
                var bl_no = e.target.value;
                state.id = bl_no;
                $.get('/json-loading?BL_no=' + bl_no, function (data) {


                    $('#shipmentWeek').empty();
                    $('#shipmentWeek').text(': ' + data.shipmentWeek);

                    $('#ETD').empty();
                    $('#ETD').text(': ' + data.ETD);

                    $('#ETA').empty();
                    $('#ETA').text(': ' + data.ETA);

                    $('#voyage').empty();
                    $('#voyage').text(': ' + data.voyage_no);

                    $('#vessel').empty();
                    $('#vessel').text(': ' + data.vessel);

                    $('#carrier').empty();
                    $('#carrier').text(': ' + data.carrier);

                    $('#POL').empty();
                    $('#POL').text(': ' + data.POL);

                    $('#POD').empty();
                    $('#POD').text(': ' + data.POD);

                    $('#exporter').empty();
                    $('#exporter').text(': ' + data.exporter);


                });


            });

            $("#createLoading").on('click', function (e) {
                e.preventDefault();
                var data = $('#productionWeek').val();
                var supplier = $('#supplier').val();

                var formData = {
                    productionWeek: data,
                    supplier_id: supplier,
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $.ajax({
                    url: "{{ url('/loadings') }}" + "/" + state.id,
                    method: 'put',
                    data: formData,
                    success: function (res) {
                       // console.log(res);
                        window.location.href = '{{route("addproduct.index")}}';
                    }
                });
            });


        });

    </script>
@endsection
