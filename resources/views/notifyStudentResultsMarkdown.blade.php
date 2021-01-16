@component('mail::message')

# Congratulations!
<p><strong>Dear {{$request->first_name}},</strong></p>

<p>The results of following subject has been released by the Examination Branch of University of Jaffna.</p>
<p>You are required to log-in in order to see the results and updated GPA.</p>

@component('mail::button', ['url' => 'http://127.0.0.100/login'])
Log In Now
@endcomponent

{{-- @component('mail::panel')
    <strong>Reg. No         : {{$request['student_registration_number']}}</strong><br>
    <strong>Index No        : {{$request['student_index_number']}}</strong><br>    
    <strong>Exam Year       : {{$request['exam_year']}}</strong><br>
    <strong>Subject Code    : {{$request['subject_code']}}</strong><br>
    <strong>Subject Title   : {{$request['title']}}</strong>
@endcomponent --}}

@component('mail::panel')
    <strong>Reg. No         : {{$request->student_registration_number}}</strong><br>
    <strong>Index No        : {{$request->student_index_number}}</strong><br>    
    <strong>Exam Year       : {{$request->exam_year}}</strong><br>
    <strong>Subject Code    : {{$request->subject_code}}</strong><br>
    <strong>Subject Title   : {{$request->title}}</strong>
@endcomponent

Thank you,<br> 
Examination Branch,<br> 
University of Jaffna
@endcomponent
