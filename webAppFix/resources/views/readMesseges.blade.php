<table class="table table-hover container-sm table-bordered border-dark rounded fs-6 mt-3">
    <th>Data Ke-</th>
    <th>Nomor Handphone</th>
    <th>Pesan</th>    
    <tbody id="tableBody">
        @php
          $i = 1;   
        @endphp
        @foreach ($messages as $data)
            <tr>
                <td>{{ $i++ }}</td> 
                <td>{{ $data->sender }}</td>
                <td>{{ $data->content }}</td>           
            </tr>
        @endforeach
    </tbody>
</table>

