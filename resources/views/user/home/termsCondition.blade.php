
@extends('user.layouts.master')

@section('content')

{{-- Terms & Conditions Start --}}
<div class="container py-5 mt-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="bg-light rounded shadow-sm p-4 p-md-5 lh-lg">

                {{-- Page Introduction --}}
                <div class="text-center mb-5">

                    <h2 class="text-primary fw-bold mb-3">
                        <i class="fas fa-file-contract me-2"></i>
                        Terms & Conditions
                    </h2>

                    <p class="text-muted">
                        Welcome to Fruitables! Please read these
                        Terms & Conditions carefully before using
                        our website and purchasing our products.
                    </p>

                    <small class="text-muted">
                        Last Updated: {{ date('F d, Y') }}
                    </small>

                </div>


                {{-- 1. Acceptance --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-check-circle text-primary me-2"></i>
                        1. Acceptance of Terms
                    </h4>

                    <p class="text-muted">
                        By accessing or using the Fruitables website,
                        you agree to follow these Terms & Conditions.
                        If you do not agree with any part of these terms,
                        please do not use our website.
                    </p>

                </div>


                {{-- 2. User Accounts --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-user text-primary me-2"></i>
                        2. User Accounts
                    </h4>

                    <p class="text-muted">
                        Customers may need to create an account
                        to use certain website features.
                    </p>

                    <ul class="text-muted small">
                        <li>Provide accurate and complete registration information.</li>
                        <li>Keep your account login details confidential.</li>
                        <li>Notify us if you suspect unauthorized account access.</li>
                        <li>You are responsible for activities performed through your account, subject to applicable law.</li>
                    </ul>

                </div>


                {{-- 3. Products --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-shopping-basket text-primary me-2"></i>
                        3. Products and Availability
                    </h4>

                    <p class="text-muted">
                        We aim to display accurate product descriptions,
                        images, and prices on our website.
                        However, product availability and details
                        may change without prior notice.
                    </p>

                    <ul class="text-muted small">
                        <li>Products are subject to availability.</li>
                        <li>Product images are for illustration purposes.</li>
                        <li>Prices may change when products are updated.</li>
                    </ul>

                </div>


                {{-- 4. Orders --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-cart-shopping text-primary me-2"></i>
                        4. Orders and Purchases
                    </h4>

                    <p class="text-muted">
                        Customers can select products, add them
                        to their shopping cart, and submit orders
                        through our website.
                    </p>

                    <ul class="text-muted small">
                        <li>Please check your products and quantities before placing an order.</li>
                        <li>Customers must provide correct contact and delivery information.</li>
                        <li>Orders are subject to confirmation and availability.</li>
                        <li>We reserve the right to reject orders when necessary, with appropriate communication to customers.</li>
                    </ul>

                </div>


                {{-- 5. Payment --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-money-bill-wave text-primary me-2"></i>
                        5. Payment Methods
                    </h4>

                    <p class="text-muted">
                        Customers must complete payment using
                        the payment methods provided on our website.
                    </p>

                    <ul class="text-muted small">
                        <li>Follow the payment instructions provided during checkout.</li>
                        <li>Submit a valid payment receipt when required.</li>
                        <li>Payment confirmation may be required before order processing.</li>
                        <li>Incorrect or unverifiable payment information may delay order processing.</li>
                    </ul>

                </div>


                {{-- 6. Cancellation --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-times-circle text-primary me-2"></i>
                        6. Order Cancellation
                    </h4>

                    <p class="text-muted">
                        Customers who wish to cancel an order
                        should contact us as soon as possible.
                        Cancellation requests are subject to
                        the order's current processing status
                        and our store's cancellation policy.
                    </p>

                </div>


                {{-- 7. Delivery --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-truck text-primary me-2"></i>
                        7. Delivery
                    </h4>

                    <p class="text-muted">
                        Customers must provide a complete and
                        accurate delivery address and contact number.
                    </p>

                    <p class="text-muted">
                        Delivery availability, charges, and estimated
                        delivery times depend on the arrangements
                        offered by our store.
                    </p>

                </div>


                {{-- 8. Returns and Refunds --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-undo text-primary me-2"></i>
                        8. Returns and Refunds
                    </h4>

                    <p class="text-muted">
                        If you receive a damaged, incorrect, or
                        unsatisfactory product, please contact us
                        with your order details.
                    </p>

                    <p class="text-muted">
                        Return and refund requests will be reviewed
                        according to our applicable store policies
                        and relevant consumer protection requirements.
                    </p>

                </div>


                {{-- 9. Prohibited Activities --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-ban text-primary me-2"></i>
                        9. Prohibited Activities
                    </h4>

                    <p class="text-muted">
                        Customers must not:
                    </p>

                    <ul class="text-muted small">
                        <li>Use the website for unlawful activities.</li>
                        <li>Provide false or misleading information.</li>
                        <li>Attempt to access another user's account.</li>
                        <li>Damage, disrupt, or interfere with website functionality.</li>
                        <li>Misuse website services or content.</li>
                    </ul>

                </div>


                {{-- 10. Intellectual Property --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-copyright text-primary me-2"></i>
                        10. Intellectual Property
                    </h4>

                    <p class="text-muted">
                        Website content, including text, graphics,
                        logos, and design elements, may be protected
                        by applicable intellectual property laws.
                        You may not reproduce or distribute such
                        content without appropriate permission.
                    </p>

                </div>


                {{-- 11. Changes --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-sync-alt text-primary me-2"></i>
                        11. Changes to These Terms
                    </h4>

                    <p class="text-muted">
                        We may update these Terms & Conditions
                        from time to time. Updated terms will
                        be published on this page.
                    </p>

                    <p class="text-muted">
                        Customers should review this page
                        periodically to stay informed.
                    </p>

                </div>


                {{-- 12. Contact --}}
                <div class="mb-4">

                    <h4 class="fw-semibold mb-3">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        12. Contact Us
                    </h4>

                    <p class="text-muted">
                        If you have questions about these
                        Terms & Conditions, please contact
                        our customer support team.
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
                        Thank You for Choosing Fruitables!
                    </h5>

                    <p class="text-muted mb-0">
                        We appreciate your support and look forward
                        to serving you.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>
{{-- Terms & Conditions End --}}

@endsection
