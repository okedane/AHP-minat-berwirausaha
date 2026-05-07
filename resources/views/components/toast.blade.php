<div class="position-fixed top-0 end-0 mt-4 me-3" style="z-index: 11">
    <div id="liveToast" class="toast @if ($errors->any() || session('success') || session('error')) show @endif" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header
            @if(session('success')) bg-primary text-white
            @elseif(session('error')) bg-danger text-white
            @elseif($errors->any()) bg-warning text-dark
            @endif">
            <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" class="me-2" height="18">
            <strong class="me-auto">Melita Kitchen</strong>
            <small class="text-muted">Just now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body
            @if(session('success')) text-success
            @elseif(session('error')) text-danger
            @elseif($errors->any()) text-warning
            @endif">
            @if(session('success'))
                {{ session('success') }}
            @elseif(session('error'))
                {{ session('error') }}
            @elseif($errors->any())
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
