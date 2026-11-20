<?php
/**
 * Shared config + layout for the Sugar Land TMS landing page (index.php, thank-you.php).
 *
 * Every clinical statement on these pages is taken from novarahc.com (TMS page, FAQ)
 * and must still be approved by Novara's clinical team before ads go live.
 */

$isStatic = defined('STATIC_BUILD') && STATIC_BUILD;

$lp = [
    'name'      => 'Novara Healthcare',
    'url'       => 'https://novarahc.com/',
    'lp_url'    => 'https://novarahc.com/lp/tms/',
    'phone'     => '(713) 818-4809',
    'phone_raw' => '+17138184809',
    'email'     => 'info@novarahealthtx.com',
    'logo'      => 'https://novarahc.com/wp-content/uploads/2026/03/Novara-Healthcare-Logo.png',
    'favicon'   => 'https://novarahc.com/wp-content/uploads/2026/03/cropped-favicon1-192x192.png',
    'street'    => '5501 Cabrera Dr Suite 503',
    'city'      => 'Sugar Land, TX 77479',
    'hours'     => 'Mon–Fri, 9:00am–5:00pm',
    'maps'      => 'https://www.google.com/maps/search/?api=1&query=Novara+Healthcare+5501+Cabrera+Dr+Suite+503+Sugar+Land+TX+77479',
    'img'       => '/assets/lp/tms/img/',
    // Static (Netlify) build posts to Netlify Forms and lands on /lp/tms/thank-you/.
    'thanks'    => $isStatic ? '/lp/tms/thank-you/' : 'thank-you.php',
];

if (!function_exists('e')) {
    function e($s) { return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8'); }
}

function lp_head(array $lp, string $title, string $desc, string $extraHead = ''): void { ?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title) ?></title>
    <meta name="description" content="<?= e($desc) ?>">
    <!-- Paid-traffic landing page: kept out of search so it doesn't compete with the main site -->
    <meta name="robots" content="noindex, follow">
    <link rel="canonical" href="<?= e($lp['lp_url']) ?>">
    <meta name="theme-color" content="#0a2b55">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e($title) ?>">
    <meta property="og:description" content="<?= e($desc) ?>">
    <meta property="og:image" content="https://novarahc.com/wp-content/uploads/2026/06/TMS-and-MeRt-by-apollo-1536x961.jpg">
    <link rel="icon" href="<?= e($lp['favicon']) ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;1,9..144,400&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
                        card: '0 30px 80px -30px rgba(6, 26, 53, 0.45)',
                    },
                },
            },
        };
    </script>
    <style>
        .text-balance { text-wrap: balance; }
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
        details[open] .faq-icon { transform: rotate(45deg); }

        /* Scroll reveal */
        .reveal { opacity: 0; transform: translateY(28px); transition: opacity .8s cubic-bezier(.2,.7,.2,1), transform .8s cubic-bezier(.2,.7,.2,1); }
        .reveal[data-anim="left"]  { transform: translateX(-32px); }
        .reveal[data-anim="right"] { transform: translateX(32px); }
        .reveal[data-anim="zoom"]  { transform: scale(.95); }
        .reveal.is-visible { opacity: 1; transform: none; }

        /* Hero entrance */
        @keyframes heroIn { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: none; } }
        .hero-in { animation: heroIn .9s cubic-bezier(.2,.7,.2,1) both; }

        /* Live "callback" dot */
        @keyframes ping { 0% { transform: scale(1); opacity: .7; } 100% { transform: scale(2.4); opacity: 0; } }
        .live-dot::after { content: ""; position: absolute; inset: 0; border-radius: 9999px; background: currentColor; animation: ping 1.8s ease-out infinite; }

        /* Sticky mobile CTA bar slides in after the hero */
        #mobile-cta { transform: translateY(110%); transition: transform .35s ease; }
        #mobile-cta.is-on { transform: none; }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            .reveal, .hero-in { opacity: 1 !important; transform: none !important; animation: none !important; transition: none !important; }
            .live-dot::after { animation: none; }
        }
    </style>
    <?= $extraHead ?>
</head>
<?php }

function lp_header(array $lp, bool $showCta = true): void { ?>
<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-full focus:bg-white focus:px-4 focus:py-2 focus:font-bold focus:text-brand-800">Skip to content</a>
<header class="sticky top-0 z-50 border-b border-brand-900/5 bg-white/90 backdrop-blur-md">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-4 px-4 sm:h-20 sm:px-6">
        <a href="<?= e($lp['url']) ?>" class="flex shrink-0 items-center" aria-label="Novara Healthcare home">
            <img src="<?= e($lp['logo']) ?>" alt="Novara Healthcare" width="180" height="48" class="h-9 w-auto sm:h-11">
        </a>
        <div class="flex items-center gap-2 sm:gap-5">
            <a href="tel:<?= e($lp['phone_raw']) ?>" data-track="call_click" class="group flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-teal-50 text-teal-700 ring-1 ring-teal-200 transition group-hover:bg-teal-100">
                    <svg class="h-[18px] w-[18px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                </span>
                <span class="hidden leading-tight sm:block">
                    <span class="block text-[11px] font-semibold uppercase tracking-[0.16em] text-slate-500">Call the Sugar Land clinic</span>
                    <span class="block text-lg font-extrabold text-brand-900"><?= e($lp['phone']) ?></span>
                </span>
            </a>
            <?php if ($showCta): ?>
            <a href="#consult" class="hidden rounded-full bg-brand-700 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-brand-700/20 transition hover:bg-brand-800 md:inline-flex">Request a free consultation</a>
            <?php endif; ?>
        </div>
    </div>
</header>
<?php }

function lp_footer(array $lp): void { ?>
<footer class="bg-brand-950 pb-28 pt-14 text-white/70 md:pb-14">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="flex flex-col gap-8 border-b border-white/10 pb-10 md:flex-row md:items-start md:justify-between">
            <div>
                <img src="<?= e($lp['logo']) ?>" alt="Novara Healthcare" width="180" height="48" class="h-10 w-auto rounded-lg bg-white px-3 py-1.5">
                <address class="mt-5 not-italic leading-relaxed">
                    <?= e($lp['street']) ?><br><?= e($lp['city']) ?><br><?= e($lp['hours']) ?>
                </address>
            </div>
            <div class="flex flex-col gap-2 text-sm md:items-end">
                <a href="tel:<?= e($lp['phone_raw']) ?>" data-track="call_click" class="font-display text-2xl text-white hover:text-teal-300"><?= e($lp['phone']) ?></a>
                <a href="mailto:<?= e($lp['email']) ?>" class="hover:text-teal-300"><?= e($lp['email']) ?></a>
                <a href="<?= e($lp['url']) ?>" class="hover:text-teal-300">Visit novarahc.com</a>
            </div>
        </div>
        <div class="space-y-3 pt-8 text-xs leading-relaxed text-white/50">
            <p>If you or someone you know is in crisis, call or text <a href="tel:988" class="font-bold text-white underline underline-offset-2">988</a> to reach the Suicide &amp; Crisis Lifeline, available 24/7. In an emergency, call 911.</p>
            <p>The information on this page is for general education and is not medical advice. Submitting an enquiry does not create a patient relationship or confirm that a treatment is suitable for you; eligibility is decided by Novara’s clinical team after an assessment. Individual results vary, and no treatment works for everyone. Insurance coverage is not guaranteed.</p>
            <p>© <?= date('Y') ?> Novara Healthcare. All rights reserved.</p>
        </div>
    </div>
</footer>
<?php }
