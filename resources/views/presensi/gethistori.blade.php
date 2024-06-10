@if($histori->isEmpty())
<div class="alert alert-warning mt-1">
    <div style="text-align: center;">
        <span><strong>Data Tidak Ditemukan</strong></span>
    </div>
</div>
@endif
<style>
    .historicontent {
        display: flex;
        margin-top: 10px;
    }
    .datapresensi {
        margin-left: 10px;
    }
</style>
@foreach($histori as $d)
@if ($d->status == "h")
 <div class="card mb-1">
     <div class="card-body">
         <div class="historicontent">
             <div class="iconpresensi">
                 <ion-icon name="finger-print-outline" style="font-size: 48px;" class="text-success"></ion-icon>
             </div>
             <div class="datapresensi">
                  <h3 style="line-height: 3px">Presensi</h3>
                  <h4 style="margin: 0px !important">{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</h4>
                  <span style="margin-right: 5px !important">{{ $d->jam_in }}</span>
                  <span> - </span>
                 <span style="margin-left: 5px !important">{{ $d->jam_out != null ? $d->jam_out : 'Belum Presensi'}}</span>
                 <br>
                 <span>
                     @if($d->jam_in >= '08:00')
                     <span class="text-danger">Terlambat</span>
                     @else
                      <span class="text-success">Tepat Waktu</span>
                      @endif
                  </span> 
              </div>
          </div>
      </div>
  </div>
  @elseif ($d->status == "i")
  <div class="card mb-1">
      <div class="card-body">
          <div class="historicontent">
              <div class="iconpresensi">
                <ion-icon name="document-outline" style="font-size: 48px;" class="text-primary"></ion-icon>
              </div>
            <div class="datapresensi">
                <h3 style="line-height: 3px">Izin - {{ $d->kode_izin }}</h3>
                <h4 style="margin: 0px !important">{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</h4>
                   <span style="margin-right: 5px !important">{{ $d->keterangan }}</span>
                </div>
            </div>
        </div>
    </div>
  @elseif ($d->status == "s")
  <div class="card mb-1">       <div class="card-body">
          <div class="historicontent">
              <div class="iconpresensi">
                 <ion-icon name="medkit-outline" style="font-size: 48px;" class="text-danger"></ion-icon>
              </div>
              <div class="datapresensi">
                  <h3 style="line-height: 3px">Sakit - {{ $d->kode_izin }}</h3>
                  <h4 style="margin: 0px !important">{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</h4>
                  <span style="margin-right: 5px !important">{{ $d->keterangan }}</span>
                  <br>
                      @if(!empty($d->doc_sid))
                      <span style="color: blue">
                     <ion-icon name="document-attach-outline"></ion-icon>SID
                     </span>
                     @endif
             </div>
         </div>
     </div>
 </div>
 @elseif ($d->status == "c")   
 <div class="card mb-1">       
    <div class="card-body">           
        <div class="historicontent">
              <div class="iconpresensi">
                  <ion-icon name="calendar-outline" style="font-size: 48px;" class="text-warning"></ion-icon>
              </div>
              <div class="datapresensi">
                  <h3 style="line-height: 3px">Cuti - {{ $d->kode_cuti }}</h3>
                  <h4 style="margin: 0px !important">{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</h4>
                  <span style="margin-right: 5px !important" class="text-info">{{ $d->nama_cuti}}</span>
                  <span style="margin-right: 5px !important">{{ $d->keterangan }}</span>
             </div>
         </div>
     </div>
 </div>
 @endif
@endforeach