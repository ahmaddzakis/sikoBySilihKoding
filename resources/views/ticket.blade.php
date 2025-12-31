<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - {{ $registration->event->judul }}</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#1a161f',
                        surface: '#26212c',
                        border: '#3a3442',
                        textMain: '#ededed',
                        textMuted: '#a1a1aa',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Outfit', sans-serif;
            background: #1a161f;
            color: #ededed;
        }

        .ticket-container {
            background: #26212c;
            border-radius: 1.5rem;
            /* box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5); */
            border: 1px solid #3a3442;
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            position: relative;
        }

        .ticket-header {
            background: linear-gradient(135deg, #ec4899 0%, #a855f7 100%);
            /* Pink to Purple */
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        /* Decorative circle in header */
        .ticket-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 60%);
            pointer-events: none;
        }

        .ticket-header h1 {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .ticket-content {
            padding: 2.5rem;
        }

        .info-row {
            display: flex;
            margin-bottom: 1.25rem;
            align-items: baseline;
        }

        .info-label {
            width: 120px;
            font-weight: 600;
            color: #a1a1aa;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .info-value {
            flex: 1;
            color: #ededed;
            font-size: 1rem;
            font-weight: 500;
        }

        .divider {
            height: 1px;
            background: #3a3442;
            margin: 2rem 0;
            position: relative;
        }
        
        /* Dashed divider look */
        .divider.dashed {
            background: transparent;
            border-top: 2px dashed #3a3442;
        }

        /* Cutout circles for ticket look */
        .ticket-container::before, .ticket-container::after {
            content: '';
            position: absolute;
            top: 260px; /* Adjust based on header/content height */
            width: 40px;
            height: 40px;
            background: #1a161f;
            border-radius: 50%;
            border: 1px solid #3a3442;
            z-index: 10;
        }
        
        .ticket-container::before { left: -20px; border-right-color: transparent; border-bottom-color: transparent;}
        .ticket-container::after { right: -20px; border-left-color: transparent; border-bottom-color: transparent;}


        .status-badge {
            background-color: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.4);
            color: #34d399;
            padding: 0.75rem 3rem;
            border-radius: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.95rem;
            letter-spacing: 0.05em;
        }
        
        .status-badge.pending {
            background-color: rgba(249, 115, 22, 0.2);
            border: 1px solid rgba(249, 115, 22, 0.4);
            color: #fb923c;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: #1a161f; /* Try to force dark bg in PDF */
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .ticket-container {
                box-shadow: none;
                border: 1px solid #3a3442;
            }
        }
    </style>
</head>

<body class="flex flex-col items-center justify-center min-h-screen p-6">

    <div id="ticket-capture" class="ticket-container">
        <!-- Header -->
        <div class="ticket-header">
            <div class="mb-2 opacity-80">
                <i class="fa-solid fa-ticket text-3xl"></i>
            </div>
            <h1>Bukti Pendaftaran</h1>
            <p class="text-white/80 text-sm mt-1 font-medium">SIKO EVENT</p>
        </div>

        <!-- Content -->
        <div class="ticket-content">
            <!-- Reg & Date -->
            <div class="flex justify-between items-center mb-8 bg-[#1a161f] p-4 rounded-xl border border-[#3a3442]">
                <div>
                    <div class="text-[#a1a1aa] text-xs font-bold uppercase tracking-wider mb-1">No. Registrasi</div>
                    <div class="text-white font-mono text-lg tracking-wide">{{ str_pad($registration->id, 3, '0', STR_PAD_LEFT) }}/REG/{{ $registration->created_at->format('m/Y') }}</div>
                </div>
                <div class="text-right">
                    <div class="text-[#a1a1aa] text-xs font-bold uppercase tracking-wider mb-1">Tanggal Acara</div>
                    <div class="text-white font-bold">{{ $registration->event->waktu_mulai->translatedFormat('d M Y') }}</div>
                </div>
            </div>

            <div class="divider dashed"></div>

            <!-- User & Event Info -->
            <div class="space-y-4">
                <div class="info-row">
                    <span class="info-label">Event</span>
                    <span class="info-value font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-500 text-xl">{{ $registration->event->judul }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Lokasi</span>
                    <span class="info-value flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-pink-500"></i>
                        {{ $registration->event->lokasi }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Peserta</span>
                    <span class="info-value uppercase">{{ $registration->name ?? $registration->user->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Kontak</span>
                    <span class="info-value">{{ $registration->phone ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Harga</span>
                    <span class="info-value">
                        @if($registration->event->harga_tiket > 0)
                            Rp {{ number_format($registration->event->harga_tiket, 0, ',', '.') }}
                        @else
                            Gratis
                        @endif
                    </span>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Status -->
            <div class="text-center">
                @if($registration->status === 'approved')
                    <div class="status-badge">
                        <i class="fa-solid fa-circle-check"></i>
                        Terkonfirmasi
                    </div>
                @else
                    <div class="status-badge pending">
                        <i class="fa-solid fa-hourglass-half"></i>
                        Menunggu Persetujuan
                    </div>
                @endif
            </div>
            
             <div class="mt-8 text-center">
                <p class="text-[#a1a1aa] text-xs">Simpan bukti ini sebagai tiket masuk acara.</p>
                <div class="mt-4 opacity-50">
                    <!-- Barcode dummy -->
                    <div class="h-12 bg-white/20 rounded mx-auto w-2/3"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <div class="mt-8 flex gap-4 no-print">
        <button id="download-btn"
            class="bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-500 hover:to-purple-500 text-white px-8 py-3 rounded-xl font-bold flex items-center gap-3 transition-all shadow-lg shadow-purple-500/20">
            <i class="fa-solid fa-download"></i>
            Unduh Tiket
        </button>
        <a href="{{ route('events.show', $registration->event_id) }}"
            class="bg-[#26212c] hover:bg-[#3a3442] text-gray-300 px-8 py-3 rounded-xl font-bold transition-all border border-[#3a3442]">
            Kembali
        </a>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        const btn = document.getElementById('download-btn');
        const element = document.getElementById('ticket-capture');

        function downloadPDF() {
            // Select the original element
            const element = document.getElementById('ticket-capture');
            
            // Create a wrapper to simulate the PDF page context (A4 width)
            // We append this to the body to ensure it renders, but we can position it absolutely
            const wrapper = document.createElement('div');
            wrapper.id = 'pdf-wrapper';
            wrapper.style.position = 'absolute';
            wrapper.style.left = '-9999px'; // Position off-screen to avoid flicker
            wrapper.style.top = '0';
            wrapper.style.width = '794px'; // A4 width (approx 210mm at 96dpi)
            // wrapper.style.minHeight = '1123px'; // A4 height (approx 297mm)
            wrapper.style.padding = '40px';
            wrapper.style.backgroundColor = '#1a161f'; // Dark background matching theme
            wrapper.style.color = '#ededed';
            wrapper.style.fontFamily = "'Outfit', sans-serif";
            
            // Clone the ticket
            const clone = element.cloneNode(true);
            clone.removeAttribute('id'); // Prevent duplicate IDs
            
            // Reset some styles on the clone to make it fit nicely in the PDF wrapper
            clone.style.margin = '0 auto'; // Center it
            clone.style.width = '100%';
            clone.style.maxWidth = '600px'; // Set a reasonable nice width for the ticket
            clone.style.boxShadow = 'none'; // Remove shadows might help rendering
            clone.style.border = '1px solid #3a3442';
            clone.style.borderRadius = '1.5rem';
            
            // Ensure background colors are preserved in the clone
            clone.style.background = '#26212c';
            
            wrapper.appendChild(clone);
            document.body.appendChild(wrapper);

            const opt = {
                margin: 0,
                filename: 'Tiket_SIKO_{{ $registration->event_id }}_{{ $registration->id }}.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { 
                    scale: 2, 
                    useCORS: true, 
                    backgroundColor: '#1a161f', // Match the wrapper bg
                    logging: true,
                    windowWidth: 794
                },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            // Generate PDF
            html2pdf().from(wrapper).set(opt).save().then(function() {
                // Cleanup
                document.body.removeChild(wrapper);
            });
        }

        btn.addEventListener('click', downloadPDF);
    </script>
</body>

</html>