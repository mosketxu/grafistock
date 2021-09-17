@extends('errors::illustrated-layout')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

@section('image')
<div style="background-image: url('/img/grafitexLogo.png');" class="absolute bg-no-repeat bg-cover pin md:bg-left lg:bg-center">
</div>
@endsection
