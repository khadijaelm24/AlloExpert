		@include('layouts.sidebar')

            <!-- NAVBAR -->
            <nav>

                </form>
                <i class='bx bx-menu' ></i>
                <div style="margin-left: 800px;">
                <input type="checkbox" id="switch-mode" hidden>
                <label for="switch-mode" class="switch-mode"></label>
                </div>

            </nav>
            <main>
            <div class="table-data">

                <div class="todo" >
   <div class="container-fluid py-4">
     <!-- Afficher les erreurs de validation -->
     @if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
 @endif

 <!-- Afficher les messages d'erreur personnalisés -->
 @if (session('error'))
     <div class="alert alert-danger">
         {{ session('error') }}
     </div>
 @endif

 <!-- Afficher les messages de succès -->
 @if (session('success'))
     <div class="alert alert-success">
         {{ session('success') }}
     </div>
 @endif
 <section id="content">
    <div class="row">
        <div class="col-12">
            <h1 style="margin-left:480px;">Edit profil<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> <dotlottie-player src="https://lottie.host/63d743ff-b9cc-4569-9ace-5fd076418ea4/qQqAQ5sjNE.json" background="transparent" speed="1" style="width: 300px; height: 300px;transform:translateY(-170px);" loop autoplay></dotlottie-player></h1>
        </div>

        <form action="{{ route('update-profile') }}" method="POST" id="profileForm" enctype="multipart/form-data" style="transform: translate(270px,-290px);">
            @csrf
            @method('PUT') <!-- Indicates that the request is actually a PUT request -->

            <!-- Display and modify the client's photo -->
            <div class="mb-3">
                <img src="{{ asset('uploads/client/' . session('photo_cl')) }}" alt="User Photo" class="img-thumbnail" style="margin: 0 0 0 280px ; border : 5px solid #fd7e14; border-radius: 50%; width:200px; height:200px;transform:translateX(-130px);">
                <div>
                    <label for="photo_cl" class="form-label">Change Photo:</label>
                    <input type="file" class="form-control" id="photo_cl" name="photo_cl" accept="image/*">
                </div>
            </div>

            <!-- Form fields for profile modification -->
            <div class="mb-3">
                <label for="nom_cl" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="nom_cl" name="nom_cl" value="{{ session('nom_cl') }}" required>
            </div>
            <div class="mb-3">
                <label for="prenom_cl" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="prenom_cl" name="prenom_cl" value="{{ session('prenom_cl') }}" required>
            </div>
            <div class="mb-3">
                <label for="email_cl" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email_cl" name="email_cl" value="{{ session('email_cl') }}" required>
            </div>
            <div class="mb-3">
                <label for="adresse_cl" class="form-label">Address:</label>
                <input type="text" class="form-control" id="adresse_cl" name="adresse_cl" value="{{ session('adresse_cl') }}" required>
            </div>
            <div class="mb-3">
                <label for="telephone_cl" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="telephone_cl" name="telephone_cl" value="{{ session('telephone_cl') }}" required>
            </div>
            <div class="mb-3">
                <label for="current_password" class="form-label">Old Password:</label>
                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password (leave blank if not changing):</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password if changing">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
            </div>

            <button type="submit" class="btn btn-primary" id="delet">Save </button>
        </form>

        </div>
    </div>

</section>
 </div>
</div>
<main>
