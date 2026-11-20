<?php
/**
 * Novara Healthcare — Sugar Land TMS landing page (paid traffic).
 * Brief: Novara_Sugar_Land_Landing_Page_Content_Requirements.docx
 *
 * CLINICAL REVIEW: all treatment, safety, FDA and insurance wording below comes from
 * novarahc.com and must be signed off by Novara's clinical team before ads run.
 */
require __DIR__ . '/_partials.php';

$title = 'TMS Therapy for Depression in Sugar Land, TX | Novara Healthcare';
$desc  = 'Non-invasive TMS therapy for depression at Novara Healthcare in Sugar Land, TX. No sedation, 20–40 minute sessions on the Apollo TMS system. Request a free consultation.';

/* ---------- Enquiry form (used in the hero and again at the end) ---------- */
function lp_form(array $lp, bool $isStatic, string $id): void { ?>
<form name="tms-lp" method="POST" action="<?= e($lp['thanks']) ?>"
      <?= $isStatic ? 'data-netlify="true" netlify-honeypot="website"' : '' ?>
      class="lp-form space-y-3.5" data-form-id="<?= e($id) ?>">
    <input type="hidden" name="form-name" value="tms-lp">
    <input type="hidden" name="form_location" value="<?= e($id) ?>">
    <?php foreach (['utm_source','utm_medium','utm_campaign','utm_term','utm_content','gclid'] as $k): ?>
    <input type="hidden" name="<?= $k ?>" value="" data-utm="<?= $k ?>">
    <?php endforeach; ?>
    <p class="hidden"><label>Leave this empty <input name="website" tabindex="-1" autocomplete="off"></label></p>

    <div>
        <label for="<?= $id ?>-name" class="mb-1.5 block text-sm font-bold text-brand-950">Full name</label>
        <input id="<?= $id ?>-name" name="name" type="text" required autocomplete="name" placeholder="Jane Smith"
               class="block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-brand-950 placeholder:text-slate-400 focus:border-brand-500 focus:ring-brand-500">
    </div>
    <div class="grid gap-3.5 sm:grid-cols-2">
        <div>
            <label for="<?= $id ?>-phone" class="mb-1.5 block text-sm font-bold text-brand-950">Phone</label>
            <input id="<?= $id ?>-phone" name="phone" type="tel" required autocomplete="tel" inputmode="tel" placeholder="(713) 555-0123" pattern="[0-9()+\-.\s]{10,}"
                   class="block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-brand-950 placeholder:text-slate-400 focus:border-brand-500 focus:ring-brand-500">
        </div>
        <div>
            <label for="<?= $id ?>-email" class="mb-1.5 block text-sm font-bold text-brand-950">Email</label>
            <input id="<?= $id ?>-email" name="email" type="email" required autocomplete="email" placeholder="you@email.com"
                   class="block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-brand-950 placeholder:text-slate-400 focus:border-brand-500 focus:ring-brand-500">
        </div>
    </div>
    <div class="grid gap-3.5 sm:grid-cols-2">
        <div>
            <label for="<?= $id ?>-interest" class="mb-1.5 block text-sm font-bold text-brand-950">I’m asking about</label>
            <select id="<?= $id ?>-interest" name="interest" class="block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-brand-950 focus:border-brand-500 focus:ring-brand-500">
                <option>TMS for depression</option>
                <option>MeRT therapy</option>
                <option>Not sure yet</option>
            </select>
        </div>
        <div>
            <label for="<?= $id ?>-time" class="mb-1.5 block text-sm font-bold text-brand-950">Best time to call</label>
            <select id="<?= $id ?>-time" name="call_time" class="block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-brand-950 focus:border-brand-500 focus:ring-brand-500">
                <option>Any time</option>
                <option>Morning (9am–12pm)</option>
                <option>Afternoon (12pm–5pm)</option>
            </select>
        </div>
    </div>
    <label class="flex gap-3 pt-1 text-xs leading-relaxed text-slate-500">
        <input type="checkbox" name="consent" value="yes" required class="mt-0.5 h-4 w-4 shrink-0 rounded border-slate-300 text-brand-700 focus:ring-brand-500">
        <span>I agree to be contacted by Novara Healthcare by phone, text or email about my enquiry. This is not a medical assessment and doesn’t confirm eligibility for treatment.</span>
    </label>
    <button type="submit" class="group flex w-full items-center justify-center gap-3 rounded-full bg-brand-700 py-4 pl-7 pr-3 text-base font-extrabold text-white shadow-lg shadow-brand-700/25 transition hover:bg-brand-800 disabled:opacity-60">
        <span class="lp-submit-label">Request my free consultation</span>
        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white/15 transition group-hover:translate-x-0.5"><svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5M21 12H3"/></svg></span>
    </button>
    <p class="flex items-center justify-center gap-2 text-xs text-slate-500">
        <svg class="h-3.5 w-3.5 text-teal-600" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
        Private and secure. No cost, no obligation.
    </p>
</form>
<?php }

$check = '<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>';

$journey = [
    ['Send an enquiry', 'Fill in the short form or call us. It takes about a minute.'],
    ['We call you back', 'A member of the Novara team calls during clinic hours, Monday to Friday.'],
    ['Ask your questions', 'Talk through your history, what TMS involves, timing, and cost.'],
    ['Book a consultation', 'If it makes sense to go further, we arrange a consultation at the Sugar Land clinic.'],
    ['Clinical assessment', 'Our clinical team reviews your health history and decides whether TMS, MeRT or another route is appropriate.'],
    ['Plan and follow-up', 'If treatment is a fit, you get a clear schedule, and we check in on progress throughout and after it.'],
];

$faqs = [
    ['What is TMS therapy?', 'Transcranial Magnetic Stimulation (TMS) delivers focused magnetic pulses to areas of the brain linked to mood regulation, such as the prefrontal cortex. The pulses stimulate activity and communication between brain cells. TMS is non-invasive and does not require sedation or anesthesia.'],
    ['Is TMS FDA-cleared?', 'Yes. TMS is FDA-cleared to treat major depressive disorder in adults who have not improved enough with antidepressant medication. Other uses, including MeRT for autism, PTSD or TBI, are not FDA-cleared indications, and our team will explain this clearly if they come up.'],
    ['What is MeRT therapy?', 'MeRT (Magnetic e-Resonance Therapy) builds on rTMS. It uses a quantitative EEG (qEEG) brain map and an ECG to personalize where and at what frequency stimulation is delivered, instead of using one fixed location and frequency for everyone. MeRT is not an FDA-cleared treatment, and results vary from person to person.'],
    ['How does the consultation process work?', 'After you send an enquiry, our team calls you back to answer questions and learn a little about your situation. If it makes sense to go further, we book a consultation at our Sugar Land clinic, where the clinical team reviews your history and talks you through the options. The first conversation is free and carries no obligation.'],
    ['What happens during an initial evaluation?', 'The clinical team reviews your medical and mental health history, current medications, and any previous treatments. They also screen for safety factors, such as implanted devices or metal in or near the head, that can affect whether TMS is suitable. You’ll leave with a clear recommendation and next steps.'],
    ['How long does treatment take?', 'Each TMS session lasts about 20–40 minutes. Patients typically attend five days a week for several weeks. The exact schedule depends on the plan your clinician recommends.'],
    ['What should I expect during a session?', 'You sit comfortably and stay awake throughout. A coil rests against the scalp and delivers magnetic pulses, which feel like a gentle tapping and make a clicking sound. The most commonly reported side effect is a mild headache at the treatment site that usually passes within a few hours. Serious side effects such as seizures are very rare.'],
    ['Is insurance accepted?', 'Coverage depends on your plan and isn’t guaranteed. Our team can help you check your benefits before you start. We accept HSA, CareCredit, and credit and debit cards. MeRT is currently covered only by TriWest/TRICARE, for depression and PTSD.'],
    ['How can I request more information?', 'Fill in the form on this page or call (713) 818-4809, Monday to Friday, 9:00am–5:00pm. You can also email info@novarahealthtx.com.'],
    ['Where is the Sugar Land clinic located?', 'Novara Healthcare is at 5501 Cabrera Dr Suite 503, Sugar Land, TX 77479, convenient to Sugar Land, Missouri City, Stafford, Richmond and southwest Houston.'],
];

$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'     => 'MedicalClinic',
            'name'      => $lp['name'] . ' – Sugar Land',
            'url'       => $lp['url'],
            'telephone' => $lp['phone_raw'],
            'email'     => $lp['email'],
            'image'     => 'https://novarahc.com/wp-content/uploads/2026/06/TMS-and-MeRt-by-apollo-1536x961.jpg',
            'address'   => ['@type' => 'PostalAddress', 'streetAddress' => $lp['street'], 'addressLocality' => 'Sugar Land', 'addressRegion' => 'TX', 'postalCode' => '77479', 'addressCountry' => 'US'],
            'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '09:00', 'closes' => '17:00']],
            'availableService' => [
                ['@type' => 'MedicalTherapy', 'name' => 'Transcranial Magnetic Stimulation (TMS)'],
                ['@type' => 'MedicalTherapy', 'name' => 'Magnetic e-Resonance Therapy (MeRT)'],
            ],
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(fn($f) => ['@type' => 'Question', 'name' => $f[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]]], $faqs),
        ],
    ],
];

$preload = '<link rel="preload" as="image" href="' . $lp['img'] . 'novara-clinic-lounge-800.jpg" imagesrcset="' . $lp['img'] . 'novara-clinic-lounge-800.jpg 800w, ' . $lp['img'] . 'novara-clinic-lounge.jpg 1600w" imagesizes="(min-width: 1024px) 55vw, 100vw" fetchpriority="high">'
         . "\n    <script type=\"application/ld+json\">" . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';

lp_head($lp, $title, $desc, $preload);
?>
<body class="bg-sand-50 font-sans text-slate-700 antialiased">
<?php lp_header($lp); ?>

<main id="main">

<!-- ===================== Hero ===================== -->
<section class="relative overflow-hidden" aria-labelledby="hero-title">
    <div class="pointer-events-none absolute -left-40 -top-40 h-[32rem] w-[32rem] rounded-full bg-teal-200/40 blur-3xl" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -right-32 top-20 h-[28rem] w-[28rem] rounded-full bg-brand-200/50 blur-3xl" aria-hidden="true"></div>

    <div class="relative mx-auto grid max-w-7xl gap-10 px-4 pb-14 pt-8 sm:px-6 lg:grid-cols-12 lg:gap-12 lg:pb-20 lg:pt-14">
        <!-- Copy -->
        <div class="lg:col-span-7">
            <p class="hero-in inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-bold uppercase tracking-[0.16em] text-brand-700 ring-1 ring-brand-900/10">
                <span class="relative h-2 w-2 rounded-full text-teal-500 live-dot" style="background:currentColor"></span>
                TMS Therapy · Sugar Land, TX
            </p>
            <h1 id="hero-title" class="hero-in mt-5 text-balance font-display text-[2.6rem] font-normal leading-[1.04] tracking-[-0.02em] text-brand-950 [animation-delay:.08s] sm:text-6xl lg:text-[4.1rem]">
                Depression treatment that works <em class="text-brand-600">differently.</em>
            </h1>
            <p class="hero-in mt-5 max-w-xl text-lg leading-relaxed text-slate-600 [animation-delay:.16s] sm:text-xl">
                When medication or talk therapy hasn’t brought enough relief, <strong class="font-semibold text-brand-950">TMS therapy</strong> offers another option. It’s non-invasive, drug-free, and needs no sedation. Find out if it may be right for you at our Sugar Land clinic.
            </p>

            <ul class="hero-in mt-7 grid gap-3 text-[15px] text-brand-950 [animation-delay:.24s] sm:grid-cols-2">
                <?php foreach ([
                    'FDA-cleared for major depression',
                    'No sedation or anesthesia',
                    'Sessions of about 20–40 minutes',
                    'Free, no-obligation consultation',
                ] as $b): ?>
                <li class="flex items-center gap-3">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-teal-500 text-white"><?= $check ?></span>
                    <?= e($b) ?>
                </li>
                <?php endforeach; ?>
            </ul>

            <!-- Apollo photo -->
            <figure class="hero-in relative mt-9 hidden [animation-delay:.32s] lg:block">
                <div class="overflow-hidden rounded-[2rem] shadow-soft ring-1 ring-brand-900/5">
                    <img src="<?= $lp['img'] ?>novara-clinic-lounge-800.jpg"
                         srcset="<?= $lp['img'] ?>novara-clinic-lounge-800.jpg 800w, <?= $lp['img'] ?>novara-clinic-lounge.jpg 1600w"
                         sizes="(min-width: 1024px) 55vw, 100vw"
                         alt="The calm patient lounge at Novara Healthcare in Sugar Land, with leather sofas, artwork and a refreshment bar"
                         width="1600" height="1200" fetchpriority="high"
                         class="aspect-[16/9] w-full object-cover object-[50%_65%] brightness-110 saturate-[1.1]">
                </div>
                <figcaption class="absolute bottom-4 left-4 flex items-center gap-3 rounded-2xl bg-white/95 px-4 py-3 shadow-lg ring-1 ring-brand-900/5 backdrop-blur sm:bottom-6 sm:left-6">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-700 text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                    </span>
                    <span class="leading-tight">
                        <span class="block text-sm font-extrabold text-brand-950">Our Sugar Land clinic</span>
                        <span class="block text-xs text-slate-500">5501 Cabrera Dr, Suite 503</span>
                    </span>
                </figcaption>
            </figure>
        </div>

        <!-- Form -->
        <div class="lg:col-span-5">
            <div id="consult" class="hero-in scroll-mt-28 rounded-[2rem] bg-white p-6 shadow-card ring-1 ring-brand-900/5 [animation-delay:.2s] sm:p-8 lg:sticky lg:top-28">
                <div class="mb-6 flex items-start justify-between gap-4">
                    <div>
                        <h2 class="font-display text-[1.75rem] leading-tight text-brand-950">Explore your treatment options</h2>
                        <p class="mt-2 text-[15px] leading-relaxed text-slate-500">Tell us how to reach you. Our team will call to answer your questions and see if a consultation makes sense.</p>
                    </div>
                </div>
                <?php lp_form($lp, $isStatic, 'hero'); ?>
                <div class="mt-6 border-t border-slate-100 pt-5 text-center text-sm text-slate-500">
                    Prefer to talk now? <a href="tel:<?= e($lp['phone_raw']) ?>" data-track="call_click" class="font-extrabold text-brand-700 underline decoration-teal-300 decoration-2 underline-offset-4"><?= e($lp['phone']) ?></a>
                </div>
            </div>
            <!-- Mobile: Apollo photo after the form so the form sits higher -->
            <figure class="mt-6 overflow-hidden rounded-[1.5rem] ring-1 ring-brand-900/5 lg:hidden">
                <img src="<?= $lp['img'] ?>novara-clinic-lounge-800.jpg" alt="The calm patient lounge at Novara Healthcare in Sugar Land" width="800" height="600" loading="lazy" decoding="async" class="aspect-[16/10] w-full object-cover object-[50%_65%]">
                <figcaption class="bg-white px-4 py-3 text-sm font-bold text-brand-950">Our Sugar Land clinic <span class="font-normal text-slate-500">· 5501 Cabrera Dr, Suite 503</span></figcaption>
            </figure>
        </div>
    </div>
</section>

<!-- ===================== Trust strip ===================== -->
<section class="border-y border-brand-900/5 bg-white" aria-label="Key facts">
    <dl class="mx-auto grid max-w-7xl grid-cols-2 gap-px bg-brand-900/5 lg:grid-cols-4" data-stagger>
        <?php foreach ([
            ['FDA-cleared', 'for major depressive disorder'],
            ['Non-invasive', 'awake, seated, no anesthesia'],
            ['20–40 min', 'per session, 5 days a week'],
            ['HSA &amp; CareCredit', 'plus credit and debit cards'],
        ] as [$big, $small]): ?>
        <div class="reveal bg-white px-4 py-7 text-center sm:px-6">
            <dt class="font-display text-2xl text-brand-950 sm:text-3xl"><?= $big ?></dt>
            <dd class="mt-1 text-sm text-slate-500"><?= $small ?></dd>
        </div>
        <?php endforeach; ?>
    </dl>
</section>

<!-- ===================== Depression / who it's for ===================== -->
<section class="py-16 lg:py-24" aria-labelledby="who-title">
    <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-12 lg:gap-16">
        <div class="lg:col-span-5">
            <p class="reveal text-xs font-bold uppercase tracking-[0.22em] text-teal-700">Depression care</p>
            <h2 id="who-title" class="reveal mt-4 text-balance font-display text-4xl leading-[1.08] tracking-[-0.01em] text-brand-950 sm:text-5xl">When the usual treatments haven’t been enough</h2>
            <p class="reveal mt-6 text-lg leading-relaxed text-slate-600">Depression is common and treatable, but medication and therapy don’t work the same way for everyone. TMS treats depression at the neurological level by stimulating the brain areas that regulate mood.</p>
            <a href="#consult" class="reveal mt-8 inline-flex items-center gap-2 font-extrabold text-brand-700 underline decoration-teal-300 decoration-2 underline-offset-8 hover:text-brand-900">Ask if TMS may be right for you →</a>
        </div>

        <div class="lg:col-span-7">
            <p class="reveal text-sm font-bold text-brand-950">TMS is often considered by adults who:</p>
            <ul class="mt-5 grid gap-4 sm:grid-cols-2" data-stagger>
                <?php foreach ([
                    ['Haven’t improved enough on antidepressants', 'Including people who have tried more than one medication.'],
                    ['Find medication side effects hard to live with', 'TMS doesn’t involve taking a medication.'],
                    ['Want a drug-free option alongside therapy', 'TMS can be used together with ongoing talk therapy and care.'],
                    ['Need a treatment that fits their day', 'No sedation means you stay awake and alert during each session.'],
                ] as [$h, $p]): ?>
                <li class="reveal rounded-3xl bg-white p-6 ring-1 ring-brand-900/5" data-anim="zoom">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-teal-100 text-teal-700"><?= $check ?></span>
                    <p class="mt-4 font-display text-xl leading-snug text-brand-950"><?= e($h) ?></p>
                    <p class="mt-2 text-[15px] leading-relaxed text-slate-500"><?= e($p) ?></p>
                </li>
                <?php endforeach; ?>
            </ul>

            <div class="reveal mt-5 flex gap-4 rounded-3xl bg-brand-50 p-6 ring-1 ring-brand-200/60">
                <svg class="mt-0.5 h-6 w-6 shrink-0 text-brand-700" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                <div class="text-[15px] leading-relaxed text-brand-950">
                    <p class="font-bold">About FDA clearance</p>
                    <p class="mt-1 text-slate-600">TMS is FDA-cleared to treat major depressive disorder in adults who have not responded adequately to antidepressant medication. Other conditions Novara treats with MeRT, such as autism, PTSD and TBI, are <strong class="text-brand-950">not</strong> FDA-cleared indications. Our clinical team decides what is appropriate for each person.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== What is TMS / Apollo ===================== -->
<section id="tms" class="bg-white py-16 lg:py-24" aria-labelledby="tms-title">
    <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 sm:px-6 lg:grid-cols-12 lg:gap-16">
        <div class="relative order-2 lg:order-1 lg:col-span-6">
            <div class="reveal relative rounded-[2.5rem] bg-gradient-to-br from-teal-50 via-white to-brand-50 p-6 ring-1 ring-brand-900/5 sm:p-10" data-anim="zoom">
                <img src="<?= $lp['img'] ?>apollo-tms-chair.webp" alt="The Apollo TMS therapy system: treatment console with touchscreen beside a reclining patient chair with an adjustable coil arm"
                     width="696" height="608" loading="lazy" decoding="async" class="mx-auto w-full max-w-md mix-blend-multiply">
                <div class="absolute right-4 top-4 rounded-full bg-white px-3.5 py-1.5 text-xs font-bold text-brand-800 shadow-sm ring-1 ring-brand-900/10 sm:right-8 sm:top-8">Apollo TMS</div>
                <div class="absolute -bottom-5 left-6 right-6 grid grid-cols-3 gap-2 rounded-2xl bg-brand-950 p-3 text-center text-white shadow-card sm:left-10 sm:right-10">
                    <div><p class="font-display text-lg">Reclining</p><p class="text-[11px] text-white/60">patient chair</p></div>
                    <div class="border-x border-white/10"><p class="font-display text-lg">Precise</p><p class="text-[11px] text-white/60">coil positioning</p></div>
                    <div><p class="font-display text-lg">Awake</p><p class="text-[11px] text-white/60">and comfortable</p></div>
                </div>
            </div>
        </div>

        <div class="order-1 lg:order-2 lg:col-span-6">
            <p class="reveal text-xs font-bold uppercase tracking-[0.22em] text-teal-700">How TMS works</p>
            <h2 id="tms-title" class="reveal mt-4 text-balance font-display text-4xl leading-[1.08] tracking-[-0.01em] text-brand-950 sm:text-5xl">Gentle magnetic pulses that help the brain reconnect</h2>
            <p class="reveal mt-6 text-lg leading-relaxed text-slate-600">Transcranial Magnetic Stimulation delivers focused magnetic pulses to areas of the brain linked to mood regulation, such as the prefrontal cortex. The pulses stimulate neural activity and encourage brain cells to communicate, drawing on <strong class="font-semibold text-brand-950">neuroplasticity</strong>, the brain’s ability to form new connections.</p>

            <ol class="mt-8 space-y-5" data-stagger>
                <?php foreach ([
                    ['Settle in', 'You sit in a comfortable treatment chair, fully awake. No sedation, needles or anesthesia.'],
                    ['Targeted pulses', 'A specialized coil rests on the scalp and delivers magnetic pulses to the targeted brain region. You’ll feel a gentle tapping.'],
                    ['Back to your day', 'Each session lasts about 20–40 minutes, typically five days a week for several weeks.'],
                ] as $i => [$h, $p]): ?>
                <li class="reveal flex gap-5" data-anim="right">
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-brand-700 font-display text-lg text-white"><?= $i + 1 ?></span>
                    <div>
                        <p class="font-bold text-brand-950"><?= e($h) ?></p>
                        <p class="mt-1 leading-relaxed text-slate-600"><?= e($p) ?></p>
                    </div>
                </li>
                <?php endforeach; ?>
            </ol>
            <p class="reveal mt-8 text-sm leading-relaxed text-slate-500">Many people report meaningful improvements in mood and quality of life, but outcomes vary with individual factors, and TMS doesn’t work for everyone.</p>
        </div>
    </div>
</section>

<!-- ===================== Safety ===================== -->
<section class="py-16 lg:py-20" aria-labelledby="safety-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="reveal lg:col-span-1">
                <p class="text-xs font-bold uppercase tracking-[0.22em] text-teal-700">Safety</p>
                <h2 id="safety-title" class="mt-4 text-balance font-display text-4xl leading-[1.08] text-brand-950">What to know before you start</h2>
                <p class="mt-5 leading-relaxed text-slate-600">Your safety screening happens at the consultation. Bring a list of your medications and any implants or devices.</p>
            </div>
            <div class="reveal rounded-[2rem] bg-white p-7 ring-1 ring-brand-900/5 sm:p-8" data-anim="zoom">
                <p class="font-display text-2xl text-brand-950">Side effects</p>
                <p class="mt-3 leading-relaxed text-slate-600">The most commonly reported side effect is a mild headache at the treatment site that usually passes within a few hours and responds to over-the-counter pain relief. Serious side effects such as seizures are very rare.</p>
            </div>
            <div class="reveal rounded-[2rem] bg-white p-7 ring-1 ring-brand-900/5 sm:p-8" data-anim="zoom">
                <p class="font-display text-2xl text-brand-950">Not suitable for everyone</p>
                <p class="mt-3 leading-relaxed text-slate-600">TMS may not be appropriate for people with certain implants or metal in or near the head, such as a pacemaker, cochlear implant, aneurysm clips or a deep brain stimulator. Our clinical team reviews this with you.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===================== Patient journey ===================== -->
<section class="bg-brand-950 py-16 text-white lg:py-24" aria-labelledby="journey-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
            <div class="max-w-2xl">
                <p class="reveal text-xs font-bold uppercase tracking-[0.22em] text-teal-300">Your path to care</p>
                <h2 id="journey-title" class="reveal mt-4 text-balance font-display text-4xl leading-[1.08] sm:text-5xl">From first call to follow-up, here’s what happens</h2>
            </div>
            <a href="#consult" class="reveal inline-flex shrink-0 items-center justify-center rounded-full bg-white px-7 py-4 font-extrabold text-brand-900 transition hover:bg-teal-100">Start with step one</a>
        </div>

        <ol class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
            <?php foreach ($journey as $i => [$h, $p]): ?>
            <li class="reveal relative rounded-3xl bg-white/[.06] p-7 ring-1 ring-white/10 transition hover:bg-white/[.09]">
                <span class="font-display text-5xl text-teal-300/90"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                <p class="mt-4 font-display text-2xl"><?= e($h) ?></p>
                <p class="mt-2 leading-relaxed text-white/70"><?= e($p) ?></p>
            </li>
            <?php endforeach; ?>
        </ol>
        <p class="reveal mt-8 text-sm text-white/50">Sending an enquiry is not a medical assessment and doesn’t confirm eligibility. Treatment decisions are made by our clinical team after evaluation.</p>
    </div>
</section>

<!-- ===================== TMS vs MeRT ===================== -->
<section id="mert" class="py-16 lg:py-24" aria-labelledby="mert-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="grid items-end gap-10 lg:grid-cols-12">
        <div class="lg:col-span-7">
            <p class="reveal text-xs font-bold uppercase tracking-[0.22em] text-teal-700">Also at Novara: MeRT</p>
            <h2 id="mert-title" class="reveal mt-4 text-balance font-display text-4xl leading-[1.08] tracking-[-0.01em] text-brand-950 sm:text-5xl">TMS or MeRT? We’ll help you understand the difference</h2>
            <p class="reveal mt-6 text-lg leading-relaxed text-slate-600">MeRT (Magnetic e-Resonance Therapy) builds on rTMS. Instead of one location and frequency for everyone, it personalizes treatment using a map of your own brain activity.</p>
        </div>
        <!-- CONSENT: confirm written photo consent from the patient's guardian before publishing -->
        <figure class="reveal lg:col-span-5" data-anim="zoom">
            <div class="overflow-hidden rounded-[2rem] shadow-soft ring-1 ring-brand-900/5">
                <img src="<?= $lp['img'] ?>novara-apollo-session-800.jpg" srcset="<?= $lp['img'] ?>novara-apollo-session-800.jpg 600w, <?= $lp['img'] ?>novara-apollo-session.jpg 1200w" sizes="(min-width: 1024px) 40vw, 100vw"
                     alt="A Novara technician positions the Apollo treatment coil for a young patient, with a caregiver beside them" width="1200" height="1600" loading="lazy" decoding="async"
                     class="aspect-[4/3] w-full object-cover object-[50%_45%]">
            </div>
            <figcaption class="mt-3 text-sm text-slate-500">A treatment session on the Apollo system at our Sugar Land clinic.</figcaption>
        </figure>
        </div>

        <div class="reveal mt-10 overflow-x-auto rounded-[2rem] bg-white ring-1 ring-brand-900/5">
            <table class="w-full min-w-[640px] text-left text-[15px]">
                <caption class="sr-only">Comparison of TMS and MeRT</caption>
                <thead>
                    <tr class="border-b border-slate-100">
                        <th scope="col" class="w-1/4 p-5 text-xs font-bold uppercase tracking-[0.16em] text-slate-400 sm:p-6"></th>
                        <th scope="col" class="p-5 sm:p-6"><span class="inline-flex items-center gap-2 font-display text-2xl text-brand-950"><span class="h-3 w-3 rounded-full bg-brand-600"></span>TMS</span></th>
                        <th scope="col" class="p-5 sm:p-6"><span class="inline-flex items-center gap-2 font-display text-2xl text-brand-950"><span class="h-3 w-3 rounded-full bg-teal-400"></span>MeRT</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-600">
                    <?php foreach ([
                        ['Approach', 'A standardized protocol: one target area at a fixed frequency.', 'Location and frequency tailored to your qEEG brain map and ECG.'],
                        ['Assessment', 'Clinical evaluation and safety screening.', 'qEEG and ECG testing, plus a clinical evaluation, before treatment.'],
                        ['Session length', 'About 20–40 minutes.', 'About 30 minutes.'],
                        ['Typical course', 'Five days a week for several weeks.', 'Commonly at least 6 weeks, adjusted to your response.'],
                        ['FDA status', 'FDA-cleared for major depressive disorder.', 'Not FDA-cleared. Uses for autism, PTSD and TBI are investigational.'],
                    ] as [$k, $a, $b]): ?>
                    <tr>
                        <th scope="row" class="p-5 align-top font-bold text-brand-950 sm:p-6"><?= e($k) ?></th>
                        <td class="p-5 align-top sm:p-6"><?= e($a) ?></td>
                        <td class="p-5 align-top sm:p-6"><?= e($b) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p class="reveal mt-5 text-sm text-slate-500">MeRT is not a guaranteed treatment, and results vary from person to person. Not sure which fits? We’ll talk it through at your free consultation.</p>
    </div>
</section>

<!-- ===================== Why Novara ===================== -->
<section class="bg-white py-16 lg:py-24" aria-labelledby="why-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-5">
                <p class="reveal text-xs font-bold uppercase tracking-[0.22em] text-teal-700">Why Novara Healthcare</p>
                <h2 id="why-title" class="reveal mt-4 text-balance font-display text-4xl leading-[1.08] tracking-[-0.01em] text-brand-950 sm:text-5xl">Personal care, right here in Sugar Land</h2>
                <p class="reveal mt-6 text-lg leading-relaxed text-slate-600">We combine advanced therapies like TMS with compassionate, patient-focused care in a welcoming clinic, with a treatment plan built around you.</p>

                <div class="reveal mt-10 overflow-hidden rounded-[2rem] bg-sand-50 ring-1 ring-brand-900/5" data-anim="left">
                    <figure class="relative">
                        <img src="<?= $lp['img'] ?>novara-team-community-800.jpg" alt="Four members of the Novara Healthcare team smiling behind the Novara information table at a community event in Houston" width="800" height="600" loading="lazy" decoding="async" class="aspect-[16/10] w-full object-cover object-[50%_35%]">
                        <figcaption class="absolute bottom-3 left-3 rounded-full bg-white/95 px-3 py-1.5 text-xs font-bold text-brand-900 shadow-sm">Our team, out in the Houston community</figcaption>
                    </figure>
                    <div class="p-7">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500">The people you’ll meet</p>
                    <ul class="mt-5 space-y-5">
                        <?php foreach ([
                            ['S', 'Spree, PharmD', 'Executive Director', 'from-brand-600 to-brand-800'],
                            ['M', 'Misha', 'Chief Neuro Technician', 'from-teal-400 to-teal-600'],
                        ] as [$i, $name, $role, $grad]): ?>
                        <li class="flex items-center gap-4">
                            <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-gradient-to-br <?= $grad ?> font-display text-2xl text-white" aria-hidden="true"><?= $i ?></span>
                            <div>
                                <p class="font-display text-xl text-brand-950"><?= e($name) ?></p>
                                <p class="text-sm text-slate-500"><?= e($role) ?></p>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <!-- TODO: add medical director / prescribing clinician profile (name, credentials, photo) once approved by Novara. -->
                    </div>
                </div>
            </div>

            <ul class="grid gap-4 sm:grid-cols-2 lg:col-span-7" data-stagger>
                <?php foreach ([
                    ['M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z', 'A plan built for you', 'Every patient receives a tailored treatment plan, not a one-size-fits-all package.'],
                    ['M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z', 'Apollo TMS equipment', 'Treatment is delivered on the Apollo TMS therapy system, with a comfortable reclining chair.'],
                    ['M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155', 'Questions answered first', 'A free conversation with our team before anything is booked, with no pressure to commit.'],
                    ['M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99', 'Coordination & follow-up', 'We schedule your sessions, check in on progress, and stay in touch after treatment ends.'],
                    ['M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z', 'Flexible ways to pay', 'HSA, CareCredit, credit and debit cards, and help checking your insurance benefits.'],
                    ['M15 10.5a3 3 0 11-6 0 3 3 0 016 0z M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z', 'Local to Sugar Land', 'Our clinic on Cabrera Dr is easy to reach from Sugar Land, Missouri City, Stafford and Richmond.'],
                ] as [$icon, $h, $p]): ?>
                <li class="reveal rounded-3xl bg-sand-50 p-6 ring-1 ring-brand-900/5 transition hover:-translate-y-0.5 hover:shadow-soft">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white text-brand-700 ring-1 ring-brand-900/10">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="<?= $icon ?>"/></svg>
                    </span>
                    <p class="mt-4 font-display text-xl text-brand-950"><?= e($h) ?></p>
                    <p class="mt-2 text-[15px] leading-relaxed text-slate-500"><?= e($p) ?></p>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Inside the clinic (real photos) -->
        <div class="mt-16">
            <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
                <h3 class="reveal font-display text-3xl text-brand-950 sm:text-4xl">Inside our Sugar Land clinic</h3>
                <p class="reveal text-slate-500">Calm, private and designed to feel nothing like a hospital.</p>
            </div>
            <div class="mt-8 grid auto-rows-[11rem] grid-cols-2 gap-3 sm:auto-rows-[14rem] lg:grid-cols-4 lg:gap-4" data-stagger>
                <?php foreach ([
                    ['novara-clinic-reception', 'Reception desk and waiting area', 'col-span-2 row-span-2', '50% 60%', 1600, 1200],
                    ['novara-clinic-seating', 'Patient lounge seating', '', '50% 60%', 1200, 1600],
                    ['novara-consult-room', 'Consultation room', '', '50% 55%', 1200, 1600],
                    ['novara-grand-opening', 'Grand opening day at the clinic', 'col-span-2', '50% 40%', 1200, 1600],
                ] as [$img, $cap, $span, $pos, $w, $h]): ?>
                <figure class="reveal group relative overflow-hidden rounded-3xl ring-1 ring-brand-900/5 <?= $span ?>" data-anim="zoom">
                    <img src="<?= $lp['img'] . $img ?>-800.jpg" srcset="<?= $lp['img'] . $img ?>-800.jpg 800w, <?= $lp['img'] . $img ?>.jpg 1600w" sizes="(min-width: 1024px) 50vw, 100vw"
                         alt="<?= e($cap) ?> at Novara Healthcare, Sugar Land" width="<?= $w ?>" height="<?= $h ?>" loading="lazy" decoding="async"
                         class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.04]" style="object-position:<?= $pos ?>">
                    <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-brand-950/70 to-transparent px-4 pb-3 pt-10 text-sm font-semibold text-white"><?= e($cap) ?></figcaption>
                </figure>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- ===================== Reviews ===================== -->
<section class="py-16 lg:py-24" aria-labelledby="reviews-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <h2 id="reviews-title" class="reveal max-w-xl text-balance font-display text-4xl leading-[1.08] text-brand-950 sm:text-5xl">What people say about Novara</h2>
            <p class="reveal flex items-center gap-1 text-amber-500" aria-label="Five star reviews">
                <?php for ($s = 0; $s < 5; $s++): ?><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M9.05 2.93c.3-.92 1.6-.92 1.9 0l1.07 3.29a1 1 0 00.95.69h3.46c.97 0 1.37 1.24.59 1.81l-2.8 2.03a1 1 0 00-.36 1.12l1.07 3.29c.3.92-.75 1.69-1.54 1.12l-2.8-2.03a1 1 0 00-1.17 0l-2.8 2.03c-.78.57-1.83-.2-1.53-1.12l1.07-3.29a1 1 0 00-.37-1.12L2.98 8.72c-.78-.57-.38-1.81.59-1.81h3.46a1 1 0 00.95-.69l1.07-3.29z"/></svg><?php endfor; ?>
            </p>
        </div>
        <div class="mt-10 grid gap-5 md:grid-cols-3" data-stagger>
            <?php foreach ([
                ['As a fellow healthcare provider, I have full confidence in recommending Novara to colleagues and patients alike. I consider them an invaluable resource in our shared mission to support mental health and recovery.', 'E.J.', 'Healthcare provider'],
                ['Spree the owner and Misha the manager are very knowledgeable with MeRT! Not only are they very knowledgeable they are also very accommodating with their clients and staff. I would give more than 5 stars if I had the option!', 'A.C.', 'Novara client'],
                ['Stopped by Novara during their Grand Opening and was really impressed. The team was super friendly and easy to talk to. You can tell they know their stuff and genuinely care about what they do.', 'Z.D.', 'Grand opening guest'],
            ] as [$q, $who, $role]): ?>
            <figure class="reveal flex flex-col justify-between rounded-[2rem] bg-white p-7 ring-1 ring-brand-900/5">
                <blockquote class="text-[17px] leading-relaxed text-brand-950">“<?= e($q) ?>”</blockquote>
                <figcaption class="mt-6 flex items-center gap-3 border-t border-slate-100 pt-5">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-50 font-bold text-brand-700"><?= e($who[0]) ?></span>
                    <span class="leading-tight"><span class="block font-bold text-brand-950"><?= e($who) ?></span><span class="text-sm text-slate-500"><?= e($role) ?></span></span>
                </figcaption>
            </figure>
            <?php endforeach; ?>
        </div>
        <p class="reveal mt-5 text-xs text-slate-500">Reviews describe individual experiences with Novara. Individual results vary.</p>
    </div>
</section>

<!-- ===================== Insurance & payment ===================== -->
<section class="pb-16 lg:pb-24" aria-labelledby="pay-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="reveal grid overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-brand-700 to-brand-900 text-white lg:grid-cols-12" data-anim="zoom">
            <div class="p-8 sm:p-12 lg:col-span-7">
                <p class="text-xs font-bold uppercase tracking-[0.22em] text-teal-300">Insurance &amp; payment</p>
                <h2 id="pay-title" class="mt-4 text-balance font-display text-4xl leading-[1.08] sm:text-5xl">Let us check your coverage before you decide</h2>
                <p class="mt-5 max-w-lg text-lg leading-relaxed text-white/75">Coverage for TMS depends on your plan and isn’t guaranteed. Share your details and our team will help you understand your benefits and costs up front.</p>
                <a href="#consult" class="mt-8 inline-flex rounded-full bg-white px-7 py-4 font-extrabold text-brand-900 transition hover:bg-teal-100">Ask about insurance</a>
            </div>
            <div class="border-t border-white/10 bg-white/[.06] p-8 sm:p-12 lg:col-span-5 lg:border-l lg:border-t-0">
                <p class="text-sm font-bold text-white">We accept</p>
                <ul class="mt-4 flex flex-wrap gap-2">
                    <?php foreach (['HSA', 'CareCredit', 'Credit cards', 'Debit cards'] as $p): ?>
                    <li class="rounded-full bg-white/10 px-4 py-2 text-sm font-semibold ring-1 ring-white/15"><?= e($p) ?></li>
                    <?php endforeach; ?>
                </ul>
                <p class="mt-8 text-sm font-bold text-white">MeRT coverage</p>
                <p class="mt-2 text-sm leading-relaxed text-white/70">MeRT is currently covered only by TriWest/TRICARE, for depression and PTSD.</p>
                <a href="https://www.carecredit.com/apply/" target="_blank" rel="noopener" class="mt-8 inline-flex text-sm font-bold text-teal-300 underline underline-offset-4 hover:text-white">Apply for CareCredit ↗</a>
            </div>
        </div>
    </div>
</section>

<!-- ===================== FAQ ===================== -->
<section id="faq" class="bg-white py-16 lg:py-24" aria-labelledby="faq-title">
    <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-12">
        <div class="lg:col-span-4">
            <p class="reveal text-xs font-bold uppercase tracking-[0.22em] text-teal-700">FAQ</p>
            <h2 id="faq-title" class="reveal mt-4 text-balance font-display text-4xl leading-[1.08] text-brand-950 sm:text-5xl">Questions, answered</h2>
            <p class="reveal mt-5 leading-relaxed text-slate-600">Don’t see yours? Call <a href="tel:<?= e($lp['phone_raw']) ?>" data-track="call_click" class="font-bold text-brand-700 underline underline-offset-4"><?= e($lp['phone']) ?></a> and we’ll talk it through.</p>
        </div>
        <div class="divide-y divide-slate-100 border-y border-slate-100 lg:col-span-8">
            <?php foreach ($faqs as $i => [$q, $a]): ?>
            <details class="group py-1" <?= $i === 0 ? 'open' : '' ?>>
                <summary class="flex cursor-pointer items-center justify-between gap-6 py-5 text-left font-display text-xl text-brand-950 hover:text-brand-700">
                    <?= e($q) ?>
                    <span class="faq-icon flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-sand-50 text-brand-700 ring-1 ring-brand-900/10 transition">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
                    </span>
                </summary>
                <p class="max-w-2xl pb-6 leading-relaxed text-slate-600"><?= e($a) ?></p>
            </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===================== Location ===================== -->
<section id="location" class="py-16 lg:py-24" aria-labelledby="loc-title">
    <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-12">
        <div class="reveal rounded-[2rem] bg-white p-8 ring-1 ring-brand-900/5 sm:p-10 lg:col-span-5" data-anim="left">
            <p class="text-xs font-bold uppercase tracking-[0.22em] text-teal-700">Visit us</p>
            <h2 id="loc-title" class="mt-4 font-display text-4xl leading-[1.08] text-brand-950">Our Sugar Land clinic</h2>
            <dl class="mt-8 space-y-6">
                <div>
                    <dt class="text-sm font-bold text-slate-500">Address</dt>
                    <dd class="mt-1 text-lg text-brand-950"><?= e($lp['street']) ?><br><?= e($lp['city']) ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-bold text-slate-500">Hours</dt>
                    <dd class="mt-1 text-lg text-brand-950"><?= e($lp['hours']) ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-bold text-slate-500">Phone</dt>
                    <dd class="mt-1"><a href="tel:<?= e($lp['phone_raw']) ?>" data-track="call_click" class="text-lg font-bold text-brand-700 hover:text-brand-900"><?= e($lp['phone']) ?></a></dd>
                </div>
                <div>
                    <dt class="text-sm font-bold text-slate-500">Serving</dt>
                    <dd class="mt-1 text-brand-950">Sugar Land, Missouri City, Stafford, Richmond, Rosenberg and southwest Houston</dd>
                </div>
            </dl>
            <a href="<?= e($lp['maps']) ?>" target="_blank" rel="noopener" class="mt-8 inline-flex rounded-full bg-brand-50 px-6 py-3 font-bold text-brand-800 ring-1 ring-brand-200 transition hover:bg-brand-100">Get directions ↗</a>
        </div>
        <div class="reveal min-h-[320px] overflow-hidden rounded-[2rem] ring-1 ring-brand-900/5 lg:col-span-7" data-anim="right">
            <iframe title="Map showing Novara Healthcare, 5501 Cabrera Dr, Sugar Land, TX"
                    src="https://www.google.com/maps?q=5501+Cabrera+Dr+Suite+503,+Sugar+Land,+TX+77479&amp;output=embed"
                    class="h-full min-h-[320px] w-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<!-- ===================== Final CTA ===================== -->
<section class="relative overflow-hidden bg-brand-950 py-16 text-white lg:py-24" aria-labelledby="final-title">
    <img src="<?= $lp['img'] ?>novara-clinic-reception-800.jpg" alt="" width="800" height="600" loading="lazy" decoding="async" class="absolute inset-0 h-full w-full object-cover opacity-25" aria-hidden="true">
    <div class="absolute inset-0 bg-gradient-to-r from-brand-950 via-brand-950/90 to-brand-950/70" aria-hidden="true"></div>
    <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-4 sm:px-6 lg:grid-cols-12">
        <div class="lg:col-span-6">
            <h2 id="final-title" class="reveal text-balance font-display text-4xl leading-[1.06] sm:text-6xl">Take the first step <em class="text-teal-300">today.</em></h2>
            <p class="reveal mt-6 max-w-md text-lg leading-relaxed text-white/75">A short, free conversation is all it takes to learn whether TMS could be part of your care. No pressure and no commitment.</p>
            <ul class="reveal mt-8 space-y-3 text-white/85">
                <?php foreach (['Callback from our Sugar Land team', 'Honest answers about fit, timing and cost', 'Help checking your insurance benefits'] as $b): ?>
                <li class="flex items-center gap-3"><span class="flex h-6 w-6 items-center justify-center rounded-full bg-teal-400 text-brand-950"><?= $check ?></span><?= e($b) ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="tel:<?= e($lp['phone_raw']) ?>" data-track="call_click" class="reveal mt-10 inline-flex items-center gap-3 font-display text-3xl text-white hover:text-teal-300">
                <?= e($lp['phone']) ?>
            </a>
        </div>
        <div class="lg:col-span-6">
            <div class="reveal rounded-[2rem] bg-white p-6 text-slate-700 shadow-card sm:p-8" data-anim="zoom">
                <p class="mb-5 font-display text-2xl text-brand-950">Request your free consultation</p>
                <?php lp_form($lp, $isStatic, 'footer'); ?>
            </div>
        </div>
    </div>
</section>

</main>

<?php lp_footer($lp); ?>

<!-- Sticky mobile CTA -->
<div id="mobile-cta" class="fixed inset-x-0 bottom-0 z-40 grid grid-cols-2 gap-2 border-t border-brand-900/10 bg-white/95 p-3 backdrop-blur md:hidden" style="padding-bottom:max(.75rem, env(safe-area-inset-bottom))">
    <a href="tel:<?= e($lp['phone_raw']) ?>" data-track="call_click" class="flex items-center justify-center gap-2 rounded-full bg-teal-50 py-3.5 font-extrabold text-teal-700 ring-1 ring-teal-200">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
        Call now
    </a>
    <a href="#consult" class="flex items-center justify-center rounded-full bg-brand-700 py-3.5 font-extrabold text-white">Free consultation</a>
</div>

<script>
(function () {
    var dl = window.dataLayer = window.dataLayer || [];
    var store = { get: function (k) { try { return sessionStorage.getItem(k); } catch (e) { return null; } },
                  set: function (k, v) { try { sessionStorage.setItem(k, v); } catch (e) {} } };

    // Keep ad attribution (UTMs / gclid) for the session and attach it to every form
    var params = new URLSearchParams(location.search);
    document.querySelectorAll('[data-utm]').forEach(function (input) {
        var k = input.getAttribute('data-utm');
        var v = params.get(k) || store.get('lp_' + k) || '';
        if (params.get(k)) store.set('lp_' + k, v);
        input.value = v;
    });

    // Form submit: guard double-clicks and fire a tracking event
    document.querySelectorAll('.lp-form').forEach(function (form) {
        form.addEventListener('submit', function () {
            var btn = form.querySelector('button[type="submit"]');
            btn.disabled = true;
            form.querySelector('.lp-submit-label').textContent = 'Sending…';
            dl.push({ event: 'lp_form_submit', form_location: form.getAttribute('data-form-id'), interest: form.interest.value });
        });
    });

    // Call clicks
    document.querySelectorAll('[data-track="call_click"]').forEach(function (a) {
        a.addEventListener('click', function () { dl.push({ event: 'lp_call_click' }); });
    });

    // Sticky mobile CTA appears once the hero form is out of view, hides near the final form
    var bar = document.getElementById('mobile-cta');
    var heroForm = document.getElementById('consult');
    var finalForm = document.querySelector('[data-form-id="footer"]');
    if ('IntersectionObserver' in window) {
        var heroGone = false, finalSeen = false;
        var sync = function () { bar.classList.toggle('is-on', heroGone && !finalSeen); };
        new IntersectionObserver(function (e) { heroGone = !e[0].isIntersecting && e[0].boundingClientRect.top < 0; sync(); }).observe(heroForm);
        new IntersectionObserver(function (e) { finalSeen = e[0].isIntersecting; sync(); }).observe(finalForm);
    }

    // Stagger + reveal on scroll
    document.querySelectorAll('[data-stagger]').forEach(function (group) {
        group.querySelectorAll(':scope > .reveal').forEach(function (el, i) { el.style.transitionDelay = (i * 100) + 'ms'; });
    });
    var reveals = document.querySelectorAll('.reveal');
    if (!('IntersectionObserver' in window)) { reveals.forEach(function (el) { el.classList.add('is-visible'); }); return; }
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) { if (en.isIntersecting) { en.target.classList.add('is-visible'); io.unobserve(en.target); } });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
    reveals.forEach(function (el) { io.observe(el); });
})();
</script>
</body>
</html>
