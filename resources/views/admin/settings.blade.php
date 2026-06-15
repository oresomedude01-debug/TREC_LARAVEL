@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('page-subtitle', 'Configure payment gateway and email preferences')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">

    {{-- Success / Error Alerts --}}
    @if(session('success'))
        <div class="flex items-center gap-3 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm">
            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm space-y-1">
            @foreach($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.save') }}" id="settings-form">
        @csrf

        {{-- ── Paystack Payment Gateway ── --}}
        <section class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="flex items-center gap-4 px-6 py-5 border-b border-slate-100 bg-slate-50/60">
                <div class="w-10 h-10 rounded-xl bg-[#0ba4db]/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#0ba4db]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Paystack Payment Gateway</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Connect your Paystack account to accept online ticket payments.</p>
                </div>
                {{-- Enable toggle --}}
                <div class="ml-auto flex items-center gap-2">
                    <label for="paystack_enabled" class="text-sm text-slate-600 font-medium cursor-pointer select-none">Enable</label>
                    <div class="relative" id="toggle-wrap">
                        <input type="hidden" name="paystack_enabled" value="0">
                        <input type="checkbox" id="paystack_enabled" name="paystack_enabled" value="1"
                               class="sr-only peer" {{ $settings['paystack_enabled'] === '1' ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-200 peer-checked:bg-[#0ba4db] rounded-full transition-colors duration-200 cursor-pointer"
                             onclick="document.getElementById('paystack_enabled').click()"></div>
                        <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform duration-200 peer-checked:translate-x-5 pointer-events-none"></div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-6 space-y-5">
                <div>
                    <label for="paystack_public_key" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Public Key <span class="text-slate-400 font-normal text-xs">(starts with pk_)</span>
                    </label>
                    <input type="text" id="paystack_public_key" name="paystack_public_key"
                           value="{{ old('paystack_public_key', $settings['paystack_public_key']) }}"
                           placeholder="Enter your Paystack public key"
                           autocomplete="off" spellcheck="false">
                    <p class="text-xs text-slate-400 mt-1.5">Used on the front-end to initialise the Paystack popup.</p>
                </div>

                <div>
                    <label for="paystack_secret_key" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Secret Key <span class="text-slate-400 font-normal text-xs">(starts with sk_)</span>
                    </label>
                    <div class="relative">
                        <input type="password" id="paystack_secret_key" name="paystack_secret_key"
                               value="{{ old('paystack_secret_key', $settings['paystack_secret_key']) }}"
                               placeholder="Enter your Paystack secret key"
                               autocomplete="off" spellcheck="false" class="pr-12">
                        <button type="button" id="toggle-secret"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 transition-colors"
                                title="Toggle visibility">
                            <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-slate-400 mt-1.5">Used server-side to verify payments. Keep this secret.</p>
                </div>

                <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl text-xs text-amber-700 flex gap-3">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>You can find your API keys in your <a href="https://dashboard.paystack.com/#/settings/developer" target="_blank" class="underline font-medium">Paystack Dashboard → Settings → API Keys & Webhooks</a>. Use <strong>test</strong> keys for development and <strong>live</strong> keys for production.</span>
                </div>
            </div>
        </section>

        {{-- ── Mail Settings ── --}}
        <section class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="flex items-center gap-4 px-6 py-5 border-b border-slate-100 bg-slate-50/60">
                <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Email Sender Identity</h2>
                    <p class="text-xs text-slate-500 mt-0.5">The name and address that appears in the From field of outgoing emails.</p>
                </div>
            </div>

            <div class="px-6 py-6 space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="mail_from_name" class="block text-sm font-medium text-slate-700 mb-1.5">From Name</label>
                        <input type="text" id="mail_from_name" name="mail_from_name"
                               value="{{ old('mail_from_name', $settings['mail_from_name']) }}"
                               placeholder="TREC Events">
                    </div>
                    <div>
                        <label for="mail_from_address" class="block text-sm font-medium text-slate-700 mb-1.5">From Email Address</label>
                        <input type="email" id="mail_from_address" name="mail_from_address"
                               value="{{ old('mail_from_address', $settings['mail_from_address']) }}"
                               placeholder="events@therippleeffectconsult.com">
                    </div>
                </div>
                <p class="text-xs text-slate-400">
                    Note: The actual mail server (SMTP credentials, driver) is configured in your <code class="bg-slate-100 px-1 py-0.5 rounded text-slate-600">.env</code> file.
                </p>
            </div>
        </section>

        {{-- ── Save Button ── --}}
        <div class="flex justify-end pb-8">
            <button type="submit" id="save-btn"
                    class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold px-6 py-2.5 rounded-xl shadow-sm transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Toggle secret key visibility
    const secretInput = document.getElementById('paystack_secret_key');
    const toggleBtn   = document.getElementById('toggle-secret');
    const eyeIcon     = document.getElementById('eye-icon');

    toggleBtn.addEventListener('click', () => {
        const isPassword = secretInput.type === 'password';
        secretInput.type = isPassword ? 'text' : 'password';
        eyeIcon.innerHTML = isPassword
            ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>'
            : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
    });
</script>
@endpush
