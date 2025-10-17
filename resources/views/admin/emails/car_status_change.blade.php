@component('mail::message')
# Car Approval Update

Hello {{ $car->supplier->name ?? 'Supplier' }},

Your car **{{ $car->c_name }}** has been 
@if($car->c_is_approved)
**approved** ✅
@else
**disapproved** ❌
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
