@if (Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Success! </strong>{{ Session::get('success') }}
    </div>
@endif


@if (Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Error! </strong>{{ Session::get('error') }}
    </div>
@endif

@if (Session::get('warning'))

    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Warning!</strong> {{ Session::get('warning') }} sffsdf
    </div>
@endif

@if (Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Note! </strong> {{ Session::get('info') }}
    </div>
@endif