@props([
    'token' => $token
])

{{--<x-mail::message>--}}
{{--    <x-mail::header url="https://www.dcplibrary.org">
        Header
    </x-mail::header>--}}
# <a href="http://localhost:8000/contact/confirm/{{ $token }}">Click here</a>

**Thank you for being a patron of the<br/>
Daviess County Public Library!**<br><br/>
{{--<x-mail::footer>--}}
Daviess County Public Library, 2020 Frederica St, Owensboro, KY 42301
{{--<x-mail::table>--}}
| [Call (270) 684-0211](tel://2706840211)  |  [help@dcplibrary.org](mailto:help@dcplibrary.orghelp@dcplibrary.org)  |  [Text (270) 279-1526](sms://12702791526)  |  [Chat](https://go.dcplibrary.org/chat) |
{{--</x-mail::table>--}}
{{--</x-mail::footer>--}}
{{--</x-mail::message>--}}
