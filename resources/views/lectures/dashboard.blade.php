@extends('layouts.dashboard')

@section('content')

<!-- Page Heading -->
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Welcome back! {{Auth::user()->name}}
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
                            <div>Dear {{Auth::user()->name }}</div>
                            <div>Here is your profile!</div>                            
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
                <div class="panel {{(App\Lecture::count() == 0) ? 'panel-yellow' : 'panel-green'}}">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="glyphicon glyphicon-user" style="font-size: 60px;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{App\Lecture::count()}}</div>
                                <div>Lecturers we have!</div>
                            </div>
                        </div>
                    </div>
                    <a href="/lectures">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
        </div>
        <div class="col-lg-3 col-md-6">
                <div class="panel {{(App\Student::count() == 0) ? 'panel-yellow' : 'panel-green'}}">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="glyphicon glyphicon-education" style="font-size: 60px;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{App\Student::count()}}</div>
                                <div>Total Students!</div>
                            </div>
                        </div>
                    </div>
                    <a href="/students">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
        </div>
        

    </div>
    
    {{-- @if(App\Department::where('department_head_employee_id', Auth::user()->user_name)->first() )
    <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Department progress of past five academic years</h3>
                    </div>
                    <div class="panel-body">
                        <div id="morris-area-chart"></div>
                    </div>
                </div>
            </div>
    </div>
    @endif --}}


@endsection
