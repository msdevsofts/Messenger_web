<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('js/libs/lazysizes.min.js') }}"></script>

@if (!empty($scripts))
    @foreach($scripts as $val)
        <script src="{{ asset($val) . '.js' }}"></script>
    @endforeach
@endif
