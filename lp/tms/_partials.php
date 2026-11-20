<?php
/**
 * Shared config + layout for the Sugar Land TMS landing page (index.php, thank-you.php).
 *
 * Every clinical statement on these pages is taken from novarahc.com (TMS page, FAQ)
 * and must still be approved by Novara's clinical team before ads go live.
 */

$isStatic = defined('STATIC_BUILD') && STATIC_BUILD;
// Where the page lives on the site. '/lp/tms/' inside the main site; build-lp.php
// sets '/' to publish the landing page as its own standalone Netlify site.
$lpBase = defined('LP_BASE') ? LP_BASE : '/lp/tms/';

$lp = [
    'name'      => 'Novara Healthcare',
    'url'       => 'https://novarahc.com/',
    'lp_url'    => defined('LP_URL') ? LP_URL : 'https://novarahc.com/lp/tms/',
    'email'     => 'info@novarahealthtx.com',
    'logo'      => 'https://novarahc.com/wp-content/uploads/2026/03/Novara-Healthcare-Logo.png',
    'favicon'   => 'https://novarahc.com/wp-content/uploads/2026/03/cropped-favicon1-192x192.png',
    'street'    => '5501 Cabrera Dr Suite 503',
    'city'      => 'Sugar Land, TX 77479',
    'hours'     => 'Mon–Fri, 9:00am–5:00pm',
    'maps'      => 'https://www.google.com/maps/search/?api=1&query=Novara+Healthcare+5501+Cabrera+Dr+Suite+503+Sugar+Land+TX+77479',
    'img'       => $lpBase . 'img/',
    // Static (Netlify) build posts to Netlify Forms and lands on <base>thank-you/.
    'thanks'    => $isStatic ? $lpBase . 'thank-you/' : 'thank-you.php',
    // Google Tag Manager container ID, e.g. 'GTM-ABC1234'. Leave empty for no tracking.
    // When set, GTM loads with Consent Mode v2 (everything denied until the visitor
    // accepts) and the cookie banner appears. Use conversion tracking only: Google
    // doesn't allow remarketing audiences built from mental-health pages.
    'gtm'       => '',
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
    <?php if ($lp['lp_url'] !== ''): ?><link rel="canonical" href="<?= e($lp['lp_url']) ?>"><?php endif; ?>
    <meta name="theme-color" content="#0a2b55">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e($title) ?>">
    <meta property="og:description" content="<?= e($desc) ?>">
    <meta property="og:image" content="https://novarahc.com/wp-content/uploads/2026/06/TMS-and-MeRt-by-apollo-1536x961.jpg">
    <link rel="icon" href="<?= e($lp['favicon']) ?>">

<?php if (!empty($lp['gtm'])): ?>
    <!-- Consent Mode v2: deny by default, restore a saved choice, then load GTM -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){ dataLayer.push(arguments); }
        gtag('consent', 'default', { ad_storage: 'denied', ad_user_data: 'denied', ad_personalization: 'denied', analytics_storage: 'denied', wait_for_update: 500 });
        gtag('set', 'ads_data_redaction', true);
        try { if (localStorage.getItem('lp_consent') === 'granted') gtag('consent', 'update', { ad_storage: 'granted', ad_user_data: 'granted', analytics_storage: 'granted' }); } catch (e) {}
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s);j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= e($lp['gtm']) ?>');
    </script>
<?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700&display=swap" rel="stylesheet">

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
                        display: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
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
        html, body { overflow-x: clip; }
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
<header class="sticky top-0 z-50 shadow-[0_1px_0_rgba(10,43,85,.08)]">
    <!-- Offer strip -->
    <div class="bg-teal-400 text-brand-950">
        <p class="mx-auto flex max-w-6xl items-center justify-center gap-2 px-4 py-1.5 text-center text-[12.5px] font-bold sm:text-[13px]">
            <svg class="h-3.5 w-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M9.05 2.93c.3-.92 1.6-.92 1.9 0l1.07 3.29a1 1 0 00.95.69h3.46c.97 0 1.37 1.24.59 1.81l-2.8 2.03a1 1 0 00-.36 1.12l1.07 3.29c.3.92-.75 1.69-1.54 1.12l-2.8-2.03a1 1 0 00-1.17 0l-2.8 2.03c-.78.57-1.83-.2-1.53-1.12l1.07-3.29a1 1 0 00-.37-1.12L2.98 8.72c-.78-.57-.38-1.81.59-1.81h3.46a1 1 0 00.95-.69l1.07-3.29z"/></svg>
            Free TMS consultation in Sugar Land<span class="hidden sm:inline"> · Mon–Fri, 9am–5pm</span>
        </p>
    </div>
    <!-- Main bar: logo + trust + form button. No menu, so visitors stay on the page. -->
    <div class="bg-white/95 backdrop-blur-md">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-4 px-4 sm:h-[72px] sm:px-6">
            <img src="<?= e($lp['logo']) ?>" alt="Novara Healthcare" width="180" height="48" class="h-9 w-auto sm:h-11">

            <ul class="hidden items-center gap-6 text-[13px] font-bold text-brand-900 lg:flex" aria-label="Highlights">
                <?php foreach (['FDA-cleared TMS', 'No sedation', 'Apollo TMS system'] as $t): ?>
                <li class="flex items-center gap-1.5"><svg class="h-4 w-4 text-teal-500" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg><?= e($t) ?></li>
                <?php endforeach; ?>
            </ul>

            <?php if ($showCta): ?>
            <a href="#consult" class="flex items-center gap-2 rounded-xl bg-brand-950 px-4 py-2.5 text-[15px] font-extrabold text-white transition hover:bg-brand-800">
                <span class="sm:hidden">Free consult</span><span class="hidden sm:inline">Get my free consultation</span>
                <svg class="h-4 w-4 text-teal-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5M21 12H3"/></svg>
            </a>
            <?php endif; ?>
        </div>
    </div>
</header>
<?php }

function lp_footer(array $lp): void { ?>
<footer class="border-t border-slate-200 bg-slate-50 pb-28 pt-10 text-sm text-slate-500 md:pb-10">
    <div class="mx-auto max-w-6xl px-4 sm:px-6">
        <div class="grid gap-6 sm:grid-cols-2 sm:items-center">
            <img src="<?= e($lp['logo']) ?>" alt="Novara Healthcare" width="180" height="48" class="h-9 w-auto">
            <address class="not-italic leading-relaxed sm:text-right">
                <?= e($lp['street']) ?>, <?= e($lp['city']) ?><br><?= e($lp['hours']) ?>
            </address>
        </div>

        <div class="mt-8 rounded-2xl bg-white p-5 text-xs leading-relaxed ring-1 ring-slate-200">
            <p><strong class="text-brand-950">In crisis?</strong> Call or text <a href="tel:988" class="font-bold text-brand-800 underline underline-offset-2">988</a> (Suicide &amp; Crisis Lifeline, 24/7). In an emergency, call 911.</p>
            <p class="mt-2">This page is for general information and is not medical advice. Submitting an enquiry does not create a patient relationship or confirm that a treatment is suitable for you; eligibility is decided by Novara’s clinical team after an assessment. Individual results vary, and no treatment works for everyone. Insurance coverage is not guaranteed.</p>
        </div>

        <div class="mt-6 flex flex-col gap-2 text-xs sm:flex-row sm:items-center sm:justify-between">
            <p>© <?= date('Y') ?> Novara Healthcare. All rights reserved.</p>
            <p class="flex flex-wrap gap-4"><?php if (!empty($lp['gtm'])): ?><button type="button" data-cookie-settings class="hover:text-brand-700">Cookie settings</button><?php endif; ?><a href="mailto:<?= e($lp['email']) ?>" class="hover:text-brand-700"><?= e($lp['email']) ?></a><a href="<?= e($lp['url']) ?>" class="hover:text-brand-700">novarahc.com</a></p>
        </div>
    </div>
</footer>
<?php if (!empty($lp['gtm'])) lp_cookie_banner();
}

/* Cookie banner, only rendered when a GTM ID is set. Accept and Reject get equal weight. */
function lp_cookie_banner(): void { ?>
<div id="cookie-banner" role="dialog" aria-labelledby="cookie-title" hidden
     class="fixed inset-x-3 bottom-3 z-[60] mx-auto max-w-xl rounded-2xl bg-white p-5 shadow-2xl ring-1 ring-brand-900/10 sm:bottom-6">
    <p id="cookie-title" class="font-extrabold text-brand-950">Cookies on this page</p>
    <p class="mt-1.5 text-sm leading-relaxed text-slate-600">With your permission we use cookies to measure how our ads perform. We never share what you enter in the form with ad platforms.</p>
    <div class="mt-4 grid grid-cols-2 gap-2">
        <button type="button" data-consent="denied" class="rounded-xl bg-slate-100 py-3 text-sm font-extrabold text-brand-950 ring-1 ring-slate-200 hover:bg-slate-200">Reject</button>
        <button type="button" data-consent="granted" class="rounded-xl bg-brand-950 py-3 text-sm font-extrabold text-white hover:bg-brand-800">Accept</button>
    </div>
</div>
<script>
(function () {
    var box = document.getElementById('cookie-banner'), saved = null;
    try { saved = localStorage.getItem('lp_consent'); } catch (e) {}
    if (!saved) box.hidden = false;
    box.addEventListener('click', function (ev) {
        var b = ev.target.closest('[data-consent]'); if (!b) return;
        var v = b.dataset.consent;
        gtag('consent', 'update', { ad_storage: v, ad_user_data: v, analytics_storage: v });
        try { localStorage.setItem('lp_consent', v); } catch (e) {}
        box.hidden = true;
    });
    document.querySelectorAll('[data-cookie-settings]').forEach(function (b) {
        b.addEventListener('click', function () { box.hidden = false; box.querySelector('button').focus(); });
    });
})();
</script>
<?php }
