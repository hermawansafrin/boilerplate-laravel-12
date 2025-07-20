@if(session('status_success'))
    <!--begin::Alert-->
    <div class="alert alert-success d-flex align-items-center p-1">
        <!--begin::Icon-->
        <i class="fas fa-exclamation-triangle text-success fs-1 me-4"></i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column m-2" >
            <!--begin::Title-->
        <h4 class="mb-1 text-white">{{ __('messages.session.success.title') }}</h4>
            <!--end::Title-->

            <!--begin::Content-->
            <span>
                {{ session('status_success') }}
            </span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Alert-->
@endif

@if(session('status_failed'))
    <!--begin::Alert-->
    <div class="alert alert-danger d-flex align-items-center p-1">
        <!--begin::Icon-->
        <i class="fas fa-exclamation-triangle text-warning fs-1 me-4"></i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column m-2" >
            <!--begin::Title-->
            <h4 class="mb-1 text-dark">Whoops..</h4>
            <!--end::Title-->

            <!--begin::Content-->
            <span>
                {{ session('status_failed') }}
            </span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Alert-->
@endif

@if($errors->any())
    <!--begin::Alert-->
    <div class="alert alert-danger d-flex align-items-center p-1">
        <!--begin::Icon-->
        <i class="fas fa-exclamation-triangle text-danger fs-1 me-4"></i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column m-2" >
            <!--begin::Title-->
            <h4 class="mb-1 text-white">{{ __('messages.session.failed.title') }}</h4>
            <!--end::Title-->
            {!! implode('', $errors->all('<li>:message</li>')) !!}
            <!--begin::Content-->
            <span>
            </span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Alert-->
@endif



