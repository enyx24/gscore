<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'GScore')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 text-gray-900 relative">
  <div id="sidebar-backdrop" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden" onclick="closeSidebar()"></div>

  <aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg p-6 space-y-4 z-40 transform -translate-x-full transition-transform duration-300 md:static md:translate-x-0 md:block md:min-h-screen">
    <button onclick="closeSidebar()" class="md:hidden text-gray-600 mb-4">
      ✖ Close
    </button>

    <h2 class="text-2xl font-bold">GScore</h2>
    <nav class="space-y-2">
      <a href="/" class="block px-2 py-1 rounded hover:bg-gray-200">Dashboard</a>
      <a href="/check" class="block px-2 py-1 rounded hover:bg-gray-200">Search Scores</a>
      <a href="/stats" class="block px-2 py-1 rounded hover:bg-gray-200">Reports</a>
      <a href="/settings" class="block px-2 py-1 rounded hover:bg-gray-200">Settings</a>
    </nav>
  </aside>

  <main class="md:ml-64 p-4">
    <button onclick="openSidebar()" class="md:hidden mb-4 bg-blue-500 text-white px-4 py-2 rounded">
      ☰ Menu
    </button>

    @yield('content')
  </main>

  <script>
    function openSidebar() {
      document.getElementById('sidebar').classList.remove('-translate-x-full');
      document.getElementById('sidebar-backdrop').classList.remove('hidden');
    }

    function closeSidebar() {
      document.getElementById('sidebar').classList.add('-translate-x-full');
      document.getElementById('sidebar-backdrop').classList.add('hidden');
    }
  </script>

</body>
</html>
