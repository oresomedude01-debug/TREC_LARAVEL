@extends('layouts.admin')

@section('title', 'Check-in Desk - TREC')
@section('page-title', 'Check-in Desk: ' . $event->name)
@section('page-subtitle', 'Scan QR codes or search manually')

@section('action-button')
<a href="{{ route('admin.events.registrations.index', $event) }}" class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-lg font-medium transition-colors">
    Back to Registrations
</a>
@endsection

@section('content')

<!-- Navigation Tabs -->
<div class="flex overflow-x-auto border-b border-slate-200 mb-6 pb-px hide-scrollbar snap-x">
    <a href="{{ route('admin.events.registrations.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Registrations
    </a>
    <a href="{{ route('admin.events.waitlist.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Waitlist
    </a>
    <a href="{{ route('admin.events.checkin.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-slate-900 text-slate-900 font-medium">
        Check-in
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Scanner Side -->
    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="bg-slate-900 p-6 text-center text-white flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold mb-2">QR Code Scanner</h3>
                    <p class="text-slate-400 text-sm">Use your device camera or enter token manually.</p>
                </div>
                <button type="button" id="toggle-camera-btn" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors text-sm shadow-sm flex items-center gap-2" title="Toggle camera scanner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Camera
                </button>
            </div>
            <div class="p-8">
                <!-- Camera Feed -->
                <div id="camera-container" class="hidden mb-6">
                    <div class="relative bg-black rounded-lg overflow-hidden" style="aspect-ratio: 4/3;">
                        <video id="camera-feed" class="w-full h-full object-cover" playsinline></video>
                        <canvas id="camera-canvas" class="hidden"></canvas>
                        <div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(45deg, transparent 48%, rgba(255,0,0,0.1) 49%, rgba(255,0,0,0.1) 51%, transparent 52%), linear-gradient(-45deg, transparent 48%, rgba(255,0,0,0.1) 49%, rgba(255,0,0,0.1) 51%, transparent 52%); background-size: 60px 60px; background-position: center;">
                        </div>
                        <div class="absolute top-0 left-0 right-0 bottom-0 border-4 border-red-500 rounded-lg pointer-events-none m-12" style="box-sizing: border-box;"></div>
                    </div>
                    <p class="text-xs text-slate-500 text-center mt-3">Point camera at QR code</p>
                    <div class="flex gap-2 mt-3">
                        <button type="button" id="force-scan-btn" class="flex-1 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg font-medium transition-colors text-sm shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Capture Scan
                        </button>
                        <button type="button" id="close-camera-btn" class="flex-1 bg-slate-200 hover:bg-slate-300 text-slate-900 px-3 py-2 rounded-lg font-medium transition-colors text-sm">
                            Close Camera
                        </button>
                    </div>
                </div>

                <!-- Status Message Area -->
                <div id="status-messages">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800 text-center font-medium">
                            <svg class="w-8 h-8 mx-auto mb-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('success') }}
                            @if(session('attendee'))
                                <div class="text-sm mt-1 text-slate-600">{{ session('attendee')->full_name }} ({{ session('attendee')->ticketType->name ?? 'Standard' }})</div>
                            @endif
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800 text-center font-medium">
                            <svg class="w-8 h-8 mx-auto mb-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if(session('warning'))
                        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-800 text-center font-medium">
                            <svg class="w-8 h-8 mx-auto mb-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            {{ session('warning') }}
                            @if(session('attendee'))
                                <div class="text-sm mt-1 text-slate-600">{{ session('attendee')->full_name }}</div>
                            @endif
                        </div>
                    @endif
                </div>

                <form action="{{ route('admin.events.checkin.scan', $event) }}" method="POST" id="scan-form">
                    @csrf
                    <div>
                        <label for="qr_token" class="block text-sm font-medium text-slate-700 mb-2">QR Token</label>
                        <input type="text" name="qr_token" id="qr_token" autofocus autocomplete="off" class="w-full text-center text-lg font-mono tracking-widest rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 py-4 shadow-inner bg-slate-50" placeholder="Scan or paste token here...">
                        <p class="text-xs text-slate-500 text-center mt-3">Use camera or manual scanner to enter token</p>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-1">Check-in Progress</p>
                <p class="text-2xl font-bold text-slate-900">{{ number_format($checkedInCount) }} <span class="text-slate-400 text-lg">/ {{ number_format($totalCount) }}</span></p>
            </div>
            <div class="w-1/2 bg-slate-200 rounded-full h-3 ml-4">
                <div class="bg-green-500 h-3 rounded-full transition-all duration-500" style="width: {{ $totalCount > 0 ? ($checkedInCount / $totalCount) * 100 : 0 }}%"></div>
            </div>
        </div>
    </div>

    <!-- Manual Search Side -->
    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-200">
                <h3 class="text-lg font-bold text-slate-900">Manual Search</h3>
            </div>
            
            <div class="p-6 border-b border-slate-100 bg-slate-50">
                <form action="{{ route('admin.events.checkin.search', $event) }}" method="POST" class="flex gap-2">
                    @csrf
                    <input type="text" name="search" value="{{ request('search') }}" required placeholder="Name, Email, or Reg Number..." class="flex-1 rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm">
                    <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-lg font-medium transition-colors text-sm shadow-sm">
                        Search
                    </button>
                </form>
            </div>

            <div class="p-0">
                @if(isset($searchResults))
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 hidden">
                            <tr>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($searchResults as $reg)
                                <tr class="hover:bg-slate-50">
                                    <td class="p-4">
                                        <div class="font-bold text-slate-900">{{ $reg->full_name }}</div>
                                        <div class="text-xs text-slate-500">{{ $reg->email }} &bull; {{ $reg->ticketType->name ?? 'Standard' }}</div>
                                        <div class="text-xs text-slate-400 font-mono mt-1">{{ $reg->registration_number }}</div>
                                    </td>
                                    <td class="p-4 text-right">
                                        @if($reg->checked_in)
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-slate-100 text-slate-500 uppercase">
                                                Already In
                                            </span>
                                        @elseif($reg->status != 'confirmed')
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-red-100 text-red-800 uppercase">
                                                {{ $reg->status }}
                                            </span>
                                        @else
                                            <form action="{{ route('admin.events.checkin.manual', [$event, $reg]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg font-medium transition-colors text-xs shadow-sm">
                                                    Check In
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="p-6 text-center text-slate-500">
                                        No registrations found matching your search.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @else
                    <div class="p-12 text-center text-slate-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <p>Search for an attendee to check them in manually.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>
<script>
    let cameraStream = null;
    let cameraActive = false;
    const cameraContainer = document.getElementById('camera-container');
    const cameraFeed = document.getElementById('camera-feed');
    const canvas = document.getElementById('camera-canvas');
    const canvasContext = canvas.getContext('2d');
    const toggleCameraBtn = document.getElementById('toggle-camera-btn');
    const closeCameraBtn = document.getElementById('close-camera-btn');
    const qrInput = document.getElementById('qr_token');
    let lastScannedQr = null;

    const forceScanBtn = document.getElementById('force-scan-btn');

    // Toggle Camera
    toggleCameraBtn.addEventListener('click', async function() {
        if (cameraActive) {
            stopCamera();
        } else {
            await startCamera();
        }
    });

    // Close Camera
    closeCameraBtn.addEventListener('click', function() {
        stopCamera();
    });

    // Manual Capture Scan
    forceScanBtn.addEventListener('click', function() {
        if (!cameraActive) return;
        
        canvas.width = cameraFeed.videoWidth;
        canvas.height = cameraFeed.videoHeight;
        canvasContext.drawImage(cameraFeed, 0, 0);
        const imageData = canvasContext.getImageData(0, 0, canvas.width, canvas.height);
        
        // Try all inversion attempts when forced
        const code = jsQR(imageData.data, imageData.width, imageData.height, {
            inversionAttempts: "attemptBoth",
        });

        if (code) {
            const qrValue = code.data.trim();
            if (qrValue) {
                lastScannedQr = qrValue;
                qrInput.value = qrValue;
                qrInput.focus();
                
                // Submit immediately
                document.getElementById('scan-form').submit();
            }
        } else {
            alert('No QR Code detected in this frame. Please make sure the code is clearly visible and try again.');
        }
    });

    // Start Camera
    async function startCamera() {
        try {
            toggleCameraBtn.disabled = true;
            const constraints = {
                video: { 
                    facingMode: 'environment',
                    width: { ideal: 1280 },
                    height: { ideal: 720 }
                }
            };
            
            cameraStream = await navigator.mediaDevices.getUserMedia(constraints);
            cameraFeed.srcObject = cameraStream;
            cameraFeed.play();
            cameraContainer.classList.remove('hidden');
            cameraActive = true;
            toggleCameraBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Close Camera';
            toggleCameraBtn.classList.add('bg-slate-500', 'hover:bg-slate-600');
            toggleCameraBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
            toggleCameraBtn.disabled = false;
            
            // Start scanning
            scanQRCode();
        } catch (error) {
            console.error('Error accessing camera:', error);
            alert('Could not access camera. Please check permissions.');
            toggleCameraBtn.disabled = false;
        }
    }

    // Stop Camera
    function stopCamera() {
        if (cameraStream) {
            cameraStream.getTracks().forEach(track => track.stop());
            cameraStream = null;
        }
        cameraContainer.classList.add('hidden');
        cameraActive = false;
        toggleCameraBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> Camera';
        toggleCameraBtn.classList.remove('bg-slate-500', 'hover:bg-slate-600');
        toggleCameraBtn.classList.add('bg-red-600', 'hover:bg-red-700');
    }

    // Scan QR Code
    function scanQRCode() {
        if (!cameraActive) return;

        if (cameraFeed.readyState === cameraFeed.HAVE_ENOUGH_DATA) {
            canvas.width = cameraFeed.videoWidth;
            canvas.height = cameraFeed.videoHeight;
            canvasContext.drawImage(cameraFeed, 0, 0);
            const imageData = canvasContext.getImageData(0, 0, canvas.width, canvas.height);
            const code = jsQR(imageData.data, imageData.width, imageData.height, {
                inversionAttempts: "attemptBoth",
            });

            if (code) {
                const qrValue = code.data.trim();
                if (qrValue && qrValue !== lastScannedQr) {
                    lastScannedQr = qrValue;
                    qrInput.value = qrValue;
                    qrInput.focus();
                    
                    // Auto-submit the form
                    setTimeout(() => {
                        document.getElementById('scan-form').submit();
                    }, 100);
                    
                    return; // Stop scanning after a successful scan
                }
            }
        }

        requestAnimationFrame(scanQRCode);
    }

    // Keep focus on the scanner input for continuous scanning
    document.addEventListener('DOMContentLoaded', function() {
        if(!cameraActive) {
            qrInput.focus();
        }
        
        // Re-focus when clicking anywhere outside of form inputs
        document.addEventListener('click', function(e) {
            if(!cameraActive && e.target.tagName !== 'INPUT' && e.target.tagName !== 'BUTTON' && e.target.tagName !== 'A') {
                qrInput.focus();
            }
        });

        // Reset lastScannedQr after form submission to allow re-scanning same code
        document.getElementById('scan-form').addEventListener('submit', function() {
            setTimeout(() => {
                lastScannedQr = null;
            }, 500);
        });
    });
</script>
@endsection
