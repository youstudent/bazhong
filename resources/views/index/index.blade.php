@extends('layouts.app')
@section('title')
    首页中心
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            首页中心
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>首页中心</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a style="color: #1c160d" href="{{url('/admin/business/index')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">商家数量</span>
                        <span class="info-box-number">{{$BusinessCount}}</span>
                    </div>
                </div>
                </a>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a style="color: #1c160d" href="{{url('/admin/activity/index')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">活动数量</span>
                        <span class="info-box-number">{{$ActivityCount}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                </a>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a style="color: #1c160d" href="{{url('/admin/client_users/index')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">用户数量</span>
                        <span class="info-box-number">{{$ClientUsersCount}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                </a>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a style="color: #1c160d" href="{{url('/admin/client_users/applyRecord')}}?status=1">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">待审核(经销商)</span>
                        <span class="info-box-number">{{$ApplyRecord}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                </a>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <img src="/qrcodes/2018-09-2953956.png" alt="">
    </section>
@endsection
