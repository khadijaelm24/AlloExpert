<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamations List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container-fluid">
        @include('layouts.sidebar_admin')
        <section id="content">
            <nav>
                <i class='bx bx-menu'></i>
                <a href="#" class="nav-link"></a>
                <form action="{{ route('reclamations.search') }}" method="GET">
                    <div class="form-input">
                        <input type="search" name="search" placeholder="Search " value="{{ request('search') }}">
                        <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                    </div>
                </form>
                
                <input type="checkbox" id="switch-mode" hidden>
                <label for="switch-mode" class="switch-mode"></label>
            </nav>
            <main>
                <div class="head-title">
                    <div class="left">
                        <h1>Reclamations List</h1>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="table-data">
                        <div class="order">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Expert Name</th>
                                <th>Description</th>
                                <th>Sender</th>
                                <th>Date Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reclamations as $reclamation)
                                <tr>
                                    <td>{{ $reclamation->client ? $reclamation->client->nom_cl . ' ' . $reclamation->client->prenom_cl : 'Unknown' }}</td>
        <!-- Display full name for expert (partenaire) -->
                                    <td>{{ $reclamation->expert ? $reclamation->expert->nom_par . ' ' . $reclamation->expert->prenom_par : 'Unknown' }}</td>
                                    <td>{{ $reclamation->description }}</td>
                                    <td>{{ $reclamation->sender }}</td>
                                    <td>{{ $reclamation->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @if($reclamation->sender == 'client')
                                            <!-- If the complaint is against a partenaire, show an icon for managing the partenaire -->
                                            <a href="{{ route('partenaires.show', $reclamation->expert->id ?? 0) }}" >
                                                <i class="fas fa-user-cog"></i>
                                            </a>
                                        @else
                                            <!-- If the complaint is against a client, show an icon for managing the client -->
                                            <a href="{{ route('admin.clients', $reclamation->client->id ?? 0) }}" >
                                                <i class="fas fa-user-cog"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            </main>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
