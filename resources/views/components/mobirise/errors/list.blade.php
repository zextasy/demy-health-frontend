@if ($errors->any())
    <div class="row">
        <div class="alert alert-danger col-12">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
