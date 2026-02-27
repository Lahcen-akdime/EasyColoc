<h1>You are invited to join {{ $colocationName }}</h1>
<p>Click the button below to accept the invitation:</p>
@if(session('error'))
          <p style="color:red">{{session('error')}}</p>
@endif

<a href="{{ url('/invitation/accept/'.$token) }}"
   style="display:inline-block;padding:10px 20px;background:#2563eb;color:#fff;text-decoration:none;border-radius:5px;">
   Accept Invitation
</a>
<p>the link of invitation:</p>
