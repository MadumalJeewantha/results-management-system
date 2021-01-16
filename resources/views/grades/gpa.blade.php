@extends('layouts.dashboard')

@section('content')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
           Grade Point Average    
           <a href="/dashboard" class="btn btn-default pull-right">Back</a>          
        </h1>

        <ol class="breadcrumb">
            <li>
                <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
            </li>
            <li>
                <i class="glyphicon glyphicon-text-background"></i> Results
            </li> 
            <li class="active">
                    <i class="glyphicon glyphicon-flash"></i> GPA
            </li>                     
        </ol>
    </div>



    <div class="col-lg-12">
            <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Grade Point Average - Semester wise</div>                    

                            <div class="panel-body">                                                
                                <div class="list-group">
                                    <span class="list-group-item list-group-item-info">
                                        <span>Period</span>
                                        <span class="pull-right">GPA</span>
                                    </span> 

                                    <span class="list-group-item list-group-item-default" style="background-color:#f5f5f5">
                                            <span>Year 1 - Semester 1</span>
                                            <span class="pull-right">{{$year1Semester1}}</span>
                                    </span> 

                                    <span class="list-group-item list-group-item-default" style="background-color:#f5f5f5">
                                            <span>Year 1 - Semester 2</span>
                                            <span  class="pull-right">{{$year1Semester2}}</span>
                                    </span> 
                                    
                                    <span class="list-group-item list-group-item-default">
                                            <span>Year 2 - Semester 1</span>
                                            <span class="pull-right">{{$year2Semester1}}</span>
                                    </span> 

                                    <span class="list-group-item list-group-item-default">
                                            <span>Year 2 - Semester 2</span>
                                            <span class="pull-right">{{$year2Semester2}}</span>
                                    </span> 

                                    <span class="list-group-item list-group-item-default" style="background-color:#f5f5f5">
                                            <span>Year 3 - Semester 1</span>
                                            <span class="pull-right">{{$year3Semester1}}</span>
                                    </span> 

                                    <span class="list-group-item list-group-item-default" style="background-color:#f5f5f5">
                                            <span>Year 3 - Semester 2</span>
                                            <span class="pull-right">{{$year3Semester2}}</span>
                                    </span> 

                                    <span class="list-group-item list-group-item-default">
                                            <span>Year 4 - Semester 1</span>
                                            <span class="pull-right">{{$year4Semester1}}</span>
                                    </span> 

                                    <span class="list-group-item list-group-item-default">
                                            <span>Year 4 - Semester 2</span>
                                            <span class="pull-right">{{$year4Semester2}}</span>
                                    </span> 
                                    

                                </div>                                                    
                            </div>
                        </div>
                    </div>


                    {{-- overall --}}
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Grade Point Average - Overall</div>                    

                            <div class="panel-body">                                                
                                <div class="list-group">
                                    <span class="list-group-item">First Class                    : <strong>3.70</strong></span> 
                                    <span class="list-group-item">Second Class(Upper Division)   : <strong>3.30</strong></span> 
                                    <span class="list-group-item">Second Class(Lower Division)   : <strong>3.00</strong></span> 
                                    {{-- Current state --}}
                                    <span class="list-group-item {{($GPA < 2.0 ) ? 'list-group-item-danger' : ($GPA < 3.0  ? 'list-group-item-warning' : ($GPA >= 3.0  ? 'list-group-item-success' : ''))}}">Current State : {{$GPA}}</span> 
                                </div>                                                    
                            </div>
                        </div>     
                    </div>

                </div>
    </div>




        
</div>

   
@endsection





