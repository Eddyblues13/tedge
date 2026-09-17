<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Tradedgepip')</title>

  <!-- Open Graph Meta Tags -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="{{ url()->current() }}" />
  <meta property="og:title" content="Tradedgepip" />
  <meta property="og:description" content="Tradedgepip - Live Charts with Indicators, Foreign Exchange Market Trading Methods, Hours, Sessions, &amp; Plans, Major and Minor Pairs Currency, Bullish and Bearish Divergence" />
  <meta property="og:image" content="{{ asset('assets/img/logo.png') }}" />

  <!-- Font: Signika Negative -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Toastr CSS and JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "timeOut": "5000"
    };
  </script>


  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: { 'signika': ["Signika Negative", "sans-serif"] }
        }
      }
    }
  </script>

  <style>
    @font-face {
      font-family: "Signika Negative";
      font-style: normal;
      font-display: swap;
      font-weight: 300;
      src: local("Signika Negative Light"),
      local("Signika Negative-Light"),
      url("{{ asset('assets/fonts/signika-negative-latin-300.woff2') }}") format("woff2"),
      url("{{ asset('assets/fonts/signika-negative-latin-300.woff') }}") format("woff");
    }

    /* CSS Custom Properties - Light Mode */
    :root {
      --primary-button: #04b3e1;
      --primary-link-colour: #04b3e1;
      --hover: #dce2e4;
      --nav-primary-font-colour: black;
      --nav-secondary-font-colour: white;
      --background-colour: #E6F3FD;
      --background-font-colour: #4a4a4a;
      --background-heading-colour: #000000;
      --primary-background: #ffffff;
      --primary-font-colour: #000000;
      --primary-border-colour: #dbdcdf;
      --secondary-background: #0B48B6;
      --secondary-font-colour: #AED5FB;
      --secondary-heading-colour: #ffffff;
      --border-colour: #f2f2f2;
    }

    /* CSS Custom Properties - Dark Mode */
    .dark {
      --hover: #252b3c;
      --nav-primary-font-colour: white;
      --nav-secondary-font-colour: white;
      --background-colour: #000000;
      --background-font-colour: #a5bdd9;
      --background-heading-colour: #ffffff;
      --primary-background: #0b1118;
      --primary-font-colour: #a5bdd9;
      --primary-border-colour: #363c4e;
      --secondary-background: #000000;
      --secondary-font-colour: #a5bdd9;
      --secondary-heading-colour: #ffffff;
      --border-colour: #434651;
    }

    /* Box sizing reset */
    *,
    *:before,
    *:after {
      box-sizing: inherit;
    }

    /* Body styles matching live site */
    html,
    body {
      height: 100%;
      font-weight: 600;
      box-sizing: border-box;
    }

    body {
      font-size: 14px;
      font-family: "Signika Negative", Arial, sans-serif;
      overflow-x: hidden;
      overflow-y: scroll;
      word-break: break-word;
      top: 0px !important;
      margin: 0 auto;
    }

    /* Utility classes */
    .row {
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 20px;
    }

    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    .row .col {
      float: left;
      box-sizing: border-box;
      padding: 0 .75rem;
      min-height: 1px;
    }

    .row .col.s12 {
      width: 100%;
      margin-left: auto;
      left: auto;
      right: auto;
    }

    /* Smooth transition for dark mode */
    * {
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }
  </style>

  <!-- Dark Mode Init (prevent flash) -->
  <script>
    if (localStorage.getItem('theme') === 'dark') {
      document.documentElement.classList.add('dark');
    }
  </script>
  <!-- Smartsupp Live Chat script -->
  <script type="text/javascript">
    var _smartsupp = _smartsupp || {};
_smartsupp.key = '974a01c057783071750f2d287518e9ecf7f0bf30';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
  </script>
  <noscript>Powered by <a href="https://www.smartsupp.com" target="_blank">Smartsupp</a></noscript>


</head>

<body class="font-signika bg-white dark:bg-[#000000] text-black dark:text-white pt-14">

  <!-- ===================== OFFCANVAS OVERLAY ===================== -->
  <div id="overlay"
    class="fixed inset-0 bg-black/50 opacity-0 pointer-events-none transition-opacity duration-200 z-[55]"></div>

  <!-- ===================== LEFT SIDEBAR (OFFCANVAS) ===================== -->
  <aside id="sidebar"
    class="fixed left-0 top-0 h-full w-[340px] max-w-[88vw] bg-[#E9F6FF] dark:bg-[#0b1118] translate-x-[-100%] transition-transform duration-200 z-[60] shadow-xl">

    <!-- Top brand icon area -->
    <div class="px-4 pt-4 pb-2">
      <div class="flex items-center gap-2">
        <!-- simple RM logo mark -->
        <div class="w-10 h-10 flex items-center justify-center">
          <svg width="36" height="36" viewBox="0 0 64 64" fill="none" aria-hidden="true">
            <path d="M14 50V14h18c10 0 18 8 18 18 0 6-3 11-8 14l10 4v8l-16-6v-8c6-2 10-6 10-12 0-7-5-12-12-12H22v30H14Z"
              fill="#00A3FF" />
            <path d="M22 50V14h8v36h-8Z" fill="#007ACC" />
          </svg>
        </div>
      </div>
    </div>

    <!-- Language bar -->
    <div class="w-full bg-[#0B4DBD] text-white font-semibold tracking-wide px-4 py-2 text-sm">
      LANGUAGE: EN
    </div>

    <!-- Menu content -->
    <div class="px-4 py-3">
      <!-- Dark toggle row -->
      <button type="button" id="darkModeToggle"
        class="w-full flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-80">
        <!-- moon icon (shown in light mode) -->
        <svg id="moonIcon" class="w-5 h-5 dark:hidden" viewBox="0 0 24 24" fill="none" aria-hidden="true">
          <path d="M21 14.5A8.5 8.5 0 0 1 9.5 3a7 7 0 1 0 11.5 11.5Z" fill="currentColor" />
        </svg>
        <!-- sun icon (shown in dark mode) -->
        <svg id="sunIcon" class="w-5 h-5 hidden dark:block" viewBox="0 0 24 24" fill="none" aria-hidden="true">
          <circle cx="12" cy="12" r="5" fill="currentColor" />
          <path
            d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        </svg>
        <span id="themeLabel">Dark</span>
      </button>

      <!-- Nav items -->
      <nav class="space-y-1 max-h-[65vh] overflow-y-auto">
        <a href="{{ url('/#plans') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- list -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <span>Plans</span>
        </a>

        <a href="{{ route('register') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- user plus -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" />
            <circle cx="8.5" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" />
            <line x1="20" y1="8" x2="20" y2="14" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" />
            <line x1="23" y1="11" x2="17" y2="11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
          <span>Sign Up</span>
        </a>

        <a href="{{ route('login') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- sign in -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" />
            <polyline points="10 17 15 12 10 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" />
            <line x1="15" y1="12" x2="3" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
          <span>Login</span>
        </a>
        <a href="{{ url('contact') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- mail -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M4 6h16v12H4V6Z" fill="currentColor" />
            <path d="M4 7l8 6 8-6" stroke="#E9F6FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <span>Contact</span>
        </a>

        <a href="{{ url('about') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- users -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M8.5 12a3.5 3.5 0 1 0-3.5-3.5A3.5 3.5 0 0 0 8.5 12Z" fill="currentColor" />
            <path d="M16.5 12a3.5 3.5 0 1 0-3.5-3.5A3.5 3.5 0 0 0 16.5 12Z" fill="currentColor" />
            <path d="M2.5 21a7 7 0 0 1 12 0" fill="currentColor" />
            <path d="M9.5 21a7 7 0 0 1 12 0" fill="currentColor" />
          </svg>
          <span>About Us</span>
        </a>

        <a href="{{ url('copy-trade') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- copy -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M8 8h12v12H8V8Z" fill="currentColor" />
            <path d="M4 4h12v3H7a3 3 0 0 0-3 3v9H4V4Z" fill="currentColor" />
          </svg>
          <span>Copy Trading</span>
        </a>

        <a href="{{ url('cookie-policy') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- shield/lock -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 2L4 6v6c0 5.5 3.4 10.3 8 12 4.6-1.7 8-6.5 8-12V6l-8-4Z" fill="currentColor" />
            <rect x="10" y="10" width="4" height="5" rx="1" fill="#E9F6FF" />
            <circle cx="12" cy="8" r="2" fill="#E9F6FF" />
          </svg>
          <span>Cookie Policy</span>
        </a>

        <a href="{{ url('crypto-mining') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- pickaxe/mining -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <rect x="3" y="3" width="18" height="18" rx="3" fill="currentColor" />
            <path d="M8 12h8M12 8v8" stroke="#E9F6FF" stroke-width="2" stroke-linecap="round" />
          </svg>
          <span>Crypto Mining</span>
        </a>

        <a href="{{ url('forex-trading') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- currency -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <rect x="2" y="4" width="20" height="16" rx="2" fill="currentColor" />
            <path d="M12 8v8M9 10h6M9 14h6" stroke="#E9F6FF" stroke-width="1.5" stroke-linecap="round" />
          </svg>
          <span>Forex Trading</span>
        </a>

        <a href="{{ url('privacy-policy') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- lock -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 2L4 6v6c0 5.5 3.4 10.3 8 12 4.6-1.7 8-6.5 8-12V6l-8-4Z" fill="currentColor" />
            <rect x="9" y="10" width="6" height="5" rx="1" fill="#E9F6FF" />
          </svg>
          <span>Privacy Policy</span>
        </a>

        <a href="{{ url('bitcoin-mining') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- bitcoin -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <circle cx="12" cy="12" r="10" fill="currentColor" />
            <path d="M12 6v2m0 8v2m-3-9h4.5a2.5 2.5 0 0 1 0 5H9m0 0h4.5a2.5 2.5 0 0 1 0 5H9m0-10v10" stroke="#E9F6FF"
              stroke-width="1.5" stroke-linecap="round" />
          </svg>
          <span>Bitcoin Mining</span>
        </a>

        <a href="{{ url('crypto-trading') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- crypto coin -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <circle cx="12" cy="12" r="10" fill="currentColor" />
            <path d="M12 7v10M9 9l3-2 3 2M9 15l3 2 3-2" stroke="#E9F6FF" stroke-width="1.5" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
          <span>Crypto Trading</span>
        </a>

        <a href="{{ url('stocks-trading') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- chart -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <rect x="3" y="3" width="18" height="18" rx="2" fill="currentColor" />
            <path d="M7 14l3-3 3 3 4-5" stroke="#E9F6FF" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
          <span>Stocks Trading</span>
        </a>

        <a href="{{ url('dogecoin-mining') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- dogecoin -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <circle cx="12" cy="12" r="10" fill="currentColor" />
            <path d="M10 7h2a5 5 0 0 1 0 10h-2V7Z" stroke="#E9F6FF" stroke-width="1.5" />
            <path d="M8 12h6" stroke="#E9F6FF" stroke-width="1.5" stroke-linecap="round" />
          </svg>
          <span>Dogecoin Mining</span>
        </a>

        <a href="{{ url('terms-of-service') }}"
          class="flex items-center gap-3 py-2 text-[14px] font-medium text-black dark:text-white hover:opacity-90">
          <!-- document -->
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M6 2h9l5 5v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Z" fill="currentColor" />
            <path d="M14 2v6h6" fill="#E9F6FF" />
            <path d="M8 13h8M8 17h5" stroke="#E9F6FF" stroke-width="1.5" stroke-linecap="round" />
          </svg>
          <span>Terms of Service</span>
        </a>
      </nav>
    </div>
  </aside>

  <!-- ===================== TOP NAVBAR ===================== -->
  <header class="fixed top-0 left-0 w-full z-50 bg-white dark:bg-[#000000]">
    <div class="max-w-7xl mx-auto px-6">
      <div class="h-14 flex items-center justify-between">
        <!-- Brand Name (left side) -->
        <a href="{{ url('/') }}" class="text-xl font-bold text-black dark:text-white"
          style="font-family: 'Signika Negative', sans-serif;">
          Tradedgepip
        </a>

        <!-- Right side: Nav + Hamburger -->
        <div class="flex items-center gap-10">
          <nav class="hidden md:flex items-center gap-10">
            <a href="{{ url('/') }}"
              class="text-sm font-semibold uppercase tracking-wider text-black dark:text-white">Home</a>
            <a href="{{ url('faqs') }}"
              class="text-sm font-semibold uppercase tracking-wider text-black dark:text-white">FAQ</a>
            <a href="{{ url('about') }}"
              class="text-sm font-semibold uppercase tracking-wider text-black dark:text-white">About Us</a>
            <a href="{{ url('contact') }}"
              class="text-sm font-semibold uppercase tracking-wider text-black dark:text-white">Contact</a>
          </nav>

          <!-- hamburger (always visible like your screenshot) -->
          <button id="openSidebar" class="p-2 text-black dark:text-white hover:opacity-90" aria-label="Open menu"
            aria-expanded="false">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M4 7H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <path d="M4 12H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <path d="M4 17H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </header>