@section('scripts')
<script>
document.getElementById('roleForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah form submit langsung
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data akan ditambahkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, tambahkan!'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit(); // Melanjutkan submit form jika user mengonfirmasi
        }
    });
});
</script>