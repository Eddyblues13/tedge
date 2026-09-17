@section('title', 'Plans - Tradedgepip')
@include('home.header')

<!-- ===================== TRADING PLANS ===================== -->
<section class="py-16 lg:py-24" style="background-color: var(--background-colour);">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl md:text-7xl font-black text-black dark:text-white mb-2">Plans</h2>
            <h3 class="text-3xl md:text-4xl font-black text-black dark:text-white">Trading</h3>
        </div>

        <style>
            @media (max-width: 768px) {
                .mobile-slide-in {
                    animation: slideInBottom 0.8s ease-out forwards;
                    opacity: 0;
                    transform: translateY(50px);
                }

                .mobile-slide-in:nth-child(1) {
                    animation-delay: 0.1s;
                }

                .mobile-slide-in:nth-child(2) {
                    animation-delay: 0.3s;
                }

                .mobile-slide-in:nth-child(3) {
                    animation-delay: 0.5s;
                }

                .mobile-slide-in:nth-child(4) {
                    animation-delay: 0.7s;
                }

                .mobile-slide-in:nth-child(5) {
                    animation-delay: 0.9s;
                }

                .mobile-slide-in:nth-child(6) {
                    animation-delay: 1.1s;
                }

                @keyframes slideInBottom {
                    from {
                        opacity: 0;
                        transform: translateY(50px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            }
        </style>

        <!-- Plans Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- PLATINUM -->
            <div
                class="mobile-slide-in bg-white dark:bg-[#0b1118] p-10 rounded-[32px] shadow-xl border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
                <div class="text-gray-400 font-bold uppercase tracking-widest text-sm mb-4">PLATINUM</div>
                <div class="text-[var(--primary-link-colour)] text-3xl md:text-4xl font-black mb-8">$1,000,000.00</div>

                <div class="w-full space-y-4 mb-8 text-left text-sm">
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Low Swap Fees</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Leverage up to 1:1000</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Spreads from 0.0 pips</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>

                <a href="{{ route('register') }}"
                    class="w-full h-12 bg-[var(--primary-button)] hover:opacity-90 text-white font-black text-sm flex items-center justify-center transition-opacity rounded-lg">
                    FUND TRADING
                </a>
            </div>

            <!-- PREMIUM -->
            <div
                class="mobile-slide-in bg-white dark:bg-[#0b1118] p-10 rounded-[32px] shadow-xl border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
                <div class="text-gray-400 font-bold uppercase tracking-widest text-sm mb-4">PREMIUM</div>
                <div class="text-[var(--primary-link-colour)] text-3xl md:text-4xl font-black mb-8">$250,000.00</div>

                <div class="w-full space-y-4 mb-8 text-left text-sm">
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Low Swap Fees</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Leverage up to 1:500</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Spreads from 0.4 pips</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>

                <a href="{{ route('register') }}"
                    class="w-full h-12 bg-[var(--primary-button)] hover:opacity-90 text-white font-black text-sm flex items-center justify-center transition-opacity rounded-lg">
                    FUND TRADING
                </a>
            </div>

            <!-- GOLD -->
            <div
                class="mobile-slide-in bg-white dark:bg-[#0b1118] p-10 rounded-[32px] shadow-xl border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
                <div class="text-gray-400 font-bold uppercase tracking-widest text-sm mb-4">GOLD</div>
                <div class="text-[var(--primary-link-colour)] text-3xl md:text-4xl font-black mb-8">$100,000.00</div>

                <div class="w-full space-y-4 mb-8 text-left text-sm">
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Low Swap Fees</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Leverage up to 1:500</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Spreads from 0.8 pips</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>

                <a href="{{ route('register') }}"
                    class="w-full h-12 bg-[var(--primary-button)] hover:opacity-90 text-white font-black text-sm flex items-center justify-center transition-opacity rounded-lg">
                    FUND TRADING
                </a>
            </div>

            <!-- SILVER -->
            <div
                class="mobile-slide-in bg-white dark:bg-[#0b1118] p-10 rounded-[32px] shadow-xl border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
                <div class="text-gray-400 font-bold uppercase tracking-widest text-sm mb-4">SILVER</div>
                <div class="text-[var(--primary-link-colour)] text-3xl md:text-4xl font-black mb-8">$40,000.00</div>

                <div class="w-full space-y-4 mb-8 text-left text-sm">
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>No Swap Fees</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Leverage up to 1:500</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Spreads from 0.8 pips</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>

                <a href="{{ route('register') }}"
                    class="w-full h-12 bg-[var(--primary-button)] hover:opacity-90 text-white font-black text-sm flex items-center justify-center transition-opacity rounded-lg">
                    FUND TRADING
                </a>
            </div>

            <!-- BRONZE -->
            <div
                class="mobile-slide-in bg-white dark:bg-[#0b1118] p-10 rounded-[32px] shadow-xl border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
                <div class="text-gray-400 font-bold uppercase tracking-widest text-sm mb-4">BRONZE</div>
                <div class="text-[var(--primary-link-colour)] text-3xl md:text-4xl font-black mb-8">$15,000.00</div>

                <div class="w-full space-y-4 mb-8 text-left text-sm">
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Leverage up to 1:500</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Spreads from 0.8 pips</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Instant Execution</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>

                <a href="{{ route('register') }}"
                    class="w-full h-12 bg-[var(--primary-button)] hover:opacity-90 text-white font-black text-sm flex items-center justify-center transition-opacity rounded-lg">
                    FUND TRADING
                </a>
            </div>

            <!-- MINI -->
            <div
                class="mobile-slide-in bg-white dark:bg-[#0b1118] p-10 rounded-[32px] shadow-xl border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
                <div class="text-gray-400 font-bold uppercase tracking-widest text-sm mb-4">MINI</div>
                <div class="text-[var(--primary-link-colour)] text-3xl md:text-4xl font-black mb-8">$1,000.00</div>

                <div class="w-full space-y-4 mb-8 text-left text-sm">
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Leverage up to 1:500</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Spreads from 1.2 pips</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-black dark:text-white font-bold">
                        <span>Standard Support</span>
                        <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>

                <a href="{{ route('register') }}"
                    class="w-full h-12 bg-[var(--primary-button)] hover:opacity-90 text-white font-black text-sm flex items-center justify-center transition-opacity rounded-lg">
                    FUND TRADING
                </a>
            </div>

        </div>
    </div>
</section>

@include('home.footer')