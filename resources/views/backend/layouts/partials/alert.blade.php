@if (Session::has('clientupdated'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Pos Status Updated Successfully',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        });
    </script>
@elseif(Session::has('clientdetailsupdated'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Pos Details Updated Successfully',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        });
    </script>
@elseif(Session::has('productUpdated'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Product Updated Successfully',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        });
    </script>
@elseif(Session::has('productAdded'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Product Added Successfully',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        });
    </script>
@elseif(Session::has('productdeleted'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Product Deleted Successfully',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        });
    </script>
@elseif(Session::has('useradded'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'User Added Successfully',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        });
    </script>
@elseif(Session::has('userupdatesuccess'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'User Updated Successfully',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        });
    </script>
@elseif(Session::has('userdeleted'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'User Deleted Successfully',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        });
    </script>
@elseif(Session::has('productupdated'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Product Updated Successfully',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        });
    </script>
@elseif(Session::has('productdeleted'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Product Deleted Successfully',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        });
    </script>
@elseif(Session::has('setloginpin'))
<script>
    $(document).ready(function() {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Set login pin Successfully',
            showConfirmButton: false,
            timer: 2000,
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    });
</script>
@elseif(Session::has('warning'))
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr['warning'](
                    '{{ Session::get('warning') }}',
                    'Warning!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);
        });
    </script>
@elseif(Session::has('danger'))
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr['error'](
                    '{{ Session::get('danger') }}',
                    'ERROR!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);
        });
    </script>
@elseif(Session::has('errors'))
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr['error'](
                    '{{ Session::get('errors') }}',
                    'ERROR!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);
        });
    </script>
@elseif(Session::has('danger'))
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr['error'](
                    '{{ Session::get('danger') }}',
                    'ERROR!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);
        });
    </script>
@elseif(Session::has('danger'))
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr['error'](
                    '{{ Session::get('danger') }}',
                    'ERROR!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);
        });
    </script>
@endif
@if (session('status'))
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr['success'](
                    '{{ Session::get('status') }}',
                    'Well done!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);
        });
    </script>
@endif
