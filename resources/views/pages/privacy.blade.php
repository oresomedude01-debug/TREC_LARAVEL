@extends('layouts.app')

@section('title', 'Privacy Policy')
@section('meta_desc', 'Learn how The Ripple Effect Consult (TREC) collects, uses, and protects your personal information when you use our website and event ticketing platform.')
@section('og_title', 'Privacy Policy – TREC')
@section('og_desc', 'Privacy Policy for TREC and the TSCC event ticketing platform.')

@section('content')
<style>
.legal-hero{background:var(--black);padding:6rem 2rem 4rem;text-align:center}
.legal-hero h1{font-family:var(--font-display);font-size:clamp(2.2rem,5vw,3.5rem);color:#fff;font-weight:400;margin-bottom:1rem}
.legal-hero p{color:rgba(255,255,255,.5);font-size:1rem;max-width:520px;margin:0 auto}
.legal-body{max-width:820px;margin:0 auto;padding:4rem 2rem 6rem}
.legal-updated{display:inline-flex;align-items:center;gap:8px;background:rgba(107,143,26,.08);border:1px solid rgba(107,143,26,.22);color:var(--green);font-size:12px;font-weight:600;padding:6px 14px;border-radius:20px;margin-bottom:2.5rem;font-family:var(--font-ui);letter-spacing:.5px}
.legal-toc{background:var(--light);border-radius:16px;padding:2rem;margin-bottom:3rem}
.legal-toc h3{font-family:var(--font-ui);font-size:12px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--charcoal);margin-bottom:1rem}
.legal-toc ol{margin:0;padding-left:1.25rem;display:grid;grid-template-columns:1fr 1fr;gap:.4rem .5rem}
.legal-toc li a{font-size:13px;color:var(--red);font-weight:500;transition:opacity .2s}
.legal-toc li a:hover{opacity:.7}
.legal-section{margin-bottom:3rem}
.legal-section h2{font-family:var(--font-h);font-size:1.35rem;color:var(--black);margin-bottom:1rem;padding-bottom:.75rem;border-bottom:2px solid var(--light);display:flex;align-items:center;gap:.5rem}
.legal-section h2 span{font-family:var(--font-ui);font-size:.8rem;background:var(--green);color:#fff;padding:3px 9px;border-radius:20px;font-weight:700}
.legal-section p{font-size:.95rem;line-height:1.9;color:var(--charcoal);margin-bottom:1rem}
.legal-section ul{margin:.5rem 0 1rem 1.25rem}
.legal-section ul li{font-size:.95rem;line-height:1.85;color:var(--charcoal);margin-bottom:.4rem}
.legal-highlight{background:linear-gradient(135deg,rgba(107,143,26,.07),rgba(107,143,26,.03));border-left:3px solid var(--green);padding:1.25rem 1.5rem;border-radius:0 10px 10px 0;margin:1.25rem 0}
.legal-highlight p{margin:0;font-size:.9rem;color:var(--charcoal)}
.data-table{width:100%;border-collapse:collapse;margin:1.25rem 0;font-size:.9rem}
.data-table th{background:var(--black);color:#fff;padding:.75rem 1rem;text-align:left;font-family:var(--font-ui);font-size:.8rem;letter-spacing:.5px}
.data-table td{padding:.75rem 1rem;border-bottom:1px solid var(--light);color:var(--charcoal);vertical-align:top}
.data-table tr:hover td{background:var(--light)}
.legal-contact-box{background:var(--black);color:#fff;border-radius:16px;padding:2.5rem;text-align:center;margin-top:4rem}
.legal-contact-box h3{font-family:var(--font-display);font-size:1.5rem;margin-bottom:.75rem}
.legal-contact-box p{color:rgba(255,255,255,.55);font-size:.9rem;margin-bottom:1.5rem}
@media(max-width:640px){.legal-toc ol{grid-template-columns:1fr}.data-table{display:block;overflow-x:auto}}
</style>

<div class="legal-hero">
  <p class="eyebrow" style="justify-content:center;color:rgba(255,255,255,.5)">Legal</p>
  <h1>Privacy Policy</h1>
  <p>We value your privacy. Here's exactly how we collect, use, and protect your personal information.</p>
</div>

<div class="legal-body">
  <div class="legal-updated">Last Updated: June 2025</div>

  <div class="legal-toc reveal">
    <h3>Table of Contents</h3>
    <ol>
      <li><a href="#intro">Introduction</a></li>
      <li><a href="#data-users">Data Collected from Users</a></li>
      <li><a href="#data-organisers">Data Collected from Organisers</a></li>
      <li><a href="#payment-data">Payment Information</a></li>
      <li><a href="#cookies">Cookies &amp; Analytics</a></li>
      <li><a href="#purpose">Purpose of Data Collection</a></li>
      <li><a href="#retention">Data Retention</a></li>
      <li><a href="#third-party">Third-Party Integrations</a></li>
      <li><a href="#your-rights">Your Rights</a></li>
      <li><a href="#contact-privacy">Contact Us</a></li>
    </ol>
  </div>

  <div class="legal-section reveal" id="intro">
    <h2><span>01</span> Introduction</h2>
    <p>The Ripple Effect Consult (<strong>"TREC"</strong>, "we", "us", or "our") is committed to protecting your personal information and your right to privacy. This Privacy Policy explains what information we collect, how we use it, and what rights you have regarding your data.</p>
    <p>This policy applies to all information collected through our website (<a href="{{ url('/') }}" style="color:var(--red)">trecnigeria.com</a>), the TSCC event registration platform, and any related services.</p>
    <div class="legal-highlight">
      <p><strong>By using our platform or registering for an event, you consent to the collection and use of your information as described in this Privacy Policy.</strong></p>
    </div>
  </div>

  <div class="legal-section reveal" id="data-users">
    <h2><span>02</span> Information We Collect from Users</h2>
    <p>When you register for an event, we collect:</p>
    <table class="data-table">
      <thead>
        <tr><th>Data Category</th><th>Examples</th><th>Why We Collect It</th></tr>
      </thead>
      <tbody>
        <tr><td><strong>Identity Data</strong></td><td>First name, last name</td><td>To identify and address you correctly</td></tr>
        <tr><td><strong>Contact Data</strong></td><td>Email address, phone number</td><td>To send your ticket and event communications</td></tr>
        <tr><td><strong>Professional Data</strong></td><td>Organisation, profession</td><td>For event planning and attendee demographics</td></tr>
        <tr><td><strong>Transaction Data</strong></td><td>Registration number, ticket type, amount paid</td><td>To process and confirm your registration</td></tr>
        <tr><td><strong>Technical Data</strong></td><td>IP address, browser type, UTM parameters</td><td>To understand traffic sources and improve the platform</td></tr>
      </tbody>
    </table>
    <p>When you contact us via our website contact form, we collect your name, email address, and the contents of your message.</p>
    <p>When you visit our website, we automatically collect certain technical data including your IP address, browser type, operating system, referring URLs, and pages visited. This is collected via standard web server logs and analytics tools.</p>
  </div>

  <div class="legal-section reveal" id="data-organisers">
    <h2><span>03</span> Information Collected from Event Organisers</h2>
    <p>If you are an event organiser working with TREC, we may collect additional information including:</p>
    <ul>
      <li>Business name and contact details</li>
      <li>Payment and banking information for settlements</li>
      <li>Event details, speaker profiles, and programme content you provide</li>
      <li>Communications and correspondence related to event planning</li>
    </ul>
    <p>This information is used solely for the purpose of managing the event relationship and is not shared with third parties except as required for payment processing or legal compliance.</p>
  </div>

  <div class="legal-section reveal" id="payment-data">
    <h2><span>04</span> Payment Information Handling</h2>
    <p>Payment transactions on this platform are processed by <strong>Paystack</strong> (paystack.com), a PCI DSS Level 1 compliant payment gateway licensed by the Central Bank of Nigeria.</p>
    <ul>
      <li><strong>We do not store</strong> your credit or debit card numbers on our servers.</li>
      <li><strong>We do not have access</strong> to your full card details at any point.</li>
      <li>TREC only receives a payment reference number and confirmation of whether the payment was successful.</li>
      <li>Transaction records (amount, date, reference) are stored by TREC for accounting and legal compliance purposes.</li>
    </ul>
    <div class="legal-highlight">
      <p>For full details of how Paystack handles your payment data, please review the <a href="https://paystack.com/privacy" target="_blank" rel="noopener" style="color:var(--red)">Paystack Privacy Policy</a>.</p>
    </div>
  </div>

  <div class="legal-section reveal" id="cookies">
    <h2><span>05</span> Cookies &amp; Analytics</h2>
    <p>Our website uses cookies — small text files placed on your device — to improve your experience. We use the following types of cookies:</p>
    <table class="data-table">
      <thead>
        <tr><th>Cookie Type</th><th>Purpose</th><th>Duration</th></tr>
      </thead>
      <tbody>
        <tr><td><strong>Essential Cookies</strong></td><td>Session management, CSRF protection, login state</td><td>Session / up to 2 hours</td></tr>
        <tr><td><strong>Functional Cookies</strong></td><td>Remembering form data, user preferences</td><td>Up to 30 days</td></tr>
        <tr><td><strong>Analytics Cookies</strong></td><td>Understanding how visitors use the site (e.g., page views, traffic sources)</td><td>Up to 24 months</td></tr>
      </tbody>
    </table>
    <p>You can control or disable cookies through your browser settings. Note that disabling essential cookies may affect the functionality of this website, including your ability to complete registration.</p>
  </div>

  <div class="legal-section reveal" id="purpose">
    <h2><span>06</span> Purpose of Data Collection</h2>
    <p>We use the information we collect to:</p>
    <ul>
      <li>Process event registrations and deliver ticket confirmations.</li>
      <li>Communicate with you about events you have registered for (reminders, updates, schedule changes).</li>
      <li>Send post-event communications such as thank-you messages, certificates, or feedback surveys.</li>
      <li>Improve our website, event planning, and attendee experience.</li>
      <li>Comply with legal and financial record-keeping obligations.</li>
      <li>Prevent fraud and ensure the security of our platform.</li>
      <li>Understand attendee demographics for event planning purposes.</li>
    </ul>
    <p>We will <strong>never sell your personal data</strong> to third parties or use it for purposes unrelated to the services you have engaged with.</p>
  </div>

  <div class="legal-section reveal" id="retention">
    <h2><span>07</span> Data Retention Policy</h2>
    <p>We retain your personal data only as long as necessary for the purposes it was collected:</p>
    <ul>
      <li><strong>Event registration data:</strong> Retained for 3 years after the event date for accounting, compliance, and certificate issuance purposes.</li>
      <li><strong>Contact form messages:</strong> Retained for 12 months then securely deleted.</li>
      <li><strong>Payment transaction records:</strong> Retained for 7 years in accordance with Nigerian financial regulations.</li>
      <li><strong>Website analytics data:</strong> Retained for up to 24 months in anonymised/aggregated form.</li>
    </ul>
    <p>After the applicable retention period, your data is securely and permanently deleted or anonymised so that it can no longer identify you.</p>
  </div>

  <div class="legal-section reveal" id="third-party">
    <h2><span>08</span> Third-Party Integrations</h2>
    <p>We use the following third-party services that may process your data:</p>
    <table class="data-table">
      <thead>
        <tr><th>Service</th><th>Purpose</th><th>Data Shared</th></tr>
      </thead>
      <tbody>
        <tr><td><strong>Paystack</strong></td><td>Payment processing</td><td>Name, email, payment amount</td></tr>
        <tr><td><strong>QR Server API</strong></td><td>Generating QR code tickets</td><td>Registration number (encoded in QR)</td></tr>
        <tr><td><strong>Google Fonts</strong></td><td>Typography</td><td>IP address (standard CDN request)</td></tr>
        <tr><td><strong>WhatsApp</strong></td><td>Support communication (if you initiate)</td><td>Information you voluntarily share in chat</td></tr>
      </tbody>
    </table>
    <p>Each third party is obligated to handle your data in accordance with their own privacy policies and applicable data protection law. We select third-party providers with strong privacy and security practices.</p>
  </div>

  <div class="legal-section reveal" id="your-rights">
    <h2><span>09</span> Your Rights Regarding Your Data</h2>
    <p>You have the following rights with respect to your personal data:</p>
    <ul>
      <li><strong>Right of Access:</strong> You may request a copy of the personal data we hold about you.</li>
      <li><strong>Right of Rectification:</strong> You may request correction of inaccurate or incomplete data.</li>
      <li><strong>Right of Erasure:</strong> You may request deletion of your data, subject to our legal retention obligations.</li>
      <li><strong>Right to Restrict Processing:</strong> You may request that we limit how we use your data in certain circumstances.</li>
      <li><strong>Right to Data Portability:</strong> You may request your data in a structured, machine-readable format.</li>
      <li><strong>Right to Object:</strong> You may object to processing based on legitimate interests or for direct marketing.</li>
      <li><strong>Right to Withdraw Consent:</strong> Where processing is based on consent, you may withdraw it at any time without affecting the lawfulness of prior processing.</li>
    </ul>
    <p>To exercise any of these rights, please contact us at <a href="mailto:rippleeffectconsult@gmail.com" style="color:var(--red);font-weight:600">rippleeffectconsult@gmail.com</a>. We will respond within 30 days. We may need to verify your identity before processing your request.</p>
  </div>

  <div class="legal-section reveal" id="contact-privacy">
    <h2><span>10</span> Contact Us</h2>
    <p>If you have questions about this Privacy Policy, wish to exercise your data rights, or have concerns about how your data is handled, please contact our Data Privacy Officer:</p>
    <ul>
      <li><strong>Organisation:</strong> The Ripple Effect Consult (TREC)</li>
      <li><strong>Email:</strong> <a href="mailto:rippleeffectconsult@gmail.com" style="color:var(--red)">rippleeffectconsult@gmail.com</a></li>
      <li><strong>Phone:</strong> <a href="tel:+2349056057502" style="color:var(--red)">+234 905 605 7502</a></li>
      <li><strong>Address:</strong> 11 Raji Crescent, Baruwa, Ipaja, Lagos, Nigeria</li>
    </ul>
    <p>If you are unsatisfied with our response, you have the right to lodge a complaint with the Nigeria Data Protection Commission (NDPC).</p>
  </div>

  <div class="legal-contact-box reveal">
    <h3>Privacy Questions?</h3>
    <p>We take data protection seriously. Reach out to us with any privacy concerns and we will respond promptly.</p>
    <a href="{{ route('contact') }}" class="btn-red" style="border-radius:8px">Contact Us</a>
  </div>
</div>
@endsection
