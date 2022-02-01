@component('mail::message')

Dear Dr {{$details['firstname']}}

Your new Afyacall account is all set to go! You can access it using the following 
credentials:

Email Address: {{$details['email']}}
IP Address: http://calls.afyacall.co.tz:5672 <br>
Password:  {{$details['password']}}

For security reasons, you will be required to change this Afyacall 
password when you login. You should choose a strong password that will 
be easy for you to remember, but hard for a computer to guess. You might 
try creating an alpha-numerical phrase from a memorable sentence (e.g. 
“I won my first spelling bee at age 7,” might become “Iwm#1sbaa7”). 
Random strings of common words, such as “Mousetrap Sandwich Hospital 
Anecdote,” tend to work well too.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
