@extends('layouts.app')

@section('title', 'Terms and Conditions')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">Terms and Conditions</h1>

    <p class="mb-4">Effective Date: {{ now()->format('F d, Y') }}</p>

    <p class="mb-4">Welcome to <strong>Mercatia</strong> (www.mercatia.store). These Terms and Conditions ("Terms") govern your access to and use of our website and services. By using this website, you agree to comply with and be bound by these Terms.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">1. General Information</h2>
    <p class="mb-4">Mercatia is an online marketplace that connects customers with vendors selling fashion and retail products.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">2. Use of the Website</h2>
    <ul class="list-disc pl-6 mb-4">
        <li>You must be at least 18 years old to use this site.</li>
        <li>You agree to use this website lawfully and ethically.</li>
        <li>You are responsible for your account's security.</li>
    </ul>

    <h2 class="text-xl font-semibold mt-6 mb-2">3. Orders and Payments</h2>
    <p class="mb-4">Orders are confirmed upon successful payment. Payments are securely processed via Flutterwave.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">4. Shipping and Delivery</h2>
    <p class="mb-4">Delivery times vary by location and vendor. We are not liable for delays caused by third-party couriers.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">5. Returns and Refunds</h2>
    <p class="mb-4">Returns are accepted within 7 days if unused and in original condition. Refunds are processed to the original payment method.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">6. User Responsibilities</h2>
    <p class="mb-4">You must not upload malicious code or engage in fraudulent activities.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">7. Intellectual Property</h2>
    <p class="mb-4">All content belongs to Mercatia or its vendors and is protected by copyright laws.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">8. Limitation of Liability</h2>
    <p class="mb-4">Mercatia is not liable for indirect or incidental damages from site use.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">9. Privacy</h2>
    <p class="mb-4">See our <a href="{{ url('/privacy') }}" class="text-blue-600 underline">Privacy Policy</a> for more details.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">10. Modifications</h2>
    <p class="mb-4">We may update these Terms anytime. Continued use means acceptance of changes.</p>

    <h2 class="text-xl font-semibold mt-6 mb-2">11. Contact</h2>
    <p>Email: milestartrade@gmail.com<br>Phone: +79526267287</p>
</div>
@endsection
