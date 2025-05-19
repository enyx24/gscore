<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'GScore')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>
<body class="flex flex-col md:flex-row min-h-screen bg-gray-100 text-gray-900">

  <aside id="sidebar" class="hidden md:block w-64 bg-white shadow-lg p-6 space-y-4 md:min-h-screen">
    <h2 class="text-2xl font-bold">GScore</h2>
    <nav class="space-y-2">
      <a href="/" class="block px-2 py-1 rounded hover:bg-gray-200">Dashboard</a>
      <a href="/check" class="block px-2 py-1 rounded hover:bg-gray-200">Search Scores</a>
      <a href="/stats" class="block px-2 py-1 rounded hover:bg-gray-200">Reports</a>
      <a href="/settings" class="block px-2 py-1 rounded hover:bg-gray-200">Settings</a>
    </nav>
  </aside>

  <main class="flex-1 p-4">
    <button onclick="toggleSidebar()" class="md:hidden mb-4 bg-blue-500 text-white px-4 py-2 rounded">
      ☰ Menu
    </button>

    @yield('content')
  </main>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('hidden');
    }
  </script>

</body>
</html>
