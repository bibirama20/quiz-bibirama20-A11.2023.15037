
<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Poliklinik' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>

    <div class="app-wrapper">

        {{-- SIDEBAR --}}
        <div id="appSidebar" class="sidebar-fixed">
            @include('components.partials.sidebar')
        </div>

        {{-- OVERLAY --}}
        <div class="sidebar-overlay"
            id="sidebarOverlay"
            onclick="toggleSidebar()">
        </div>

        {{-- MAIN --}}
        <div class="main-content">

            @include('components.partials.header')

            <div class="main-scroll">

                {{-- NOTIFIKASI BERHASIL --}}
                @if (session('success') || (session('message') && session('type', 'success') === 'success'))
                    <div id="notification"
                        class="alert alert-success mb-4 rounded-xl shadow-sm">

                        <i class="fas fa-check-circle"></i>

                        <span>
                            {{ session('success') ?? session('message') }}
                        </span>
                    </div>
                @endif

                {{-- NOTIFIKASI GAGAL --}}
                @if (session('error') || (session('message') && session('type') === 'error'))
                    <div id="notification"
                        class="alert alert-error mb-4 rounded-xl shadow-sm">

                        <i class="fas fa-circle-xmark"></i>

                        <span>
                            {{ session('error') ?? session('message') }}
                        </span>
                    </div>
                @endif

                {{-- NOTIFIKASI PERINGATAN --}}
                @if (session('message') && session('type') === 'warning')
                    <div id="notification"
                        class="alert alert-warning mb-4 rounded-xl shadow-sm">

                        <i class="fas fa-triangle-exclamation"></i>

                        <span>{{ session('message') }}</span>
                    </div>
                @endif

                {{-- NOTIFIKASI VALIDASI --}}
                @if ($errors->any())
                    <div class="alert alert-error mb-4 rounded-xl shadow-sm">

                        <i class="fas fa-circle-exclamation"></i>

                        <div>
                            <p class="font-semibold">
                                Data belum valid.
                            </p>

                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                {{-- KONTEN HALAMAN --}}
                {{ $slot }}

            </div>

            @include('components.partials.footer')

        </div>

    </div>

    {{-- FUNGSI SIDEBAR DAN FULLSCREEN --}}
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('appSidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.toggle('open');

            overlay.style.display =
                sidebar.classList.contains('open') ? 'block' : 'none';
        }

        function toggleFullscreen() {
            const icon = document.getElementById('fsIcon');

            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
                icon.className = 'fas fa-compress';
            } else {
                document.exitFullscreen();
                icon.className = 'fas fa-expand';
            }
        }
    </script>

    {{-- TIMER NOTIFIKASI 2 DETIK --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notifications = document.querySelectorAll('#notification');

            notifications.forEach(function (notification) {
                setTimeout(function () {
                    notification.style.transition = 'opacity 0.3s ease';
                    notification.style.opacity = '0';

                    setTimeout(function () {
                        notification.remove();
                    }, 300);
                }, 2000);
            });
        });
    </script>

    @stack('scripts')

</body>

</html>
