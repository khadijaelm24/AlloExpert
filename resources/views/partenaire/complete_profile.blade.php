@include('layouts.sidebar_par')
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <!-- Ajoutez du contenu de navbar ici si nécessaire -->
    </nav>
    <main>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <h1 id="h11">Complete your profil</h1>
                </div>
                <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

                <dotlottie-player src="https://lottie.host/be92241e-8234-43b0-8006-8160f09ce0d0/K7L0VCZLKd.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay ></dotlottie-player>
                <form action="{{ route('complete_profile_par') }}" method="POST" id="profileForm" style="transform: translate(300px,-300px);">
                    @csrf
                    <div class="mb-3">
                        <label for="domaine_expertise" class="form-label">Field of expertise:</label>
                        <input type="text" class="form-control" id="domaine_expertise" name="domaine_expertise" value="{{ Session::get('domaine_expertise') }}" readonly>
                    </div>
                    <!-- Afficher une liste de choix spécifique en fonction du domaine d'expertise -->
                    <div class="mb-3">
                        <input type="hidden" name="service_count" id="serviceCount" value="1"> <!-- Hidden field to keep track of the number of services -->

                        <label for="service[1]" class="form-label">Service 1:</label>
                        <select name="services[1][service]" id="service1" class="form-select">
                            @php
                                $servicesOptions = [
                                    'bricolage' => [
                                        "Appliance installation",
                                        "Home security system installation",
                                        "Heating and air conditioning (HVAC) installation",
                                        "Curtain and blinds installation",
                                        "Plumbing repair",
                                        "Handle installation"
                                    ],
                                    'jardinage' => [
                                        "Landscape design",
                                        "Garden lighting",
                                        "Garden cleaning",
                                        "Lawn treatment",
                                        "Deck and patio construction",
                                        "Hedge maintenance",
                                        "Seasonal maintenance services"
                                    ]
                                ];
                            @endphp
                             @foreach($servicesOptions[Session::get('domaine_expertise')] as $serviceOption)
                             <option value="{{ $serviceOption }}">{{ $serviceOption }}</option>
                             @endforeach
                        </select>
                    </div>
                    <!-- Fin de la liste de choix spécifique -->
                    <div class="service-fields">
                        <!-- Champs de service seront ajoutés dynamiquement ici -->
                    </div>
                    <div class="mb-3">
                        <label for="creneau1" class="form-label">Availability slot :</label>
                        <select name="services[1][creneau]" id="creneau1" class="form-select">
                            <option  value="Morning (07:00->12:00)">Morning (07:00->12:00)</option>
                            <option  value="Afternoon(12:00->18:00)">Afternoon(12:00->18:00)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="prix1" class="form-label">Service Price:</label>
                        <input type="text" class="form-control" name="services[1][prix]" id="prix1" >
                    </div>
                    <div id="additionalFields">
                        <!-- Additional fields will be appended here dynamically -->
                    </div>
                    <button type="button" id="addMoreFields" class="btn btn-secondary">ADD More</button>
                    <button type="submit" class="btn btn-primary" id="sumit">Save</button>
                </form>
            </div>
        </div>
        </div>
        </div>
    </main>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var counter = 2; // Start with 2 since service1, prix1, creneau1 are already there

        $('#addMoreFields').click(function() {
            if (counter > 3) {
                $(this).prop('disabled', true); // Disable the button if more than 3 services
                return; // Do not execute the rest of the code
            }

            var newFields = `<div class="mb-3">
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

            $('#additionalFields').append(newFields);
            counter++;
            if (counter > 3) {
                $(this).prop('disabled', true); // Disable the button if more than 3 services
            }
        });
    });
</script>
