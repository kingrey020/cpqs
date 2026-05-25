<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queue Management - Medicenter Admin</title>
    
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
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="text-slate-800 antialiased relative overflow-x-hidden min-h-screen flex flex-col">

    <!-- Decorative Background Blobs -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-brand-500/10 rounded-full mix-blend-multiply filter blur-[100px] animate-pulse-slow"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[500px] h-[500px] bg-emerald-400/10 rounded-full mix-blend-multiply filter blur-[100px] animate-pulse-slow" style="animation-delay: 2s;"></div>
    </div>

    <!-- Admin Navbar -->
    <nav class="glass-nav sticky top-0 z-50 transition-all duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-700 rounded-xl flex items-center justify-center shadow-lg shadow-brand-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-800 leading-none mb-1">Medicenter</h1>
                        <p class="text-[11px] font-semibold tracking-wider text-brand-600 uppercase">Admin Portal</p>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center gap-6 font-semibold text-sm">
                    <a href="/admin/dashboard" class="text-slate-500 hover:text-brand-600 hover:bg-slate-50 px-3 py-2 rounded-lg transition-colors">Dashboard</a>
                    <a href="/admin/queue" class="text-brand-600 px-3 py-2 bg-brand-50 rounded-lg transition-colors">Manage Queue</a>
                    
                    <div class="h-6 w-px bg-slate-200 mx-2"></div> <!-- Divider -->
                    
                    <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 text-slate-500 hover:text-red-600 hover:bg-red-50 px-4 py-2 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full animate-fade-in-up">
        
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Queue Management</h2>
            <p class="text-slate-500 mt-1 text-sm">Organize patients, call the next in line, and manage entries.</p>
        </div>

        <!-- Action Center Card -->
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40 p-8 md:p-12 mb-10 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8">
            
            <div class="absolute right-0 top-0 w-64 h-64 bg-gradient-to-br from-brand-50 to-emerald-50 rounded-full filter blur-[60px] opacity-70 pointer-events-none"></div>

            <div class="relative z-10 w-full md:w-1/2 text-center md:text-left">
                @if($currentCalled ?? false)
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-600 mb-4">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-xs font-bold uppercase tracking-wider">Currently Serving</span>
                    </div>
                    <div class="flex flex-col md:flex-row items-center gap-4 md:gap-6">
                        <h3 class="text-7xl font-black text-slate-800 tracking-tighter">{{ $currentCalled->queue_number }}</h3>
                        <div class="text-center md:text-left">
                            <p class="text-lg font-bold text-slate-700">{{ $currentCalled->patient->name }}</p>
                            <p class="text-sm font-medium text-slate-400">{{ $currentCalled->patient->service }} • {{ $currentCalled->patient->complaint }}</p>
                        </div>
                    </div>
                @else
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-50 border border-amber-100 text-amber-600 mb-4">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        <span class="text-xs font-bold uppercase tracking-wider">Standby</span>
                    </div>
                    <h3 class="text-3xl font-bold text-slate-800 tracking-tight mb-2">Ready to Call Next</h3>
                    <p class="text-slate-500 text-sm">No patient is currently at the counter.</p>
                @endif
            </div>

            <div class="relative z-10 w-full md:w-auto shrink-0 text-center">
                <form method="POST" action="{{ route('admin.queue.callNext') }}" class="m-0">
                    @csrf
                    <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-emerald-500 to-emerald-400 hover:from-emerald-600 hover:to-emerald-500 text-white font-bold rounded-2xl text-lg px-10 py-5 shadow-lg shadow-emerald-500/30 transform transition-all duration-200 hover:-translate-y-1 active:translate-y-0 flex items-center justify-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                        Call Next Patient
                    </button>
                </form>
            </div>
        </div>

        <!-- Organized Queue List -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden" id="queue-table-section">
            
            <div class="px-6 py-4 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/50">
                <div class="flex items-center gap-1 p-1 bg-slate-200/50 rounded-xl overflow-x-auto w-full md:w-auto" id="filter-tabs">
                    <button data-filter="all" class="tab-btn px-4 py-2 text-sm font-bold bg-white text-brand-600 rounded-lg shadow-sm whitespace-nowrap transition-all">All Patients</button>
                    <button data-filter="waiting" class="tab-btn px-4 py-2 text-sm font-bold text-slate-500 hover:text-slate-800 whitespace-nowrap transition-all">Waiting</button>
                    <button data-filter="serving" class="tab-btn px-4 py-2 text-sm font-bold text-slate-500 hover:text-slate-800 whitespace-nowrap transition-all">Serving</button>
                    <button data-filter="completed" class="tab-btn px-4 py-2 text-sm font-bold text-slate-500 hover:text-slate-800 whitespace-nowrap transition-all">Completed</button>
                </div>

                <div class="relative w-full md:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" id="searchInput" placeholder="Search patient or queue..." class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white text-slate-400 text-xs uppercase tracking-wider font-bold border-b border-slate-100">
                            <th class="px-6 py-4">Queue #</th>
                            <th class="px-6 py-4">Patient Info</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Time Registered</th>
                            <th class="px-6 py-4 text-right">Manage</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="queueTableBody">
                    @forelse($entries as $e)
                        <tr class="queue-row hover:bg-slate-50/50 transition-colors group" data-status="{{ strtolower($e->status) }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-xl font-black text-brand-600 bg-brand-50 px-3 py-1 rounded-lg border border-brand-100 queue-num">{{ $e->queue_number }}</span>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-bold text-slate-800 patient-name">{{ $e->patient->name }}</p>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs font-semibold text-slate-500 patient-service">{{ $e->patient->service }}</span>
                                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                    <span class="text-xs font-semibold text-slate-400">{{ $e->patient->complaint }}</span>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($e->status === 'waiting')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-600 border border-amber-100">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Waiting
                                    </span>
                                @elseif($e->status === 'called')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-brand-50 text-brand-600 border border-brand-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-brand-500 animate-pulse"></span>
                                        Called
                                    </span>
                                @elseif($e->status === 'serving')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                        Serving
                                    </span>
                                @elseif($e->status === 'completed')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        {{ ucfirst($e->status) }}
                                    </span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-500">
                                {{ $e->created_at->format('h:i A') }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex justify-end gap-2">
                                    
                                    @if($e->status === 'called' || $e->status === 'serving')
                                        <form method="POST" action="{{ route('admin.queue.serve', $e->id) }}" class="m-0 action-form">
                                            @csrf
                                            <button type="submit" title="Mark as Completed" class="w-9 h-9 flex items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if($e->status === 'waiting' || $e->status === 'called')
                                        <form method="POST" action="{{ route('admin.queue.skip', $e->id) }}" class="m-0 action-form">
                                            @csrf
                                            <button type="submit" title="Skip Patient" class="w-9 h-9 flex items-center justify-center rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.933 12.8a1 1 0 000-1.6L6.6 7.2A1 1 0 005 8v8a1 1 0 001.6.8l5.333-4zM19.933 12.8a1 1 0 000-1.6l-5.333-4A1 1 0 0013 8v8a1 1 0 001.6.8l5.333-4z"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <!-- CANCEL QUEUE STATUS BUTTON -->
                                    @if($e->status === 'waiting')
                                        <form method="POST" action="{{ route('admin.queue.cancel', $e->id) }}" class="m-0 action-form" 
                                              onsubmit="openModal(event, 'Cancel Queue Status', 'Are you sure you want to cancel this queue entry? The patient will be marked as cancelled but the record will remain.', 'Yes, Cancel Status', 'bg-gradient-to-r from-orange-500 to-orange-600 shadow-orange-500/30 hover:from-orange-600 hover:to-orange-700', 'text-orange-500 bg-orange-50 border-orange-100')">
                                            @csrf
                                            <button type="submit" title="Cancel Queue Status" class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-orange-500 hover:text-white transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- HARD DELETE PERMANENTLY BUTTON -->
                                    <form method="POST" action="{{ route('admin.queue.destroy', $e->id) }}" class="m-0 action-form" 
                                          onsubmit="openModal(event, 'Permanently Delete Record', 'WARNING: Are you sure you want to permanently delete this record? This action cannot be undone and all data will be lost.', 'Delete Permanently', 'bg-gradient-to-r from-red-500 to-red-600 shadow-red-500/30 hover:from-red-600 hover:to-red-700', 'text-red-500 bg-red-50 border-red-100')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Delete Permanently" class="w-9 h-9 flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="empty-state">
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                    <svg class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <p class="text-base font-bold text-slate-700">No patients found</p>
                                <p class="text-sm font-medium text-slate-400 mt-1">The queue is currently empty.</p>
                            </td>
                        </tr>
                    @endforelse
                    
                        <tr id="no-results-row" class="hidden">
                            <td colspan="5" class="px-6 py-16 text-center">
                                <p class="text-base font-bold text-slate-700">No matching patients</p>
                                <p class="text-sm font-medium text-slate-400 mt-1">Try adjusting your search or filter.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- CUSTOM CONFIRMATION MODAL -->
    <div id="custom-modal" class="fixed inset-0 z-[100] hidden items-center justify-center">
        <!-- Blur Backdrop -->
        <div id="modal-backdrop" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm opacity-0 transition-opacity duration-300" onclick="closeModal()"></div>
        
        <!-- Modal Panel -->
        <div id="modal-panel" class="relative bg-white rounded-3xl shadow-2xl w-full max-w-sm mx-4 p-8 transform scale-95 opacity-0 transition-all duration-300">
            <!-- Icon -->
            <div id="modal-icon-container" class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 border shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            
            <h3 id="modal-title" class="text-xl font-bold text-slate-800 tracking-tight mb-2">Confirm Action</h3>
            <p id="modal-message" class="text-slate-500 text-sm mb-8 leading-relaxed">Are you sure?</p>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <button type="button" onclick="closeModal()" class="w-full sm:w-1/2 px-4 py-3 rounded-xl text-slate-600 font-bold bg-slate-100 hover:bg-slate-200 transition-colors border border-slate-200 text-sm">Cancel</button>
                <button type="button" id="modal-confirm-btn" onclick="executeModalAction()" class="w-full sm:w-1/2 px-4 py-3 rounded-xl text-white font-bold transition-all shadow-lg hover:-translate-y-0.5 text-sm">Confirm</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-auto py-8 text-center border-t border-slate-200 bg-white">
        <p class="text-slate-400 text-sm font-medium">&copy; 2026 Medicenter Admin Panel. All rights reserved.</p>
    </footer>

    <!-- JavaScript Base -->
    <script>
        // ==========================================
        // 1. CUSTOM MODAL LOGIC
        // ==========================================
        let formToSubmit = null;

        function openModal(event, title, message, btnText, btnColorClass, iconColorClass) {
            event.preventDefault(); // Stop form from submitting immediately
            formToSubmit = event.target; // Save the form that was clicked

            // Set Texts
            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-message').innerText = message;
            
            // Set Button Colors & Text
            const confirmBtn = document.getElementById('modal-confirm-btn');
            confirmBtn.innerText = btnText;
            confirmBtn.className = `w-full sm:w-1/2 px-4 py-3 rounded-xl text-white font-bold transition-all shadow-lg hover:-translate-y-0.5 text-sm ${btnColorClass}`;

            // Set Icon Colors (Orange for Cancel, Red for Delete)
            const iconContainer = document.getElementById('modal-icon-container');
            iconContainer.className = `w-16 h-16 rounded-2xl flex items-center justify-center mb-6 border shadow-inner ${iconColorClass}`;

            // Show Modal Container
            const modal = document.getElementById('custom-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Trigger Fade & Scale Animation
            setTimeout(() => {
                document.getElementById('modal-backdrop').classList.remove('opacity-0');
                document.getElementById('modal-backdrop').classList.add('opacity-100');
                
                document.getElementById('modal-panel').classList.remove('scale-95', 'opacity-0');
                document.getElementById('modal-panel').classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            // Animate out
            document.getElementById('modal-backdrop').classList.remove('opacity-100');
            document.getElementById('modal-backdrop').classList.add('opacity-0');
            
            document.getElementById('modal-panel').classList.remove('scale-100', 'opacity-100');
            document.getElementById('modal-panel').classList.add('scale-95', 'opacity-0');
            
            // Hide container after animation
            setTimeout(() => {
                const modal = document.getElementById('custom-modal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                formToSubmit = null; // Clear the saved form
            }, 300);
        }

        function executeModalAction() {
            if (formToSubmit) {
                // Save scroll state before final submit
                sessionStorage.setItem('adminQueueScroll', window.scrollY);
                formToSubmit.submit();
            }
        }


        // ==========================================
        // 2. SCROLL & FILTER MEMORY SYSTEM
        // ==========================================
        document.addEventListener('DOMContentLoaded', function() {
            
            // Restore scroll position instantly if it exists
            const savedScroll = sessionStorage.getItem('adminQueueScroll');
            if (savedScroll) {
                window.scrollTo({ top: parseInt(savedScroll, 10), behavior: 'instant' });
                sessionStorage.removeItem('adminQueueScroll');
            }

            // Save scroll state for normal action buttons (Serve, Skip)
            document.querySelectorAll('.action-form').forEach(form => {
                // Ignore forms that trigger modals, they save scroll inside executeModalAction()
                if (!form.hasAttribute('onsubmit')) {
                    form.addEventListener('submit', function() {
                        sessionStorage.setItem('adminQueueScroll', window.scrollY);
                    });
                }
            });

            // ==========================================
            // 3. LIVE FILTER & TAB SYSTEM
            // ==========================================
            const searchInput = document.getElementById('searchInput');
            const tabButtons = document.querySelectorAll('.tab-btn');
            const rows = document.querySelectorAll('.queue-row');
            const noResultsRow = document.getElementById('no-results-row');
            const emptyStateRow = document.getElementById('empty-state');
            
            let currentFilter = sessionStorage.getItem('adminQueueFilter') || 'all';
            let searchQuery = '';

            function updateTabStyles(activeFilter) {
                tabButtons.forEach(t => {
                    if (t.getAttribute('data-filter') === activeFilter) {
                        t.className = "tab-btn px-4 py-2 text-sm font-bold bg-white text-brand-600 rounded-lg shadow-sm whitespace-nowrap transition-all";
                    } else {
                        t.className = "tab-btn px-4 py-2 text-sm font-bold text-slate-500 hover:text-slate-800 whitespace-nowrap transition-all";
                    }
                });
            }

            searchInput.addEventListener('input', function(e) {
                searchQuery = e.target.value.toLowerCase();
                filterTable();
            });

            tabButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    currentFilter = this.getAttribute('data-filter');
                    sessionStorage.setItem('adminQueueFilter', currentFilter);
                    updateTabStyles(currentFilter);
                    filterTable();
                });
            });

            function filterTable() {
                let visibleCount = 0;

                rows.forEach(row => {
                    const status = row.getAttribute('data-status');
                    const textContent = row.textContent.toLowerCase();
                    
                    let matchesStatus = false;
                    if (currentFilter === 'all') {
                        matchesStatus = true;
                    } else if (currentFilter === 'serving' && (status === 'serving' || status === 'called')) {
                        matchesStatus = true;
                    } else if (status === currentFilter) {
                        matchesStatus = true;
                    }

                    const matchesSearch = textContent.includes(searchQuery);

                    if (matchesStatus && matchesSearch) {
                        row.style.display = ''; 
                        visibleCount++;
                    } else {
                        row.style.display = 'none'; 
                    }
                });

                if (emptyStateRow) {
                    emptyStateRow.style.display = rows.length === 0 ? '' : 'none';
                }
                
                if (visibleCount === 0 && rows.length > 0) {
                    noResultsRow.classList.remove('hidden');
                } else {
                    noResultsRow.classList.add('hidden');
                }
            }

            updateTabStyles(currentFilter);
            filterTable();
        });
    </script>
</body>
</html>