@section('title', 'Contact Us - Tradedgepip')
@include('home.header')

<!-- ===================== CONTACT CONTENT ===================== -->
<main class="bg-[#E6F3FD] dark:bg-[#0b1118]">
    <div class="max-w-7xl mx-auto px-6 py-12 lg:py-20">

        <!-- Page Title -->
        <h1 class="text-4xl lg:text-5xl font-bold text-left text-black dark:text-white mb-12">
            Contact Us
        </h1>

        <!-- Content Area: Box with border radius -->
        <div
            class="w-full mx-auto bg-white dark:bg-[#0b1118] p-8 lg:p-12 shadow-xl border border-gray-200 dark:border-[#363c4e]">

            <div class="max-w-2xl mx-auto">
                <p class="text-base leading-relaxed text-black/80 dark:text-[#a5bdd9] text-center mb-12">
                    Have a question or want to get in touch? Fill out the form below, and we'll get back to you as soon
                    as possible!
                </p>

                <form class="space-y-6">

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-bold text-black dark:text-white mb-2 ml-1">Your Name</label>
                        <input type="text"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-[#1e293b] border border-gray-200 dark:border-gray-700 rounded-lg text-black dark:text-white focus:outline-none focus:border-[#04b3e1] focus:ring-1 focus:ring-[#04b3e1] transition-colors"
                            required placeholder="Enter your full name">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold text-black dark:text-white mb-2 ml-1">Your Email</label>
                        <input type="email"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-[#1e293b] border border-gray-200 dark:border-gray-700 rounded-lg text-black dark:text-white focus:outline-none focus:border-[#04b3e1] focus:ring-1 focus:ring-[#04b3e1] transition-colors"
                            required placeholder="name@example.com">
                    </div>

                    <!-- Message -->
                    <div>
                        <label class="block text-sm font-bold text-black dark:text-white mb-2 ml-1">Message</label>
                        <textarea rows="5"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-[#1e293b] border border-gray-200 dark:border-gray-700 rounded-lg text-black dark:text-white focus:outline-none focus:border-[#04b3e1] focus:ring-1 focus:ring-[#04b3e1] transition-colors"
                            required placeholder="How can we help you?"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-[#04b3e1] hover:bg-[#039bc2] text-white font-bold py-4 rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                        Send Message
                    </button>

                </form>
            </div>

        </div>
    </div>
</main>

@include('home.footer')