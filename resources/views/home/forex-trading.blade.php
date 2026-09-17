@section('title', 'Forex Trading - Tradedgepip')
@include('home.header')

<!-- ===================== FOREX TRADING CONTENT ===================== -->
<main class="bg-[#E6F3FD] dark:bg-[#0b1118]">
    <div class="max-w-7xl mx-auto px-6 py-12 lg:py-20">

        <!-- Page Title -->
        <h1 class="text-4xl lg:text-5xl font-bold text-left text-black dark:text-white mb-12">
            Forex Trading
        </h1>

        <!-- Content Area: Box with border radius -->
        <div
            class="w-full mx-auto bg-white dark:bg-[#0b1118] p-8 lg:p-12 shadow-xl border border-gray-200 dark:border-[#363c4e]">

            <div class="space-y-8 text-base leading-relaxed text-black/80 dark:text-[#a5bdd9]">
                <p>
                    Forex is short for foreign exchange. The forex market is a place where currencies are traded. It is
                    the largest and most liquid financial market in the world with an average daily turnover of 6.6
                    trillion U.S. dollars as of 2019. The basis of the forex market is the fluctuations of exchange
                    rates. Forex traders speculate on the price fluctuations of currency pairs, making money on the
                    difference between buying and selling prices.
                </p>

                <div>
                    <h3 class="text-xl font-bold text-black dark:text-white mb-2">What is Margin?</h3>
                    <p>
                        Margin is the amount of a trader's funds required to open a new position. Margin is estimated
                        based on the size of your trade, which is measured in lots. A standard lot is 100,000 units. We
                        also provide mini lots (10,000 units), micro lots (1,000 units), and nano lots (100 units). The
                        greater the lot, the bigger the margin amount. Margin allows you to trade with leverage, which,
                        in turn, allows you to place trades larger than the amount of your trading capital. Leverage
                        influences the margin amount too.
                    </p>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-black dark:text-white mb-2">What is Leverage?</h3>
                    <p>
                        Leverage is the ability to trade positions larger than the amount of capital you possess. This
                        mechanism allows traders to use extra funds from a broker in order to increase the size of their
                        trades. For example, 1:100 leverage means that a trader who has deposited $1,000 into his or her
                        account can trade with $100,000. Although leverage lets traders increase their trade size and,
                        consequently, potential gains, it magnifies their potential losses, putting their capital at
                        risk.
                    </p>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-black dark:text-white mb-2">When is the Forex Market Open?</h3>
                    <p>
                        Due to different time zones, the international forex market is open 24 hours a day — from 5 p.m.
                        Eastern Standard Time (EST) on Sunday to 4 p.m. EST on Friday, except holidays. Markets first
                        open in Australasia, then in Europe, and afterwards in North America. So, when the market closes
                        in Australia, traders can have access to markets in other regions. The 24-hour availability of
                        the forex market is what makes it so attractive to millions of traders.
                    </p>
                </div>

                <p class="pt-4 border-t border-gray-100 dark:border-gray-700 mt-8">
                    Start your forex trading journey with us today and access the world's largest financial market with
                    competitive spreads and advanced trading tools.
                </p>
            </div>

        </div>
    </div>
</main>

@include('home.footer')