$(document).ready(function() {
    read();

});

function read() {
    $.get("{{ url('read') }}", {}, function(data, status) {
        $("#read").html(data);
    });
}

function filterByYear() {
    var selectedYear = $("#tahun").val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "{{ url('filterByYear') }}",
        method: "POST",
        data: {
            year: selectedYear
        },
        success: function(data, status) {
            $("#read").html(data);
            if (selectedYear === 'all') {
                $("#libur").text("DAFTAR HARI LIBUR");
            } else {
                $("#libur").text("HARI LIBUR TAHUN " + selectedYear);
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            alert('Terjadi kesalahan: ' + xhr.responseText);
        }
    });
}

function create() {
    $.get("{{ url('create') }}", {}, function(data, status) {
        $("#ModalLabel").html("Tambahkan Tanggal Baru");
        $("#page").html(data);
        $("#myModal").modal("show");
    });
}

function addDate() {
    var off_date = $("#off_date").val();
    var desc = $("#desc").val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "{{ url('store') }}",
        method: "POST",
        data: {
            off_date: off_date,
            desc: desc
        },
        success: function(response) {

            $(".btn-close").click();
            read();
            // Atur aksi lain yang diinginkan setelah penyimpanan data berhasil.
            // Show SweetAlert for successful data addition
            Swal.fire({
                icon: 'success',
                title: 'Data berhasil disimpan!',
                showConfirmButton: false,
                timer: 1500
            });
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            alert('Terjadi kesalahan: ' + xhr.responseText);
        }
    });
}

function edit(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "{{ url('show') }}/" + id,
        method: "POST", // Ubah metode HTTP menjadi POST
        data: {},
        success: function(data, status) {
            $("#ModalLabel").html("Update Tanggal");
            $("#page").html(data);
            $("#myModal").modal("show");
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            alert('Terjadi kesalahan: ' + xhr.responseText);
        }
    });
}

function update(id) {
    var off_date = $("#off_date").val();
    var desc = $("#desc").val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "{{ url('update') }}/" + id,
        method: "POST",
        data: {
            off_date: off_date,
            desc: desc
        },
        success: function(response) {
            $(".btn-close").click();
            read();
            Swal.fire({
                icon: 'success',
                title: 'Data berhasil diubah!',
                showConfirmButton: false,
                timer: 1500
            });
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            alert('Terjadi kesalahan: ' + xhr.responseText);
        }
    });
}

function destroy(id) {
    // Show confirmation SweetAlert
    Swal.fire({
        title: 'Apakah Anda yakin ingin menghapus data ini?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user confirms, proceed with the delete action
            var off_date = $("#off_date").val();
            var desc = $("#desc").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('delete') }}/" + id,
                method: "POST",
                data: {
                    off_date: off_date,
                    desc: desc
                },
                success: function(response) {
                    $(".btn-close").click();
                    read();

                    // Show success SweetAlert after deletion
                    Swal.fire({
                        title: 'Data berhasil dihapus!',
                        icon: 'success',
                        timer: 1500,
                        buttons: false,
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }
    });
}