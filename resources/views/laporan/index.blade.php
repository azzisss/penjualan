@extends('layout.main')

@section('mainkonten')
<div class="container-fluid px-4">
 <h1 class="mt-4">Laporan</h1>
 <ol class="breadcrumb mb-4">
     <li class="breadcrumb-item active">Laporan</li>
 </ol>
 <div class="row">
     <div class="col-xl-3 col-sm-6">
         <div class="card border border-primary bg-primary text-white mb-4">
             <div class="card-header"><h5>Laporan Harian</h5></div>
             <div class="card-body bg-light">
                <h5 class="text-black">
                    <span class="badge bg-secondary mx-auto d-block rounded-0 ">terjual</span>
                    <button class="btn btn-primary rounded-0"><img src="{{ asset('img/cup-hot.svg') }}" style="width: 2em; height:2em" alt=""></button>&nbsp; {{ $trjlhari }} Buah <hr>
                    <span class="badge bg-secondary mx-auto d-block rounded-0">pendapatan</span>
                    <button class="btn btn-primary rounded-0"><p class="mb-0 text-black fs-5 fw-bold" >Rp.</p></button>&nbsp; {{ number_format($pndptnhari,2,",",".") }}
                </h5>
            </div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                 <a class="small text-white stretched-link" href="/laporan/harian">View Details</a>
                 <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
         </div>
     </div>
     <div class="col-xl-3 col-md-6">
         <div class="card bg-warning text-white mb-4">
            <div class="card-header"><h5>Laporan Bulanan</h5></div>
            <div class="card-body bg-light">
                <h5 class="text-black">
                    <span class="badge bg-secondary mx-auto d-block rounded-0 ">terjual</span>
                    <button class="btn btn-warning rounded-0"><img src="{{ asset('img/cup-hot.svg') }}" style="width: 2em; height:2em" alt=""></button>&nbsp; {{ $trjlbulan }} Buah <hr>
                    <span class="badge bg-secondary mx-auto d-block rounded-0">pendapatan</span>
                    <button class="btn btn-warning rounded-0"><p class="mb-0 text-black fs-5 fw-bold" >Rp.</p></button>&nbsp; {{ number_format($pndptnbulan,2,",",".") }}
                </h5>
             </div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                 <a class="small text-white stretched-link" href="laporan/bulanan">View Details</a>
                 <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
         </div>
     </div>
     <div class="col-xl-3 col-md-6">
         <div class="card bg-success text-white mb-4">
            <div class="card-header"><h5>Laporan Tahunan</h5></div>
            <div class="card-body bg-light">
                <h5 class="text-black">
                    <span class="badge bg-secondary mx-auto d-block rounded-0 ">terjual</span>
                    <button class="btn btn-success rounded-0"><img src="{{ asset('img/cup-hot.svg') }}" style="width: 2em; height:2em" alt=""></button>&nbsp; {{ $trjltahun }} Buah <hr>
                    <span class="badge bg-secondary mx-auto d-block rounded-0">pendapatan</span>
                    <button class="btn btn-success rounded-0"><p class="mb-0 text-black fs-5 fw-bold" >Rp.</p></button>&nbsp; {{ number_format($pndptntahun,2,",",".") }}
                    
                </h5>
             </div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                 <a class="small text-white stretched-link" href="laporan/tahunan">View Details</a>
                 <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
         </div>
     </div>
     <div class="col-xl-3 col-md-6">
         <div class="card bg-danger text-white mb-4">
             <div class="card-body">
                <h5>Laporan Acak</h5>
             </div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                 <a class="small text-white stretched-link" href="laporan/semua">View Details</a>
                 <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
         </div>
     </div>
 </div>
 <div class="row">
 </div>
@endsection