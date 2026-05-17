<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Auto-refresh the status every 30 seconds so the patient's phone stays updated -->
    <meta http-equiv="refresh" content="30">
    
    <title>Live Queue Status - Medicenter</title>
    
    <!-- Modern Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                        }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #f8fafc; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="text-slate-800 antialiased relative overflow-x-hidden min-h-screen flex flex-col">

    <!-- Decorative Background Blobs -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-brand-500/20 rounded-full mix-blend-multiply filter blur-[100px] animate-pulse-slow"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[600px] h-[600px] bg-emerald-400/20 rounded-full mix-blend-multiply filter blur-[120px] animate-pulse-slow" style="animation-delay: 2s;"></div>
    </div>

    <!-- Header / Navbar -->
    <nav class="glass-nav sticky top-0 z-50 transition-all duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-3 cursor-pointer" onclick="window.location.href='/'">
                    <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-700 rounded-xl flex items-center justify-center shadow-lg shadow-brand-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    </div>
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-brand-900 to-brand-600">Medicenter</span>
                </div>
                <div class="hidden md:flex items-center gap-8 font-medium text-sm text-slate-600">
                    <a href="/" class="hover:text-brand-600 transition-colors">Home</a>
                    <a href="#" class="hover:text-brand-600 transition-colors">Services</a>
                    <a href="#" class="hover:text-brand-600 transition-colors">Contact</a>
                    <a href="/" class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-lg transition-all shadow-md">New Registration</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10 w-full animate-fade-in-up">
        
        <!-- Status Container (Split Card) -->
        <div class="bg-white rounded-[2rem] sm:rounded-[2.5rem] shadow-2xl shadow-brand-900/5 border border-slate-100 overflow-hidden flex flex-col lg:flex-row relative">
            
            <!-- Left Side - Image Panel -->
            <div class="lg:w-5/12 relative hidden md:block min-h-[600px]">
                <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?q=80&w=2070&auto=format&fit=crop" alt="Healthcare" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 right-0 p-10 text-white">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-white mb-4">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-xs font-bold uppercase tracking-wider">Live Updates</span>
                    </div>
                    <h2 class="text-3xl font-bold mb-2">Track Your Turn<br>In Real-Time.</h2>
                    <p class="text-slate-300 text-sm">Please monitor your status. We will notify you when it's your turn to proceed to the counter.</p>
                </div>
            </div>

            <!-- Right Side - Live Status Dashboard -->
            <div class="lg:w-7/12 p-6 sm:p-12 relative flex flex-col justify-center">
                
                <!-- Patient Name & Status -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                    <div>
                        <p class="text-slate-400 font-semibold text-xs sm:text-sm uppercase tracking-wider mb-1">Live Status Dashboard</p>
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-800 tracking-tight">{{ $entry->patient->name }}</h2>
                    </div>
                    <div>
                        <span class="inline-flex items-center justify-center px-4 py-2 rounded-full text-sm font-bold shadow-sm {{ $entry->status === 'waiting' ? 'bg-amber-50 text-amber-600 border border-amber-100' : ($entry->status === 'called' || $entry->status === 'serving' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-100 text-slate-600 border border-slate-200') }}">
                            {{ ucfirst($entry->status) }}
                        </span>
                    </div>
                </div>

                <!-- Massive Queue Number -->
                <div class="bg-slate-50 rounded-[2rem] p-8 border border-slate-100 text-center mb-8 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-400 via-brand-600 to-emerald-400"></div>
                    <p class="text-slate-500 font-bold text-xs sm:text-sm uppercase tracking-widest mb-2">Your Queue Number</p>
                    <h1 class="text-7xl sm:text-8xl font-black bg-clip-text text-transparent bg-gradient-to-r from-brand-900 to-brand-600 tracking-tighter drop-shadow-sm">
                        {{ $entry->queue_number }}
                    </h1>
                    <div class="mt-4 flex flex-wrap items-center justify-center gap-2 text-xs sm:text-sm font-bold text-slate-600">
                        <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        <span class="bg-white px-3 py-1 rounded-md shadow-sm border border-slate-100">{{ $entry->patient->service }}</span>
                        <span class="bg-white px-3 py-1 rounded-md shadow-sm border border-slate-100">{{ $entry->patient->complaint }}</span>
                    </div>
                </div>

                <!-- Real-time Metrics Grid -->
                <div class="grid grid-cols-2 gap-3 sm:gap-4 mb-8">
                    <!-- Now Serving -->
                    <div class="bg-brand-50/70 rounded-2xl p-4 sm:p-5 border border-brand-100">
                        <p class="text-brand-600 text-[10px] sm:text-xs font-bold uppercase tracking-wider mb-1">Now Serving</p>
                        @if($currentCalled)
                            <p class="text-2xl sm:text-3xl font-black text-brand-700">{{ $currentCalled->queue_number }}</p>
                        @else
                            <p class="text-lg sm:text-xl font-bold text-slate-500 mt-1">Standby...</p>
                        @endif
                    </div>
                    
                    <!-- Ahead of You -->
                    <div class="bg-rose-50/70 rounded-2xl p-4 sm:p-5 border border-rose-100">
                        <p class="text-rose-600 text-[10px] sm:text-xs font-bold uppercase tracking-wider mb-1">Ahead of You</p>
                        <p class="text-2xl sm:text-3xl font-black text-rose-600">
                            {{ $waitingAhead }} <span class="text-sm sm:text-base font-bold text-rose-400">person(s)</span>
                        </p>
                    </div>

                    <!-- Wait Time -->
                    <div class="bg-emerald-50/70 rounded-2xl p-4 sm:p-5 border border-emerald-100 col-span-2">
                        <p class="text-emerald-600 text-[10px] sm:text-xs font-bold uppercase tracking-wider mb-1">Estimated Wait Time</p>
                        <p class="text-2xl sm:text-3xl font-black text-emerald-600">
                            {{ $estimatedMinutes }} <span class="text-sm sm:text-base font-bold text-emerald-500">minutes</span>
                        </p>
                    </div>
                </div>

                <!-- Action Options Grid -->
                @if($entry->status === 'waiting')
                    <div class="mt-2 pt-6 border-t border-slate-100">
                        <p class="text-sm font-bold text-slate-800 mb-4 tracking-tight">Manage Your Appointment</p>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            
                            <!-- Refresh Button -->
                            <button onclick="window.location.reload();" class="w-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold rounded-xl text-sm px-4 py-3.5 flex items-center justify-center gap-2 transition-all duration-200 border border-blue-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Refresh
                            </button>
                            
                            <!-- Edit Button -->
                            <a href="{{ route('queue.edit', $entry->queue_number) }}" class="w-full bg-slate-100 text-slate-700 hover:bg-slate-800 hover:text-white font-semibold rounded-xl text-sm px-4 py-3.5 flex items-center justify-center gap-2 transition-all duration-200 border border-slate-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit Details
                            </a>

                            <!-- Delete / Cancel Button -->
                            <form method="POST" action="{{ route('queue.cancel', $entry->queue_number) }}" class="m-0" onsubmit="return confirm('Are you sure you want to delete/cancel your queue? This cannot be undone.');">
                                @csrf
                                <button type="submit" class="w-full bg-red-50 text-red-600 hover:bg-red-600 hover:text-white font-semibold rounded-xl text-sm px-4 py-3.5 flex items-center justify-center gap-2 transition-all duration-200 border border-red-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Delete
                                </button>
                            </form>

                        </div>
                    </div>
                @else
                    <div class="mt-4 p-5 bg-slate-50 border border-slate-200 rounded-2xl flex items-start gap-3">
                        <svg class="w-5 h-5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-sm font-medium text-slate-600">Your queue entry cannot be modified because it has already been called or processed by the admin.</p>
                    </div>
                @endif

            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="mt-auto bg-white border-t border-slate-200 py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-brand-600 rounded-md flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                </div>
                <span class="font-bold text-slate-800 text-lg">Medicenter</span>
            </div>
            <p class="text-slate-500 text-sm">&copy; 2026 Medicenter. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>