<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'GScore')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>
<body class="flex min-h-screen bg-gray-100 text-gray-900">

  {{-- Sidebar --}}
  <aside class="w-64 bg-white shadow-lg p-6 space-y-4">
    <h2 class="text-2xl font-bold">GScore</h2>
    <nav class="space-y-2">
      <a href="/" class="block px-2 py-1 rounded hover:bg-gray-200">Dashboard</a>
      <a href="/check" class="block px-2 py-1 rounded hover:bg-gray-200">Search Scores</a>
      <a href="/stats" class="block px-2 py-1 rounded hover:bg-gray-200">Reports</a>
      <a href="/settings" class="block px-2 py-1 rounded hover:bg-gray-200">Settings</a>
    </nav>
  </aside>

  {{-- Nội dung --}}
  <main class="flex-1 p-8">
    @yield('content')
  </main>

</body>
</html>
