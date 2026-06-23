@extends('layouts.app')

@section('title', 'Terms & Conditions')
@section('meta_desc', 'Read the Terms and Conditions for The Ripple Effect Consult (TREC) and the TSCC event ticketing platform. Understand your rights and responsibilities when using our services.')
@section('og_title', 'Terms & Conditions – TREC')
@section('og_desc', 'Terms and Conditions for using TREC services and the TSCC event ticketing platform.')

@section('content')
<style>
.legal-hero{background:var(--black);padding:6rem 2rem 4rem;text-align:center}
.legal-hero h1{font-family:var(--font-display);font-size:clamp(2.2rem,5vw,3.5rem);color:#fff;font-weight:400;margin-bottom:1rem}
.legal-hero p{color:rgba(255,255,255,.5);font-size:1rem;max-width:520px;margin:0 auto}
.legal-body{max-width:820px;margin:0 auto;padding:4rem 2rem 6rem}
.legal-updated{display:inline-flex;align-items:center;gap:8px;background:rgba(216,45,55,.08);border:1px solid rgba(216,45,55,.18);color:var(--red);font-size:12px;font-weight:600;padding:6px 14px;border-radius:20px;margin-bottom:2.5rem;font-family:var(--font-ui);letter-spacing:.5px}
.legal-toc{background:var(--light);border-radius:16px;padding:2rem;margin-bottom:3rem}
.legal-toc h3{font-family:var(--font-ui);font-size:12px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--charcoal);margin-bottom:1rem}
.legal-toc ol{margin:0;padding-left:1.25rem;display:grid;grid-template-columns:1fr 1fr;gap:.4rem .5rem}
.legal-toc li a{font-size:13px;color:var(--red);font-weight:500;transition:opacity .2s}
.legal-toc li a:hover{opacity:.7}
.legal-section{margin-bottom:3rem}
.legal-section h2{font-family:var(--font-h);font-size:1.35rem;color:var(--black);margin-bottom:1rem;padding-bottom:.75rem;border-bottom:2px solid var(--light);display:flex;align-items:center;gap:.5rem}
.legal-section h2 span{font-family:var(--font-ui);font-size:.8rem;background:var(--red);color:#fff;padding:3px 9px;border-radius:20px;font-weight:700}
.legal-section p{font-size:.95rem;line-height:1.9;color:var(--charcoal);margin-bottom:1rem}
.legal-section ul{margin:.5rem 0 1rem 1.25rem}
.legal-section ul li{font-size:.95rem;line-height:1.85;color:var(--charcoal);margin-bottom:.4rem}
.legal-highlight{background:linear-gradient(135deg,rgba(216,45,55,.05),rgba(229,105,24,.05));border-left:3px solid var(--red);padding:1.25rem 1.5rem;border-radius:0 10px 10px 0;margin:1.25rem 0}
.legal-highlight p{margin:0;font-size:.9rem;color:var(--charcoal);font-style:italic}
.legal-contact-box{background:var(--black);color:#fff;border-radius:16px;padding:2.5rem;text-align:center;margin-top:4rem}
.legal-contact-box h3{font-family:var(--font-display);font-size:1.5rem;margin-bottom:.75rem}
.legal-contact-box p{color:rgba(255,255,255,.55);font-size:.9rem;margin-bottom:1.5rem}
.legal-contact-box a{color:var(--red);font-weight:600}
@media(max-width:640px){.legal-toc ol{grid-template-columns:1fr}}
</style>

<div class="legal-hero">
  <p class="eyebrow" style="justify-content:center;color:rgba(255,255,255,.5)">Legal</p>
  <h1>Terms &amp; Conditions</h1>
  <p>Please read these terms carefully before using our services or purchasing event tickets.</p>
</div>

<div class="legal-body">
  <div class="legal-updated">Last Updated: June 2025</div>

  <div class="legal-toc reveal">
    <h3>Table of Contents</h3>
    <ol>
      <li><a href="#platform">About the Platform</a></li>
      <li><a href="#responsibilities">User Responsibilities</a></li>
      <li><a href="#tickets">Ticket Purchase Terms</a></li>
      <li><a href="#organiser">Organiser Responsibilities</a></li>
      <li><a href="#refunds">Refund &amp; Cancellation Policy</a></li>
      <li><a href="#payment">Payment Processing</a></li>
      <li><a href="#liability">Limitation of Liability</a></li>
      <li><a href="#ip">Intellectual Property</a></li>
      <li><a href="#governing">Governing Law</a></li>
      <li><a href="#contact-legal">Contact Information</a></li>
    </ol>
  </div>

  <div class="legal-section reveal" id="platform">
    <h2><span>01</span> About the Platform</h2>
    <p>The Ripple Effect Consult (TREC) operates an event management and ticketing platform for the <strong>The School Counselling Conference (TSCC)</strong> and other professional development events. This platform enables participants to discover events, register, and purchase tickets online.</p>
    <p>By accessing or using this website, you agree to be bound by these Terms and Conditions. If you do not agree to any part of these terms, you must not use our services.</p>
    <p>TREC reserves the right to update these terms at any time. Continued use of the platform after changes constitutes acceptance of the revised terms.</p>
  </div>

  <div class="legal-section reveal" id="responsibilities">
    <h2><span>02</span> User Responsibilities</h2>
    <p>By using this platform, you agree to:</p>
    <ul>
      <li>Provide accurate, current, and complete registration information.</li>
      <li>Maintain the confidentiality of your registration details and QR code ticket.</li>
      <li>Not transfer or resell tickets to third parties for profit.</li>
      <li>Comply with all event rules, venue policies, and applicable laws.</li>
      <li>Not attempt to access the system through automated means, scraping, or other unauthorised methods.</li>
      <li>Use the platform solely for lawful purposes.</li>
    </ul>
    <div class="legal-highlight">
      <p>You are responsible for ensuring that the email address provided during registration is valid and accessible, as your ticket and confirmation will be delivered electronically.</p>
    </div>
  </div>

  <div class="legal-section reveal" id="tickets">
    <h2><span>03</span> Ticket Purchase Terms</h2>
    <p>When you purchase a ticket through this platform:</p>
    <ul>
      <li>Ticket prices are displayed clearly on the event page before you proceed to payment.</li>
      <li>All prices are in Nigerian Naira (₦) unless otherwise stated.</li>
      <li>Payment is processed securely through <strong>Paystack</strong>, a PCI DSS compliant payment gateway.</li>
      <li>A confirmation email with your ticket and QR code will be sent to your registered email address upon successful payment.</li>
      <li>Tickets are personal and non-transferable unless TREC explicitly permits transfers in writing.</li>
      <li>TREC reserves the right to cancel or invalidate tickets obtained through fraudulent means.</li>
      <li>Tickets grant admission to the stated event only and do not confer any membership, employment, or ongoing relationship with TREC.</li>
    </ul>
    <p>Your ticket purchase is complete when you receive a confirmation email. If you do not receive a confirmation within 30 minutes of payment, contact us immediately at <a href="mailto:rippleeffectconsult@gmail.com" style="color:var(--red);font-weight:600">rippleeffectconsult@gmail.com</a>.</p>
  </div>

  <div class="legal-section reveal" id="organiser">
    <h2><span>04</span> Event Organiser Responsibilities</h2>
    <p>TREC, as the event organiser, is responsible for:</p>
    <ul>
      <li>Providing accurate event details including date, time, venue, and programme schedule.</li>
      <li>Notifying registered attendees promptly of any material changes to the event.</li>
      <li>Delivering the event as described to the best of its ability.</li>
      <li>Managing the check-in process and ensuring orderly access for ticketed attendees.</li>
      <li>Complying with all applicable venue regulations and local laws.</li>
    </ul>
    <p>TREC reserves the right to modify the event programme, speakers, or schedule for reasons beyond its control, including but not limited to speaker unavailability, force majeure, or venue constraints. Such changes do not automatically entitle attendees to a refund unless the event is cancelled entirely.</p>
  </div>

  <div class="legal-section reveal" id="refunds">
    <h2><span>05</span> Refund &amp; Cancellation Policy</h2>
    <p><strong>Event Cancellation by TREC:</strong> If TREC cancels an event, all ticketed attendees will receive a full refund within 7–14 business days.</p>
    <p><strong>Event Postponement:</strong> If an event is postponed, your ticket remains valid for the rescheduled date. If you cannot attend the new date, you may request a refund within 14 days of the postponement announcement.</p>
    <p><strong>Attendee Cancellation:</strong></p>
    <ul>
      <li>Cancellations made more than 30 days before the event: 80% refund.</li>
      <li>Cancellations made 15–30 days before the event: 50% refund.</li>
      <li>Cancellations made fewer than 14 days before the event: No refund (the ticket may be transferred to another person with written approval from TREC).</li>
    </ul>
    <div class="legal-highlight">
      <p>All refund requests must be submitted in writing to rippleeffectconsult@gmail.com with your registration number and reason for cancellation. Refunds are processed to the original payment method only.</p>
    </div>
    <p><strong>No-Shows:</strong> Failure to attend the event without prior cancellation notice does not entitle the attendee to a refund.</p>
  </div>

  <div class="legal-section reveal" id="payment">
    <h2><span>06</span> Payment Processing Disclaimer</h2>
    <p>Online payments on this platform are processed by <strong>Paystack</strong>, an independent third-party payment processor authorised by the Central Bank of Nigeria (CBN). By making a payment, you agree to Paystack's terms of service and privacy policy in addition to ours.</p>
    <ul>
      <li>TREC does not store your card details on its servers.</li>
      <li>All card transactions are encrypted and processed in a secure PCI-DSS compliant environment.</li>
      <li>TREC is not liable for any payment processing failures, errors, or delays caused by the payment gateway or your financial institution.</li>
      <li>In case of a failed transaction where your account was debited, contact us and Paystack simultaneously for prompt resolution.</li>
    </ul>
    <p>Free tickets (where applicable) require registration but no payment. Paid tickets require full payment at the time of registration.</p>
  </div>

  <div class="legal-section reveal" id="liability">
    <h2><span>07</span> Limitation of Liability</h2>
    <p>To the fullest extent permitted by law, TREC and its officers, directors, and staff shall not be liable for:</p>
    <ul>
      <li>Any indirect, incidental, special, or consequential damages arising from use of this platform.</li>
      <li>Technical failures, downtime, or data loss affecting your registration or payment.</li>
      <li>Personal injury, loss, or damage sustained at any TREC event beyond what is covered by event insurance.</li>
      <li>Actions, content, or decisions of third-party speakers, sponsors, or vendors at events.</li>
    </ul>
    <p>Our total liability in any matter arising from your use of this platform is limited to the amount you paid for your ticket.</p>
  </div>

  <div class="legal-section reveal" id="ip">
    <h2><span>08</span> Intellectual Property</h2>
    <p>All content on this website — including text, graphics, logos, images, audio, and video — is the intellectual property of The Ripple Effect Consult or its licensors and is protected under Nigerian and international copyright law.</p>
    <ul>
      <li>You may not reproduce, distribute, or create derivative works from any content without prior written consent from TREC.</li>
      <li>Event presentations, materials, and recordings remain the intellectual property of TREC and/or the respective speakers.</li>
      <li>Photography or video recording at events may be restricted and is subject to event-specific policies.</li>
    </ul>
    <p>The TSCC name, logo, and associated branding are trademarks of The Ripple Effect Consult. Unauthorised use is strictly prohibited.</p>
  </div>

  <div class="legal-section reveal" id="governing">
    <h2><span>09</span> Governing Law &amp; Dispute Resolution</h2>
    <p>These Terms and Conditions shall be governed by and construed in accordance with the laws of the <strong>Federal Republic of Nigeria</strong>.</p>
    <p>In the event of a dispute:</p>
    <ul>
      <li>Both parties agree to first attempt resolution through good-faith negotiation within 30 days.</li>
      <li>If unresolved, the dispute shall be referred to mediation under the Lagos State Multi-Door Courthouse or a mutually agreed mediator.</li>
      <li>If mediation fails, the dispute shall be submitted to the jurisdiction of the courts of Lagos State, Nigeria.</li>
    </ul>
    <p>Nothing in these terms limits your rights as a consumer under applicable Nigerian consumer protection law.</p>
  </div>

  <div class="legal-section reveal" id="contact-legal">
    <h2><span>10</span> Contact Information</h2>
    <p>For questions about these terms, refund requests, or any legal enquiries, please contact:</p>
    <ul>
      <li><strong>Organisation:</strong> The Ripple Effect Consult (TREC)</li>
      <li><strong>Email:</strong> <a href="mailto:rippleeffectconsult@gmail.com" style="color:var(--red)">rippleeffectconsult@gmail.com</a></li>
      <li><strong>Phone:</strong> <a href="tel:+2349056057502" style="color:var(--red)">+234 905 605 7502</a></li>
      <li><strong>Address:</strong> 11 Raji Crescent, Baruwa, Ipaja, Lagos, Nigeria</li>
    </ul>
  </div>

  <div class="legal-contact-box reveal">
    <h3>Questions about these Terms?</h3>
    <p>Our team is happy to clarify any aspect of these Terms &amp; Conditions before you register.</p>
    <a href="{{ route('contact') }}" class="btn-red" style="border-radius:8px">Contact Us</a>
  </div>
</div>
@endsection
