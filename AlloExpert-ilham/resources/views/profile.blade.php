@extends('layouts.user_type.auth')
@section('profile')
{{-- @section('content') --}}
  {{-- <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100"> --}}
    <div class="container-fluid">
      {{-- <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div> --}}
      {{-- <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden"> --}}
        <div class="row justify-content-center my-5">
            <div class="col-lg-3">
                @include('layouts.navbars.auth.sidebar')
            </div>
            
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{ asset('uploads/client/' . session('photo_cl')) }}" alt="photo_cl" class="w-100 border-radius-lg shadow-sm">

            </div>
          </div>  
        </div>
      <div class="container">
      <div class="row justify-content-center my-5 mx-10">
        <div class="col-30 col-xl-30">
          <div class="card h-100">
        <div class="col-180 col-xl-50">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Mon profile    </h6>
                </div>
                <div class="col-md-10  text-end">
                  <a href={{route('edit-profile')}}>
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nom: </strong>{{ session('nom_cl') }} </li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Prénom: </strong> {{ session('prenom_cl') }}  </li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:  </strong>{{ session('email_cl') }}</li> </li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Adresse:  </strong>{{ session('adresse_cl') }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Telephone:  </strong> {{ session('telephone_cl') }}</li>


              </ul>
            </div>
          </div>
        </div>
    </div>
  

@endsection

