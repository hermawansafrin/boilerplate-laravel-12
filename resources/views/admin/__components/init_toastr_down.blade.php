<!-- Toastr -->
<script src="{{ asset('admin-template') }}/plugins/toastr/toastr.min.js"></script>

<script>

customConfigToastr = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toastr-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "1000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

const toastrSuccess = (message) => {
    toastr.options = toastr.customConfigToastr;
    toastr.success(message);
}

</script>
