@section('title', 'FAQs - Tradedgepip')
@include('home.header')

<!-- ===================== FAQ ===================== -->
<section class="py-16 lg:py-24" style="background-color: var(--background-colour);">
    <style>
        .collapsible-header {
            border-bottom: 0px;
            color: var(--primary-font-colour) !important;
            background: var(--primary-background);
            font-size: 1rem;
            cursor: pointer;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            line-height: 1.5;
            padding: 1rem;
            display: flex;
            align-items: center;
            width: 100%;
            text-align: left;
        }

        .collapsible-header:hover {
            background-color: var(--hover, #dce2e4);
        }

        details[open] .collapsible-header {
            border-bottom: none;
        }

        details:last-child .collapsible-header {
            border-bottom: none;
        }

        details[open]:last-child .collapsible-header {
            border-bottom: none;
        }

        .faq-arrow {
            margin-right: 1rem;
            transition: transform 0.3s ease;
            width: 20px;
            height: 20px;
        }

        details[open] .faq-arrow {
            transform: rotate(180deg);
        }
    </style>
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-black mb-4" style="color: var(--background-heading-colour);">FAQs</h2>
        </div>

        <div class="space-y-6">

            <!-- Card 1: Trading Questions -->
            <div class="rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow"
                style="background-color: var(--primary-background);">

                <!-- Q1 -->
                <details class="group">
                    <summary class="collapsible-header">
                        <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        What are the fees?
                    </summary>
                    <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
                        Every investor is to pay a 20% withdrawal fee to complete withdrawal process and each trader
                        gets a set percentage of the profit they make.
                    </div>
                </details>

                <!-- Q2 -->
                <details class="group">
                    <summary class="collapsible-header">
                        <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        How does copy trading work?
                    </summary>
                    <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
                        Here is how the copier works: You, as an investor, simply select an expert or experts that you
                        want to copy trades from. Once you are signed up, this is the only action needed on your part.
                        Once you've taken care of the above, you are all set. There are no codes that you need to run or
                        signals for you to manually input. Our software will handle the trade copying automatically on
                        your behalf. We monitor your experts trading activity and as soon as there is a trade, we
                        calculate all the necessary parameters and execute the trade. The only thing you have to make
                        sure of is that you have enough available base currency that your expert trades with, in your
                        trading account. How much is enough? First, you must meet the exchanges minimum order amount
                        (let's say about $10 per trade to be safe). That means that if your expert executes a 5% order,
                        you must have at least $300 in your account total value (at 100% expert allocation as an
                        example). This also means that you need to have at least 10% or higher in available base
                        currency to avoid missed trades. When the expert exits a position, you too will exit it.
                        Automatically. You can also change allocation at any time.
                    </div>
                </details>

                <!-- Q3 -->
                <details class="group">
                    <summary class="collapsible-header">
                        <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Who are the trading experts?
                    </summary>
                    <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
                        We carefully select expert applicants. We get to know them as a trader and examine their trading
                        performance over a period of time. We also tend to look for expert who already have a following
                        to further confirm their competence (social proof). You can also read about every expert on
                        their individual performance pages.
                    </div>
                </details>

                <!-- Q4 -->
                <details class="group">
                    <summary class="collapsible-header">
                        <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Do I Need to Install Any Trading Software?
                    </summary>
                    <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
                        You can trade on our online platform in the web version right after you create an account. There
                        is no need to install new software.
                    </div>
                </details>

                <!-- Q5 -->
                <details class="group">
                    <summary class="collapsible-header">
                        <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        What is the recommended amount to start with?
                    </summary>
                    <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
                        We suggest to have around $3000-$5000 in your account in BTC value due to exchanges minimum
                        order requirements and so that you can at least cover the subscription cost every month.
                    </div>
                </details>

            </div>

            <!-- Card 2: Mining Questions -->
            <div class="rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow"
                style="background-color: var(--primary-background);">

                <!-- Q1 -->
                <details class="group">
                    <summary class="collapsible-header">
                        <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Are you mining for yourself?
                    </summary>
                    <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
                        Besides the fact that we ourselves mine with the very same hardware that we offer to our
                        clients, our capital is limited. We believe that Bitcoin and Altcoin mining is one of the best
                        ways to receive Cryptocurrencies, however, we do not want to "put all our eggs in one basket".
                    </div>
                </details>

                <!-- Q2 -->
                <details class="group">
                    <summary class="collapsible-header">
                        <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        What is the maintenance fee?
                    </summary>
                    <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
                        Some of our products have a maintenance fee attached. The maintenance fee covers all costs
                        related to mining including, inter alia: electricity cost cooling maintenance work hosting
                        services The fee is fixed in USD but deducted from the daily mining rewards in the natively
                        mined coin on a daily basis.
                    </div>
                </details>

                <!-- Q3 -->
                <details class="group">
                    <summary class="collapsible-header">
                        <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        How does Bitcoin mining work?
                    </summary>
                    <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
                        It's quick and very easy! As soon as we receive your payment your contract will be added to your
                        profile, and you can immediately start mining. Depending on the blockchain algorithm you select
                        and the associated mining service agreement you enter into, you can either mine native
                        cryptocurrencies directly or allocate your hashpower to other cryptocurrencies (marked with
                        AUTO), and even choose a specific allocation for them. For example: 60% LTC, 20% BTC and 20%
                        DOGE. The first mining output is released after 48 hours, and then a daily mining output will
                        follow.
                    </div>
                </details>

                <!-- Q4 -->
                <details class="group">
                    <summary class="collapsible-header">
                        <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Where is your mining farm located?
                    </summary>
                    <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
                        For security reasons, we do not disclose the exact location of our mining farms. As of April
                        2015, we are operating several mining farms that are located in Europe, America and Asia.
                        Electricity cost and availability of cooling are important, but not the only criteria. See our
                        Datacenters page for more information.
                    </div>
                </details>

                <!-- Q5 -->
                <details class="group">
                    <summary class="collapsible-header">
                        <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Which pools are you using for mining?
                    </summary>
                    <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
                        We do not publish a list of pools we are using. Our main criteria for a good pool are:
                        reliability, fee structure and reject rate. Going forward we will solo-mine a few coins (and
                        pass the fee savings to our users!). Our internal policy is: "be a good crypto citizen". This
                        means, that we will at least use two different pools (in some cases we use up to four) for each
                        coin. This is to preserve the decentralized nature of the crypto networks! If we become aware
                        that a pool is getting close to 50% share, we will switch away from it and use a backup instead.
                    </div>
                </details>

            </div>

        </div>
    </div>
</section>

@include('home.footer')