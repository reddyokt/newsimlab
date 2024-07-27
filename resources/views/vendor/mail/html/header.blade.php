@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{URL::asset('landing/assets/img/simlab.png')}}" class="logo" alt="Simlab Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
