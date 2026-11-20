<?php
/**
 * Thank-you page for the Sugar Land TMS landing page.
 * On Netlify the form is handled by Netlify Forms, which then redirects here.
 * On a PHP server this page receives the POST and emails the enquiry.
 */
require __DIR__ . '/_partials.php';

$sent = true;
if (!$isStatic && ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $sent = false;
    $field = fn($k) => trim(strip_tags((string) ($_POST[$k] ?? '')));
    $name  = $field('name');
    $phone = $field('phone');
    $email = filter_var($field('email'), FILTER_VALIDATE_EMAIL);

    if ($field('website') === '' && $name !== '' && $phone !== '' && $email) {
        $body = '';
        foreach (['name','phone','email','for_whom','timeline','consent','utm_source','utm_medium','utm_campaign','utm_term','utm_content','gclid'] as $k) {
            $body .= str_pad($k . ':', 16) . $field($k) . "\n";
        }
        $sent = @mail($lp['email'], 'New TMS landing page enquiry: ' . $name, $body,
            "From: Novara Website <no-reply@novarahc.com>\r\nReply-To: {$email}\r\nContent-Type: text/plain; charset=UTF-8");
    }
}

lp_head($lp, 'Thank you | Novara Healthcare Sugar Land', 'Thanks for contacting Novara Healthcare. Our Sugar Land team will be in touch.');
?>
<body class="flex min-h-screen flex-col bg-sand-50 font-sans text-slate-700 antialiased">
<?php lp_header($lp, false); ?>

<main id="main" class="relative flex-1 overflow-hidden">
    <div class="pointer-events-none absolute -left-40 -top-40 h-[32rem] w-[32rem] rounded-full bg-teal-200/40 blur-3xl" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -right-32 top-32 h-[28rem] w-[28rem] rounded-full bg-brand-200/50 blur-3xl" aria-hidden="true"></div>

    <div class="relative mx-auto max-w-3xl px-4 py-16 text-center sm:px-6 lg:py-24">
        <?php if ($sent): ?>
        <span class="hero-in mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-teal-500 text-white shadow-lg shadow-teal-500/30">
            <svg class="h-9 w-9" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
        </span>
        <h1 class="hero-in mt-8 text-balance font-display text-5xl leading-[1.05] text-brand-950 [animation-delay:.08s] sm:text-6xl">Thank you. <em class="text-brand-600">We’ve got it.</em></h1>
        <p class="hero-in mx-auto mt-6 max-w-xl text-lg leading-relaxed text-slate-600 [animation-delay:.16s]">A member of our Sugar Land team will call you back during clinic hours (<?= e($lp['hours']) ?>) to answer your questions and talk through next steps.</p>
        <?php else: ?>
        <h1 class="hero-in font-display text-5xl leading-[1.05] text-brand-950">Sorry, something went wrong.</h1>
        <p class="hero-in mx-auto mt-6 max-w-xl text-lg leading-relaxed text-slate-600">We couldn’t send your enquiry. Please email us at <a href="mailto:<?= e($lp['email']) ?>" class="font-bold text-brand-700 underline"><?= e($lp['email']) ?></a> and we’ll be glad to help.</p>
        <?php endif; ?>

        <div class="hero-in mt-12 grid gap-4 text-left [animation-delay:.24s] sm:grid-cols-3">
            <?php foreach ([
                ['01', 'We call you', 'Keep your phone handy. We call during clinic hours, Monday to Friday.'],
                ['02', 'Quick chat', 'We answer your questions about TMS, timing and cost.'],
                ['03', 'Next steps', 'If it makes sense, we book a consultation at the clinic.'],
            ] as [$n, $h, $p]): ?>
            <div class="rounded-3xl bg-white p-6 ring-1 ring-brand-900/5">
                <span class="font-display text-3xl text-teal-500"><?= $n ?></span>
                <p class="mt-2 font-display text-xl text-brand-950"><?= e($h) ?></p>
                <p class="mt-1 text-[15px] leading-relaxed text-slate-500"><?= e($p) ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="hero-in mt-12 flex flex-col items-center justify-center gap-3 [animation-delay:.32s] sm:flex-row">
            <a href="https://novarahc.com/healthcare-services/tms-therapy/" class="inline-flex items-center justify-center px-5 py-4 font-bold text-brand-700 underline decoration-teal-300 decoration-2 underline-offset-8">Read more about TMS</a>
        </div>
    </div>
</main>

<?php lp_footer($lp); ?>

<script>
// Conversion event for Google Ads / GTM (fires once per page load)
<?php if ($sent): ?>
(window.dataLayer = window.dataLayer || []).push({ event: 'lp_lead', lead_source: 'tms-lp-sugar-land' });
<?php endif; ?>
</script>
</body>
</html>
