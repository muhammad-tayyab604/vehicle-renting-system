@component('mail::message')
# Contact Form Submission

**Name:** {{ $request->name }}

**Email:** {{ $request->email }}

**Message:** {{ $request->message }}
@endcomponent
