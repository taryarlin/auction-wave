<script>
    @if (session()->has('success'))
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "{{ session('success') }}",
        });
    @endif

    @if (session()->has('error'))
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "{{ session('error') }}",
        });
    @endif
</script>
