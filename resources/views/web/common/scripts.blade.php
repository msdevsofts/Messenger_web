<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('js/libs/lazysizes.min.js') }}"></script>

@if (!empty($commonScripts))
    @foreach($commonScripts as $val)
        <script src="{{ asset('js/' . $val) . '.js' }}"></script>
    @endforeach

    <script>
        Default.IMG_PROF = '{{ \App\System\Config\DefaultConfig::IMG_PROF }}';
        Default.NICKNAME = '{{ \App\System\Config\DefaultConfig::NICKNAME }}';
    </script>
@endif

@if (!empty($scripts))
    @foreach($scripts as $val)
        <script src="{{ asset('js/' . $val) . '.js' }}"></script>
    @endforeach
@endif
