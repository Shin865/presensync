<form action="/departemen/{{ $departemen->kode_dept }}/update" method="POST" id="formDepartemen">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="input-icon mb-3">
          <span class="input-icon-addon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3"></path>
              <path d="M4 6v6c0 1.657 3.582 3 8 3c1.075 0 2.1 -.08 3.037 -.224"></path>
              <path d="M20 12v-6"></path>
              <path d="M4 12v6c0 1.657 3.582 3 8 3c.166 0 .331 -.002 .495 -.006"></path>
              <path d="M16 19h6"></path>
              <path d="M19 16v6"></path>
           </svg>
          </span>
          <input type="text" id="nik" value="{{ $departemen->kode_dept }}" class="form-control" name="kode_dept" placeholder="Kode_Jabatan" readonly>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="input-icon mb-3">
          <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
              <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
            </svg>
          </span>
          <input type="text" id="nama_dept" value="{{ $departemen->nama_dept }}" name="nama_dept" class="form-control" placeholder="Nama Jabatan">
        </div>
      </div>
    </div>
<div class="row mt-2">
<div class="col-12">
<div class="form-group">
<button class="btn btn-primary w-100">
  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
    <path d="M10 14l11 -11"></path>
    <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
 </svg>
 Simpan
</button>
</div>
</div>
</div>
</form>