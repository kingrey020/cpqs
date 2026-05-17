<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Medicenter</title>
    
    <!-- Modern Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    
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
                    <a href="/admin/dashboard" class="text-brand-600 px-3 py-2 bg-brand-50 rounded-lg transition-colors">Dashboard</a>
                    <a href="/admin/queue" class="text-slate-500 hover:text-brand-600 hover:bg-slate-50 px-3 py-2 rounded-lg transition-colors">Manage Queue</a>
                    
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

    <!-- Main Dashboard Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full space-y-8 animate-fade-in-up">
        
        <!-- Welcome Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-2">
            <div>
                <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Overview</h2>
                <p class="text-slate-500 mt-1 text-sm">Real-time metrics and clinic performance.</p>
            </div>
            <p class="text-sm font-medium text-slate-500 bg-white px-4 py-2 rounded-lg border border-slate-200 shadow-sm">
                Date: <span class="text-slate-800">{{ now()->format('l, F j, Y') }}</span>
            </p>
        </div>

        <!-- 1. Key Metrics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Patients -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-xl shadow-slate-200/40 cursor-pointer group hover:-translate-y-1 transition-all duration-300" onclick="window.location.href='/admin/queue'">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-800 mb-1">{{ $totalPatientsToday }}</h3>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Today</p>
                </div>
            </div>

            <!-- Waiting -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-xl shadow-slate-200/40 group hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-800 mb-1">{{ $patientsWaiting }}</h3>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Waiting</p>
                </div>
            </div>

            <!-- Serving -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-xl shadow-slate-200/40 group hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-800 mb-1">{{ $currentlyServing }}</h3>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Currently Serving</p>
                </div>
            </div>

            <!-- Completed -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-xl shadow-slate-200/40 group hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 rounded-xl bg-violet-50 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-800 mb-1">{{ $completedToday }}</h3>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Completed</p>
                </div>
            </div>
        </div>

        <!-- 2. Analytics & Performance -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Doughnut Chart -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-xl shadow-slate-200/40 lg:col-span-1 flex flex-col">
                <h3 class="text-lg font-bold text-slate-800 mb-6">Queue Status</h3>
                <div class="flex-grow flex items-center justify-center relative min-h-[250px]">
                    <canvas id="queueChart" class="max-w-[250px] max-h-[250px]"></canvas>
                    <!-- Center Overlay -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none mb-6">
                        <span class="text-4xl font-black text-slate-800">{{ $totalPatientsToday }}</span>
                        <span class="text-[10px] uppercase font-bold text-slate-400 tracking-widest mt-1">Total</span>
                    </div>
                </div>
            </div>

            <!-- Performance Progress -->
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-xl shadow-slate-200/40 lg:col-span-2 flex flex-col justify-center">
                <h3 class="text-lg font-bold text-slate-800 mb-6">Performance Metrics</h3>
                
                <div class="space-y-8">
                    <!-- Efficiency -->
                    <div>
                        <div class="flex justify-between items-end mb-3">
                            <div>
                                <span class="text-slate-700 font-bold block mb-1">Queue Efficiency</span>
                                <span class="text-xs font-medium text-slate-400">Patients completed vs total registered</span>
                            </div>
                            <span class="text-brand-600 font-black text-2xl">
                                @php $efficiency = $totalPatientsToday > 0 ? round(($completedToday / $totalPatientsToday) * 100) : 0; @endphp
                                {{ $efficiency }}%
                            </span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden border border-slate-200/60">
                            <div class="bg-gradient-to-r from-brand-500 to-brand-600 h-full rounded-full transition-all duration-1000" style="width: {{ $efficiency }}%"></div>
                        </div>
                    </div>

                    <!-- Wait Volume -->
                    <div>
                        <div class="flex justify-between items-end mb-3">
                            <div>
                                <span class="text-slate-700 font-bold block mb-1">Wait Volume</span>
                                <span class="text-xs font-medium text-slate-400">Percentage of total patients currently waiting</span>
                            </div>
                            <span class="text-amber-500 font-black text-2xl">
                                @php $waitVol = round($patientsWaiting / max(1, $totalPatientsToday) * 100); @endphp
                                {{ $waitVol }}%
                            </span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden border border-slate-200/60">
                            <div class="bg-gradient-to-r from-amber-400 to-amber-500 h-full rounded-full transition-all duration-1000" style="width: {{ $waitVol }}%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex items-center gap-3 p-4 bg-brand-50 rounded-xl border border-brand-100">
                    <svg class="w-5 h-5 text-brand-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-sm text-brand-800 font-medium">You have successfully served <strong class="text-brand-900">{{ $completedToday }}</strong> out of <strong class="text-brand-900">{{ $totalPatientsToday }}</strong> patients today.</p>
                </div>
            </div>
        </div>

        <!-- 3. Breakdowns -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Departments -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-xl shadow-slate-200/40">
                <div class="flex items-center gap-2 mb-6">
                    <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <h3 class="text-lg font-bold text-slate-800">Department Volume</h3>
                </div>
                <div class="space-y-1">
                    @forelse($serviceBreakdown as $service => $count)
                        <div class="flex items-center justify-between p-3 hover:bg-slate-50 rounded-xl transition-colors border-b border-slate-100 last:border-0">
                            <div>
                                <p class="font-bold text-slate-700">{{ $service }}</p>
                                <p class="text-xs text-slate-400 font-medium">{{ $count }} patient{{ $count > 1 ? 's' : '' }}</p>
                            </div>
                            <div class="bg-slate-100 text-slate-700 px-3 py-1 rounded-full text-sm font-bold">{{ $count }}</div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-slate-400 text-sm font-medium border-2 border-dashed border-slate-100 rounded-xl">No data available</div>
                    @endforelse
                </div>
            </div>

            <!-- Purposes -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-xl shadow-slate-200/40">
                <div class="flex items-center gap-2 mb-6">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <h3 class="text-lg font-bold text-slate-800">Visit Purposes</h3>
                </div>
                <div class="space-y-1">
                    @forelse($complaintBreakdown as $complaint => $count)
                        <div class="flex items-center justify-between p-3 hover:bg-slate-50 rounded-xl transition-colors border-b border-slate-100 last:border-0">
                            <div>
                                <p class="font-bold text-slate-700">{{ $complaint }}</p>
                                <p class="text-xs text-slate-400 font-medium">{{ $count }} patient{{ $count > 1 ? 's' : '' }}</p>
                            </div>
                            <div class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-sm font-bold">{{ $count }}</div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-slate-400 text-sm font-medium border-2 border-dashed border-slate-100 rounded-xl">No data available</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- 4. Active Table -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <h3 class="text-lg font-bold text-slate-800">Live Waiting Patients</h3>
                </div>
                <a href="/admin/queue" class="text-sm font-semibold text-brand-600 hover:text-brand-800 transition-colors">View All &rarr;</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-400 text-xs uppercase tracking-wider font-bold">
                            <th class="px-6 py-4">Queue #</th>
                            <th class="px-6 py-4">Patient Name</th>
                            <th class="px-6 py-4">Department</th>
                            <th class="px-6 py-4">Purpose</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($waitingPatients as $patient)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-lg font-black text-slate-800">{{ $patient->queue_number }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-700">
                                    {{ $patient->patient->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-600">
                                        {{ $patient->patient->service }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-bold bg-brand-50 text-brand-600">
                                        {{ $patient->patient->complaint }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-600 border border-amber-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        {{ ucfirst($patient->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    <p class="text-sm font-medium text-slate-500">No patients are currently waiting.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 5. Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="/admin/queue" class="bg-white rounded-2xl p-6 border border-slate-100 shadow-lg shadow-slate-200/30 hover:-translate-y-1 transition-transform duration-300 flex items-center gap-4 group">
                <div class="w-14 h-14 rounded-full bg-brand-50 flex items-center justify-center shrink-0 group-hover:bg-brand-100 transition-colors">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 text-lg">Manage Queue</h3>
                    <p class="text-xs font-medium text-slate-500 mt-0.5">Call & update patients</p>
                </div>
            </a>
            <a href="#" class="bg-white rounded-2xl p-6 border border-slate-100 shadow-lg shadow-slate-200/30 hover:-translate-y-1 transition-transform duration-300 flex items-center gap-4 group">
                <div class="w-14 h-14 rounded-full bg-emerald-50 flex items-center justify-center shrink-0 group-hover:bg-emerald-100 transition-colors">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 text-lg">View Reports</h3>
                    <p class="text-xs font-medium text-slate-500 mt-0.5">Export daily analytics</p>
                </div>
            </a>
            <a href="#" class="bg-white rounded-2xl p-6 border border-slate-100 shadow-lg shadow-slate-200/30 hover:-translate-y-1 transition-transform duration-300 flex items-center gap-4 group">
                <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center shrink-0 group-hover:bg-slate-200 transition-colors">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 text-lg">Settings</h3>
                    <p class="text-xs font-medium text-slate-500 mt-0.5">Configure system config</p>
                </div>
            </a>
        </div>

        <!-- 6. Summary Strip (Dark Anchor) -->
        <div class="bg-slate-900 rounded-2xl p-6 sm:p-8 shadow-2xl mt-8 relative overflow-hidden">
            <!-- Subtle background pattern -->
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
            
            <div class="relative z-10 grid grid-cols-2 md:grid-cols-4 gap-6 divide-x divide-slate-800">
                <div class="px-4 text-center">
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Peak Hour</p>
                    <p class="text-2xl font-black text-white">10:00 <span class="text-base text-slate-500 ml-0.5">AM</span></p>
                </div>
                <div class="px-4 text-center">
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Avg. Wait</p>
                    <p class="text-2xl font-black text-white">15<span class="text-base text-slate-500 ml-1">mins</span></p>
                </div>
                <div class="px-4 text-center">
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Registered</p>
                    <p class="text-2xl font-black text-white">{{ $totalPatientsToday }}</p>
                </div>
                <div class="px-4 text-center">
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Service Rate</p>
                    <p class="text-2xl font-black text-white">8.5<span class="text-base text-slate-500 ml-1">/hr</span></p>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="mt-auto py-8 text-center border-t border-slate-200 bg-white">
        <p class="text-slate-400 text-sm font-medium">&copy; 2026 Medicenter Admin Panel. All rights reserved.</p>
    </footer>

    <!-- Chart Configuration -->
    <script>
        const ctx = document.getElementById('queueChart').getContext('2d');
        const queueChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Waiting', 'Being Served', 'Completed'],
                datasets: [{
                    data: [
                        {{ $patientsWaiting }},
                        {{ $currentlyServing }},
                        {{ $completedToday }}
                    ],
                    backgroundColor: [
                        '#f59e0b', // Amber 500
                        '#10b981', // Emerald 500
                        '#8b5cf6'  // Violet 500
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '78%', // Makes the doughnut ring sleek and thin
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: {
                                family: "'Plus Jakarta Sans', sans-serif",
                                size: 12,
                                weight: '600'
                            },
                            color: '#475569'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        cornerRadius: 12,
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13 },
                        bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 14, weight: 'bold' },
                        displayColors: false
                    }
                }
            }
        });
    </script>
</body>
</html>