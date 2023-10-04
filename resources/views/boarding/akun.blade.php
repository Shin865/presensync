
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Konfigurasi
          </div>
          <h2 class="page-title">
            Konfigurasi Lokasi Kantor
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    @php
                    if(Session::get('success')){
                      echo '<div class="alert alert-success">'.Session::get('success').'</div>';
                    }elseif(Session::get('error')){
                       echo '<div class="alert alert-danger">'.Session::get('error').'</div>';
                     }
                    @endphp
                    <form action="/konfigurasi/updatelokkantor" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                              <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-cog" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v8"></path>
                                        <path d="M9 4v13"></path>
                                        <path d="M15 7v6.5"></path>
                                        <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M19.001 15.5v1.5"></path>
                                        <path d="M19.001 21v1.5"></path>
                                        <path d="M22.032 17.25l-1.299 .75"></path>
                                        <path d="M17.27 20l-1.3 .75"></path>
                                        <path d="M15.97 17.25l1.3 .75"></path>
                                        <path d="M20.733 20l1.3 .75"></path>
                                     </svg>
                                </span>
                                <input type="text" id="lokasi_kantor" value="{{ $lok_kantor->lokasi_kantor }}" class="form-control" name="lokasi_kantor" placeholder="Lokasi Kantor">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-radar-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M15.51 15.56a5 5 0 1 0 -3.51 1.44"></path>
                                        <path d="M18.832 17.86a9 9 0 1 0 -6.832 3.14"></path>
                                        <path d="M12 12v9"></path>
                                     </svg>
                                </span>
                                <input type="text" id="radius" value="{{ $lok_kantor->radius }}" name="radius" class="form-control" placeholder="Radius">
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
                </div>
            </div>
        </div>
    </div>
</div>