@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

{{-- flash messages --}}
    {{-- success message --}}
    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif

    {{-- error message --}}
    @if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
    @endif

    {{-- warning message --}}
    @if(session('warning'))
    <div class="alert alert-warning">
        {{session('warning')}}
    </div>
    @endif
{{-- End flash messages --}}