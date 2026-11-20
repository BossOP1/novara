<?php
/**
 * Novara Healthcare — Google Ads landing page: TMS therapy, Sugar Land TX.
 * One goal: get the visitor to submit the enquiry form.
 *
 * CLINICAL REVIEW: treatment, safety, FDA and insurance wording comes from
 * novarahc.com and must be signed off by Novara's clinical team before ads run.
 */
require __DIR__ . '/_partials.php';

$title = 'TMS Therapy for Depression in Sugar Land, TX | Novara Healthcare';
$desc  = 'Non-invasive TMS therapy for depression in Sugar Land, TX. FDA-cleared, no sedation, 20–40 minute sessions. Request a free consultation with Novara Healthcare.';
$img   = $lp['img'];

$check = '<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>';
$arrow = '<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5M21 12H3"/></svg>';

$faqs = [
    ['Is TMS FDA-cleared?', 'Yes. TMS is FDA-cleared to treat major depressive disorder in adults who have not improved enough with antidepressant medication. Other uses, including MeRT for autism, PTSD or TBI, are not FDA-cleared indications.'],
    ['Does it hurt? Are there side effects?', 'You stay awake and seated. Most people feel a gentle tapping on the scalp. The most commonly reported side effect is a mild headache at the treatment site that usually passes within a few hours. Serious side effects such as seizures are very rare.'],
    ['How long does treatment take?', 'Each session lasts about 20–40 minutes. Patients typically come in five days a week for several weeks. Your clinician confirms the exact schedule.'],
    ['Is TMS right for me?', 'That’s decided by our clinical team after an assessment. TMS isn’t suitable for everyone, for example people with certain implants or metal in or near the head. The free call is the first step to finding out.'],
    ['Is insurance accepted?', 'Coverage depends on your plan and isn’t guaranteed. Our team can help check your benefits before you start. We accept HSA, CareCredit, and credit and debit cards.'],
    ['What about MeRT?', 'Novara also offers MeRT, which personalizes magnetic stimulation using a qEEG brain map. MeRT is not FDA-cleared, and results vary. Ask us about it on your call.'],
];

$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'     => 'MedicalClinic',
            'name'      => $lp['name'] . ' – Sugar Land',
            'url'       => $lp['url'],
            'address'   => ['@type' => 'PostalAddress', 'streetAddress' => $lp['street'], 'addressLocality' => 'Sugar Land', 'addressRegion' => 'TX', 'postalCode' => '77479', 'addressCountry' => 'US'],
            'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '09:00', 'closes' => '17:00']],
        ],
        ['@type' => 'FAQPage', 'mainEntity' => array_map(fn($f) => ['@type' => 'Question', 'name' => $f[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]]], $faqs)],
    ],
];

lp_head($lp, $title, $desc,
    '<link rel="preload" as="image" href="' . $img . 'apollo-tms-chair.webp">'
    . "\n    <script type=\"application/ld+json\">" . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>'
    . "\n    <style>
        /* Multi-step form: without JS every step shows; with JS one at a time */
        .js .step { display: none; }
        .js .step.is-active { display: block; animation: heroIn .45s cubic-bezier(.2,.7,.2,1) both; }
        .choice input:checked + span { border-color: #0f4c9a; background: #eef5fd; box-shadow: 0 0 0 1px #0f4c9a inset; }
        .choice input:checked + span .dot { background: #0f4c9a; box-shadow: inset 0 0 0 3px #fff; border-color: #0f4c9a; }
        .choice input:focus-visible + span { outline: 2px solid #22a998; outline-offset: 2px; }
        .hl { background: linear-gradient(transparent 62%, #a2eadd 62%, #a2eadd 92%, transparent 92%); }
    </style>
    <script>document.documentElement.classList.add('js')</script>"
);
?>
<body class="bg-white font-sans text-slate-700 antialiased">
<?php lp_header($lp); ?>

<main id="main">

<!-- ===================== Hero + form ===================== -->
<section class="relative overflow-hidden bg-gradient-to-b from-brand-50 via-white to-white" aria-labelledby="hero-title">
    <div class="pointer-events-none absolute -right-40 -top-24 h-[34rem] w-[34rem] rounded-full bg-teal-100/70 blur-3xl" aria-hidden="true"></div>

    <div class="relative mx-auto grid max-w-6xl items-start gap-10 px-4 pb-14 pt-8 sm:px-6 lg:grid-cols-[1.1fr_1fr] lg:gap-14 lg:pb-20 lg:pt-14">
        <div>
            <p class="hero-in inline-flex items-center gap-2 rounded-full bg-white px-3 py-1.5 text-[13px] font-bold text-brand-800 shadow-sm ring-1 ring-brand-900/10">
                <svg class="h-4 w-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                Sugar Land, TX · 5501 Cabrera Dr
            </p>
            <h1 id="hero-title" class="hero-in mt-5 text-balance text-[2.5rem] font-extrabold leading-[1.05] tracking-[-0.03em] text-brand-950 [animation-delay:.06s] sm:text-[3.4rem]">
                TMS Therapy for Depression in <span class="hl">Sugar Land</span>
            </h1>
            <p class="hero-in mt-5 max-w-xl text-lg leading-relaxed text-slate-600 [animation-delay:.12s]">
                When antidepressants haven’t brought enough relief, TMS is a different approach: gentle magnetic pulses, no medication, no sedation. See if it may be right for you.
            </p>

            <ul class="hero-in mt-7 space-y-3 [animation-delay:.18s]">
                <?php foreach ([
                    ['FDA-cleared', 'for major depressive disorder in adults'],
                    ['Drug-free and non-invasive', 'you stay awake, no anesthesia'],
                    ['20–40 minute sessions', 'at our Sugar Land clinic'],
                ] as [$b, $s]): ?>
                <li class="flex items-start gap-3 text-[17px]">
                    <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-teal-500 text-white"><?= $check ?></span>
                    <span><strong class="font-bold text-brand-950"><?= e($b) ?></strong> <span class="text-slate-500">· <?= e($s) ?></span></span>
                </li>
                <?php endforeach; ?>
            </ul>

            <!-- Apollo device + review -->
            <div class="hero-in mt-9 hidden items-center gap-5 rounded-3xl bg-white p-4 pr-6 shadow-soft ring-1 ring-brand-900/5 [animation-delay:.24s] sm:flex">
                <img src="<?= $img ?>apollo-tms-chair.webp" alt="Apollo TMS therapy system with treatment chair" width="696" height="608" class="h-28 w-32 shrink-0 rounded-2xl bg-brand-50 object-contain p-2">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.14em] text-teal-700">Apollo TMS therapy system</p>
                    <p class="mt-1.5 text-[15px] leading-snug text-brand-950">“Very knowledgeable… also very accommodating with their clients. I would give more than 5 stars if I had the option!”</p>
                    <p class="mt-1.5 flex items-center gap-2 text-sm text-slate-500"><span class="text-amber-500" aria-label="5 stars">★★★★★</span> A.C., Novara client</p>
                </div>
            </div>
        </div>

        <!-- Multi-step enquiry form -->
        <div id="consult" class="hero-in scroll-mt-32 [animation-delay:.1s] lg:sticky lg:top-32">
            <div class="overflow-hidden rounded-3xl bg-white shadow-card ring-1 ring-brand-900/10">
                <div class="bg-brand-700 px-6 py-4 text-white sm:px-7">
                    <p class="text-lg font-extrabold">See if TMS is right for you</p>
                    <p class="text-sm text-white/75">Takes 30 seconds · Free · No obligation</p>
                </div>
                <form id="lp-form" name="tms-lp" method="POST" action="<?= e($lp['thanks']) ?>"
                      <?= $isStatic ? 'data-netlify="true" netlify-honeypot="website"' : '' ?>
                      class="p-6 sm:p-7" novalidate>
                    <input type="hidden" name="form-name" value="tms-lp">
                    <?php foreach (['utm_source','utm_medium','utm_campaign','utm_term','utm_content','gclid'] as $k): ?>
                    <input type="hidden" name="<?= $k ?>" value="" data-utm="<?= $k ?>">
                    <?php endforeach; ?>
                    <p class="hidden"><label>Leave this empty <input name="website" tabindex="-1" autocomplete="off"></label></p>

                    <!-- Progress (JS only) -->
                    <div class="mb-5 hidden items-center gap-3 [.js_&]:flex">
                        <div class="h-1.5 flex-1 overflow-hidden rounded-full bg-slate-100"><div id="lp-bar" class="h-full w-1/3 rounded-full bg-teal-500 transition-all duration-500"></div></div>
                        <span id="lp-step-label" class="text-xs font-bold text-slate-500">Step 1 of 3</span>
                    </div>

                    <!-- Step 1 -->
                    <fieldset class="step is-active" data-step="1">
                        <legend class="mb-4 text-lg font-extrabold text-brand-950">Who are you looking into TMS for?</legend>
                        <div class="grid gap-2.5">
                            <?php foreach (['Myself', 'A family member or loved one'] as $o): ?>
                            <label class="choice block cursor-pointer">
                                <input type="radio" name="for_whom" value="<?= e($o) ?>" class="sr-only" required aria-label="<?= e($o) ?>">
                                <span class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-3.5 font-semibold text-brand-950 transition hover:border-brand-400">
                                    <span class="dot h-5 w-5 shrink-0 rounded-full border-2 border-slate-300"></span><?= e($o) ?>
                                </span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </fieldset>

                    <!-- Step 2 -->
                    <fieldset class="step mt-6 [.js_&]:mt-0" data-step="2">
                        <legend class="mb-4 text-lg font-extrabold text-brand-950">When would you like to get started?</legend>
                        <div class="grid gap-2.5">
                            <?php foreach (['As soon as possible', 'In the next month or two', 'Just researching for now'] as $o): ?>
                            <label class="choice block cursor-pointer">
                                <input type="radio" name="timeline" value="<?= e($o) ?>" class="sr-only" required aria-label="<?= e($o) ?>">
                                <span class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-3.5 font-semibold text-brand-950 transition hover:border-brand-400">
                                    <span class="dot h-5 w-5 shrink-0 rounded-full border-2 border-slate-300"></span><?= e($o) ?>
                                </span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" data-back class="mt-4 hidden text-sm font-bold text-slate-500 hover:text-brand-700 [.js_&]:inline">← Back</button>
                    </fieldset>

                    <!-- Step 3 -->
                    <fieldset class="step mt-6 space-y-3 [.js_&]:mt-0" data-step="3">
                        <legend class="mb-1 text-lg font-extrabold text-brand-950">Where should we call you?</legend>
                        <p class="mb-2 text-sm text-slate-500">Our Sugar Land team calls back during clinic hours.</p>
                        <input name="name" type="text" required autocomplete="name" placeholder="Full name" aria-label="Full name"
                               class="block w-full rounded-xl border-slate-200 px-4 py-3.5 text-brand-950 placeholder:text-slate-400 focus:border-brand-500 focus:ring-brand-500">
                        <input name="phone" type="tel" required autocomplete="tel" inputmode="tel" placeholder="Phone number" aria-label="Phone number" pattern="[\s\-\.\(\)\+]*(?:\d[\s\-\.\(\)\+]*){10,15}" title="10-digit phone number"
                               class="block w-full rounded-xl border-slate-200 px-4 py-3.5 text-brand-950 placeholder:text-slate-400 focus:border-brand-500 focus:ring-brand-500">
                        <input name="email" type="email" required autocomplete="email" placeholder="Email" aria-label="Email"
                               class="block w-full rounded-xl border-slate-200 px-4 py-3.5 text-brand-950 placeholder:text-slate-400 focus:border-brand-500 focus:ring-brand-500">
                        <label class="flex gap-3 pt-1 text-xs leading-relaxed text-slate-500">
                            <input type="checkbox" name="consent" value="yes" required class="mt-0.5 h-4 w-4 shrink-0 rounded border-slate-300 text-brand-700 focus:ring-brand-500">
                            <span>I agree to be contacted by Novara Healthcare by phone, text or email. This is not a medical assessment and doesn’t confirm eligibility for treatment.</span>
                        </label>
                        <p id="lp-error" class="hidden rounded-lg bg-red-50 px-3 py-2 text-sm font-semibold text-red-700" role="alert"></p>
                        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-teal-500 py-4 text-base font-extrabold text-brand-950 shadow-lg shadow-teal-500/30 transition hover:bg-teal-400 disabled:opacity-60">
                            <span class="lp-submit-label">Get my free consultation</span> <?= $arrow ?>
                        </button>
                        <button type="button" data-back class="hidden text-sm font-bold text-slate-500 hover:text-brand-700 [.js_&]:inline">← Back</button>
                    </fieldset>
                </form>
                <div class="flex items-center justify-between gap-3 border-t border-slate-100 bg-slate-50 px-6 py-4 text-sm sm:px-7">
                    <span class="flex items-center gap-1.5 text-slate-500">
                        <svg class="h-4 w-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                        Private &amp; secure
                    </span>
                    <span class="font-bold text-slate-500">Free · No obligation</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== Trust bar ===================== -->
<section class="border-y border-slate-100 bg-slate-50" aria-label="Why patients choose Novara">
    <ul class="mx-auto grid max-w-6xl grid-cols-2 gap-x-6 gap-y-4 px-4 py-6 text-sm font-bold text-brand-950 sm:px-6 lg:grid-cols-4">
        <?php foreach ([
            ['M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z', 'FDA-cleared treatment'],
            ['M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z', 'Apollo TMS system'],
            ['M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z', 'HSA &amp; CareCredit accepted'],
            ['M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z', 'Callback within clinic hours'],
        ] as [$icon, $t]): ?>
        <li class="flex items-center gap-2.5">
            <svg class="h-5 w-5 shrink-0 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="<?= $icon ?>"/></svg>
            <?= $t ?>
        </li>
        <?php endforeach; ?>
    </ul>
</section>

<!-- ===================== How it works: 3 steps ===================== -->
<section class="py-16 lg:py-20" aria-labelledby="steps-title">
    <div class="mx-auto max-w-6xl px-4 sm:px-6">
        <div class="mx-auto max-w-2xl text-center">
            <h2 id="steps-title" class="reveal text-balance text-3xl font-extrabold tracking-[-0.02em] text-brand-950 sm:text-4xl">Getting started is simple</h2>
            <p class="reveal mt-3 text-lg text-slate-500">Three steps from your first question to your first session.</p>
        </div>
        <ol class="mt-12 grid gap-5 md:grid-cols-3" data-stagger>
            <?php
            $ico = fn($d) => '<svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="' . $d . '"/></svg>';
            foreach ([
                ['Free phone consultation', 'Tell us a little about what you’ve tried so far. We answer your questions about TMS, timing and cost, and help check your insurance.', 'M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z'],
                ['Clinical assessment', 'Visit our Sugar Land clinic. Our clinical team reviews your history and safety screening to decide whether TMS is appropriate.', 'M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z'],
                ['Start your sessions', 'Sit back, stay awake, and feel a gentle tapping. About 20–40 minutes per visit, typically five days a week for several weeks.', 'M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z'],
            ] as $i => [$h, $p, $path]): ?>
            <li class="reveal relative rounded-3xl bg-white p-7 ring-1 ring-brand-900/10">
                <div class="flex items-center justify-between">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-50 text-teal-600 ring-1 ring-teal-100"><?= $ico($path) ?></span>
                    <span class="text-5xl font-extrabold leading-none text-brand-900/10"><?= sprintf('%02d', $i + 1) ?></span>
                </div>
                <p class="mt-6 text-xl font-extrabold text-brand-950"><?= e($h) ?></p>
                <p class="mt-2 leading-relaxed text-slate-600"><?= e($p) ?></p>
            </li>
            <?php endforeach; ?>
        </ol>
        <div class="reveal mt-10 text-center">
            <a href="#consult" class="inline-flex items-center gap-2 rounded-xl bg-brand-700 px-7 py-4 font-extrabold text-white shadow-lg shadow-brand-700/25 transition hover:bg-brand-800">Start step 1: free consultation <?= $arrow ?></a>
        </div>
    </div>
</section>

<!-- ===================== Is TMS for you + what to expect ===================== -->
<section class="bg-brand-950 py-16 text-white lg:py-20" aria-labelledby="fit-title">
    <div class="mx-auto grid max-w-6xl gap-12 px-4 sm:px-6 lg:grid-cols-2 lg:gap-16">
        <div>
            <h2 id="fit-title" class="reveal text-balance text-3xl font-extrabold tracking-[-0.02em] sm:text-4xl">TMS is often considered when</h2>
            <ul class="mt-8 space-y-4" data-stagger>
                <?php foreach ([
                    'Antidepressants haven’t brought enough improvement',
                    'Medication side effects have been hard to tolerate',
                    'You’d prefer a drug-free option alongside therapy',
                    'You need a treatment with no sedation or recovery',
                ] as $t): ?>
                <li class="reveal flex items-start gap-3 text-lg" data-anim="left">
                    <span class="mt-1 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-teal-400 text-brand-950"><?= $check ?></span><?= e($t) ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <p class="reveal mt-8 rounded-2xl bg-white/[.06] p-5 text-sm leading-relaxed text-white/70 ring-1 ring-white/10">TMS is FDA-cleared for major depressive disorder in adults who haven’t responded adequately to antidepressants. Eligibility is decided by our clinical team after assessment. Results vary, and TMS doesn’t work for everyone.</p>
        </div>

        <div class="reveal" data-anim="right">
            <p class="text-sm font-bold uppercase tracking-[0.16em] text-teal-300">What to expect</p>
            <dl class="mt-6 grid grid-cols-2 gap-px overflow-hidden rounded-3xl bg-white/10 ring-1 ring-white/10">
                <?php foreach ([
                    ['20–40 min', 'per session'],
                    ['5 days', 'a week, for several weeks'],
                    ['Awake', 'no sedation or anesthesia'],
                    ['Mild', 'headache is the most common side effect, usually brief'],
                ] as [$a, $b]): ?>
                <div class="min-w-0 bg-brand-950 p-5 sm:p-6">
                    <dt class="text-2xl font-extrabold text-white sm:text-3xl"><?= e($a) ?></dt>
                    <dd class="mt-1 text-sm leading-snug text-white/60"><?= e($b) ?></dd>
                </div>
                <?php endforeach; ?>
            </dl>
            <a href="#consult" class="mt-8 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-teal-400 px-7 py-4 font-extrabold text-brand-950 transition hover:bg-teal-300 sm:w-auto">Check if I’m a candidate <?= $arrow ?></a>
        </div>
    </div>
</section>

<!-- ===================== Clinic gallery (real photos) ===================== -->
<section class="bg-slate-50 py-16 lg:py-20" aria-labelledby="gallery-title">
    <div class="mx-auto max-w-6xl px-4 sm:px-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="reveal text-sm font-bold uppercase tracking-[0.16em] text-teal-600">Real photos, not stock</p>
                <h2 id="gallery-title" class="reveal mt-2 text-balance text-3xl font-extrabold tracking-[-0.02em] text-brand-950 sm:text-4xl">Inside our Sugar Land clinic</h2>
                <p class="reveal mt-3 max-w-xl text-lg text-slate-500">A quiet, private space at <?= e($lp['street']) ?>. Here’s what you’ll see when you visit.</p>
            </div>
            <a href="<?= e($lp['maps']) ?>" target="_blank" rel="noopener" class="reveal inline-flex shrink-0 items-center gap-1.5 font-bold text-brand-700 underline decoration-teal-300 decoration-2 underline-offset-8 hover:text-brand-900">Get directions ↗</a>
        </div>

        <ul class="mt-10 grid grid-flow-dense grid-cols-2 gap-3 sm:gap-4 lg:h-[600px] lg:grid-cols-4 lg:grid-rows-2" data-stagger>
            <?php foreach ([
                ['novara-consult-room',     'Consultation room',  'Private consultation room at Novara Healthcare, Sugar Land', 'col-span-1 aspect-[3/4] lg:row-span-2'],
                ['novara-clinic-lounge',    'Patient lounge',     'Patient lounge with leather sofas at Novara Healthcare, Sugar Land', 'col-span-2 aspect-[4/3]'],
                ['novara-clinic-seating',   'Waiting area',       'Waiting area seating at Novara Healthcare, Sugar Land', 'col-span-1 aspect-[3/4] lg:row-span-2'],
                ['novara-clinic-reception', 'Reception',          'Reception area at Novara Healthcare, Sugar Land', 'col-span-2 aspect-[4/3]'],
            ] as $i => [$photo, $cap, $alt, $span]): ?>
            <li class="reveal <?= $span ?> lg:aspect-auto">
                <a href="<?= $img . $photo ?>.jpg" data-gallery="<?= $i ?>" data-caption="<?= e($cap) ?>" class="group relative block h-full overflow-hidden rounded-3xl bg-slate-200 focus:outline-none focus-visible:ring-4 focus-visible:ring-teal-400">
                    <img src="<?= $img . $photo ?>-800.jpg" srcset="<?= $img . $photo ?>-800.jpg 800w, <?= $img . $photo ?>.jpg 1600w" sizes="(min-width: 1024px) 50vw, 100vw"
                         alt="<?= e($alt) ?>" loading="lazy" decoding="async" class="h-full w-full object-cover brightness-105 transition duration-700 group-hover:scale-105">
                    <span class="pointer-events-none absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-brand-950/60 to-transparent" aria-hidden="true"></span>
                    <span class="absolute bottom-3 left-3 rounded-full bg-white/95 px-3 py-1.5 text-xs font-bold text-brand-950 shadow sm:bottom-4 sm:left-4 sm:text-sm"><?= e($cap) ?></span>
                    <span class="absolute right-3 top-3 hidden h-9 w-9 items-center justify-center rounded-full bg-white/90 text-brand-900 opacity-0 shadow transition group-hover:opacity-100 sm:flex" aria-hidden="true">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/></svg>
                    </span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<!-- Gallery lightbox -->
<dialog id="lightbox" class="m-auto max-h-none max-w-none bg-transparent p-0 backdrop:bg-brand-950/90" aria-label="Clinic photo">
    <figure class="relative flex h-[100dvh] w-screen flex-col items-center justify-center gap-3 p-4 sm:p-10">
        <img id="lb-img" src="" alt="" class="max-h-[80dvh] max-w-full rounded-2xl object-contain shadow-2xl">
        <figcaption id="lb-cap" class="text-sm font-bold text-white/90"></figcaption>
        <button type="button" data-lb="close" class="absolute right-4 top-4 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white ring-1 ring-white/20 hover:bg-white/20" aria-label="Close">✕</button>
        <button type="button" data-lb="-1" class="absolute left-2 top-1/2 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white/10 text-2xl text-white ring-1 ring-white/20 hover:bg-white/20 sm:left-6" aria-label="Previous photo">‹</button>
        <button type="button" data-lb="1" class="absolute right-2 top-1/2 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white/10 text-2xl text-white ring-1 ring-white/20 hover:bg-white/20 sm:right-6" aria-label="Next photo">›</button>
    </figure>
</dialog>

<!-- ===================== Proof ===================== -->
<section class="py-16 lg:py-20" aria-labelledby="proof-title">
    <div class="mx-auto max-w-6xl px-4 sm:px-6">
        <div class="grid items-center gap-10 lg:grid-cols-[1fr_1.2fr] lg:gap-14">
            <figure class="reveal relative" data-anim="left">
                <img src="<?= $img ?>novara-team-community-800.jpg" alt="The Novara Healthcare team at a community event in Houston" width="800" height="600" loading="lazy" decoding="async" class="aspect-[4/3] w-full rounded-3xl object-cover">
                <figcaption class="absolute -bottom-5 left-5 right-5 rounded-2xl bg-white p-4 shadow-card ring-1 ring-brand-900/5 sm:left-auto sm:w-72">
                    <p class="font-extrabold text-brand-950">Meet our team</p>
                    <p class="text-sm text-slate-500">Led by Spree, PharmD (Executive Director) and Misha (Chief Neuro Technician)</p>
                </figcaption>
            </figure>
            <div class="pt-6 lg:pt-0">
                <h2 id="proof-title" class="reveal text-balance text-3xl font-extrabold tracking-[-0.02em] text-brand-950 sm:text-4xl">A local team that takes time with you</h2>
                <div class="mt-8 space-y-4" data-stagger>
                    <?php foreach ([
                        ['As a fellow healthcare provider, I have full confidence in recommending Novara to colleagues and patients alike.', 'E.J.', 'Healthcare provider'],
                        ['Not only are they very knowledgeable they are also very accommodating with their clients and staff. I would give more than 5 stars if I had the option!', 'A.C.', 'Novara client'],
                    ] as [$q, $who, $role]): ?>
                    <figure class="reveal rounded-2xl bg-slate-50 p-5 ring-1 ring-slate-100">
                        <p class="text-amber-500" aria-label="5 stars">★★★★★</p>
                        <blockquote class="mt-2 leading-relaxed text-brand-950">“<?= e($q) ?>”</blockquote>
                        <figcaption class="mt-3 text-sm font-bold text-slate-500"><?= e($who) ?> · <span class="font-medium"><?= e($role) ?></span></figcaption>
                    </figure>
                    <?php endforeach; ?>
                </div>
                <p class="reveal mt-4 text-xs text-slate-400">Individual experiences. Results vary.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===================== FAQ ===================== -->
<section id="faq" class="bg-slate-50 py-16 lg:py-20" aria-labelledby="faq-title">
    <div class="mx-auto max-w-3xl px-4 sm:px-6">
        <h2 id="faq-title" class="reveal text-center text-3xl font-extrabold tracking-[-0.02em] text-brand-950 sm:text-4xl">Common questions</h2>
        <div class="mt-10 space-y-3">
            <?php foreach ($faqs as $i => [$q, $a]): ?>
            <details class="reveal group rounded-2xl bg-white ring-1 ring-slate-200/70" <?= $i === 0 ? 'open' : '' ?>>
                <summary class="flex cursor-pointer items-center justify-between gap-6 px-6 py-5 text-left text-[17px] font-bold text-brand-950">
                    <?= e($q) ?>
                    <span class="faq-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-brand-50 text-brand-700 transition">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
                    </span>
                </summary>
                <p class="px-6 pb-6 leading-relaxed text-slate-600"><?= e($a) ?></p>
            </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===================== Final CTA ===================== -->
<section class="py-16 lg:py-20" aria-labelledby="final-title">
    <div class="mx-auto max-w-6xl px-4 sm:px-6">
        <div class="reveal grid overflow-hidden rounded-[2rem] bg-brand-700 text-white lg:grid-cols-[1.2fr_1fr]" data-anim="zoom">
            <div class="p-8 sm:p-12">
                <h2 id="final-title" class="text-balance text-3xl font-extrabold tracking-[-0.02em] sm:text-[2.6rem] sm:leading-[1.1]">Find out if TMS is right for you</h2>
                <p class="mt-4 max-w-md text-lg text-white/80">One free call with our Sugar Land team. No pressure, no commitment.</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#consult" class="inline-flex items-center justify-center gap-2 rounded-xl bg-teal-400 px-7 py-4 font-extrabold text-brand-950 transition hover:bg-teal-300">Get my free consultation <?= $arrow ?></a>
                </div>
            </div>
            <div class="relative min-h-[240px]">
                <img src="<?= $img ?>novara-clinic-seating-800.jpg" alt="Patient lounge at Novara Healthcare, Sugar Land" width="600" height="800" loading="lazy" decoding="async" class="absolute inset-0 h-full w-full object-cover">
                <a href="<?= e($lp['maps']) ?>" target="_blank" rel="noopener" class="absolute bottom-4 left-4 right-4 rounded-2xl bg-white/95 p-4 text-brand-950 shadow-lg transition hover:bg-white">
                    <span class="block font-extrabold">5501 Cabrera Dr, Suite 503</span>
                    <span class="block text-sm text-slate-500">Sugar Land, TX 77479 · Get directions ↗</span>
                </a>
            </div>
        </div>
    </div>
</section>

</main>

<?php lp_footer($lp); ?>

<!-- Sticky mobile CTA -->
<div id="mobile-cta" class="fixed inset-x-0 bottom-0 z-40 grid border-t border-brand-900/10 bg-white/95 p-3 backdrop-blur md:hidden" style="padding-bottom:max(.75rem, env(safe-area-inset-bottom))">
    <a href="#consult" class="flex items-center justify-center rounded-xl bg-teal-500 py-3.5 font-extrabold text-brand-950">Get my free consultation</a>
</div>

<script>
(function () {
    var dl = window.dataLayer = window.dataLayer || [];
    var store = { get: function (k) { try { return sessionStorage.getItem(k); } catch (e) { return null; } },
                  set: function (k, v) { try { sessionStorage.setItem(k, v); } catch (e) {} } };

    // Keep ad attribution (UTMs / gclid) for the session
    var params = new URLSearchParams(location.search);
    document.querySelectorAll('[data-utm]').forEach(function (input) {
        var k = input.getAttribute('data-utm');
        if (params.get(k)) store.set('lp_' + k, params.get(k));
        input.value = params.get(k) || store.get('lp_' + k) || '';
    });

    // Multi-step form
    var form = document.getElementById('lp-form');
    var steps = form.querySelectorAll('.step');
    var bar = document.getElementById('lp-bar');
    var label = document.getElementById('lp-step-label');
    var err = document.getElementById('lp-error');
    var current = 1, started = false;
    function show(n) {
        current = n;
        steps.forEach(function (s) { s.classList.toggle('is-active', +s.dataset.step === n); });
        bar.style.width = (n / steps.length * 100) + '%';
        label.textContent = 'Step ' + n + ' of ' + steps.length;
        if (n === steps.length) { var f = form.querySelector('[name="name"]'); if (f) f.focus({ preventScroll: true }); }
    }
    form.querySelectorAll('input[type="radio"]').forEach(function (r) {
        r.addEventListener('change', function () {
            if (!started) { started = true; dl.push({ event: 'lp_form_start' }); }
            var step = +r.closest('.step').dataset.step;
            setTimeout(function () { show(step + 1); }, 220);
        });
    });
    form.querySelectorAll('[data-back]').forEach(function (b) { b.addEventListener('click', function () { show(current - 1); }); });

    form.addEventListener('submit', function (ev) {
        // Validate every step; jump to the first one with a problem
        for (var i = 0; i < steps.length; i++) {
            var bad = Array.prototype.find.call(steps[i].querySelectorAll('input'), function (el) { return !el.checkValidity(); });
            if (bad) {
                ev.preventDefault();
                show(i + 1);
                var last = i + 1 === steps.length;
                err.textContent = bad.type === 'checkbox' ? 'Please tick the box to agree to be contacted.' : 'Please enter a valid ' + (bad.getAttribute('aria-label') || 'answer').toLowerCase() + '.';
                err.classList.toggle('hidden', !last);
                if (last) bad.focus();
                return;
            }
        }
        err.classList.add('hidden');
        var btn = form.querySelector('button[type="submit"]');
        btn.disabled = true;
        form.querySelector('.lp-submit-label').textContent = 'Sending…';
        dl.push({ event: 'lp_form_submit' });   // no health answers sent to analytics
    });

    // Gallery lightbox (links open the full image if JS or <dialog> is unavailable)
    var lb = document.getElementById('lightbox');
    var shots = Array.prototype.slice.call(document.querySelectorAll('[data-gallery]'));
    if (lb && typeof lb.showModal === 'function') {
        var lbImg = document.getElementById('lb-img'), lbCap = document.getElementById('lb-cap'), at = 0;
        var open = function (i) {
            at = (i + shots.length) % shots.length;
            var a = shots[at];
            lbImg.src = a.getAttribute('href');
            lbImg.alt = a.querySelector('img').alt;
            lbCap.textContent = a.dataset.caption + ' · ' + (at + 1) + ' / ' + shots.length;
            if (!lb.open) lb.showModal();
        };
        shots.forEach(function (a, i) { a.addEventListener('click', function (ev) { ev.preventDefault(); open(i); }); });
        lb.addEventListener('click', function (ev) {
            var b = ev.target.closest('[data-lb]');
            if (b) { b.dataset.lb === 'close' ? lb.close() : open(at + +b.dataset.lb); }
            else if (ev.target === lb || ev.target.tagName === 'FIGURE') lb.close();
        });
        lb.addEventListener('keydown', function (ev) {
            if (ev.key === 'ArrowRight') open(at + 1);
            if (ev.key === 'ArrowLeft') open(at - 1);
        });
    }

    // Sticky mobile bar once the form is scrolled past
    var mbar = document.getElementById('mobile-cta');
    var consult = document.getElementById('consult');
    if ('IntersectionObserver' in window) {
        new IntersectionObserver(function (e) {
            mbar.classList.toggle('is-on', !e[0].isIntersecting && e[0].boundingClientRect.top < 0);
        }).observe(consult);
    }

    // Reveal on scroll
    document.querySelectorAll('[data-stagger]').forEach(function (g) {
        g.querySelectorAll(':scope > .reveal').forEach(function (el, i) { el.style.transitionDelay = (i * 100) + 'ms'; });
    });
    var reveals = document.querySelectorAll('.reveal');
    if (!('IntersectionObserver' in window)) { reveals.forEach(function (el) { el.classList.add('is-visible'); }); return; }
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) { if (en.isIntersecting) { en.target.classList.add('is-visible'); io.unobserve(en.target); } });
    }, { threshold: 0.12 });
    reveals.forEach(function (el) { io.observe(el); });
})();
</script>
</body>
</html>
