<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Laravel App</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>

        .navbar-brand {
            font-weight: bold;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .hero-section {
            background-color: #3E97FF;
            color: white;
            padding: 50px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
        }

        .card {
            margin-top: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer {
            margin-top: 50px;
            padding: 20px 0;
            background-color: #f8f9fa;
            text-align: center;
        }

        .footer p {
            margin: 0;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
    	<link rel="stylesheet" href="{{ asset('assets/css/custom-style.css') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
<div class="navbar-logo">
    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
</div>
            <a class="navbar-brand font-custom" href="#">My App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active font-custom" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item font-custom">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item font-custom">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item font-custom">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-6 mb-2">{{ $username }}</h1>
            <p class="lead mb-0">{{ $last_login }}</p>
        </div>
    </section>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title font-custom">Form Pertanyaan</h5>
                            @if (session('info'))
                    <div class="alert alert-info">
                        {!! session('info') !!}
                    </div>
                @endif
            <form action="{{ route('question.store') }}" method="POST">


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @csrf
                <div class="mb-3 font-custom">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control"name="nama" value="{{ old('nama') }}">
                </div>
                <div class="mb-3 font-custom">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control"name="email" value="{{ old('email') }}">
                </div>
                <div class="mb-3 font-custom">
                    <label for="pertanyaan" class="form-label">Pertanyaan</label>
                    <textarea class="form-control" rows="4"name="pertanyaan">{{ old('pertanyaan') }} </textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Pertanyaan</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 My Laravel App. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
