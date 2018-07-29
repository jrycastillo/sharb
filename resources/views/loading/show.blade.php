@extends('layouts.app')


@section('style')
    <style>
        .loading-container {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            padding: 1rem 1rem;
            font-size: 12px;
        }

        .company-name {
            grid-column: 3 / 7;
            text-align: center;
        }

        .margin-0 {
            margin: 0;
        }

        .margin-tb-1 {
            margin: 0.7rem 0;
        }

        .company-attribute {
            grid-column: 1 / 3;
        }

        .company-attribute-2 {
            grid-column: 9 / 11;
        }

        .company-value {
            grid-column: 3 / 5;
        }

        .company-value-2 {
            grid-column: 11 / 13;
        }

        .fnt-bold {
            font-weight: bold;
        }

        .table-container {
            grid-column: 1 / 13;
            text-align: center;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .breakdown-width {
            width: 49%;
        }
    </style>

@endsection


@section('content')


    <div class="loading-container">
        <div class="company-name"><h6 class="margin-0">MOHAMMAD A. SHARBATLY CO. LTD.</h6></div>
        <div class="company-name"><p class="margin-0">DAVAO BRANCH</p></div>
        <div class="company-attribute"><p class="fnt-bold margin-0">Shipment Date</p></div>
        <p class="company-value margin-0">: {{$loadingDetail->ETA}}</p>
        <div class="company-attribute-2"><p class="fnt-bold margin-0">Supplier</p></div>
        <p class="company-value-2 margin-0">: {{$loadingDetail->supplier}}</p>
        <div class="company-attribute"><p class="fnt-bold margin-0">Vessel Name</p></div>
        <p class="company-value margin-0">: {{$loadingDetail->vessel}}</p>
        <div class="company-attribute-2"><p class="fnt-bold margin-0">Exporter</p></div>
        <p class="company-value-2 margin-0">: {{$loadingDetail->exporter}}</p>
        <div class="company-attribute"><p class="fnt-bold margin-0">Voyage Number</p></div>
        <p class="company-value margin-0">: {{$loadingDetail->voyage_no}}</p>
        <div class="company-attribute-2"><p class="fnt-bold margin-0">Carrier</p></div>
        <p class="company-value-2 margin-0">: {{$loadingDetail->carrier}}</p>
        <div class="company-attribute"><p class="fnt-bold margin-tb-1">{{$loadingDetail->POD}}</p></div>

        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Week {{$loadingDetail->productionWeek}}</th>
                    <th colspan="{{count($productHead)}}}">CLASS A</th>
                    <th colspan="{{count($productHeadB)}}">CLASS B</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    @if($results->isEmpty())
                        <td></td>
                        <td></td>
                    @else
                        @foreach($results as $result)
                            <td>{{$result->name}}</td>
                        @endforeach
                    @endif
                    <td></td>
                </tr>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data['van_no']}}</td>
                        @if($isEmpty === 'true')
                            <td></td>
                            <td></td>
                            <td></td>
                        @else
                            @foreach($data['items'] as $item)
                                <td>{{$item}}</td>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
                <tr>
                    <td>TOTAL</td>
                    @if($results->isEmpty())
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        @foreach($results as $result)
                            <td>{{$result->quantity}}</td>
                        @endforeach
                        <td>{{$sum}}</td>
                    @endif
                </tr>
                </tbody>
            </table>
        </div>
        <p class="fnt-bold">BREAKDOWN:</p>
        <div class="table-container">
            @foreach($vanDetails as $data)
                <div class="breakdown-width">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th colspan="5">{{$data->van_no}}</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Class</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data->vanDetails as $item)
                            <tr>
                                <td></td>
                                <td>{{$item->product->name}}</td>
                                <td>{{$item->product->unit->value}} kg</td>
                                <td>{{$item->product->class}}</td>
                                <td>{{$item->quantity}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">Total</td>
                            <td>{{$data->vanDetails->sum('quantity')}}</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="padding: 0;">
                                <a type="button"
                                   class="btn btn-primary btn-lg btn-block"
                                   style="border-radius: 0"
                                   href="{{route('loadings.container.detail.create', ['loading'=>$data->loading_id,'van'=>$data->id])}}"
                                >
                                    <i class="fa fa-fw fas fa-plus"></i>
                                    <span class="nav-link-text">Fill Container</span>

                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            @endforeach
        </div>
    </div>


@endsection