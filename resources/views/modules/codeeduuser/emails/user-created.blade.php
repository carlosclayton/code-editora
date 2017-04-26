<h3>{{ config('app.name') }}</h3>
<p> Your account at our platform was created with success</p>
<p>User: <strong>{{$user->email}}</strong></p>
<p>
    <?php $link = route('codeeduuser.email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) ; ?>
    Please, click here to verify your account <a href="{{ $link  }}"> {{ $link }}</a>
</p>

<br />
<p>Don't reply this email, it was automatically generated</p>