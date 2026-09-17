<!-- ===================== FOOTER ===================== -->
<footer class="bg-white dark:bg-[#000000] pt-20 pb-12 border-t border-gray-100 dark:border-gray-800">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex flex-col lg:flex-row justify-between gap-12 lg:gap-24">

      <!-- Brand / Contact / Copyright -->
      <div class="flex flex-col gap-8 max-w-xs">
        <a href="{{ route('home') }}" class="inline-block">
          <img src="{{ asset('assets/img/logo.png') }}" alt="Tradedgepip" class="h-12 w-auto">
        </a>

        <div class="flex items-center gap-3 text-gray-600 dark:text-gray-400 font-medium">
          <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
              </path>
            </svg>
          </div>
          <a href="mailto:info@Tradedgepip.live"
            class="hover:text-[#00A3FF] transition-colors">info@Tradedgepip.live</a>
        </div>

        <div class="text-sm text-gray-400 dark:text-gray-500 font-medium">
          &copy; {{ date('Y') }} Tradedgepip. All Rights Reserved.
        </div>
      </div>

      <!-- Links Grid -->
      <div class="flex-1 grid grid-cols-2 md:grid-cols-3 gap-8 lg:gap-12">

        <!-- Explore -->
        <div>
          <h4 class="font-bold text-black dark:text-white text-lg mb-6">Explore</h4>
          <ul class="space-y-4 text-gray-500 dark:text-gray-400 font-medium">
            <li><a href="{{ url('faqs') }}" class="hover:text-[#00A3FF] transition-colors">FAQs</a></li>
            <li><a href="{{ url('about') }}" class="hover:text-[#00A3FF] transition-colors">About</a></li>
            <li><a href="{{ url('contact') }}" class="hover:text-[#00A3FF] transition-colors">Contact</a></li>
          </ul>
        </div>

        <!-- Services -->
        <div>
          <h4 class="font-bold text-black dark:text-white text-lg mb-6">Services</h4>
          <ul class="space-y-4 text-gray-500 dark:text-gray-400 font-medium">
            <li><a href="{{ url('copy-trade') }}" class="hover:text-[#00A3FF] transition-colors">Copy Trading</a></li>
            <li><a href="{{ url('forex-trading') }}" class="hover:text-[#00A3FF] transition-colors">Forex Trading</a>
            </li>
            <li><a href="{{ url('crypto-trading') }}" class="hover:text-[#00A3FF] transition-colors">Crypto Trading</a>
            </li>
            <li><a href="{{ url('stocks-trading') }}" class="hover:text-[#00A3FF] transition-colors">Stocks Trading</a>
            </li>
          </ul>
        </div>

        <!-- Resource -->
        <div>
          <h4 class="font-bold text-black dark:text-white text-lg mb-6">Resource</h4>
          <ul class="space-y-4 text-gray-500 dark:text-gray-400 font-medium">
            <li><a href="{{ url('cookie-policy') }}" class="hover:text-[#00A3FF] transition-colors">Cookie Policy</a>
            </li>
            <li><a href="{{ url('privacy-policy') }}" class="hover:text-[#00A3FF] transition-colors">Privacy Policy</a>
            </li>
            <li><a href="{{ url('terms-of-service') }}" class="hover:text-[#00A3FF] transition-colors">Terms Of
                Service</a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>
</footer>

<!-- ===================== JS (Sidebar, Dark Mode, FAQ) ===================== -->
<script>
  // Sidebar
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const openBtn = document.getElementById("openSidebar");

    function openSidebar() {
      sidebar.classList.remove("translate-x-[-100%]");
      overlay.classList.remove("opacity-0", "pointer-events-none");
      overlay.classList.add("opacity-100");
      openBtn.setAttribute("aria-expanded", "true");
      document.body.style.overflow = "hidden";
    }

    function closeSidebar() {
      sidebar.classList.add("translate-x-[-100%]");
      overlay.classList.add("opacity-0", "pointer-events-none");
      overlay.classList.remove("opacity-100");
      openBtn.setAttribute("aria-expanded", "false");
      document.body.style.overflow = "";
    }

    if (openBtn) openBtn.addEventListener("click", openSidebar);
    if (overlay) overlay.addEventListener("click", closeSidebar);

    // FAQ Accordion
    document.querySelectorAll('.faq-item button').forEach(button => {
      button.addEventListener('click', () => {
        const content = button.nextElementSibling;
        const icon = button.querySelector('svg');
        
        // Toggle current
        const isOpen = !content.classList.contains('hidden');
        
        // Close all others
        document.querySelectorAll('.faq-content').forEach(c => c.classList.add('hidden'));
        document.querySelectorAll('.faq-item svg').forEach(s => s.classList.remove('rotate-180'));
        
        if (!isOpen) {
          content.classList.remove('hidden');
          icon.classList.add('rotate-180');
        }
      });
    });

    // Dark Mode Toggle
    const darkModeToggle = document.getElementById("darkModeToggle");
    const themeLabel = document.getElementById("themeLabel");

    function updateThemeLabel() {
      if (document.documentElement.classList.contains('dark')) {
        themeLabel.textContent = 'Light';
      } else {
        themeLabel.textContent = 'Dark';
      }
    }

    // Initial label update
    if (themeLabel) updateThemeLabel();

    if (darkModeToggle) {
        darkModeToggle.addEventListener("click", () => {
        document.documentElement.classList.toggle('dark');
        
        // Save preference to localStorage
        if (document.documentElement.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
        
        updateThemeLabel();
        });
    }
</script>

</body>

</html>