<form action="/karyawan/{{ $karyawan->nik }}/update" method="POST" id="formKaryawan" enctype="multipart/form-data">
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
          <input type="text" readonly id="nik" value="{{ $karyawan->nik }}" class="form-control" name="nik" placeholder="NIK">
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
          <input type="text" id="nama_lengkap" value="{{ $karyawan->nama_lengkap }}" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap">
        </div>
      </div>
    </div>
<div class="row">
<div class="col-12">
<div class="input-icon mb-3">
  <span class="input-icon-addon">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-accessible" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
      <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
      <path d="M10 16.5l2 -3l2 3m-2 -3v-2l3 -1m-6 0l3 1"></path>
      <circle cx="12" cy="7.5" r=".5" fill="currentColor"></circle>
   </svg>
  </span>
  <input type="text" id="jabatan" value="{{ $karyawan->jabatan }}" class="form-control" name="jabatan" placeholder="Jabatan">
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="input-icon mb-3">
  <span class="input-icon-addon">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
      <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
      <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
      <path d="M9 12a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1"></path>
   </svg>
  </span>
  <input type="text" id="no_hp" value="{{ $karyawan->no_hp }}" class="form-control" name="no_hp" placeholder="No.HP">
</div>
</div>
</div>
<div class="row mt-2">
<div class="col-12">
<input type="file" name="foto" class="form-control">
<input type="hidden" name="foto_lama" value="{{ $karyawan->foto }}">
</div>
</div>
<div class="row mt-2">
<div class="col-12">
<select name="kode_dept" id="kode_dept" class="form-select">
  <option value="">-- Pilih Departemen --</option>
  @foreach ($departemen as $item)
  <option {{ $karyawan->kode_dept == $item->kode_dept ? 'selected' : ''  }} value="{{ $item->kode_dept }}">{{ $item->nama_dept }}</option>
  @endforeach
</select>
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