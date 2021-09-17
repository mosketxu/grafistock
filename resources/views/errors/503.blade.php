@extends('errors::illustrated-layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))

@section('image')
<div style="background-image: url('/img/grafitexLogo.png');" class="absolute bg-no-repeat bg-cover pin md:bg-left lg:bg-center">
</div>
@endsection
