
@extends('user.layouts.master')

@section('content')

<div class="container py-5 mt-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="bg-light rounded shadow-sm p-4 p-md-5 lh-lg">

                {{-- Page Heading --}}
                <div class="text-center mb-5">

                    <h2 class="text-primary fw-bold mb-3">
                        <i class="fas fa-shield-alt me-2"></i>
                        Our Privacy Policy
                    </h2>

                    <p class="text-muted mb-2">
                        Your privacy is important to us. This policy explains
                        how Fruitables collects, uses, and protects your
                        personal information when you use our website.
                    </p>

                    <small class="text-muted">
                        Last Updated: November 16, 2026
                    </small>

                </div>


                {{-- 1. Introduction --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        1. Introduction
                    </h4>

                    <p class="text-muted">
                        Welcome to Fruitables. We respect your privacy
                        and are committed to protecting your personal
                        information. This Privacy Policy explains how
                        we handle your information when you visit
                        or use our website.
                    </p>

                </div>


                {{-- 2. Information We Collect --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-user text-primary me-2"></i>
                        2. Information We Collect
                    </h4>

                    <p class="text-muted">
                        When you use our website, we may collect
                        the following information:
                    </p>

                    <ul class="text-muted small">
                        <li>Name and account information</li>
                        <li>Email address</li>
                        <li>Phone number</li>
                        <li>Delivery address</li>
                        <li>Order and shopping history</li>
                        <li>Uploaded payment receipts for order verification</li>
                    </ul>

                </div>


                {{-- 3. How We Use Your Information --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-shopping-cart text-primary me-2"></i>
                        3. How We Use Your Information
                    </h4>

                    <p class="text-muted">
                        We use customer information for the following purposes:
                    </p>

                    <ul class="text-muted small">
                        <li>To create and manage customer accounts.</li>
                        <li>To process and manage customer orders.</li>
                        <li>To communicate about orders and payments.</li>
                        <li>To provide customer support.</li>
                        <li>To improve our website and shopping experience.</li>
                    </ul>

                </div>


                {{-- 4. Protection of Your Information --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-lock text-primary me-2"></i>
                        4. Protection of Your Information
                    </h4>

                    <p class="text-muted">
                        We take reasonable steps to protect customer
                        information against unauthorized access,
                        alteration, disclosure, or destruction.
                    </p>

                    <p class="text-muted">
                        However, no method of online transmission
                        or electronic storage can be guaranteed
                        to be completely secure.
                    </p>

                </div>


                {{-- 5. Sharing Your Information --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-share-alt text-primary me-2"></i>
                        5. Sharing Your Information
                    </h4>

                    <p class="text-muted">
                        We do not sell customer personal information.
                        Information may be shared when necessary to
                        operate our website, fulfill orders, provide
                        services, or comply with applicable legal
                        requirements.
                    </p>

                </div>


                {{-- 6. Cookies --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-cookie-bite text-primary me-2"></i>
                        6. Cookies
                    </h4>

                    <p class="text-muted">
                        Our website may use cookies or similar
                        technologies to support website functionality,
                        maintain user sessions, and improve the
                        browsing experience.
                    </p>

                </div>


                {{-- 7. Your Privacy Rights --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-user-check text-primary me-2"></i>
                        7. Your Privacy Rights
                    </h4>

                    <p class="text-muted">
                        You may contact us to request access to,
                        correction of, or deletion of your personal
                        information, subject to applicable laws
                        and necessary business records.
                    </p>

                </div>


                {{-- 8. Changes to Privacy Policy --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-sync-alt text-primary me-2"></i>
                        8. Changes to This Privacy Policy
                    </h4>

                    <p class="text-muted">
                        We may update this Privacy Policy from time
                        to time. Any changes will be published
                        on this page with an updated revision date.
                    </p>

                </div>


                {{-- 9. Contact Us --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        9. Contact Us
                    </h4>

                    <p class="text-muted">
                        If you have any questions or concerns
                        about this Privacy Policy, please contact
                        us through our Contact Us page.
                    </p>

                    <a href="{{ route('user#contactPage') }}"
                       class="btn btn-primary rounded-pill px-4 py-2 mt-2">

                        <i class="fas fa-paper-plane me-2"></i>
                        Contact Us

                    </a>

                </div>


                {{-- Footer Message --}}
                <hr class="my-4">

                <div class="text-center">

                    <h5 class="text-primary fw-bold mb-2">
                        Thank You for Shopping with Fruitables!
                    </h5>

                    <p class="text-muted mb-0">
                        We appreciate your trust and value your privacy.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
