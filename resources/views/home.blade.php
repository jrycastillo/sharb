@extends('layouts.app')

@section('content')
    <div id="home">
        <v-content>
            DASHBOARD
        </v-content>
    </div>
@endsection


@section('scripts')
    <script>
        new Vue({
            el:'#home'
        })
    </script>

@endsection
