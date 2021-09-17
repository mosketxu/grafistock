@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))

@section('image')
<div style="background-image: url('/img/grafitexLogo.png');" class="absolute bg-no-repeat bg-cover pin md:bg-left lg:bg-center">
</div>
@endsection
