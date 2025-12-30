<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - {{ $registration->event->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f7fa;
            color: #333;
        }

        .ticket-container {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
        }

        .ticket-header {
            background-color: #2563eb;
            /* Blue from image */
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .ticket-header h1 {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .ticket-content {
            padding: 2rem;
        }

        .info-row {
            display: flex;
            margin-bottom: 1.25rem;
            align-items: baseline;
        }

        .info-label {
            width: 120px;
            font-weight: 700;
            color: #1a1a1a;
            font-size: 0.95rem;
        }

        .info-value {
            flex: 1;
            color: #4b5563;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 1.5rem 0;
        }

        .status-badge {
            background-color: #10b981;
            /* Green from image */
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.95rem;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white;
            }

            .ticket-container {
                box-shadow: none;
                border: 1px solid #eee;
            }
        }
    </style>
</head>

<body class="flex flex-col items-center justify-center min-h-screen p-6">

    <div id="ticket-capture" class="ticket-container">
        <!-- Header -->
        <div class="ticket-header">
            <h1>Bukti Pendaftaran</h1>
        </div>

        <!-- Content -->
        <div class="ticket-content">
            <!-- Reg & Date -->
            <div class="space-y-1 mb-6">
                <div class="flex gap-2">
                    <span class="text-gray-500 font-medium text-sm text-[10px] uppercase">No. Registrasi:</span>
                    <span
                        class="text-gray-800 font-bold text-sm text-[10px]">{{ str_pad($registration->id, 3, '0', STR_PAD_LEFT) }}/REG/{{ $registration->created_at->format('m/Y') }}</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-gray-500 font-medium text-sm text-[10px] uppercase">Tanggal:</span>
                    <span
                        class="text-gray-800 font-bold text-sm text-[10px]">{{ $registration->event->waktu_mulai->translatedFormat('d F Y') }}</span>
                </div>
            </div>

            <div class="divider"></div>

            <!-- User & Event Info -->
            <div class="space-y-4">
                <div class="info-row">
                    <span class="info-label">Nama Acara:</span>
                    <span class="info-value font-bold text-blue-600">{{ $registration->event->judul }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Lokasi:</span>
                    <span class="info-value">{{ $registration->event->lokasi }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nama:</span>
                    <span class="info-value uppercase">{{ $registration->name ?? $registration->user->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">No. HP:</span>
                    <span class="info-value">{{ $registration->phone ?? '-' }}</span>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Status -->
            <div class="text-center mt-8">
                @if($registration->status === 'approved')
                    <div class="status-badge">
                        <i class="fa-solid fa-check"></i>
                        Terdaftar
                    </div>
                @else
                    <div class="status-badge !bg-orange-500">
                        <i class="fa-solid fa-hourglass-half"></i>
                        Menunggu
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Controls -->
    <div class="mt-8 flex gap-4 no-print">
        <button id="download-btn"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-bold flex items-center gap-2 transition-all">
            <i class="fa-solid fa-file-pdf"></i>
            Unduh PDF
        </button>
        <a href="{{ route('events.show', $registration->event_id) }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2.5 rounded-xl font-bold transition-all">
            Kembali ke Acara
        </a>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        const btn = document.getElementById('download-btn');
        const element = document.getElementById('ticket-capture');

        function downloadPDF() {
            const opt = {
                margin: 10,
                filename: 'Bukti_Pendaftaran_{{ $registration->id }}.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, useCORS: true },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().from(element).set(opt).save();
        }

        btn.addEventListener('click', downloadPDF);

        // Auto download on load
        window.addEventListener('load', () => {
            setTimeout(downloadPDF, 1000);
        });
    </script>
</body>

</html>