@extends('layout.navbar')

@section('container')
    <div class="container-sm mx-auto text-center">
        <div class="border border-danger rounded fs-6" style="background-color: rgb(247 206 204)">
            <p class="mt-2">Mohon tanggal libur yang diinputkan, bukan merupakan hari sabtu maupun hari minggu!</p>
        </div>
        <div class="border border-dark rounded fs-6 my-3 text-start">
            <form class="m-2" action="">
                @csrf
                <label for="tahun">Silakan Pilih Tahun</label>
                <select name="tahun" id="tahun" onchange="filterByYear()">
                    @php
                        $startYear = date('Y');
                        $endYear = date('Y') + 10;
                    @endphp
                    <option value="all">All Years</option>
                    @for ($year = $startYear; $year <= $endYear; $year++)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </form>
        </div>
        <h6 id="libur">DAFTAR HARI LIBUR</h6>
        <div class="text-start">
            <button class="btn btn-primary m-1" id="addButton" onClick="create()">Tambah Data</button>
        </div>
        <div id="read" class="mt-3"></div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="page"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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
    </script>
@endsection
