@include('layouts.sidebar_par')

<!-- Inclusion de SweetAlert via CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
        <div style="margin-left: 800px;">
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" the="switch-mode"></label>
        </div>
    </nav>
    <main style="display: flex; justify-content: center; align-items: flex-start; height: 100vh; overflow: auto;">
        <div class="profile-container" style="width: 100%; max-width: 600px; padding: 20px; box-shadow: none; background-color: #f0f0f0; border-radius: 5px; border: 1px solid orange;">
            <div style="text-align: center;"> <!-- Div pour centrer l'image -->
                <img src="{{ asset('alloexpert/assets/images/complaint.png') }}" style="width: 160px; height: 160px;"><br>
            </div>

            <!-- Check for success message and display it with SweetAlert -->
            @if (session('success'))
                <script>
                    Swal.fire({
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    });
                    // Additional styles
                    document.querySelector('.btn').style.backgroundColor = 'orange';
                </script>
            @endif
            <!-- Form for claim submission -->
            <form action="{{ route('submit-complaint-par') }}" method="post" style="text-align: left;">
                @csrf
                <h2 style="text-align: center">Complaint's Submission :</h2><br>
                <b>For which reason do you choose to submit that complaint?</b><br><br>
                <div style="margin-bottom: 10px;">
                    <label><input type="radio" name="claim_type" value="Non-payment for services rendered"> Non-payment for services rendered</label><br>
                    <label><input type="radio" name="claim_type" value="Uncompensated overtime"> Uncompensated overtime</label><br>
                    <label><input type="radio" name="claim_type" value="Late cancellation"> Late cancellation</label><br>
                </div>
                <br>
                <div style="margin-bottom: 10px;">
                    <label for="client_address"><b>Select client address:</b></label>
                    <select name="client_address" id="client_address" style="width: 100%; height: 50px; margin: 20px 0; background-color: lightgray; font-size: 16px;">
                        <option value="choose">Choose</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->adresse }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="text-align: center;">
                    <input type="submit" value="Submit" class="action message" style="box-shadow: none; width: auto; padding: 10px 20px; height: 50px; margin: 20px 0; font-size: 16px;">
                </div>
                {{-- <input type="submit" value="Submit Complaint" class="action message"> --}}
            </form>
        </div>
    </main>
</section>
