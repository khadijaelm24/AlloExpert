<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parteners List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Custom CSS if needed like in the Clients -->
    {{-- <link href="{{ asset('/assets/css/custom.css') }}" rel="stylesheet"> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .pagination-wrapper {
            text-align: center;
            margin-top: 20px;
            overflow-x: hidden; /* Hide horizontal scrollbar */
        }
        
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        
        .pagination li {
            display: inline;
        }
        
        .pagination li a, .pagination li span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #007bff;
            text-decoration: none;
            background-color: #FFF;
            border: 1px solid #ddd;
        }
        
        .pagination li.active span {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        
        .pagination li a:hover {
            background-color: #f8f9fa;
            border-color: #ddd;
        }
        </style>
        
</head>
<body>
    <div class="container-fluid">
        @include('layouts.sidebar_admin')
        <!-- Sidebar -->
    </div>

    <!-- Content -->
    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link"></a>
            <form action="{{ route('partenaires.search') }}" method="GET">
                <div class="form-input">
                    <input type="search" name="search" placeholder="Search partenaires..." value="{{ request('search') }}">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
        </nav>
        <!-- Main Content Area -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Partners List</h1>
                </div>
            </div>
            <div class="table-responsive">
                <div class="table-data">
                    <div class="order">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>City</th>
                                   
                                    <th>Domain of Expertise</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($partenaires as $partenaire)
                                    <tr>
                                        <td>{{ $partenaire->nom_par }} {{ $partenaire->prenom_par }}</td>
                                        <td>{{ $partenaire->email }}</td>
                                        <td>{{ $partenaire->ville }}</td>
                                        
                                        <td>{{ $partenaire->domaine_expertise }}</td>

                                        
                                            <td>
                                                @if($partenaire->is_active)
                                                <form action="{{ route('partenaires.deactivate', $partenaire->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-danger"><i class="fa fa-unlock"></i></button>
                                                </form>
                                                @else
                                                <form action="{{ route('partenaires.activate', $partenaire->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-success"><i class="fa fa-lock"></i></button>
                                                </form>
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
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            // Check for Laravel flash session message and display it using SweetAlert2
            @if(session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'Okay'
                });
            @elseif(session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonText: 'Okay'
                });
            @endif
        });
        </script>
        
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
