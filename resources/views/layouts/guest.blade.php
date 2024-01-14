<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>Edutrans Institute by Hendi Pratama</title>
  <meta name="title" content="Edutrans Institute" />
  <meta name="description" content="Edutrans Institute merupakan sebuah platform transformasi edukasi yang memiliki misi untuk menyederhanakan & mempermudah proses pembelajaran melalui berbagai pilihan e-course sesuai dengan kebutuhan pelanggan dan industri masa kini tentunya." />
  <meta name="keywords" content="Kursus murah, kursus gratis, kursus bersertifikat, personal branding, pengembangan diri, materi public speaking" />

  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://edutransinstitute.com" />
  <meta property="og:title" content="Edutrans Institute" />
  <meta property="og:description" content="Edutrans Institute merupakan sebuah platform transformasi edukasi yang memiliki misi untuk menyederhanakan & mempermudah proses pembelajaran melalui berbagai pilihan e-course sesuai dengan kebutuhan pelanggan dan industri masa kini tentunya." />
  <meta property="og:image" content="https://edutransinstitute.com/assets/images/og.png" />

  <meta property="twitter:card" content="summary_large_image" />
  <meta property="twitter:url" content="https://edutransinstitute.com" />
  <meta property="twitter:title" content="Edutrans Institute" />
  <meta property="twitter:description" content="Edutrans Institute merupakan sebuah platform transformasi edukasi yang memiliki misi untuk menyederhanakan & mempermudah proses pembelajaran melalui berbagai pilihan e-course sesuai dengan kebutuhan pelanggan dan industri masa kini tentunya.." />
  <meta property="twitter:image" content="https://edutransinstitute.com/assets/images/og.png" />

  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/favicon/apple-icon-57x57.png') }}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/favicon/apple-icon-60x60.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/favicon/apple-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/favicon/apple-icon-76x76.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/favicon/apple-icon-114x114.png') }}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/favicon/apple-icon-120x120.png') }}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/favicon/apple-icon-144x144.png') }}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/favicon/apple-icon-152x152.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-icon-180x180.png') }}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/favicon/android-icon-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicon/favicon-96x96.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('assets/favicon/manifest.json') }}">
  <meta name="msapplication-TileColor" content="#4C8DAB">
  <meta name="msapplication-TileImage" content="{{ asset('assets/favicon/ms-icon-144x144.png') }}">
  <meta name="theme-color" content="#4C8DAB">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script async src="https://eu.umami.is/script.js" data-website-id="690e8481-ce7b-4556-bba7-b5e9fe0ef587"></script>

  @if(env('APP_ENV') === 'local')
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/icons.css'])
  @else
  <link rel="stylesheet" href="{{ asset('build/assets/app-42205b7d.css') }}">
  <link rel="stylesheet" href="{{ asset('build/assets/icons-adf300ab.css') }}">
  <script src="{{ asset('build/assets/app-02317797.js') }}"></script>
  @endif
  @stack('css')
</head>

<body data-mode="light" data-sidebar-size="lg">
  @include('layouts.partials.member.topbar')
  {{ $slot }}
  @include('layouts.partials.member.footer')
  @include('layouts.partials.scripts')
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  @stack('js')
</body>

</html>
