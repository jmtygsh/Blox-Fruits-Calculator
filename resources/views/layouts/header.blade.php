<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('storage/images/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('storage/images/favicon.ico') }}" type="image/x-icon">

    <title>@yield('title', 'Default Site Title')</title>
    <meta name="description" content="@yield('description', 'Default site description.')">
    <meta name="keywords"
        content="Blox Fruits calculator, blox fruit calculator 2024, blox fruit trade checker, blox fruit values">
    <meta name="author" content="Yogesh Jm">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Blox Fruits Calculator - Updated on August 15, 2024">
    <meta property="og:description"
        content="Discover the power of our Blox Fruits calculator to effortlessly compare values, calculate fair trades, and determine potential profit or loss with ease.">
    <meta property="og:image" content="{{ asset('storage/images/logo.webp') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Canonical Link -->
    <link rel="canonical" href="{{ url()->current() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "name": "Blox Fruits Calculator",
          "url": "{{route('/')}}"
        }
      </script>
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "SoftwareApplication",
          "name": "Blox Fruits Calculator",
          "url": "{{route('/')}}",
          "image": "{{ asset('storage/images/logo.png') }}",
          "description": "Discover the power of our Blox Fruits calculator 2024 to effortlessly compare values, calculate fair trades, and determine potential profit or loss with ease.",
          "operatingSystem": "Web",
          "applicationCategory": "GameApplication",
          "author": {
            "@type": "Person",
            "name": "Ygsh Jm",
            "url": "{{route('/')}}"
          },
          "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "5",
            "ratingCount": "75950"
          },
          "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "USD"
          }
        }
      </script>
</head>

<body>
    @include('layouts.navigation')
