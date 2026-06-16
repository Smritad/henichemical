@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Peto Pentaerythritol Ester Applications</h2>

    <ul class="application-popup-row">
        @foreach ($links as $link)
            <li><a href="{{ $link }}" target="_blank">{{ $link }}</a></li>
        @endforeach
    </ul>
</div>
@endsection
