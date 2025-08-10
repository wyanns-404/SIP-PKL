@if($getState())
    <iframe src="{{ asset('storage/' . $getState()) }}" width="100%" height="500px"></iframe>
@endif
