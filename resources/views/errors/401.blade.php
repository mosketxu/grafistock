@extends('errors::illustrated-layout')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))

@section('image')
<div style="background-image: url('/img/grafitexLogo.png');" class="absolute bg-no-repeat bg-cover pin md:bg-left lg:bg-center">
</div>
@endsection
