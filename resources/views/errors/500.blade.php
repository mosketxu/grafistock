@extends('errors::illustrated-layout')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))

@section('image')
<div style="background-image: url('/img/grafitexLogo.png');" class="absolute bg-no-repeat bg-cover pin md:bg-left lg:bg-center">
</div>
@endsection
