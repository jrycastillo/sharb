@extends('layouts.app')


@section('content')

<div id="app">
    <p></p>
</div>



@endsection


@section('scripts')

    <script>



        new Vue({
            el: '#app',
            data: {
                title: 'hello World'
            }
        });

    </script>
@endsection