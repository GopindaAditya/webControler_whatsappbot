<form id="inputForm">
    @csrf
    <div class="p2">
        <div class="form-group text-start">
            <label for="off_date" class="m-2">Tanggal</label>
            <input type="date" name="off_date" id="off_date" class="form-control" value="">
        </div>
        <div class="form-group text-start">
            <label for="desc">Keterangan</label>
            <input type="text" name="desc" id="desc" class="form-control">
        </div>
        <div class="form-group text-start mt-2">
            <button type="button" class="btn btn-primary" onClick="addDate()">Save</button>
        </div>
    </div>
</form>
