<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  @include("jehem-meadolan.components.template")
  @yield('meta_data')

</head>

<body class="bg-gray-50 h-screen">
  {{-- @include("jehem-meadolan.components.navbar") --}}
  @include("jehem-meadolan.login.main")

</body>
</html>