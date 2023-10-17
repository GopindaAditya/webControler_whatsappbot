<table class="table table-hover container-sm table-bordered border-dark rounded fs-6 mt-3">
    <th>Tanggal</th>
    <th>Keterangan</th>
    <th>Action</th>
    <tbody id="tableBody">
        @foreach ($offDate as $date)
            <tr>
                <td>{{ $date->off_date }}</td>
                <td>{{ $date->desc }}</td>
                <td>
                    <button class="btn btn-warning" id="btn" onClick="edit({{ $date->id }})">Edit</button> 
                    <button class="btn btn-danger" id="btn" onClick="destroy({{ $date->id }})">Hapus</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

