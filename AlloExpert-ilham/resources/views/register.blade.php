@extends('layouts.user_type.guest')

@section('content')

<section class="min-vh-100 mb-8">
  <!-- New field for choosing user type -->

  <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
    style="background-image: url('../assets/img/curved-images/curved14.jpg'); top:-90px;">
   
    <div class="container"  >
      <div class="row justify-content-center">
        <div class="col-lg-5 text-center mx-auto">
          <h1 class="text-white mb-2 mt-5">Welcome</h1>
          <p class="text-lead text-white">Register now to get services and sell your experience for free </p>
        </div>
      </div>
    </div>
  </div>
                        @if (Session::has('successRegisterClient'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('successRegisterClient') }}
                            </div>
                            @elseif (Session::has('successRegisterPartenaire'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('successRegisterPartenaire') }}
                            </div>
                        @elseif (Session::has('errorRegister'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('errorRegister') }}
                            </div>
                        @endif
  <div class="container" style="margin-top:-130px;">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10">
      <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
        <div class="card z-index-0">
          <div class="card-body">
            <form role="form text-left" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="user_type" class="form-label">I am a:</label>
                <select class="form-select" id="user_type" name="user_type">
                  <!-- Ajouter ici pour choisir -->
                  <option value="choisir">Choisir</option>
                  <option value="partner">Partenaire</option>
                  <option value="client">Client</option>
                </select>
              </div>
              <div class="client-fields" style="display: none;"> <!-- Conditional client fields -->
                <div class="mb-3">
                  <label for="nom_cl"></label>
                  <input type="text" class="form-control" placeholder="Nom" aria-label="Nom" aria-describedby="nom-addon" name="nom_cl" id="nom_cl">
                </div>
                <div class="mb-3">
                  <label for="prenom_cl"></label>
                  <input type="text" class="form-control" placeholder="Prénom" aria-label="Prénom" aria-describedby="prenom-addon" name="prenom_cl" id="prenom_cl"> 
                </div>
                <div class="mb-3">
                  <label for="photo_cl"></label>
                  <input type="file" class="form-control" id="photo_cl" name="photo_cl" accept="image/*">
                </div>
                <div class="mb-3">
                  <label for="adresse"></label>
                  <input type="text" class="form-control" placeholder="Adresse" aria-label="Adresse" aria-describedby="adresse-addon" name="adresse" id="adresse">
                </div>
                <div class="mb-3">
                  <label for="telephone"></label>
                  <input type="tel" class="form-control" placeholder="Téléphone" aria-label="Téléphone" aria-describedby="telephone-addon" name="telephone" id="telephone">
                </div>
              </div>
              <!-- End of conditional client fields -->

              <div class="partner-fields" style="display: none;"> <!-- Conditional partner fields -->
                <div class="mb-3">
                  <label for="nom_par"></label>
                  <input type="text" class="form-control" placeholder="Nom" aria-label="Nom" aria-describedby="nom-addon" name="nom_par" id="nom_par">
                </div>
                <div class="mb-3">
                  <label for="prenom_par"></label>
                  <input type="text" class="form-control" placeholder="Prénom" aria-label="Prénom" aria-describedby="prenom-addon" name="prenom_par" id="prenom_par">
                </div>
                <div class="mb-3">
                  <label for="photo_par"></label>
                  <input type="file" class="form-control" id="photo_par" name="photo_par" accept="image/*">
                </div>
                <div class="mb-3">
                  <label for="ville"></label>
                  <input type="text" class="form-control" placeholder="Ville" aria-label="Ville" aria-describedby="ville-addon" name="ville" id="ville">
                </div>
                <div class="mb-3">
                  <label for="metier"></label>
                  <input type="text" class="form-control" placeholder="Métier" aria-label="Métier" aria-describedby="metier-addon" name="metier" id="metier">
                </div>
                <div class="mb-3">
                  <label for="nbr_experience"></label>
                  <input type="number" class="form-control" placeholder="Nombre d'expérience" aria-label="Nombre d'expérience" aria-describedby="experience-addon" name="nbr_experience" id="nbr_experience">
                </div>
                <div class="mb-3">
                  <label for="domaine_expertise" class="form-label">Domaine d'expertise:</label>
                  <select multiple class="form-select" id="domaine_expertise" name="domaine_expertise">
                    <option value="jardinage">Jardinage</option>
                    <option value="ménage">Ménage</option>
                    <option value="cuisine">Cuisine</option>
                    <option value="bricolage">Bricolage</option>
                    <!-- Add more options as needed -->
                  </select>
                </div>
              </div>
              <!-- End of conditional partner fields -->

              <!-- Common fields for both client and partner -->
              <div class="mb-3">
                <label for="email"></label>
                <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="email" id="email">
                @error('email')
                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-3">
                <label for="password"></label>
                <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                  aria-describedby="password-addon" name="password" id="password">
                @error('password')
                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-check form-check-info text-left">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked name="agreement">
                <label class="form-check-label" for="flexCheckDefault">
                  I agree to the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and
                    Conditions</a>
                </label>
              </div>
              <div class="text-center">
                <button type="submit" class="btn  w-100 my-4 mb-2">Sign up</button>
              </div>
              <p class="text-sm mt-3 mb-0">Already have an account? <a href="javascript:;"
                  class="text-dark font-weight-bolder">Sign in</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $('#user_type').change(function () {
      var userType = $(this).val();
      if (userType === 'partner') {
        $('.client-fields').hide();
        $('.partner-fields').show();
      } else if (userType === 'client') {
        $('.partner-fields').hide();
        $('.client-fields').show();
        // Ajouter ici l'option de ni client ni partner avant de choisir pour remplir
      } else if (userType === 'choisir') {
        $('.partner-fields').hide();
        $('.client-fields').hide();
      }
    });
  });
</script>

@endsection