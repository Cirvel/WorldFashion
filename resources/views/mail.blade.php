@component('mail')
    # WORLD FASHION
    <img src="{!! base64_encode(QrCode::format('png')->size(256)->generate('lodawkaswwe')) !!}" alt="">
    
    {{ config('app.name') }}
@endcomponent