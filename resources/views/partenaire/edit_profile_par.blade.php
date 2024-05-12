@include('layouts.sidebar_par')

<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
        <div style="margin-left: 800px;">
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
        </div>
    </nav>

    <main>

            <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <h1 style="margin-left:480px;">Edit profil<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> <dotlottie-player src="https://lottie.host/63d743ff-b9cc-4569-9ace-5fd076418ea4/qQqAQ5sjNE.json" background="transparent" speed="1" style="width: 300px; height: 300px;transform:translateY(-170px);" loop autoplay></dotlottie-player></h1>
                </div>
                <form action="{{ route('update-profile-partenaire') }}" method="POST" id="profileForm" style="transform: translate(270px,-290px);" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <img src="{{ asset('uploads/partenaire/' . session('photo_par')) }}" alt="photo_par" class="w-9 border-radius-lg shadow-sm" style="margin: 0 0 0 280px ; border : 5px solid #fd7e14; border-radius: 50%; width:200px; height:200px;transform:translateX(-130px);">
                        <div>
                            <label for="photo_par" class="form-label">Change Photo:</label>
                            <input type="file" class="form-control" id="photo_par" name="photo_par" accept="image/*">
                        </div>
                    </div>

                    <!-- Form fields for partenaire's personal information -->
                    <div class="mb-3">
                        <label for="nom_par" class="form-label">First Name :</label>
                        <input type="text" class="form-control" id="nom_par" name="nom_par" value="{{ session('nom_par') }}">
                    </div>
                    <div class="mb-3">
                        <label for="prenom_par" class="form-label">Last Name :</label>
                        <input type="text" class="form-control" id="prenom_par" name="prenom_par" value="{{  session('prenom_par') }}">
                    </div>
                    <div class="mb-3">
                        <label for="email_par" class="form-label">Email :</label>
                        <input type="text" class="form-control" id="email_par" name="email_par" value="{{  session('email_par') }}">
                    </div>
                    <div class="mb-3">
                        <label for="ville_par" class="form-label">City :</label>
                        <input type="text" class="form-control" id="ville_par" name="ville_par" value="{{  session('ville_par') }}">
                    </div>
                    <div class="mb-3">
                        <label for="nbr_experience" class="form-label">Number of years of experience :</label>
                        <input type="text" class="form-control" id="nbr_experience" name="nbr_experience" value="{{ session('nbr_experience') }}">
                    </div>
                    <div class="mb-3">
                        <label for="domaine_expertise" class="form-label">Field of expertise:</label>
                        <input type="text" class="form-control" id="domaine_expertise" name="domaine_expertise" value="{{ session('domaine_expertise') }}" readonly>
                    </div>
                                    <!-- Form fields for updating services -->
                                    @foreach ($services as $service)
                                    <div class="mb-3">
                                        <label class="form-label">Service's name {{ $loop->iteration }} :</label>
                                        <input type="text" class="form-control" value="{{ $service->nom_service }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Availability {{ $loop->iteration }} :</label>
                                        <input type="text" class="form-control" value="{{ $service->crenau_dispo }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Price {{ $loop->iteration }} :</label>
                                        <input type="text" class="form-control" value="{{ $service->prix }}" readonly>
                                    </div>
                                    @endforeach
                    <!-- Form fields for updating services -->
                                         <!-- Additional services fields -->
                     <div class="service-fields">
                        <!-- New service fields will be appended here dynamically -->
                    </div>
                    <!-- Add More button to add services dynamically -->
                    <button type="button" id="addMoreFields" class="btn btn-secondary">Add More</button>
                    <button type="submit" class="btn btn-primary" id="sumit" >Save</button>
                </form>
            </div>
        </div>

        <!-- Profile update form -->


    </main>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var counter = {{ count($services) }} + 1; // Start with the number of existing services + 1

        $('#addMoreFields').click(function() {
            if (counter <= 3) {
                var newFields =
                `<div class="mb-3">
                <label for="service[${counter}]" class="form-label">Service ${counter}:</label>
                <select name="services[${counter}][service]" id="service${counter}" class="form-select">
                    @foreach($servicesOptions[Session::get('domaine_expertise')] as $serviceOption)
                        <option value="{{ $serviceOption }}">{{ $serviceOption }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="creneau${counter}" class="form-label">Creneau de disponibilité:</label>
                <select name="services[${counter}][creneau]" id="creneau${counter}" class="form-select">
                    <option value="Morning (07:00->12:00)">Morning (07:00->12:00)</option>
                    <option value="Afternoon(12:00->18:00)">Afternoon(12:00->18:00)</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="prix${counter}" class="form-label">Prix de service:</label>
                <input type="text" class="form-control" name="services[${counter}][prix]" id="prix${counter}">
            </div>`;


                $('.service-fields').append(newFields);
                counter++;
                if (counter > 3) {
                    $(this).prop('disabled', true); // Disable the button if more than 3 services
                }
            }
        });
    });
</script>
