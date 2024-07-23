 
 
 
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         let roleForm = document.getElementById('roleForm');

         roleForm.addEventListener('submit', function(event) {
             // Ambil nilai dari setiap input
             let name = roleForm.querySelector('input[name="name"]').value.trim();
             let permissions = roleForm.querySelector('select[name="permissions[]"]').selectedOptions;

             // Cek apakah semua input telah diisi
             if (name !== "" && permissions.length > 0) {
                 event.preventDefault(); // Mencegah pengiriman formulir secara otomatis

                 // Tampilkan konfirmasi
                 Swal.fire({
                     title: 'Apakah Anda yakin?',
                     html: '<p style="font-size: 14px;">Anda akan menambah data peran user baru dengan nama <strong>' +
                         name + '</strong></p>',
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Ya, tambahkan!',
                     cancelButtonText: 'Batal'
                 }).then((result) => {
                     if (result.isConfirmed) {
                         roleForm.submit(); // Kirim formulir jika pengguna menekan "Ya"
                     }
                 });
             }
         });
     });
 </script>

 <script>
     document.addEventListener('DOMContentLoaded', function() {
         let roleForm = document.getElementById('roleForm');

         roleForm.addEventListener('submit', function(event) {
             // Ambil nilai dari setiap input
             let name = roleForm.querySelector('input[name="name"]').value.trim();
             let permissions = roleForm.querySelector('select[name="permissions[]"]').selectedOptions;

             // Cek apakah semua input telah diisi
             if (name !== "" && permissions.length > 0) {
                 event.preventDefault(); // Mencegah pengiriman formulir secara otomatis

                 // Tampilkan konfirmasi
                 Swal.fire({
                     title: 'Apakah Anda yakin?',
                     html: '<p style="font-size: 14px;">Anda akan mengubah data peran user dengan nama <strong>' +
                         name + '</strong></p>',
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Ya, ubah!',
                     cancelButtonText: 'Batal'
                 }).then((result) => {
                     if (result.isConfirmed) {
                         roleForm.submit(); // Kirim formulir jika pengguna menekan "Ya"
                     }
                 });
             }
         });
     });
 </script>
