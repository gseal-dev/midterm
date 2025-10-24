<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales & Inventory</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            margin: 0;
            min-height: 100vh;
        }

        /* Sidebar (Navbar sa left) */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #212529, #343a40);
            color: white;
            display: flex;
            flex-direction: column;
            padding: 1.5rem 1rem;
        }

        .sidebar .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
        }

        .sidebar .navbar-brand i {
            margin-right: 10px;
            font-size: 1.6rem;
        }

        .sidebar .btn {
            text-align: left;
            margin-bottom: 0.8rem;
            font-size: 1rem;
            padding: 0.7rem 1rem;
        }

        /* Clock - maliit na version */
        .clock {
            text-align: center;
            font-size: 0.85rem;
            font-weight: normal;
            margin-top: -15px;
            margin-bottom: 2rem;
            color: #ffc107;
        }

        /* Content */
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 2rem;
        }

        main {
            flex: 1;
        }
    </style>
</head>
<body>
    {{-- Sidebar Navbar --}}
    <div class="sidebar">
        <a class="navbar-brand" href="{{ route('products.index') }}">
            <i class="bi bi-box-seam"></i> Sales & Inventory
        </a>

        {{-- Clock (baba lang ng Sales & Inventory) --}}
        <div class="clock" id="clock"></div>

        <a class="btn btn-outline-light btn-custom" href="{{ route('categories.index') }}">
            <i class="bi bi-tags"></i> Categories
        </a>
        <a class="btn btn-outline-light btn-custom" href="{{ route('products.index') }}">
            <i class="bi bi-cart4"></i> Products
        </a>
    </div>

    {{-- Main Content --}}
    <div class="content">
        <main>
            {{-- Flash messages (dito na lang) --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Clock Script --}}
    <script>
        function updateClock() {
            const now = new Date();
            let h = String(now.getHours()).padStart(2, '0');
            let m = String(now.getMinutes()).padStart(2, '0');
            let s = String(now.getSeconds()).padStart(2, '0');
            let ampm = h >= 12 ? 'PM' : 'AM';
            h = h % 12;
            h = h ? h : 12;

            document.getElementById('clock').textContent = `${h}:${m}:${s} ${ampm}`;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>
