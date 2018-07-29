@include('layouts.app')



@section('content')
    <div class="container">
        {!! Form::open(['method' => 'POST', 'action' => 'Booking\BookingController@update','id' => 'myForm' ]) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@endsection