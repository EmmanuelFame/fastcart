@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">Privacy Policy</h1>

    <p class="mb-4">Effective Date: {{ now()->format('F d, Y') }}</p>

    <p class="mb-4">At Mercatia, your privacy is important to us. This Privacy Policy explains how we collect, use, and protect your information.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">1. Information We Collect</h2>
    <ul class="list-disc pl-6 mb-4">
        <li>Personal information (name, email, phone, address)</li>
        <li>Order and payment information (via Flutterwave)</li>
        <li>Device and usage data (IP, browser, pages visited)</li>
    </ul>

    <h2 class="text-xl font-semibold mt-6 mb-2">2. Use of Your Information</h2>
    <p class="mb-4">We use your data to process orders, improve services, and communicate with you.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">3. Sharing Information</h2>
    <p class="mb-4">We do not sell your data. We share it with payment processors, logistics partners, and legal authorities when necessary.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">4. Cookies</h2>
    <p class="mb-4">We use cookies to enhance user experience and track performance. You can control cookie settings in your browser.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">5. Data Security</h2>
    <p class="mb-4">We use industry-standard security to protect your information.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">6. Your Rights</h2>
    <p class="mb-4">You may request to access, correct, or delete your data by contacting us at hello@mercatia.store.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">7. Children’s Privacy</h2>
    <p class="mb-4">We do not knowingly collect information from children under 18.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">8. Updates to this Policy</h2>
    <p class="mb-4">We may revise this policy periodically. Continued use of the site indicates agreement with any changes.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">9. Contact Us</h2>
    <p>Email: milestartrade@gmail.com <br>Phone: +79526267287</p>
</div>
@endsection
