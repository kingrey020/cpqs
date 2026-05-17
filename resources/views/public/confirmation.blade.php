<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queue Confirmation - Medicenter</title>
    
    <!-- Modern Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config for Custom Colors & Animations -->
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
                        'scale-pop': 'scalePop 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        scalePop: {
                            '0%': { transform: 'scale(0.5)', opacity: '0' },
                            '60%': { transform: 'scale(1.1)' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #f8fafc;
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Glass Utilities */
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="text-slate-800 antialiased relative overflow-x-hidden min-h-screen flex flex-col">

    <!-- Decorative Background Blobs -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-brand-500/20 rounded-full mix-blend-multiply filter blur-[100px] animate-pulse-slow"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[500px] h-[500px] bg-teal-400/20 rounded-full mix-blend-multiply filter blur-[120px] animate-pulse-slow" style="animation-delay: 2s;"></div>
    </div>

    <!-- Header / Navbar -->
    <nav class="glass-nav sticky top-0 z-50 transition-all duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-3 cursor-pointer">
                    <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-700 rounded-xl flex items-center justify-center shadow-lg shadow-brand-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-brand-900 to-brand-600">Medicenter</span>
                </div>
                <div class="hidden md:flex items-center gap-8 font-medium text-sm text-slate-600">
                    <a href="/" class="hover:text-brand-600 transition-colors">Home</a>
                    <a href="#" class="hover:text-brand-600 transition-colors">Services</a>
                    <a href="#" class="hover:text-brand-600 transition-colors">About</a>
                    <a href="#" class="hover:text-brand-600 transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <!-- Fixed Mobile Layout: Uses m-auto instead of items-center to prevent clipping when scrolling -->
    <div class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex flex-col">
        
        <!-- Unified Card -->
        <div class="w-full m-auto bg-white rounded-[2rem] shadow-2xl shadow-brand-900/5 border border-slate-100 overflow-hidden flex flex-col lg:flex-row animate-fade-in-up">
            
            <!-- Left Side - Image & Features Overlay -->
            <div class="lg:w-5/12 relative hidden md:flex flex-col justify-end min-h-[600px]">
                <!-- FIXED IMAGE URL HERE -->
                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
                     alt="Modern Clinic Waiting Area" class="absolute inset-0 w-full h-full object-cover">
                
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-brand-900 via-brand-900/80 to-brand-900/20"></div>
                
                <!-- Overlay Content -->
                <div class="relative z-10 p-10 text-white w-full">
                    <h2 class="text-3xl font-bold mb-3 leading-tight">You're in line.</h2>
                    <p class="text-brand-100 text-sm mb-8">Please review your queue details and wait for your number to be called.</p>
                    
                    <div class="space-y-4">
                        <div class="glass-card rounded-xl p-4 flex items-start gap-4">
                            <div class="text-2xl mt-1">📍</div>
                            <div>
                                <h4 class="font-semibold text-sm">What's Next</h4>
                                <p class="text-xs text-brand-100 mt-0.5 leading-relaxed">Wait in the designated lounge area and listen for your queue number.</p>
                            </div>
                        </div>
                        <div class="glass-card rounded-xl p-4 flex items-start gap-4">
                            <div class="text-2xl mt-1">⏰</div>
                            <div>
                                <h4 class="font-semibold text-sm">Track Your Position</h4>
                                <p class="text-xs text-brand-100 mt-0.5 leading-relaxed">Keep this page open or use the link to check your status anytime.</p>
                            </div>
                        </div>
                        <div class="glass-card rounded-xl p-4 flex items-start gap-4">
                            <div class="text-2xl mt-1">❓</div>
                            <div>
                                <h4 class="font-semibold text-sm">Have Questions?</h4>
                                <p class="text-xs text-brand-100 mt-0.5 leading-relaxed">Approach our front desk staff for immediate assistance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Confirmation Information -->
            <div class="lg:w-7/12 p-8 sm:p-12 flex flex-col justify-center">
                
                <!-- Success Header -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-emerald-100 mb-5 animate-scale-pop shadow-lg shadow-emerald-500/20">
                        <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Registration Successful!</h2>
                    <p class="text-slate-500 mt-2 text-sm font-medium">Your spot in the clinic queue is confirmed.</p>
                </div>

                <!-- Digital Ticket Area (Bulletproof Tailwind Fix) -->
                <div class="mb-8">
                    <div class="bg-gradient-to-br from-brand-600 to-brand-800 rounded-2xl p-8 text-center relative shadow-xl shadow-brand-600/20 border border-brand-500 overflow-hidden">
                        
                        <!-- Dashed border inner layer -->
                        <div class="absolute inset-2 border-2 border-dashed border-white/20 rounded-xl pointer-events-none"></div>
                        
                        <!-- Left & Right Circular Cutouts (Fixes Safari/iOS CSS Mask Bugs) -->
                        <div class="absolute top-1/2 -left-4 w-8 h-8 bg-white rounded-full transform -translate-y-1/2 border border-brand-500 pointer-events-none"></div>
                        <div class="absolute top-1/2 -right-4 w-8 h-8 bg-white rounded-full transform -translate-y-1/2 border border-brand-500 pointer-events-none"></div>
                        
                        <p class="text-brand-100 text-xs font-bold uppercase tracking-[0.2em] mb-2 relative z-10">Your Queue Number</p>
                        <p class="text-6xl sm:text-7xl font-black text-white tracking-tighter drop-shadow-md relative z-10">{{ $entry->queue_number }}</p>
                    </div>
                </div>

                <!-- Patient & Visit Details Grid -->
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 mb-6 grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Department</p>
                            <p class="text-sm font-bold text-slate-800">{{ $patient->service }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Visit Purpose</p>
                            <p class="text-sm font-bold text-slate-800">{{ $patient->complaint }}</p>
                        </div>
                    </div>
                </div>

                <!-- Live Metrics Grid -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <!-- Wait Time -->
                    <div class="bg-amber-50 rounded-2xl p-5 border border-amber-100 flex flex-col justify-center relative overflow-hidden">
                        <div class="flex items-center gap-2 mb-2 relative z-10">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-xs text-amber-700 font-bold uppercase tracking-wider">Est. Wait</p>
                        </div>
                        <p class="text-3xl font-black text-amber-600 leading-none relative z-10">{{ $estimatedMinutes }}<span class="text-sm font-bold text-amber-500 ml-1">min</span></p>
                    </div>

                    <!-- Ahead of You -->
                    <div class="bg-indigo-50 rounded-2xl p-5 border border-indigo-100 flex flex-col justify-center relative overflow-hidden">
                        <div class="flex items-center gap-2 mb-2 relative z-10">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <p class="text-xs text-indigo-700 font-bold uppercase tracking-wider">Ahead of You</p>
                        </div>
                        <p class="text-3xl font-black text-indigo-600 leading-none relative z-10">{{ $waitingAhead }}<span class="text-sm font-bold text-indigo-500 ml-1">people</span></p>
                    </div>
                </div>

                <!-- Alert/Notification -->
                <div class="mb-8 flex items-start sm:items-center gap-3 p-4 bg-brand-50 rounded-xl border border-brand-100">
                    <div class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center shrink-0 mt-0.5 sm:mt-0">
                        <svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-sm text-brand-800 font-medium">Keep your phone nearby. You'll be notified when it's your turn.</p>
                </div>

                <!-- Actions Container -->
                <div class="space-y-3">
                    <!-- Primary Action -->
                    <a href="{{ route('queue.status', $entry->queue_number) }}" class="flex items-center justify-center w-full bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-700 hover:to-brand-600 text-white font-semibold rounded-xl text-base px-6 py-4 shadow-lg shadow-brand-500/30 transform transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0 gap-2">
                        View Live Queue Status
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>

                    <!-- Secondary Actions Grid (Fixed Mobile Layout) -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('queue.edit', $entry->queue_number) }}" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-white border border-slate-200 text-slate-700 font-semibold rounded-xl text-sm hover:bg-slate-50 transition-colors">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            Edit Details
                        </a>
                        
                        <form method="POST" action="{{ route('queue.cancel', $entry->queue_number) }}" class="flex-1 w-full" onsubmit="return confirm('Are you sure you want to cancel your queue entry?');">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white border border-red-200 text-red-600 font-semibold rounded-xl text-sm hover:bg-red-50 hover:border-red-300 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Cancel Spot
                            </button>
                        </form>
                    </div>

                    <!-- Return Home -->
                    <div class="text-center mt-6 pt-4">
                        <a href="/" class="text-sm font-semibold text-slate-500 hover:text-brand-600 transition-colors inline-flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Return to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-auto py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-brand-600 rounded-md flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                </div>
                <span class="font-bold text-slate-800 text-lg">Medicenter</span>
            </div>
            <p class="text-slate-500 text-sm">&copy; 2025 Medicenter. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>