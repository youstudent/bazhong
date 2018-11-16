@extends('agency.layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">
                商家二维码
            </h3>
        </div>
        <div class="panel-body" align="center">
            <img src="{{request()->user()['code_img']}}" alt="">
        </div>
    </div>
    @endsection
