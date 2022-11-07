@push('styles')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

<x-layout>
    <div class="content-container">
        <img src="{{ asset('images/kryztan.jpg') }}" alt="Kryztan Santos"
             style="height: 300px; border-radius: 50%; border: 6px solid #606060; margin-right: 50px;">

        <div style="display: flex; flex-direction: column;">
            <div style="color: white; font-size: 32px; font-family: monospace;
                border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 10px;">
                Joel Kryztan Santos</div>
            <div style="color: white; font-size: 32px; font-family: monospace;">Full Stack Web Developer<span class="blinking">_</span></div>
        </div>
    </div>
</x-layout>
