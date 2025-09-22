<x-mail::message>
# Request to renew account
<br/>
<br/>
{{ session('Barcode') }}
<br/>
{{ session('NameFirst') }} {{session('NameMiddle')}} {{ session('NameLast') }} {{session('NameSuffix')}}
<br/>
{{ session('displayableExpirationDate') }}
<br/>
<br/>
{{ session('EmailAddress') }}
<br/>
{{ session('PhoneVoice1') }}

</x-mail::message>
