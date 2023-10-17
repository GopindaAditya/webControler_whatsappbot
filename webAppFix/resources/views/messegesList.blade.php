@extends('layout.navbar')

@section('container')
    <div class="text-center">
        <h5 id="libur">DAFTAR PESAN MASUK</h5>
        <div class="container-sm mx-auto text-center">
            <div class="text-start">
                <button class="btn btn-primary " id="refreshButton" onClick="read()"><i
                        class="bi bi-arrow-clockwise"></i></button>
            </div>
        </div>
        <div id="read" class="mt-3"></div>
    </div>
    <script>
        $(document).ready(function() {
            read();
        });

        function read() {
            $.get("{{ url('readMessages') }}", {}, function(data, status) {
                $("#read").html(data);
            });
        }
    </script>
@endsection
