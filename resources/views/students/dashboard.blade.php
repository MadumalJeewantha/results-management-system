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
            <div class="panel  {{(App\Student::findOrFail(Auth::user()->user_name)->email == '' ) ? 'panel-red' : 'panel-primary'}}">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-heart" style="font-size: 60px;"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div>Dear {{Auth::user()->name }}</div>
                            <div>{{(App\Student::findOrFail(Auth::user()->user_name)->email == '' ) ? 'Please add email address to your profile!' : 'Here is your profile!'}}</div>                            
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
            <div class="panel {{($gpa < 2.0 ) ? 'panel-red' : ($gpa < 3.0  ? 'panel-yellow' : ($gpa >= 3.0  ? 'panel-green' : ''))}}">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-education" style="font-size: 60px;"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$gpa}}</div>
                            <div>Current GPA!</div>
                        </div>
                    </div>
                </div>
                <a href="/gpa">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-chevron-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-text-background" style="font-size: 60px;"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{Auth::user()->unreadNotifications->count()}}</div>
                            <div>New results!</div>
                        </div>
                    </div>
                </div>
                <a href="/grades/{{Auth::user()->user_name}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-chevron-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        

    </div>

    {{-- Morris.js area chart --}}
    <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Your progress since first year</h3>
                    </div>
                    <div class="panel-body">
                            {{-- <canvas id="progress" width="400" height="100"></canvas> --}}
                            {!! $progress->render() !!}
                    </div>
                </div>
            </div>
        </div>

{{-- Using direct Chart.js --}}
{{-- <script>
        var ctx = document.getElementById("progress");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Sem 1", "Sem 2", "Sem 3", "Sem 4", "Sem 5", "Sem 6", "Sem 7", "Sem 8"],
                datasets: [{
                    label: 'Grade Point Average (GPA)',
                    data: [12, 19, 3, 5, 2, 3],
                    "fill":false,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                       
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',                        
                    ],
                    borderWidth: 1,
                    
                }]
            },
            options: {               
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        </script>
 --}}
        {{-- <script>
        new Chart(document.getElementById("progress"),
        {"type":"line",
        "data":{"labels":["January","February","March","April","May","June","July"],
        "datasets":[{"label":"My First Dataset",
        "data":[65,59,80,81,56,55,40],
        "fill":false,
        "borderColor":"rgb(75, 192, 192)",
        "lineTension":0.1}]},
        "options":{}});
        </script> --}}

@endsection