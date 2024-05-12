@include('layouts.sidebar_par')
<!-- At the end of your layouts/main.blade.php or directly in demandes.blade.php before the closing body tag -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu' ></i>
        <a href="#" class="nav-link">Search:</a>
        <form action="{{ route('demande_search') }}" method="GET">
            <div class="form-input">
                <input type="search" name="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
        </form>
    </nav>

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1> Requests</h1>
            </div>
        </div>

        <div class="table-data">
            <div class="order">
                <table>
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th>Client Last Name</th>
                            <th>Client city</th>
                            <th>Date Start</th>
                            <th>Date End</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->service->nom_service }}</td>
                            <td>{{ explode(' ', $reservation->client->nom_cl)[0] }}</td> <!-- Displaying just the first name of the client -->
                            <td>{{ $reservation->client->ville  }}</td>
                            <td>{{ $reservation->date_debut  }}</td>
                            <td>{{ $reservation->date_fin}}</td>
                            <td>{{ $reservation->statut }}</td>
                            <td>
                                <a href="{{ route('reservation.accept', ['id' => $reservation->id]) }}" class="btn-icon"><i class='bx bx-check'></i></a>
                                <a href="{{ route('reservation.refuse', ['id' => $reservation->id]) }}" class="btn-icon"><i class='bx bx-x'></i></a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false
        });
        @endif
    
        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}'
        });
        @endif
    });
    </script>
    