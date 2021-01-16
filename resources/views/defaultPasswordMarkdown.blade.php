@component('mail::message')

# Congratulations!
<p><strong>Dear {{$request['name']}},</strong></p>

<p>This is your username and default password for Results Management System of 
Faculty of Management Studies &amp; Commerce, University of Jaffna.</p>
<p>We highly recommend to change the default password after your first login.
Have a great time!
</p>

@component('mail::panel')
    <strong>User Name : {{$request['user_name']}}</strong><br>
    <strong>Password  : {{$request['password']}}</strong>
@endcomponent

@component('mail::button', ['url' => 'http://127.0.0.100/login'])
Log In Now
@endcomponent

Thank you,<br> 
{{-- {{ config('app.name') }} --}}
Dean<br> 
Faculty of Management Studies &amp; Commerce<br> 
University of Jaffna
@endcomponent
