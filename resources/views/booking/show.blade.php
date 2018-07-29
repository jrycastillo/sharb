@extends('layouts.app')

@section('style')
    <style>
        .bg {
            display: grid;
            grid-template-columns: 1fr 2fr;
            grid-row-gap: 1rem;
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
            grid-column: 1 / 3;
            font-weight: bold;
            font-size: 20px;
        }

        .card-header h3 {
            margin: 0;
        }

        .bg h4, h6 {
            margin: 0;
        }
    </style>
@endsection
@section('content')

    <div class="container">
        <div class="mb-3 card">
            <div class="card-header">
                <h3>
                    <i class="fa fa-table"> View Booking Details</i>
                </h3>
            </div>
            <div class="card-body">
                <div class="bg mb-3">
                    <h6>Booking no</h6>
                    <h6>: {{$loadingDetail->BL_no}}</h6>
                    <h6>Shipment Week</h6>
                    <h6>: {{$loadingDetail->shipmentWeek}}</h6>
                    <h6>Voyage no</h6>
                    <h6>: {{$loadingDetail->voyage_no}}</h6>
                    <h6>ETD</h6>
                    <h6>: {{$loadingDetail->ETD}}</h6>
                    <h6>ETA</h6>
                    <h6>: {{$loadingDetail->ETA}}</h6>
                    <h6>Exporter</h6>
                    <h6>: {{$loadingDetail->exporter}}</h6>
                    <h6>Shipping</h6>
                    <h6>: {{$loadingDetail->carrier}}</h6>
                    <h6>Vessel</h6>
                    <h6>: {{$loadingDetail->vessel}}</h6>
                    <h6>Port of Loading</h6>
                    <h6>: {{$loadingDetail->POL}}</h6>
                    <h6>Port of Discharge</h6>
                    <h6>: {{$loadingDetail->POD}}</h6>
                </div>
                <a class="btn btn-primary btn-lg btn-block"
                   href="{{route('booking.edit', ['id'=>$loadingDetail->id])}}">Edit</a>
            </div>
        </div>
    </div>



@endsection

