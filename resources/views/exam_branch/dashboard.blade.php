@extends('layouts.dashboard')

@section('content')

<!-- Page Heading -->
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Welcome back!
            </h1>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                </ol>
        </div>
</div>

{{-- Widgets --}}
<div class="row">
        <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="glyphicon glyphicon-heart" style="font-size: 60px;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>Dear {{Auth::user()->user_name }}</div>
                                <div>Here is your profile!</div>  
                                <div>&nbsp;</div> 
                                <div>&nbsp;</div>                          

                            </div>
                        </div>
                    </div>
                    <a href="/profile">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-warning-sign" style="font-size: 60px;"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$attentions}}</div>
                            <div>Attention! There are unpublished results</div>
                        </div>
                    </div>
                </div>
                <a href="/grades">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-chevron-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    

@endsection
