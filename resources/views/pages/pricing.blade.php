@extends('layouts.app')

@section('title', 'Pricing & Fees')
@section('meta_desc', 'Understand how ticket pricing works on the TREC TSCC event platform. Ticket prices are set by event organisers and displayed clearly before payment. No hidden fees.')
@section('og_title', 'Pricing & Fees – TREC | TSCC Event Platform')
@section('og_desc', 'Transparent pricing for TREC and TSCC event tickets. Prices are displayed clearly on each event page before any payment is required.')

@section('content')
<style>
.pricing-hero{background:var(--black);padding:6rem 2rem 4rem;text-align:center;position:relative;overflow:hidden}
.pricing-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 70% 50%,rgba(216,45,55,.12) 0%,transparent 60%),radial-gradient(ellipse at 30% 50%,rgba(107,143,26,.08) 0%,transparent 60%);pointer-events:none}
.pricing-hero h1{font-family:var(--font-display);font-size:clamp(2.2rem,5vw,3.5rem);color:#fff;font-weight:400;margin-bottom:1rem;position:relative}
.pricing-hero p{color:rgba(255,255,255,.5);font-size:1rem;max-width:540px;margin:0 auto;position:relative}
.pricing-body{max-width:960px;margin:0 auto;padding:4rem 2rem 6rem}

/* Transparency banner */
.transparency-banner{background:linear-gradient(135deg,rgba(107,143,26,.08),rgba(107,143,26,.04));border:1.5px solid rgba(107,143,26,.2);border-radius:16px;padding:1.75rem 2rem;margin-bottom:3.5rem;display:flex;align-items:flex-start;gap:1.25rem}
.transparency-icon{width:48px;height:48px;background:var(--green);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.transparency-icon svg{width:24px;height:24px;stroke:#fff;fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:2}
.transparency-text h3{font-family:var(--font-h);font-size:1.1rem;color:var(--black);margin-bottom:.35rem}
.transparency-text p{font-size:.9rem;color:var(--charcoal);line-height:1.75;margin:0}

/* Section headings */
.pricing-section{margin-bottom:4rem}
.pricing-section-title{font-family:var(--font-display);font-size:clamp(1.6rem,3vw,2.2rem);color:var(--black);margin-bottom:.5rem;line-height:1.2}
.pricing-section-lead{font-size:.95rem;color:var(--charcoal);line-height:1.8;margin-bottom:2rem;max-width:680px}

/* Ticket pricing card */
.ticket-pricing-card{background:#fff;border:1.5px solid var(--mid);border-radius:16px;padding:2rem;margin-bottom:1.25rem;display:flex;align-items:center;justify-content:space-between;gap:1.5rem;transition:box-shadow .25s,transform .25s}
.ticket-pricing-card:hover{box-shadow:var(--shadow-md);transform:translateY(-2px)}
.ticket-pricing-card.featured{border-color:var(--red);background:linear-gradient(135deg,rgba(216,45,55,.03),rgba(229,105,24,.02))}
.ticket-type-info h3{font-family:var(--font-h);font-size:1.1rem;color:var(--black);margin-bottom:.3rem}
.ticket-type-info p{font-size:.88rem;color:var(--charcoal);line-height:1.6;max-width:420px}
.ticket-price-tag{text-align:right;flex-shrink:0}
.ticket-price-tag .price-label{font-family:var(--font-ui);font-size:.75rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--charcoal);opacity:.6;margin-bottom:.25rem}
.ticket-price-tag .price-value{font-family:var(--font-display);font-size:1.75rem;color:var(--black);line-height:1}
.ticket-price-tag .price-note{font-size:.8rem;color:var(--charcoal);opacity:.65;margin-top:.25rem}
.live-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(107,143,26,.1);color:var(--green);font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px;font-family:var(--font-ui);letter-spacing:.5px;margin-bottom:.5rem}
.live-badge span{width:6px;height:6px;background:var(--green);border-radius:50%;display:block;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}

/* How it works steps */
.how-steps{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:2rem}
.how-step{background:var(--light);border-radius:16px;padding:1.75rem;text-align:center}
.how-step-num{width:40px;height:40px;background:var(--black);color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--font-ui);font-size:1rem;font-weight:700;margin:0 auto 1rem}
.how-step h4{font-family:var(--font-h);font-size:.95rem;color:var(--black);margin-bottom:.4rem}
.how-step p{font-size:.85rem;color:var(--charcoal);line-height:1.7}

/* Fee table */
.fee-table-wrap{background:#fff;border:1.5px solid var(--mid);border-radius:16px;overflow:hidden;margin:1.5rem 0}
.fee-row{display:grid;grid-template-columns:1fr auto;align-items:center;gap:1rem;padding:1.25rem 1.75rem;border-bottom:1px solid var(--light)}
.fee-row:last-child{border-bottom:none}
.fee-row.header{background:var(--black);padding:1rem 1.75rem}
.fee-row.header span{font-family:var(--font-ui);font-size:.8rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:rgba(255,255,255,.6)}
.fee-row .fee-name{font-size:.95rem;color:var(--charcoal)}
.fee-row .fee-name strong{display:block;color:var(--black);margin-bottom:.15rem}
.fee-row .fee-amount{font-family:var(--font-ui);font-size:.9rem;font-weight:700;color:var(--black);text-align:right;white-space:nowrap}
.fee-row .fee-amount.free{color:var(--green)}
.fee-row .fee-amount.dynamic{color:var(--red)}

/* Example checkout */
.checkout-example{background:var(--light);border-radius:16px;padding:2rem;margin-top:2rem}
.checkout-example h4{font-family:var(--font-ui);font-size:.8rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--charcoal);margin-bottom:1.25rem;opacity:.7}
.checkout-line{display:flex;justify-content:space-between;align-items:center;padding:.6rem 0;border-bottom:1px solid var(--mid);font-size:.9rem}
.checkout-line:last-of-type{border-bottom:none}
.checkout-line .item-name{color:var(--charcoal)}
.checkout-line .item-price{font-weight:600;color:var(--black)}
.checkout-total{display:flex;justify-content:space-between;align-items:center;padding:1rem 0 0;margin-top:.5rem;border-top:2px solid var(--black)}
.checkout-total .item-name{font-family:var(--font-h);font-size:1rem;font-weight:700;color:var(--black)}
.checkout-total .item-price{font-family:var(--font-display);font-size:1.5rem;color:var(--red)}

/* Organiser box */
.organiser-box{background:var(--black);color:#fff;border-radius:16px;padding:2.5rem;margin-top:2rem}
.organiser-box h3{font-family:var(--font-display);font-size:1.75rem;margin-bottom:.75rem}
.organiser-box p{color:rgba(255,255,255,.55);font-size:.95rem;line-height:1.85;margin-bottom:1rem}
.organiser-box p:last-of-type{margin-bottom:0}

/* CTA */
.pricing-cta{text-align:center;margin-top:4rem;padding:3.5rem;background:linear-gradient(135deg,rgba(216,45,55,.06),rgba(229,105,24,.04));border:1.5px solid rgba(216,45,55,.15);border-radius:20px}
.pricing-cta h3{font-family:var(--font-display);font-size:2rem;color:var(--black);margin-bottom:.75rem}
.pricing-cta p{color:var(--charcoal);font-size:.95rem;margin-bottom:1.75rem;max-width:440px;margin-left:auto;margin-right:auto}

@media(max-width:768px){
  .how-steps{grid-template-columns:1fr}
  .ticket-pricing-card{flex-direction:column;align-items:flex-start}
  .ticket-price-tag{text-align:left}
}
</style>

<div class="pricing-hero">
  <p class="eyebrow" style="justify-content:center;color:rgba(255,255,255,.5)">Transparent by Design</p>
  <h1>Pricing &amp; Fees</h1>
  <p>All ticket prices and applicable fees are displayed clearly before you make any payment. No surprises.</p>
</div>

<div class="pricing-body">

  {{-- Transparency Banner --}}
  <div class="transparency-banner reveal">
    <div class="transparency-icon">
      <svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
    </div>
    <div class="transparency-text">
      <h3>Our Pricing Commitment</h3>
      <p>We believe you should always know what you're paying before you pay it. Every ticket price, service fee, and total charge is displayed on the event page and on the checkout screen — before you enter any payment details. Paystack's secure checkout also displays a final summary before any charge is made.</p>
    </div>
  </div>

  {{-- Section 1: Ticket Pricing --}}
  <div class="pricing-section reveal" id="ticket-pricing">
    <div class="eyebrow">Ticket Pricing</div>
    <h2 class="pricing-section-title">How Ticket Prices are Set</h2>
    <p class="pricing-section-lead">Ticket prices are determined by TREC based on the event type, programme scope, and target audience. Prices may vary across ticket categories (e.g., Early Bird, Standard, VIP) and are clearly labelled on each event page.</p>

    <div class="ticket-pricing-card reveal">
      <div class="ticket-type-info">
        <div class="live-badge"><span></span> Live Event Pricing</div>
        <h3>Event-Specific Pricing</h3>
        <p>Each TSCC and TREC event publishes its own ticket categories with individual prices. You can view all available ticket types, prices, and remaining availability directly on the event's registration page before making any commitment.</p>
      </div>
      <div class="ticket-price-tag">
        <div class="price-label">Starting From</div>
        <div class="price-value" style="font-size:1.1rem;color:var(--charcoal)">Displayed on<br>Event Page</div>
        <div class="price-note">All prices in ₦ (NGN)</div>
      </div>
    </div>

    <div class="ticket-pricing-card featured reveal">
      <div class="ticket-type-info">
        <h3>Free Tickets</h3>
        <p>Where events offer free registration, this is clearly stated on the event page and no payment is required. A registration form is still completed to generate your ticket and QR code.</p>
      </div>
      <div class="ticket-price-tag">
        <div class="price-label">Price</div>
        <div class="price-value" style="color:var(--green)">Free</div>
        <div class="price-note">No card required</div>
      </div>
    </div>

    <div class="how-steps">
      <div class="how-step reveal">
        <div class="how-step-num">1</div>
        <h4>View Event Page</h4>
        <p>Browse to the event page. All ticket types and their prices are listed clearly in the "Tickets" section.</p>
      </div>
      <div class="how-step reveal">
        <div class="how-step-num">2</div>
        <h4>Select Your Ticket</h4>
        <p>Choose a ticket type. The price and total payable amount update instantly so you always know your total.</p>
      </div>
      <div class="how-step reveal">
        <div class="how-step-num">3</div>
        <h4>Pay Securely</h4>
        <p>You are redirected to Paystack's secure checkout where you see a final summary before any payment is charged.</p>
      </div>
    </div>
  </div>

  {{-- Section 2: Fees --}}
  <div class="pricing-section reveal" id="fees">
    <div class="eyebrow">Fee Structure</div>
    <h2 class="pricing-section-title">Platform &amp; Service Fees</h2>
    <p class="pricing-section-lead">We are committed to complete transparency about all charges. Below is a breakdown of fees that may apply.</p>

    <div class="fee-table-wrap">
      <div class="fee-row header">
        <span>Fee Type</span>
        <span>Amount</span>
      </div>
      <div class="fee-row">
        <div class="fee-name">
          <strong>Ticket Price</strong>
          The base price set for the selected ticket category. Displayed on the event page.
        </div>
        <div class="fee-amount dynamic">As displayed</div>
      </div>
      <div class="fee-row">
        <div class="fee-name">
          <strong>Platform Booking Fee</strong>
          A service fee may be applied on certain ticket types to cover platform and processing costs. If applicable, it is displayed in the checkout summary before payment.
        </div>
        <div class="fee-amount dynamic">Shown at checkout</div>
      </div>
      <div class="fee-row">
        <div class="fee-name">
          <strong>Payment Processing Fee (Paystack)</strong>
          Paystack applies a transaction fee of 1.5% + ₦100 for local cards. This is absorbed by TREC for most standard ticket types; where applicable, it is disclosed at checkout.
        </div>
        <div class="fee-amount dynamic">May apply</div>
      </div>
      <div class="fee-row">
        <div class="fee-name">
          <strong>Registration Fee (Free Tickets)</strong>
          No payment required for free tickets. Registration only.
        </div>
        <div class="fee-amount free">₦0.00</div>
      </div>
    </div>

    {{-- Example Checkout --}}
    <div class="checkout-example reveal">
      <h4>Example Checkout Breakdown</h4>
      <div class="checkout-line">
        <span class="item-name">General Admission Ticket × 1</span>
        <span class="item-price">₦10,000.00</span>
      </div>
      <div class="checkout-line">
        <span class="item-name">Service Fee (if applicable)</span>
        <span class="item-price">₦500.00</span>
      </div>
      <div class="checkout-total">
        <span class="item-name">Total Payable</span>
        <span class="item-price">₦10,500.00</span>
      </div>
      <p style="font-size:.8rem;color:var(--charcoal);opacity:.65;margin-top:1rem">* This is an illustrative example. Actual prices and fees are shown on each event page and at checkout. Amounts displayed may differ per event.</p>
    </div>
  </div>

  {{-- Section 3: Organiser Pricing --}}
  <div class="pricing-section reveal" id="organiser-pricing">
    <div class="eyebrow">Event Organisers</div>
    <h2 class="pricing-section-title">Organiser Access &amp; Fees</h2>

    <div class="organiser-box">
      <h3>For Event Organisers</h3>
      <p>The Ripple Effect Consult manages event creation, ticket management, and registration processing for TSCC and other TREC-affiliated events directly through this platform.</p>
      <p>Event organisers may create and manage events subject to platform policies and any service agreements in place with TREC. Any applicable fees for event creation, promotion, or platform services will be clearly communicated and agreed upon before submission or payment.</p>
      <p>If you are interested in partnering with TREC to host an event on this platform, please <a href="{{ route('contact') }}" style="color:var(--orange);font-weight:600">contact us</a> to discuss terms and applicable fees.</p>
    </div>
  </div>

  {{-- CTA --}}
  <div class="pricing-cta reveal">
    <h3>Ready to Register?</h3>
    <p>Browse our upcoming events to see ticket prices and availability. All pricing is shown clearly before you commit to anything.</p>
    <a href="{{ route('tscc') }}" class="btn-red" style="border-radius:8px;margin-right:.75rem">View TSCC Events</a>
    <a href="{{ route('contact') }}" class="btn-ghost" style="border-radius:8px">Ask a Question</a>
  </div>

</div>
@endsection
