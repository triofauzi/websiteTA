@if (Session::has('success'))
    <!-- Success Alert -->
    <div class="alert alert-success alert-dismissible alert-additional shadow fade show" role="alert">
        <div class="alert-body">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                    <i class="ri-notification-off-line fs-16 align-middle"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="alert-heading">Success!</h5>
                    <p class="mb-0">{{ Session::get('success') }} </p>
                </div>
            </div>
        </div>
        <div class="alert-content">
            <p class="mb-0">{!! Session::get('description') ? Session::get('description') : 'Success Alert!' !!}</p>
        </div>
    </div>
@endif

@if (Session::has('warning'))
    <!-- Warning Alert -->
    <div class="alert alert-warning alert-dismissible alert-additional shadow fade show" role="alert">
        <div class="alert-body">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                    <i class="ri-notification-off-line fs-16 align-middle"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="alert-heading">Warning!</h5>
                    <p class="mb-0">{{ Session::get('warning') }} </p>
                </div>
            </div>
        </div>
        <div class="alert-content">
            <p class="mb-0">{!! Session::get('description') ? Session::get('description') : 'Warning Alert!' !!}</p>
        </div>
    </div>
@endif
