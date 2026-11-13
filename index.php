<?php
/**
 * Novara Healthcare — Homepage
 * Tailwind CSS (CDN build) + semantic, SEO-ready markup.
 */

$site = [
    'name'      => 'Novara Healthcare',
    'url'       => 'https://novarahc.com/',
    'phone'     => '(713) 818-4809',
    'phone_raw' => '+17138184809',
    'email'     => 'info@novarahealthtx.com',
    'logo'      => 'https://novarahc.com/wp-content/uploads/2026/03/Novara-Healthcare-Logo.png',
    'favicon'   => 'https://novarahc.com/wp-content/uploads/2026/03/cropped-favicon1-192x192.png',
    'title'     => 'MeRT & TMS Treatment in Houston & Sugar Land, TX | Novara Healthcare',
    'desc'      => 'Novara Healthcare offers personalized MeRT and TMS brain treatment for autism, depression, PTSD and more in Sugar Land (Houston), TX and the Washington DC Metro area. Book a free consultation.',
];

/* Set by build.php when rendering the static site for Netlify. */
$isStatic = defined('STATIC_BUILD') && STATIC_BUILD;

/* ---------- Simple contact form handler (local / PHP hosting only) ---------- */
$formStatus = null;
if (!$isStatic && ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['contact_form'])) {
    $first   = trim(strip_tags($_POST['first_name'] ?? ''));
    $last    = trim(strip_tags($_POST['last_name'] ?? ''));
    $phone   = trim(strip_tags($_POST['phone'] ?? ''));
    $email   = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $message = trim(strip_tags($_POST['message'] ?? ''));
    $honey   = $_POST['website'] ?? '';

    if ($honey !== '') {
        $formStatus = 'success'; // silently drop bots
    } elseif ($first === '' || !$email || $message === '') {
        $formStatus = 'error';
    } else {
        $body = "Name: $first $last\nPhone: $phone\nEmail: $email\n\n$message";
        $headers = 'From: ' . $site['email'] . "\r\nReply-To: $email";
        $formStatus = @mail($site['email'], 'New website enquiry — ' . "$first $last", $body, $headers) ? 'success' : 'error';
    }
}

function e($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

/** Editorial label row used at the top of each section. */
function section_label($left, $right = '', $dark = false) {
    $line = $dark ? 'border-white/10 text-white/50' : 'border-brand-900/10 text-slate-500';
    $dot  = $dark ? 'bg-teal-300' : 'bg-teal-500';
    echo '<div class="reveal flex flex-wrap items-center justify-between gap-4 border-b pb-6 text-[11px] font-bold uppercase tracking-[0.24em] ' . $line . '">'
       . '<p class="flex items-center gap-3"><span class="h-2 w-2 rounded-full ' . $dot . '" aria-hidden="true"></span>' . e($left) . '</p>'
       . ($right !== '' ? '<p>' . e($right) . '</p>' : '')
       . '</div>';
}

$services = [
    [
        'title'  => 'Magnetic eResonance Therapy (MeRT)',
        'text'   => 'An advanced, non-invasive treatment that uses your EEG to deliver precisely tuned magnetic pulses to the areas of the brain that need support.',
        'img'    => 'https://novarahc.com/wp-content/uploads/2026/06/TMS-Therapy-1024x683.jpg',
        'srcset' => 'https://novarahc.com/wp-content/uploads/2026/06/TMS-Therapy-768x512.jpg 768w, https://novarahc.com/wp-content/uploads/2026/06/TMS-Therapy-1024x683.jpg 1024w, https://novarahc.com/wp-content/uploads/2026/06/TMS-Therapy.jpg 1536w',
        'pos'    => '35% center',
        'alt'    => 'Clinician fitting an EEG cap to map brainwave activity before MeRT treatment',
        'href'   => 'https://novarahc.com/healthcare-services/magnetic-eresonance-therapy/',
        'tags'   => ['Autism', 'Depression', 'PTSD', 'TBI'],
    ],
    [
        'title'  => 'Transcranial Magnetic Stimulation (TMS)',
        'text'   => 'A non-invasive approach for depression that uses magnetic fields to stimulate nerve cells in the brain linked to mood.',
        'img'    => 'https://novarahc.com/wp-content/uploads/2026/04/Depression-Therapy-1024x683.jpg',
        'srcset' => 'https://novarahc.com/wp-content/uploads/2026/04/Depression-Therapy-768x512.jpg 768w, https://novarahc.com/wp-content/uploads/2026/04/Depression-Therapy-1024x683.jpg 1024w',
        'pos'    => 'center',
        'alt'    => 'Patient speaking with a clinician about TMS therapy for depression',
        'href'   => 'https://novarahc.com/healthcare-services/tms-therapy/',
        'tags'   => ['Depression'],
    ],
    [
        'title'  => 'Autism Spectrum Disorder (ASD) Clinic',
        'text'   => 'A safe, sensory-friendly space for children and families, pairing MeRT with compassionate, individualized support.',
        'img'    => 'https://novarahc.com/wp-content/uploads/2026/04/hero-autism-Dj6R_GE2-1024x576.jpg',
        'srcset' => 'https://novarahc.com/wp-content/uploads/2026/04/hero-autism-Dj6R_GE2-768x432.jpg 768w, https://novarahc.com/wp-content/uploads/2026/04/hero-autism-Dj6R_GE2-1024x576.jpg 1024w, https://novarahc.com/wp-content/uploads/2026/04/hero-autism-Dj6R_GE2.jpg 1920w',
        'pos'    => '30% center',
        'alt'    => 'Clinician comforting a smiling child at a sensory-friendly autism clinic',
        'href'   => 'https://novarahc.com/healthcare-services/autism-therapy/',
        'tags'   => ['Children & families', 'Sensory-friendly'],
    ],
];

/* Main navigation — mirrors the menu on novarahc.com */
$nav = [
    ['Locations', null, [
        ['Houston / Sugar Land, TX', 'https://novarahc.com/locations/houston-sugar-land-tx/'],
        ['Washington DC Metro', 'https://novarahc.com/locations/washington-dc-metro/'],
    ]],
    ['About', 'https://novarahc.com/about/', [
        ['About Novara Healthcare', 'https://novarahc.com/about/'],
        ['Reviews', '#reviews'],
        ['FAQ', 'https://novarahc.com/faq/'],
    ]],
    ['Autism Therapy', 'https://novarahc.com/healthcare-services/autism-therapy/', [
        ['Autism and MeRT', 'https://novarahc.com/healthcare-services/autism-therapy/'],
        ['ABA And MeRT For Autism', 'https://novarahc.com/aba-and-mert-for-autism/'],
        ['MeRT Plus Therapies', 'https://novarahc.com/healthcare-services/mert-plus-therapies/'],
    ]],
    ['Healthcare Services', 'https://novarahc.com/healthcare-services/', [
        ['TMS Therapy', 'https://novarahc.com/healthcare-services/tms-therapy/'],
        ['Magnetic eResonance Therapy', 'https://novarahc.com/healthcare-services/magnetic-eresonance-therapy/'],
        ['Depression Therapy', 'https://novarahc.com/healthcare-services/depression-therapy/'],
        ['PTSD Treatment with MeRT', 'https://novarahc.com/healthcare-services/ptsd-treatment-with-mert/'],
    ]],
    ['Research', 'https://novarahc.com/research/', [
        ['Research Sources', 'https://novarahc.com/research/'],
        ['Video Resources', 'https://novarahc.com/video-resources/'],
    ]],
    ['Resources', null, [
        ['Apply for CareCredit', 'https://www.carecredit.com/apply/'],
        ['Events & Specials', 'https://novarahc.com/events-specials/'],
        ['Lodging & Attractions in Sugar Land Texas', 'https://novarahc.com/places-to-stay-and-things-to-see-and-do-in-sugar-land-texas/'],
    ]],
    ['Contact Us', null, [
        ['Contact', 'https://novarahc.com/contact/'],
        ['Referral Form', 'https://novarahc.com/contact/referral/'],
    ]],
    ['Log In', null, [
        ['SimplePractice Patient Portal', 'https://novarahealthcare.clientsecure.me/'],
        ['Treatment Portal', 'https://mymert.health/'],
    ]],
];

/** External links (other domains) open in a new tab. */
function link_attrs($href) {
    $ext = preg_match('#^https?://#', $href) && !str_starts_with($href, 'https://novarahc.com');
    return 'href="' . e($href) . '"' . ($ext ? ' target="_blank" rel="noopener"' : '');
}

$conditions = [
    ['Autism (ASD)', 'https://novarahc.com/healthcare-services/autism-therapy/'],
    ['Depression', 'https://novarahc.com/healthcare-services/depression-therapy/'],
    ['PTSD', 'https://novarahc.com/healthcare-services/ptsd-treatment-with-mert/'],
    ['Anxiety', 'https://novarahc.com/healthcare-services/magnetic-eresonance-therapy/'],
    ['Traumatic Brain Injury', 'https://novarahc.com/healthcare-services/magnetic-eresonance-therapy/'],
    ['Sleep Disorders', 'https://novarahc.com/healthcare-services/magnetic-eresonance-therapy/'],
];

$steps = [
    ['Free Consultation', 'A no-obligation phone or in-office conversation with a patient coordinator about your history, symptoms and goals — zero pressure.'],
    ['qEEG Brain Map & EKG', 'A painless diagnostic evaluation records your brain’s electrical activity and heart rhythm to build a protocol as unique as your brain.'],
    ['Personalized Treatment', 'Relaxed sessions, typically 5 days a week for several weeks, with a mid-treatment qEEG to measure progress and fine-tune care.'],
    ['Follow-Up & Support', 'A final evaluation reviews your progress and next steps. Our team stays your partner in long-term wellness.'],
];

$reviews = [
    ['As a fellow healthcare provider, I have full confidence in recommending Novara to colleagues and patients alike. They are setting the gold standard in MeRT & TMS treatment. I consider them an invaluable resource in our shared mission to support mental health and recovery.', 'E.J.', 'Healthcare provider'],
    ['Spree the owner and Misha the manager are very knowledgeable with MeRT! Not only are they very knowledgeable they are also very accommodating with their clients and staff. I would give more than 5 stars if I had the option!', 'A.C.', 'Novara client'],
    ['Stopped by Novara during their Grand Opening and was really impressed. The team was super friendly and easy to talk to. You can tell they know their stuff and genuinely care about what they do. The space looks amazing and feels very well put together!', 'Z.D.', 'Grand opening guest'],
    ['Met the team at Novara during their Grand Opening event, they were super friendly and knowledgeable, and they have a great facility!', 'Y.A.', 'Grand opening guest'],
];

$faqs = [
    ['What conditions does MeRT treat?', 'MeRT (Magnetic e-Resonance Therapy) has been used to support patients experiencing treatment-resistant depression, anxiety, PTSD, traumatic brain injury (TBI), autism spectrum disorder, and sleep disorders. It uses your brain’s own unique EEG patterns to deliver personalized, targeted magnetic stimulation — different from standard TMS protocols that use a one-size-fits-all approach.'],
    ['How do I know if I’m a candidate?', 'Candidacy is determined through a simple, non-invasive evaluation that includes a qEEG brain map and an EKG. These tests help our clinical team identify irregular brainwave patterns and assess whether MeRT or TMS may benefit you. Certain medical implants (such as cochlear implants or metal in the skull) may affect eligibility.'],
    ['Is the treatment painful or time-consuming?', 'MeRT and TMS sessions are non-invasive and typically well-tolerated. Most patients describe a gentle tapping or clicking near the scalp. Each session lasts approximately 30–45 minutes, generally 5 days a week over several weeks. No anesthesia or recovery time is needed.'],
    ['What results can I expect, and how soon?', 'Results vary by individual and condition. Many patients begin noticing changes in sleep quality, mood, focus or energy within the first 2–3 weeks, while others see more gradual changes after completing a full protocol. A follow-up qEEG is typically performed mid-treatment to track changes objectively.'],
];

/* ---------- Structured data ---------- */
$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'       => 'MedicalClinic',
            '@id'         => $site['url'] . '#clinic',
            'name'        => $site['name'],
            'url'         => $site['url'],
            'logo'        => $site['logo'],
            'image'       => $site['logo'],
            'description' => $site['desc'],
            'telephone'   => $site['phone_raw'],
            'email'       => $site['email'],
            'medicalSpecialty' => ['Neurologic', 'Psychiatric'],
            'availableService' => [
                ['@type' => 'MedicalTherapy', 'name' => 'Magnetic eResonance Therapy (MeRT)'],
                ['@type' => 'MedicalTherapy', 'name' => 'Transcranial Magnetic Stimulation (TMS)'],
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress'   => '5501 Cabrera Dr Suite 503',
                'addressLocality' => 'Sugar Land',
                'addressRegion'   => 'TX',
                'postalCode'      => '77479',
                'addressCountry'  => 'US',
            ],
            'openingHoursSpecification' => [[
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'opens'     => '09:00',
                'closes'    => '17:00',
            ]],
            'sameAs' => [
                'https://www.facebook.com/people/Novara-Health-Care-Brain-Treatment-Center/61570570193895/',
                'https://www.instagram.com/novarahealthcare/',
                'https://www.youtube.com/channel/UCRsvjw4q4qIRSTEjH_bNqHg',
            ],
            'department' => [[
                '@type' => 'MedicalClinic',
                'name'  => 'Novara Healthcare — Washington DC Metro',
                'telephone' => $site['phone_raw'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress'   => '2401 Brandermill Suite 330',
                    'addressLocality' => 'Gambrills',
                    'addressRegion'   => 'MD',
                    'postalCode'      => '21054',
                    'addressCountry'  => 'US',
                ],
            ]],
        ],
        [
            '@type' => 'WebSite',
            '@id'   => $site['url'] . '#website',
            'url'   => $site['url'],
            'name'  => $site['name'],
            'publisher' => ['@id' => $site['url'] . '#clinic'],
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(fn($f) => [
                '@type' => 'Question',
                'name'  => $f[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]],
            ], $faqs),
        ],
    ],
];
?>
<!DOCTYPE html>
<html lang="en-US" class="scroll-smooth scroll-pt-28">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($site['title']) ?></title>
    <meta name="description" content="<?= e($site['desc']) ?>">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="<?= e($site['url']) ?>">
    <meta name="theme-color" content="#061a35">

    <!-- Open Graph / Twitter -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= e($site['name']) ?>">
    <meta property="og:title" content="<?= e($site['title']) ?>">
    <meta property="og:description" content="<?= e($site['desc']) ?>">
    <meta property="og:url" content="<?= e($site['url']) ?>">
    <meta property="og:image" content="https://novarahc.com/wp-content/uploads/2026/06/TMS-and-MeRt-by-apollo-1536x961.jpg">
    <meta property="og:locale" content="en_US">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($site['title']) ?>">
    <meta name="twitter:description" content="<?= e($site['desc']) ?>">
    <meta name="twitter:image" content="https://novarahc.com/wp-content/uploads/2026/06/TMS-and-MeRt-by-apollo-1536x961.jpg">

    <link rel="icon" href="<?= e($site['favicon']) ?>" sizes="192x192">
    <link rel="apple-touch-icon" href="https://novarahc.com/wp-content/uploads/2026/03/cropped-favicon1-180x180.png">
    <link rel="preload" as="image" href="https://novarahc.com/wp-content/uploads/2026/06/TMS-and-MeRt-by-apollo-1536x961.jpg" imagesrcset="https://novarahc.com/wp-content/uploads/2026/06/TMS-and-MeRt-by-apollo-768x480.jpg 768w, https://novarahc.com/wp-content/uploads/2026/06/TMS-and-MeRt-by-apollo-1024x640.jpg 1024w, https://novarahc.com/wp-content/uploads/2026/06/TMS-and-MeRt-by-apollo-1536x961.jpg 1536w" imagesizes="100vw">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 50:'#eef5fd', 100:'#d6e6f8', 200:'#aecdf1', 400:'#4b8fd9', 500:'#1f6fc4', 600:'#165aa8', 700:'#0f4c9a', 800:'#0c3a75', 900:'#0a2b55', 950:'#061a35' },
                        teal:  { 50:'#ecfbf8', 100:'#cff5ee', 200:'#a2eadd', 300:'#6cd9c8', 400:'#3ec4b2', 500:'#22a998', 600:'#17887c', 700:'#156d65' },
                        sand:  { 50:'#faf8f4', 100:'#f3efe7' },
                    },
                    fontFamily: {
                        display: ['Fraunces', 'Georgia', 'serif'],
                        sans: ['Manrope', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        soft: '0 20px 60px -20px rgba(15, 76, 154, 0.25)',
                    },
                    keyframes: {
                        float: { '0%,100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-10px)' } },
                        pulseRing: { '0%': { transform: 'scale(.9)', opacity: '.6' }, '100%': { transform: 'scale(1.6)', opacity: '0' } },
                    },
                    animation: {
                        float: 'float 6s ease-in-out infinite',
                        ring: 'pulseRing 3.5s cubic-bezier(.2,.6,.3,1) infinite',
                    },
                },
            },
        };
    </script>
    <style>
        .text-balance { text-wrap: balance; }
        details > summary::-webkit-details-marker { display: none; }
        details[open] .faq-icon { transform: rotate(45deg); }
        /* Navbar: glass over hero, solid white once scrolled */
        .nav-shell { background: rgba(255,255,255,.08); box-shadow: inset 0 0 0 1px rgba(255,255,255,.18); -webkit-backdrop-filter: blur(14px); backdrop-filter: blur(14px); transition: background-color .35s ease, box-shadow .35s ease; }
        .nav-logo { filter: brightness(0) invert(1); transition: filter .35s ease; }
        .nav-link { color: #fff; transition: background-color .2s ease, color .35s ease; }
        .nav-link:hover { background: rgba(255,255,255,.14); }
        .nav-cta { background: #fff; color: #061a35; transition: background-color .35s ease, color .35s ease; }
        .nav-cta-dot { background: #0f4c9a; color: #fff; }
        .nav-cta:hover { background: #cff5ee; }
        #site-header.is-solid .nav-shell { background: rgba(255,255,255,.9); box-shadow: 0 12px 40px -14px rgba(10,43,85,.28), inset 0 0 0 1px rgba(15,76,154,.08); }
        #site-header.is-solid .nav-logo { filter: none; }
        #site-header.is-solid .nav-link { color: #0a2b55; }
        #site-header.is-solid .nav-link:hover { background: #eef5fd; }
        #site-header.is-solid .nav-cta { background: #0f4c9a; color: #fff; }
        #site-header.is-solid .nav-cta-dot { background: rgba(255,255,255,.18); }
        #site-header.is-solid .nav-cta:hover { background: #0c3a75; }
        .hero-in { opacity: 0; animation: heroIn 1s cubic-bezier(.2,.7,.2,1) forwards; }
        @keyframes heroIn { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: none; } }
        /* Reviews slider: first card aligns with the content column, track bleeds to the viewport edge */
        .rv-pad { padding-inline: 1rem; scroll-padding-inline: 1rem; }
        @media (min-width: 640px) { .rv-pad { padding-inline: max(1.5rem, calc((100vw - 80rem) / 2 + 1.5rem)); scroll-padding-inline: max(1.5rem, calc((100vw - 80rem) / 2 + 1.5rem)); } }
        .eeg-path { stroke-dasharray: 2600; stroke-dashoffset: 2600; animation: eegDraw 7s ease-in-out infinite; }
        @keyframes eegDraw { 0% { stroke-dashoffset: 2600; } 55% { stroke-dashoffset: 0; } 100% { stroke-dashoffset: -2600; } }
        .reveal { opacity: 0; transform: translateY(24px); transition: opacity .8s ease, transform .8s ease; }
        .reveal.is-visible { opacity: 1; transform: none; }
        @media (prefers-reduced-motion: reduce) {
            .reveal { opacity: 1; transform: none; transition: none; }
            .hero-in { opacity: 1; animation: none; }
            .eeg-path { animation: none; stroke-dashoffset: 0; }
        }
    </style>

    <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body class="bg-sand-50 font-sans text-slate-700 antialiased selection:bg-teal-200 selection:text-brand-900">

<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-lg focus:bg-white focus:px-4 focus:py-2 focus:text-brand-800 focus:shadow">Skip to content</a>

<!-- ===================== Header ===================== -->
<?php $chev = '<svg class="h-3.5 w-3.5 opacity-70 transition group-hover:rotate-180 group-focus-within:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>'; ?>
<header id="site-header" class="fixed inset-x-0 top-0 z-50 px-3 pt-3 sm:px-5 sm:pt-4">
    <nav class="nav-shell mx-auto flex max-w-[88rem] items-center justify-between gap-3 rounded-full py-2 pl-5 pr-2 sm:pl-6" aria-label="Main navigation">
        <a href="<?= e($site['url']) ?>" class="flex shrink-0 items-center" aria-label="Novara Healthcare home">
            <img src="<?= e($site['logo']) ?>" alt="Novara Healthcare logo" width="300" height="233" class="nav-logo h-11 w-auto sm:h-12">
        </a>

        <ul class="hidden items-center text-[14px] font-semibold xl:flex">
            <?php foreach ($nav as $n => [$label, $href, $items]): $alignRight = $n >= count($nav) - 2; ?>
            <li class="group relative">
                <?php if ($href): ?>
                <a href="<?= e($href) ?>" class="nav-link flex items-center gap-1 whitespace-nowrap rounded-full px-2.5 py-2.5 2xl:px-3.5"><?= e($label) ?><?= $chev ?></a>
                <?php else: ?>
                <button type="button" class="nav-link flex items-center gap-1 whitespace-nowrap rounded-full px-2.5 py-2.5 2xl:px-3.5" aria-haspopup="true"><?= e($label) ?><?= $chev ?></button>
                <?php endif; ?>
                <div class="invisible absolute top-full w-72 translate-y-2 pt-4 opacity-0 transition duration-200 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 <?= $alignRight ? 'right-0' : 'left-1/2 -translate-x-1/2' ?>">
                    <ul class="rounded-3xl bg-white p-2 text-[15px] text-brand-950 shadow-soft ring-1 ring-brand-900/5">
                        <?php foreach ($items as [$t, $h]): ?>
                        <li><a class="flex items-center justify-between gap-3 rounded-2xl px-4 py-3 font-semibold transition hover:bg-brand-50 hover:text-brand-700" <?= link_attrs($h) ?>><?= e($t) ?><?php if (str_contains(link_attrs($h), '_blank')): ?><span class="text-xs text-slate-400" aria-hidden="true">↗</span><?php endif; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>

        <div class="flex items-center gap-1.5">
            <a href="tel:<?= e($site['phone_raw']) ?>" class="nav-link hidden h-11 w-11 items-center justify-center rounded-full sm:flex xl:hidden 2xl:flex" aria-label="Call <?= e($site['phone']) ?>" title="<?= e($site['phone']) ?>">
                <svg class="h-[18px] w-[18px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 00-1.173.417l-.97 1.293a1.125 1.125 0 01-1.21.38 12.035 12.035 0 01-7.143-7.143 1.125 1.125 0 01.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
            </a>
            <a href="#contact" class="nav-cta group hidden items-center gap-2 whitespace-nowrap rounded-full py-1.5 pl-5 pr-1.5 text-sm font-bold sm:inline-flex">
                <span class="xl:hidden 2xl:inline">Book a consultation</span><span class="hidden xl:inline 2xl:hidden">Book now</span>
                <span class="nav-cta-dot flex h-8 w-8 items-center justify-center rounded-full transition group-hover:translate-x-0.5">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5M21 12H3"/></svg>
                </span>
            </a>
            <button id="menu-btn" type="button" class="nav-link inline-flex h-11 w-11 items-center justify-center rounded-full xl:hidden" aria-controls="mobile-menu" aria-expanded="false" aria-label="Open menu">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" d="M4 8h16M4 16h16"/></svg>
            </button>
        </div>
    </nav>

    <!-- Mobile / tablet menu -->
    <div id="mobile-menu" class="mx-auto mt-2 hidden max-h-[calc(100svh-6rem)] max-w-[88rem] overflow-y-auto rounded-3xl bg-white p-2 shadow-soft ring-1 ring-brand-900/5 xl:hidden">
        <ul class="grid gap-0.5 text-base font-semibold text-brand-950">
            <?php foreach ($nav as [$label, $href, $items]): ?>
            <li>
                <details class="group">
                    <summary class="flex cursor-pointer list-none items-center justify-between rounded-2xl px-4 py-3 hover:bg-brand-50">
                        <?= e($label) ?>
                        <svg class="h-4 w-4 text-slate-400 transition group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                    </summary>
                    <ul class="mb-2 ml-4 border-l border-brand-100 pl-2 text-[15px] font-medium text-slate-600">
                        <?php foreach ($items as [$t, $h]): ?>
                        <li><a class="block rounded-xl px-4 py-2.5 hover:bg-brand-50 hover:text-brand-800" <?= link_attrs($h) ?>><?= e($t) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </details>
            </li>
            <?php endforeach; ?>
        </ul>
        <div class="mt-2 grid grid-cols-2 gap-2 border-t border-brand-100 p-2 pt-4">
            <a href="tel:<?= e($site['phone_raw']) ?>" class="rounded-full border border-brand-200 py-3 text-center text-sm font-bold text-brand-800">Call <?= e($site['phone']) ?></a>
            <a href="#contact" class="rounded-full bg-brand-700 py-3 text-center text-sm font-bold text-white">Book a consultation</a>
        </div>
    </div>
</header>

<main id="main">

<!-- ===================== Hero ===================== -->
<section class="relative isolate overflow-hidden bg-brand-950 pt-24 sm:pt-28" aria-labelledby="hero-title">
    <!-- Background photo -->
    <img
        src="https://novarahc.com/wp-content/uploads/2026/06/TMS-and-MeRt-by-apollo-1536x961.jpg"
        srcset="https://novarahc.com/wp-content/uploads/2026/06/TMS-and-MeRt-by-apollo-768x480.jpg 768w, https://novarahc.com/wp-content/uploads/2026/06/TMS-and-MeRt-by-apollo-1024x640.jpg 1024w, https://novarahc.com/wp-content/uploads/2026/06/TMS-and-MeRt-by-apollo-1536x961.jpg 1536w"
        sizes="100vw"
        alt="Patient receiving personalized MeRT / TMS brain stimulation with a Novara Healthcare clinician"
        width="1536" height="961"
        fetchpriority="high" decoding="async"
        class="absolute inset-0 -z-20 h-full w-full object-cover object-[62%_center]">
    <!-- Text overlay -->
    <div class="absolute inset-0 -z-10 bg-brand-950/[.72]" aria-hidden="true"></div>

    <div class="mx-auto flex min-h-[calc(100svh-6rem)] max-w-7xl flex-col px-4 sm:min-h-[calc(100svh-7rem)] sm:px-6 lg:min-h-[740px]">
        <div class="flex flex-1 items-center py-12 lg:py-16">
            <div class="max-w-2xl">
                <h1 id="hero-title">
                    <span class="hero-in flex items-center gap-4 text-xs font-bold uppercase tracking-[0.28em] text-teal-300 sm:text-sm">
                        <span class="h-px w-10 bg-teal-300" aria-hidden="true"></span>
                        MeRT &amp; TMS Therapy · Sugar Land &amp; Houston, TX
                    </span>
                    <span class="hero-in mt-7 block font-display text-[2.75rem] font-normal leading-[1.02] tracking-[-0.02em] text-white [animation-delay:.1s] sm:text-6xl lg:text-[5.25rem]">
                        Every brain has<br class="hidden sm:block"> its own rhythm.<br>
                        <em class="font-normal text-teal-200">We treat yours.</em>
                    </span>
                </h1>

                <p class="hero-in mt-8 max-w-lg text-lg leading-relaxed text-white/85 [animation-delay:.2s]">
                    Using a qEEG brain map, we find the exact areas that aren’t connecting as they should — then gently stimulate them with precisely targeted magnetic waves. Care for autism, depression, PTSD and more, built around one person: you.
                </p>

                <div class="hero-in mt-10 flex flex-col gap-4 sm:flex-row sm:items-center [animation-delay:.3s]">
                    <a href="#contact" class="group inline-flex items-center justify-center gap-3 rounded-full bg-white py-2 pl-7 pr-2 text-base font-bold text-brand-950 transition hover:bg-teal-100">
                        Book a free consultation
                        <span class="flex h-11 w-11 items-center justify-center rounded-full bg-brand-700 text-white transition group-hover:translate-x-0.5 group-hover:bg-teal-500">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5M21 12H3"/></svg>
                        </span>
                    </a>
                    <a href="tel:<?= e($site['phone_raw']) ?>" class="inline-flex items-center justify-center gap-2 px-2 py-3 text-base font-semibold text-white underline decoration-white/30 underline-offset-[6px] transition hover:decoration-teal-300">
                        or call <?= e($site['phone']) ?>
                    </a>
                </div>

                <p class="hero-in mt-12 flex items-center gap-3 text-sm text-white/75 [animation-delay:.4s]">
                    <svg class="h-5 w-5 shrink-0 text-teal-300" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><rect x="2.5" y="5" width="19" height="12" rx="2"/><path stroke-linecap="round" d="M8 21h8M12 17v4"/></svg>
                    <span>MeRT for autism featured on <a href="https://novarahc.com/video-resources/" class="font-semibold text-white underline decoration-white/30 underline-offset-4 hover:decoration-teal-300">“The Doctors”</a></span>
                </p>
            </div>
        </div>

        <!-- Docked info panel -->
        <div class="hero-in relative mb-8 grid rounded-3xl bg-white/10 px-6 text-white ring-1 ring-white/15 backdrop-blur-md [animation-delay:.5s] md:grid-cols-12 md:px-8">
            <nav class="py-6 md:col-span-7 md:pr-8" aria-label="Conditions we help with">
                <p class="text-[11px] font-bold uppercase tracking-[0.24em] text-white/60">Conditions we help with</p>
                <ul class="mt-3 flex flex-wrap gap-x-1 gap-y-1 font-display text-lg sm:text-xl">
                    <?php foreach ($conditions as $i => [$name, $href]): ?>
                    <li class="flex items-center">
                        <a href="<?= e($href) ?>" class="text-white transition hover:text-teal-200"><?= e($name) ?></a>
                        <?php if ($i < count($conditions) - 1): ?><span class="ml-1 text-teal-300/60" aria-hidden="true">/</span><?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <div class="grid grid-cols-2 border-t border-white/15 md:col-span-5 md:border-l md:border-t-0">
                <div class="py-6 md:pl-8">
                    <p class="text-[11px] font-bold uppercase tracking-[0.24em] text-white/60">Sessions</p>
                    <p class="mt-3 font-display text-lg sm:text-xl">30–45 min,<br>no downtime</p>
                </div>
                <div class="border-l border-white/15 py-6 pl-6 md:pl-8">
                    <p class="text-[11px] font-bold uppercase tracking-[0.24em] text-white/60">Clinics</p>
                    <p class="mt-3 font-display text-lg sm:text-xl">Sugar Land, TX<br><span class="text-white/65">&amp; DC Metro</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== About ===================== -->
<section id="about" class="relative overflow-hidden bg-sand-50 py-16 lg:py-24" aria-labelledby="about-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">

        <!-- Intro statement -->
        <div class="reveal flex flex-wrap items-center justify-between gap-4 border-b border-brand-900/10 pb-6 text-[11px] font-bold uppercase tracking-[0.24em] text-slate-500">
            <p class="flex items-center gap-3"><span class="h-2 w-2 rounded-full bg-teal-500" aria-hidden="true"></span>About Novara Healthcare</p>
            <p>Sugar Land, Texas &nbsp;·&nbsp; Opened May 2025</p>
        </div>

        <h2 id="about-title" class="reveal mt-12 max-w-5xl text-balance font-display text-[2.6rem] font-normal leading-[1.04] tracking-[-0.02em] text-brand-950 sm:text-6xl lg:text-[4.6rem]">
            Novara began with one family, and a son we wanted to see <em class="text-teal-600">thrive.</em>
        </h2>

        <div class="mt-12 grid gap-12 lg:mt-14 lg:grid-cols-12 lg:gap-16">

            <!-- Photo -->
            <figure class="reveal relative lg:col-span-5">
                <div class="relative overflow-hidden rounded-[2rem]">
                    <img
                        src="https://novarahc.com/wp-content/uploads/2026/04/Autism-Asn-1024x707.jpg"
                        srcset="https://novarahc.com/wp-content/uploads/2026/04/Autism-Asn-768x530.jpg 768w, https://novarahc.com/wp-content/uploads/2026/04/Autism-Asn-1024x707.jpg 1024w, https://novarahc.com/wp-content/uploads/2026/04/Autism-Asn-1536x1061.jpg 1536w"
                        sizes="(min-width: 1024px) 40vw, 100vw"
                        alt="Young boy on the autism spectrum sitting quietly at a playground"
                        width="1024" height="707" loading="lazy" decoding="async"
                        class="aspect-[4/5] w-full object-cover object-[70%_center]">
                    <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-brand-950/70 to-transparent" aria-hidden="true"></div>
                    <figcaption class="absolute inset-x-6 bottom-6 font-display text-xl italic leading-snug text-white sm:text-2xl">
                        Care designed around how each child experiences the world.
                    </figcaption>
                </div>
                <!-- Sticker -->
                <div class="absolute -right-3 -top-5 flex h-28 w-28 rotate-6 flex-col items-center justify-center rounded-full bg-teal-400 text-center text-brand-950 shadow-soft sm:-right-6 sm:h-32 sm:w-32">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                    <span class="mt-1 text-[11px] font-extrabold uppercase leading-tight tracking-wider">Sensory-<br>friendly<br>clinic</span>
                </div>
            </figure>

            <!-- Story + mission -->
            <div class="lg:col-span-7 lg:pt-4">
                <div class="reveal max-w-2xl space-y-5 text-lg leading-relaxed text-slate-600">
                    <p class="first-letter:float-left first-letter:mr-3 first-letter:mt-1 first-letter:font-display first-letter:text-[4.5rem] first-letter:leading-[.8] first-letter:text-brand-700">
                        Inspired by our own family’s journey, we founded Novara Healthcare to bring groundbreaking, EEG-guided <strong class="font-semibold text-brand-950">MeRT and TMS therapy</strong> to families in Houston, Sugar Land and beyond, in partnership with the Brain Treatment Center.
                    </p>
                    <p>
                        Today we care for children and adults with autism, depression, PTSD and other neurological conditions, in a family-oriented clinic with caring staff and engaging spaces like sensory playrooms.
                    </p>
                </div>

                <ol class="mt-12 border-b border-brand-900/10">
                    <?php foreach ([
                        ['i', 'Renewing minds', 'Precise protocols built from your brain’s own EEG, never one-size-fits-all.'],
                        ['ii', 'Reshaping lives', 'Support for the whole person and family, at every step of treatment.'],
                        ['iii', 'Restoring hope', 'For patients who haven’t found relief through traditional treatments.'],
                    ] as [$n, $t, $d]): ?>
                    <li class="reveal group grid grid-cols-[2.5rem_1fr] items-baseline gap-x-4 border-t border-brand-900/10 py-6 sm:grid-cols-[3rem_auto_1fr] sm:gap-x-8">
                        <span class="font-display text-sm italic text-teal-600"><?= $n ?>.</span>
                        <h3 class="font-display text-3xl font-normal tracking-[-0.01em] text-brand-950 transition-colors duration-300 group-hover:text-brand-600 sm:text-4xl"><?= e($t) ?></h3>
                        <p class="col-start-2 mt-2 max-w-sm text-[15px] leading-relaxed text-slate-500 sm:col-start-3 sm:mt-0 sm:justify-self-end sm:text-right"><?= e($d) ?></p>
                    </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>

        <!-- People + partners -->
        <div class="reveal mt-14 grid overflow-hidden rounded-[2rem] bg-white ring-1 ring-brand-900/5 lg:grid-cols-12">
            <div class="p-8 sm:p-10 lg:col-span-5">
                <p class="text-[11px] font-bold uppercase tracking-[0.24em] text-slate-500">The people you’ll meet</p>
                <ul class="mt-6 space-y-5">
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
            </div>
            <div class="border-t border-brand-900/5 bg-brand-50/50 p-8 sm:p-10 lg:col-span-7 lg:border-l lg:border-t-0">
                <p class="text-[11px] font-bold uppercase tracking-[0.24em] text-slate-500">Working alongside</p>
                <ul class="mt-6 grid gap-6 sm:grid-cols-3">
                    <?php foreach ([
                        ['Brain Treatment Center', 'MeRT clinical partner'],
                        ['Pathways to Progress', 'ABA therapy partner'],
                        ['We Rock The Spectrum', 'Kid’s Gym, Sugar Land'],
                    ] as [$p, $d]): ?>
                    <li class="border-l-2 border-teal-400 pl-4">
                        <p class="font-display text-lg leading-snug text-brand-950"><?= e($p) ?></p>
                        <p class="mt-1 text-sm text-slate-500"><?= e($d) ?></p>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <a href="https://novarahc.com/about/" class="group mt-8 inline-flex items-center gap-2 font-bold text-brand-700 hover:text-brand-900">
                    Read our full story
                    <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===================== Services ===================== -->
<section id="services" class="bg-white py-16 lg:py-24" aria-labelledby="services-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <?php section_label('Healthcare Services', 'MeRT · TMS · Autism Clinic'); ?>

        <div class="mt-12 flex flex-col justify-between gap-8 lg:flex-row lg:items-end">
            <h2 id="services-title" class="reveal max-w-3xl text-balance font-display text-[2.6rem] font-normal leading-[1.04] tracking-[-0.02em] text-brand-950 sm:text-6xl">
                Compassion, combined with <em class="text-brand-600">cutting-edge</em> brain technology.
            </h2>
            <a href="https://novarahc.com/healthcare-services/" class="reveal group inline-flex shrink-0 items-center gap-3 font-bold text-brand-800">
                All treatments
                <span class="flex h-11 w-11 items-center justify-center rounded-full ring-1 ring-brand-900/15 transition group-hover:bg-brand-700 group-hover:text-white group-hover:ring-brand-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                </span>
            </a>
        </div>

        <div class="mt-14 grid gap-4 sm:gap-5 lg:grid-cols-12 lg:grid-rows-2">
            <?php foreach ($services as $i => $s): $big = $i === 0; ?>
            <a href="<?= e($s['href']) ?>" class="reveal group relative isolate flex overflow-hidden rounded-[2rem] <?= $big ? 'min-h-[460px] lg:col-span-7 lg:row-span-2 lg:min-h-[640px]' : 'min-h-[340px] lg:col-span-5' ?>" style="transition-delay: <?= $i * 80 ?>ms">
                <img src="<?= e($s['img']) ?>" srcset="<?= e($s['srcset']) ?>" sizes="(min-width: 1024px) <?= $big ? '55vw' : '40vw' ?>, 100vw" alt="<?= e($s['alt']) ?>" width="1024" height="683" loading="lazy" decoding="async" class="absolute inset-0 -z-20 h-full w-full object-cover transition duration-[1.2s] ease-out group-hover:scale-105" style="object-position: <?= e($s['pos']) ?>">
                <div class="absolute inset-0 -z-10 bg-gradient-to-t from-brand-950/90 via-brand-950/35 to-brand-950/0 transition duration-500 group-hover:from-brand-950/95 group-hover:via-brand-950/50" aria-hidden="true"></div>

                <div class="flex w-full flex-col justify-between p-6 sm:p-8">
                    <div class="flex items-start justify-between gap-4">
                        <span class="rounded-full bg-white/15 px-3 py-1 font-display text-sm italic text-white ring-1 ring-white/25 backdrop-blur">0<?= $i + 1 ?></span>
                        <span class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-brand-950 transition duration-300 group-hover:rotate-45 group-hover:bg-teal-300" aria-hidden="true">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.25" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                        </span>
                    </div>
                    <div>
                        <ul class="mb-4 flex flex-wrap gap-1.5">
                            <?php foreach ($s['tags'] as $t): ?>
                            <li class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-white/90 ring-1 ring-white/20 backdrop-blur"><?= e($t) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <h3 class="font-display font-normal leading-tight text-white <?= $big ? 'text-3xl sm:text-[2.6rem]' : 'text-2xl sm:text-3xl' ?>"><?= e($s['title']) ?></h3>
                        <p class="mt-3 max-w-md text-[15px] leading-relaxed text-white/75 <?= $big ? '' : 'lg:line-clamp-2' ?>"><?= e($s['text']) ?></p>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===================== What is MeRT ===================== -->
<section id="mert" class="relative overflow-hidden bg-brand-950 py-16 text-white lg:py-24" aria-labelledby="mert-title">
    <div class="pointer-events-none absolute -right-40 -top-40 h-[520px] w-[520px] rounded-full bg-teal-500/10 blur-3xl" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6">
        <?php section_label('What is MeRT?', 'An evolution of rTMS', true); ?>

        <div class="mt-12 grid gap-14 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-6">
                <h2 id="mert-title" class="reveal text-balance font-display text-[2.6rem] font-normal leading-[1.04] tracking-[-0.02em] sm:text-6xl">
                    Magnetic therapy, tuned to <em class="text-teal-300">your</em> brainwaves.
                </h2>
                <div class="reveal mt-8 max-w-xl space-y-5 text-lg leading-relaxed text-brand-100/80">
                    <p>Magnetic eResonance Therapy (MeRT) is an advanced, non-invasive brain stimulation technique that uses highly individualized protocols to optimize brain function.</p>
                    <p>By analyzing your unique brainwave patterns through an EEG, MeRT targets areas of dysregulation with precisely tuned magnetic pulses to encourage neural connectivity and balance — building on decades of research into brainwave modulation.</p>
                </div>
                <a href="https://novarahc.com/healthcare-services/magnetic-eresonance-therapy/" class="reveal group mt-10 inline-flex items-center gap-3 rounded-full bg-teal-300 py-2 pl-7 pr-2 font-bold text-brand-950 transition hover:bg-teal-200">
                    How MeRT works
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-950 text-white transition group-hover:translate-x-0.5"><svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5M21 12H3"/></svg></span>
                </a>
            </div>

            <div class="reveal lg:col-span-6">
                <div class="rounded-[2rem] bg-white/[.04] p-6 ring-1 ring-white/10 sm:p-10">
                    <div class="flex items-center justify-between">
                        <p class="text-[11px] font-bold uppercase tracking-[0.24em] text-teal-300">Treatment at a glance</p>
                        <span class="flex items-center gap-2 text-xs text-white/50"><span class="h-1.5 w-1.5 animate-pulse rounded-full bg-teal-300"></span>Non-invasive</span>
                    </div>
                    <dl class="mt-6">
                        <?php foreach ([
                            ['Personalized by', 'qEEG brain map + EKG'],
                            ['Session length', '30–45 minutes'],
                            ['Schedule', '5 days a week, over several weeks'],
                            ['How it feels', 'A gentle tapping near the scalp'],
                            ['Downtime', 'None — no anesthesia or recovery'],
                            ['Progress check', 'Mid-treatment qEEG'],
                        ] as [$k, $v]): ?>
                        <div class="grid grid-cols-[minmax(0,9rem)_1fr] gap-4 border-t border-white/10 py-4 sm:grid-cols-[11rem_1fr]">
                            <dt class="text-sm text-white/50"><?= e($k) ?></dt>
                            <dd class="font-display text-lg leading-snug text-white sm:text-xl"><?= e($v) ?></dd>
                        </div>
                        <?php endforeach; ?>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- EEG waveform -->
    <svg class="mt-12 h-20 w-full sm:h-28" viewBox="0 0 1440 120" preserveAspectRatio="none" fill="none" aria-hidden="true">
        <path d="M0 60 H180 L200 40 L215 82 L232 22 L250 98 L268 50 L284 66 L300 60 H520 L536 52 L548 70 L560 60 H700 L716 30 L730 96 L746 12 L764 108 L780 44 L796 72 L812 60 H1040 L1056 48 L1068 74 L1082 60 H1220 L1238 38 L1252 86 L1268 28 L1284 92 L1300 60 H1440" stroke="#3ec4b2" stroke-opacity=".18" stroke-width="1.5"/>
        <path class="eeg-path" d="M0 60 H180 L200 40 L215 82 L232 22 L250 98 L268 50 L284 66 L300 60 H520 L536 52 L548 70 L560 60 H700 L716 30 L730 96 L746 12 L764 108 L780 44 L796 72 L812 60 H1040 L1056 48 L1068 74 L1082 60 H1220 L1238 38 L1252 86 L1268 28 L1284 92 L1300 60 H1440" stroke="#6cd9c8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</section>

<!-- ===================== Featured on TV ===================== -->
<section class="bg-sand-50 py-16 lg:py-24" aria-labelledby="tv-title">
    <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 sm:px-6 lg:grid-cols-12 lg:gap-16">
        <div class="reveal lg:col-span-5">
            <p class="text-[11px] font-bold uppercase tracking-[0.24em] text-teal-600">As seen on TV</p>
            <h2 id="tv-title" class="mt-5 text-balance font-display text-4xl font-normal leading-[1.08] tracking-[-0.01em] text-brand-950 sm:text-5xl">
                <em class="text-brand-600">“The Doctors”</em> on MeRT as a brain treatment for autism
            </h2>
            <p class="mt-6 text-lg leading-relaxed text-slate-600">Neurologist Dr. Spencer O. Miller, who has worked with MeRT for autism for several years, was interviewed alongside a mother who shares her child’s experience with MeRT treatment.</p>
            <a href="https://novarahc.com/video-resources/" class="mt-8 inline-flex items-center gap-2 font-bold text-brand-700 underline decoration-teal-300 decoration-2 underline-offset-8 hover:text-brand-900">More video resources</a>
        </div>
        <div class="reveal lg:col-span-7">
            <div class="relative aspect-video overflow-hidden rounded-[2rem] bg-brand-950 shadow-soft">
                <button type="button" data-yt="rj8oVwvnZ6E" data-title="The Doctors: MeRT as a brain treatment for autism" class="group absolute inset-0 h-full w-full" aria-label="Play video: The Doctors feature on MeRT for autism">
                    <img src="https://novarahc.com/wp-content/uploads/2026/03/video_00.png" alt="" width="1162" height="576" loading="lazy" decoding="async" class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.03]">
                    <span class="absolute inset-0 bg-brand-950/25 transition group-hover:bg-brand-950/10" aria-hidden="true"></span>
                    <span class="absolute left-1/2 top-1/2 flex h-20 w-20 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-brand-800 shadow-xl backdrop-blur transition duration-300 group-hover:scale-110 group-hover:bg-teal-300 sm:h-24 sm:w-24" aria-hidden="true">
                        <span class="absolute inset-0 animate-ping rounded-full bg-white/40 [animation-duration:2.4s]"></span>
                        <svg class="relative ml-1 h-8 w-8" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.14v13.72a1 1 0 001.5.86l11-6.86a1 1 0 000-1.72l-11-6.86A1 1 0 008 5.14z"/></svg>
                    </span>
                    <span class="absolute bottom-5 left-5 rounded-full bg-brand-950/70 px-4 py-2 text-sm font-semibold text-white backdrop-blur" aria-hidden="true">Watch the episode</span>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- ===================== Process ===================== -->
<section id="process" class="bg-white py-16 lg:py-24" aria-labelledby="process-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <?php section_label('New Patient Process', 'Four steps'); ?>

        <div class="mt-12 grid gap-14 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-5">
                <div class="lg:sticky lg:top-32">
                    <h2 id="process-title" class="reveal text-balance font-display text-[2.6rem] font-normal leading-[1.04] tracking-[-0.02em] text-brand-950 sm:text-6xl">
                        Your journey, guided <em class="text-brand-600">every step</em> of the way.
                    </h2>
                    <p class="reveal mt-6 max-w-md text-lg leading-relaxed text-slate-600">From the first call to long-term support, our team stays beside you, with zero pressure and no commitment to start.</p>
                    <a href="#contact" class="reveal mt-8 inline-flex rounded-full bg-brand-700 px-7 py-4 font-bold text-white shadow-lg shadow-brand-700/25 transition hover:-translate-y-0.5 hover:bg-brand-800">Start with step one</a>
                </div>
            </div>

            <ol class="relative lg:col-span-7">
                <span class="absolute bottom-10 left-[1.65rem] top-10 w-px bg-gradient-to-b from-teal-400 via-brand-200 to-transparent sm:left-[2.15rem]" aria-hidden="true"></span>
                <?php $meta = ['No obligation', 'Painless & non-invasive', 'Typically 5 days a week', 'Ongoing partnership']; ?>
                <?php foreach ($steps as $i => [$t, $d]): ?>
                <li class="reveal relative grid grid-cols-[3.5rem_1fr] gap-5 pb-12 last:pb-0 sm:grid-cols-[4.5rem_1fr] sm:gap-8">
                    <span class="relative z-10 flex h-14 w-14 items-center justify-center rounded-full bg-white font-display text-xl text-brand-800 ring-1 ring-brand-900/10 sm:h-[4.3rem] sm:w-[4.3rem] sm:text-2xl"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
                    <div class="rounded-[1.75rem] bg-sand-50 p-6 ring-1 ring-brand-900/5 transition duration-300 hover:bg-white hover:shadow-soft sm:p-8">
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-teal-600"><?= e($meta[$i]) ?></p>
                        <h3 class="mt-2 font-display text-2xl font-normal text-brand-950 sm:text-[1.75rem]"><?= e($t) ?></h3>
                        <p class="mt-3 leading-relaxed text-slate-600"><?= e($d) ?></p>
                    </div>
                </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
</section>

<!-- ===================== Testimonials ===================== -->
<section id="reviews" class="overflow-hidden bg-sand-50 py-16 lg:py-24" aria-labelledby="reviews-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <?php section_label('Reviews', 'From families & providers'); ?>

        <div class="mt-12 flex flex-col justify-between gap-8 sm:flex-row sm:items-end">
            <h2 id="reviews-title" class="reveal max-w-2xl text-balance font-display text-[2.6rem] font-normal leading-[1.04] tracking-[-0.02em] text-brand-950 sm:text-6xl">
                Kind words from our <em class="text-brand-600">community.</em>
            </h2>
            <div class="reveal flex items-center gap-5">
                <p class="font-display text-lg text-brand-950" aria-hidden="true"><span id="rv-count">01</span> <span class="text-slate-400">/ <?= str_pad(count($reviews), 2, '0', STR_PAD_LEFT) ?></span></p>
                <div class="flex gap-2">
                    <button id="rv-prev" type="button" class="flex h-14 w-14 items-center justify-center rounded-full text-brand-900 ring-1 ring-brand-900/15 transition hover:bg-brand-700 hover:text-white hover:ring-brand-700 disabled:pointer-events-none disabled:opacity-30" aria-label="Previous review" aria-controls="rv-track">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                    </button>
                    <button id="rv-next" type="button" class="flex h-14 w-14 items-center justify-center rounded-full bg-brand-700 text-white transition hover:bg-brand-800 disabled:pointer-events-none disabled:opacity-30" aria-label="Next review" aria-controls="rv-track">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <div id="rv-track" class="rv-pad reveal mt-12 flex snap-x snap-mandatory gap-5 overflow-x-auto scroll-smooth pb-2 outline-none [scrollbar-width:none] focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-teal-400 [&::-webkit-scrollbar]:hidden" tabindex="0" role="region" aria-roledescription="carousel" aria-label="Patient and provider reviews">
            <?php foreach ($reviews as $i => [$q, $who, $role]): $dark = $i % 2 === 0; ?>
            <figure class="relative flex min-h-[380px] shrink-0 basis-[86%] snap-start flex-col justify-between overflow-hidden rounded-[2rem] p-8 sm:basis-[62%] sm:p-10 lg:basis-[560px] <?= $dark ? 'bg-brand-900 text-white' : 'bg-white text-brand-950 ring-1 ring-inset ring-brand-900/5' ?>" aria-roledescription="slide" aria-label="Review <?= $i + 1 ?> of <?= count($reviews) ?>">
                <svg class="pointer-events-none absolute -right-3 -top-4 h-40 w-40 <?= $dark ? 'text-white/[.05]' : 'text-brand-900/[.04]' ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9.6 6C6.5 7.3 4.5 10 4.5 13.4c0 2.6 1.6 4.6 3.9 4.6 2 0 3.5-1.5 3.5-3.4 0-1.9-1.3-3.3-3.1-3.3-.3 0-.7 0-.9.1.5-1.7 2-3.3 3.8-4.2L9.6 6zm9 0c-3.1 1.3-5.1 4-5.1 7.4 0 2.6 1.6 4.6 3.9 4.6 2 0 3.5-1.5 3.5-3.4 0-1.9-1.3-3.3-3.1-3.3-.3 0-.7 0-.9.1.5-1.7 2-3.3 3.8-4.2L18.6 6z"/></svg>
                <div class="relative">
                    <div class="flex gap-1 <?= $dark ? 'text-teal-300' : 'text-amber-400' ?>" aria-label="5 out of 5 stars"><?php for ($s = 0; $s < 5; $s++): ?><svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M9.05 2.93c.3-.92 1.6-.92 1.9 0l1.07 3.29a1 1 0 00.95.69h3.46c.97 0 1.37 1.24.59 1.81l-2.8 2.03a1 1 0 00-.36 1.12l1.07 3.29c.3.92-.76 1.69-1.54 1.12l-2.8-2.03a1 1 0 00-1.18 0l-2.8 2.03c-.78.57-1.84-.2-1.54-1.12l1.07-3.29a1 1 0 00-.36-1.12L2.98 8.72c-.78-.57-.38-1.81.59-1.81h3.46a1 1 0 00.95-.69l1.07-3.29z"/></svg><?php endfor; ?></div>
                    <blockquote class="mt-7 font-display text-xl font-normal leading-[1.4] sm:text-[1.6rem]">“<?= e($q) ?>”</blockquote>
                </div>
                <figcaption class="relative mt-10 flex items-center gap-4 border-t pt-6 <?= $dark ? 'border-white/10' : 'border-brand-900/10' ?>">
                    <span class="flex h-12 w-12 items-center justify-center rounded-full text-sm font-bold <?= $dark ? 'bg-teal-300 text-brand-950' : 'bg-brand-50 text-brand-800' ?>"><?= e(str_replace('.', '', $who)) ?></span>
                    <span>
                        <span class="block font-bold"><?= e($who) ?></span>
                        <span class="text-sm <?= $dark ? 'text-white/60' : 'text-slate-500' ?>"><?= e($role) ?></span>
                    </span>
                </figcaption>
            </figure>
            <?php endforeach; ?>
        </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="mt-10 h-px bg-brand-900/10" aria-hidden="true"><div id="rv-bar" class="h-px bg-brand-700 transition-[width] duration-300" style="width: <?= round(100 / count($reviews)) ?>%"></div></div>
    </div>
</section>

<!-- ===================== FAQ ===================== -->
<section id="faq" class="bg-white py-16 lg:py-24" aria-labelledby="faq-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <?php section_label('FAQ', 'Is MeRT / TMS right for you?'); ?>

        <div class="mt-12 grid gap-12 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-5">
                <div class="lg:sticky lg:top-32">
                    <h2 id="faq-title" class="reveal text-balance font-display text-[2.6rem] font-normal leading-[1.04] tracking-[-0.02em] text-brand-950 sm:text-6xl">
                        Questions, <em class="text-brand-600">answered.</em>
                    </h2>
                    <p class="reveal mt-6 max-w-md text-lg leading-relaxed text-slate-600">Certain conditions may affect eligibility, so it’s worth understanding whether MeRT or TMS is the right fit before you begin.</p>
                    <div class="reveal mt-10 flex items-center gap-5 rounded-[1.75rem] bg-teal-50 p-6 ring-1 ring-teal-200/60">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-teal-400 text-brand-950">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 00-1.173.417l-.97 1.293a1.125 1.125 0 01-1.21.38 12.035 12.035 0 01-7.143-7.143 1.125 1.125 0 01.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                        </span>
                        <div>
                            <p class="font-bold text-brand-950">Still have questions?</p>
                            <p class="text-sm text-slate-600">Talk to a patient coordinator: <a href="tel:<?= e($site['phone_raw']) ?>" class="font-bold text-brand-700 underline underline-offset-4"><?= e($site['phone']) ?></a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-b border-brand-900/10 lg:col-span-7">
                <?php foreach ($faqs as $i => [$q, $a]): ?>
                <details class="reveal group border-t border-brand-900/10" <?= $i === 0 ? 'open' : '' ?>>
                    <summary class="flex cursor-pointer list-none items-start gap-5 py-7">
                        <span class="mt-1.5 font-display text-sm italic text-teal-600"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
                        <h3 class="flex-1 font-display text-xl font-normal leading-snug text-brand-950 transition group-hover:text-brand-600 sm:text-2xl"><?= e($q) ?></h3>
                        <span class="faq-icon mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-full ring-1 ring-brand-900/15 transition duration-300 group-open:bg-brand-700 group-open:text-white group-open:ring-brand-700" aria-hidden="true">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
                        </span>
                    </summary>
                    <p class="-mt-2 pb-8 pl-10 pr-4 leading-relaxed text-slate-600 sm:pr-16"><?= e($a) ?></p>
                </details>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- ===================== Contact ===================== -->
<section id="contact" class="bg-sand-50 px-3 py-3 sm:px-5 sm:py-5" aria-labelledby="contact-title">
    <div class="relative isolate mx-auto max-w-[96rem] overflow-hidden rounded-[2.5rem] bg-brand-950 px-4 py-16 sm:px-6 lg:py-20">
        <div class="pointer-events-none absolute -left-32 bottom-0 -z-10 h-96 w-96 rounded-full bg-teal-500/15 blur-3xl" aria-hidden="true"></div>
        <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-12 lg:gap-16">
            <div class="text-white lg:col-span-5">
                <p class="text-[11px] font-bold uppercase tracking-[0.24em] text-teal-300">Free consultation</p>
                <h2 id="contact-title" class="mt-5 font-display text-5xl font-normal leading-[1.02] tracking-[-0.02em] sm:text-6xl lg:text-7xl">Things can get <em class="text-teal-300">better.</em></h2>
                <p class="mt-6 max-w-md text-lg leading-relaxed text-brand-100/75">Get the information you need to decide whether MeRT may benefit you or your loved one. No pressure, no commitment.</p>

                <dl class="mt-12 divide-y divide-white/10 border-y border-white/10">
                    <div class="flex flex-wrap items-baseline justify-between gap-2 py-5">
                        <dt class="text-sm text-white/50">Call</dt>
                        <dd><a href="tel:<?= e($site['phone_raw']) ?>" class="font-display text-2xl hover:text-teal-300"><?= e($site['phone']) ?></a></dd>
                    </div>
                    <div class="flex flex-wrap items-baseline justify-between gap-2 py-5">
                        <dt class="text-sm text-white/50">Email</dt>
                        <dd><a href="mailto:<?= e($site['email']) ?>" class="break-all text-lg hover:text-teal-300"><?= e($site['email']) ?></a></dd>
                    </div>
                    <div class="flex flex-wrap items-baseline justify-between gap-2 py-5">
                        <dt class="text-sm text-white/50">Hours</dt>
                        <dd class="text-lg">Mon–Fri, 9:00am–5:00pm</dd>
                    </div>
                </dl>

                <div class="mt-8 grid gap-6 sm:grid-cols-2">
                    <address class="not-italic">
                        <p class="text-sm font-bold text-teal-300">Houston / Sugar Land, TX</p>
                        <p class="mt-1 text-white/75">5501 Cabrera Dr Suite 503<br>Sugar Land, TX 77479</p>
                    </address>
                    <address class="not-italic">
                        <p class="text-sm font-bold text-teal-300">Washington DC Metro</p>
                        <p class="mt-1 text-white/75">2401 Brandermill Suite 330<br>Gambrills, MD 21054</p>
                    </address>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="rounded-[2rem] bg-white p-6 shadow-2xl shadow-black/20 sm:p-10">
                    <h3 class="font-display text-2xl text-brand-950 sm:text-3xl">Request a consultation</h3>
                    <p class="mt-2 text-slate-500">Tell us a little about what you’re looking for and a patient coordinator will be in touch.</p>

                    <?php if ($formStatus === 'success'): ?>
                        <div class="mt-6 rounded-2xl bg-teal-50 p-4 font-semibold text-teal-700 ring-1 ring-teal-200" role="status">Thank you! A patient coordinator will be in touch shortly.</div>
                    <?php elseif ($formStatus === 'error'): ?>
                        <div class="mt-6 rounded-2xl bg-red-50 p-4 font-semibold text-red-700 ring-1 ring-red-200" role="alert">Something went wrong. Please check your details or call us at <?= e($site['phone']) ?>.</div>
                    <?php endif; ?>
                    <?php if ($isStatic): ?>
                        <div id="form-success" class="mt-6 hidden rounded-2xl bg-teal-50 p-4 font-semibold text-teal-700 ring-1 ring-teal-200" role="status">Thank you! A patient coordinator will be in touch shortly.</div>
                    <?php endif; ?>

                    <?php if ($isStatic): /* Netlify Forms: detected at deploy time, submissions appear in the Netlify dashboard */ ?>
                    <form name="contact" method="POST" action="/?sent=1#contact" data-netlify="true" netlify-honeypot="website" class="mt-8 grid gap-5 sm:grid-cols-2">
                        <input type="hidden" name="form-name" value="contact">
                    <?php else: ?>
                    <form method="post" action="#contact" class="mt-8 grid gap-5 sm:grid-cols-2">
                    <?php endif; ?>
                        <input type="hidden" name="contact_form" value="1">
                        <div class="hidden" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
                        <?php foreach ([
                            ['first_name', 'First name', 'text', 'given-name', true],
                            ['last_name', 'Last name', 'text', 'family-name', false],
                            ['phone', 'Phone', 'tel', 'tel', false],
                            ['email', 'Email', 'email', 'email', true],
                        ] as [$n, $l, $t, $ac, $req]): ?>
                        <div>
                            <label for="<?= $n ?>" class="mb-2 block text-sm font-semibold text-brand-950"><?= $l ?><?= $req ? ' <span class="text-teal-600">*</span>' : '' ?></label>
                            <input id="<?= $n ?>" name="<?= $n ?>" type="<?= $t ?>" autocomplete="<?= $ac ?>" <?= $req ? 'required' : '' ?> class="w-full rounded-2xl border-0 bg-sand-50 px-4 py-3.5 text-brand-950 ring-1 ring-inset ring-brand-900/10 transition placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-teal-400">
                        </div>
                        <?php endforeach; ?>
                        <div class="sm:col-span-2">
                            <label for="message" class="mb-2 block text-sm font-semibold text-brand-950">How can we help? <span class="text-teal-600">*</span></label>
                            <textarea id="message" name="message" rows="4" required class="w-full rounded-2xl border-0 bg-sand-50 px-4 py-3.5 text-brand-950 ring-1 ring-inset ring-brand-900/10 transition focus:bg-white focus:ring-2 focus:ring-teal-400"></textarea>
                        </div>
                        <div class="flex flex-col gap-4 sm:col-span-2 sm:flex-row sm:items-center sm:justify-between">
                            <p class="max-w-xs text-xs leading-relaxed text-slate-500">Please don’t include sensitive medical details. See our <a href="https://novarahc.com/privacy-policy/" class="underline">Privacy Policy</a>.</p>
                            <button type="submit" class="group inline-flex items-center justify-center gap-3 rounded-full bg-brand-700 py-2 pl-7 pr-2 font-bold text-white shadow-lg shadow-brand-700/25 transition hover:bg-brand-800">
                                Send request
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white/15 transition group-hover:translate-x-0.5"><svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5M21 12H3"/></svg></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</main>

<!-- ===================== Footer ===================== -->
<footer class="relative overflow-hidden bg-sand-50 pt-14 text-slate-600">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="grid gap-12 border-b border-brand-900/10 pb-14 md:grid-cols-2 lg:grid-cols-12">
            <div class="lg:col-span-4">
                <a href="<?= e($site['url']) ?>" class="inline-block" aria-label="Novara Healthcare home">
                    <img src="<?= e($site['logo']) ?>" alt="Novara Healthcare" width="300" height="233" loading="lazy" class="h-20 w-auto">
                </a>
                <p class="mt-6 max-w-xs leading-relaxed">Empowering minds, reshaping lives. Personalized MeRT and TMS therapy in Houston &amp; Sugar Land, TX and the Washington DC Metro.</p>
                <div class="mt-6 flex gap-2">
                    <?php foreach ([
                        ['Facebook', 'https://www.facebook.com/people/Novara-Health-Care-Brain-Treatment-Center/61570570193895/', '<path d="M13.5 21v-7.5h2.5l.4-3h-2.9V8.6c0-.9.3-1.5 1.5-1.5h1.5V4.4c-.3 0-1.2-.1-2.2-.1-2.2 0-3.7 1.3-3.7 3.8v2.3H8v3h2.6V21h2.9z" fill="currentColor"/>'],
                        ['Instagram', 'https://www.instagram.com/novarahealthcare/', '<rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="2" fill="none"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2" fill="none"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/>'],
                        ['YouTube', 'https://www.youtube.com/channel/UCRsvjw4q4qIRSTEjH_bNqHg', '<path d="M21.6 7.2a2.5 2.5 0 00-1.8-1.8C18.2 5 12 5 12 5s-6.2 0-7.8.4A2.5 2.5 0 002.4 7.2 26 26 0 002 12a26 26 0 00.4 4.8 2.5 2.5 0 001.8 1.8c1.6.4 7.8.4 7.8.4s6.2 0 7.8-.4a2.5 2.5 0 001.8-1.8A26 26 0 0022 12a26 26 0 00-.4-4.8zM10 15V9l5.2 3L10 15z" fill="currentColor"/>'],
                    ] as [$n, $h, $svg]): ?>
                    <a href="<?= e($h) ?>" target="_blank" rel="noopener" aria-label="<?= $n ?>" class="flex h-11 w-11 items-center justify-center rounded-full text-brand-800 ring-1 ring-brand-900/15 transition hover:bg-brand-700 hover:text-white hover:ring-brand-700"><svg class="h-4 w-4" viewBox="0 0 24 24" aria-hidden="true"><?= $svg ?></svg></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <nav aria-label="Treatments" class="lg:col-span-2 lg:col-start-6">
                <h2 class="text-[11px] font-bold uppercase tracking-[0.24em] text-slate-400">Treatments</h2>
                <ul class="mt-5 space-y-3 font-medium text-brand-950">
                    <li><a class="hover:text-teal-600" href="https://novarahc.com/healthcare-services/magnetic-eresonance-therapy/">MeRT Therapy</a></li>
                    <li><a class="hover:text-teal-600" href="https://novarahc.com/healthcare-services/tms-therapy/">TMS Therapy</a></li>
                    <li><a class="hover:text-teal-600" href="https://novarahc.com/healthcare-services/autism-therapy/">Autism Therapy</a></li>
                    <li><a class="hover:text-teal-600" href="https://novarahc.com/healthcare-services/depression-therapy/">Depression Therapy</a></li>
                    <li><a class="hover:text-teal-600" href="https://novarahc.com/healthcare-services/ptsd-treatment-with-mert/">PTSD Treatment</a></li>
                </ul>
            </nav>
            <nav aria-label="Quick links" class="lg:col-span-2">
                <h2 class="text-[11px] font-bold uppercase tracking-[0.24em] text-slate-400">Novara</h2>
                <ul class="mt-5 space-y-3 font-medium text-brand-950">
                    <li><a class="hover:text-teal-600" href="https://novarahc.com/about/">About us</a></li>
                    <li><a class="hover:text-teal-600" href="https://novarahc.com/research/">Research</a></li>
                    <li><a class="hover:text-teal-600" href="https://novarahc.com/video-resources/">Video resources</a></li>
                    <li><a class="hover:text-teal-600" href="https://novarahc.com/events-specials/">Events &amp; specials</a></li>
                    <li><a class="hover:text-teal-600" href="https://novarahc.com/contact/referral/">Referral form</a></li>
                </ul>
            </nav>
            <div class="lg:col-span-3">
                <h2 class="text-[11px] font-bold uppercase tracking-[0.24em] text-slate-400">Visit</h2>
                <address class="mt-5 space-y-4 not-italic text-brand-950">
                    <p>5501 Cabrera Dr Suite 503<br>Sugar Land, TX 77479</p>
                    <p>2401 Brandermill Suite 330<br>Gambrills, MD 21054</p>
                    <p><a href="tel:<?= e($site['phone_raw']) ?>" class="font-bold hover:text-teal-600"><?= e($site['phone']) ?></a></p>
                </address>
                <a href="https://www.carecredit.com/apply/" target="_blank" rel="noopener" class="mt-6 inline-flex rounded-full bg-white px-5 py-2.5 text-sm font-bold text-brand-800 ring-1 ring-brand-900/10 transition hover:ring-brand-700">Apply for CareCredit ↗</a>
            </div>
        </div>

        <div class="flex flex-col items-center justify-between gap-3 py-6 text-sm sm:flex-row">
            <p>&copy; <?= date('Y') ?> Novara Healthcare. All rights reserved.</p>
            <ul class="flex gap-6">
                <li><a class="hover:text-brand-900" href="https://novarahc.com/disclaimer/">Disclaimer</a></li>
                <li><a class="hover:text-brand-900" href="https://novarahc.com/privacy-policy/">Privacy</a></li>
                <li><a class="hover:text-brand-900" href="https://novarahc.com/terms-of-services/">Terms</a></li>
            </ul>
        </div>
    </div>
    <p class="pointer-events-none select-none text-center font-display text-[24vw] font-normal leading-[.72] tracking-[-0.04em] text-brand-900/[.06]" aria-hidden="true">Novara</p>
</footer>

<!-- Mobile sticky CTA -->
<div class="fixed inset-x-0 bottom-0 z-40 grid grid-cols-2 gap-2 border-t border-brand-100 bg-white/95 p-3 backdrop-blur sm:hidden">
    <a href="tel:<?= e($site['phone_raw']) ?>" class="rounded-full border border-brand-200 py-3 text-center text-sm font-bold text-brand-800">Call Now</a>
    <a href="#contact" class="rounded-full bg-brand-700 py-3 text-center text-sm font-bold text-white">Free Consultation</a>
</div>
<div class="h-20 sm:hidden" aria-hidden="true"></div>

<script>
    // Mobile menu
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');
    btn.addEventListener('click', () => {
        const open = menu.classList.toggle('hidden') === false;
        btn.setAttribute('aria-expanded', open);
    });
    menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => { menu.classList.add('hidden'); btn.setAttribute('aria-expanded', 'false'); }));

    // Header: glass over hero, solid once scrolled (or menu open)
    const header = document.getElementById('site-header');
    const onScroll = () => header.classList.toggle('is-solid', window.scrollY > 24 || !menu.classList.contains('hidden'));
    window.addEventListener('scroll', onScroll, { passive: true });
    btn.addEventListener('click', onScroll);
    onScroll();

    // Netlify Forms redirect back here with ?sent=1 — show the thank-you message
    const formOk = document.getElementById('form-success');
    if (formOk && new URLSearchParams(location.search).has('sent')) {
        formOk.classList.remove('hidden');
        history.replaceState(null, '', location.pathname + '#contact');
    }

    // Lightweight YouTube embed: load the player only on click
    document.querySelectorAll('[data-yt]').forEach(b => b.addEventListener('click', () => {
        const f = document.createElement('iframe');
        f.src = 'https://www.youtube-nocookie.com/embed/' + b.dataset.yt + '?autoplay=1&rel=0';
        f.title = b.dataset.title;
        f.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
        f.allowFullscreen = true;
        f.className = 'absolute inset-0 h-full w-full';
        b.replaceWith(f);
    }));

    // Reviews slider (native scroll-snap + buttons, progress and gentle autoplay)
    const track = document.getElementById('rv-track');
    if (track) {
        const slides = [...track.children];
        const prev = document.getElementById('rv-prev');
        const next = document.getElementById('rv-next');
        const count = document.getElementById('rv-count');
        const bar = document.getElementById('rv-bar');
        const step = () => slides[0].getBoundingClientRect().width + parseFloat(getComputedStyle(track).columnGap || 20);
        const max = () => track.scrollWidth - track.clientWidth;
        const update = () => {
            const atEnd = track.scrollLeft >= max() - 4;
            const idx = atEnd ? slides.length - 1 : Math.round(track.scrollLeft / step());
            count.textContent = String(idx + 1).padStart(2, '0');
            bar.style.width = ((idx + 1) / slides.length * 100) + '%';
            prev.disabled = track.scrollLeft < 4;
            next.disabled = atEnd;
        };
        const go = dir => { track.scrollBy({ left: dir * step() }); setTimeout(update, 450); };
        prev.addEventListener('click', () => go(-1));
        next.addEventListener('click', () => go(1));
        track.addEventListener('keydown', e => {
            if (e.key === 'ArrowRight') { e.preventDefault(); next.click(); }
            if (e.key === 'ArrowLeft') { e.preventDefault(); prev.click(); }
        });
        track.addEventListener('scroll', update, { passive: true });
        window.addEventListener('resize', update);
        update();

        let timer = null;
        const play = () => {
            if (timer || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
            timer = setInterval(() => { track.scrollLeft >= max() - 4 ? track.scrollTo({ left: 0 }) : track.scrollBy({ left: step() }); setTimeout(update, 450); }, 6000);
        };
        const stop = () => { clearInterval(timer); timer = null; };
        [track, prev, next].forEach(el => {
            el.addEventListener('pointerenter', stop);
            el.addEventListener('pointerleave', play);
            el.addEventListener('focusin', stop);
        });
        track.addEventListener('touchstart', stop, { passive: true });
        // Only auto-advance while the slider is on screen
        new IntersectionObserver(([en]) => en.isIntersecting ? play() : stop(), { threshold: 0.5 }).observe(track);
    }

    // Reveal on scroll
    const io = new IntersectionObserver((entries) => {
        entries.forEach(en => { if (en.isIntersecting) { en.target.classList.add('is-visible'); io.unobserve(en.target); } });
    }, { threshold: 0.12 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>
</body>
</html>
