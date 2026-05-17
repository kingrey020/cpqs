<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Queue Information - Medicenter</title>
    
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
        body {
            background-color: #f8fafc;
        }
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
    <div class="flex-grow flex items-center justify-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        
        <!-- Unified Card -->
        <div class="w-full bg-white rounded-[2rem] shadow-2xl shadow-brand-900/5 border border-slate-100 overflow-hidden flex flex-col lg:flex-row animate-fade-in-up">
            
            <!-- Left Side - Image & Overlay -->
            <div class="lg:w-5/12 relative hidden md:flex flex-col justify-end min-h-[600px]">
                <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=2080&auto=format&fit=crop" 
                     alt="Medical Records" class="absolute inset-0 w-full h-full object-cover">
                
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-brand-900 via-brand-900/80 to-transparent"></div>
                
                <!-- Overlay Content -->
                <div class="relative z-10 p-10 text-white w-full">
                    <h2 class="text-3xl font-bold mb-3 leading-tight">Keep your info<br>up to date.</h2>
                    <p class="text-brand-100 text-sm mb-8">Ensure your details are accurate so we can provide you with the best possible care.</p>
                    
                    <div class="space-y-4">
                        <div class="glass-card rounded-xl p-4 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-sm">Accurate Records</h4>
                                <p class="text-xs text-brand-100 mt-0.5">Helps our doctors prepare</p>
                            </div>
                        </div>
                        <div class="glass-card rounded-xl p-4 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-sm">Faster Service</h4>
                                <p class="text-xs text-brand-100 mt-0.5">Streamlines your consultation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Edit Form -->
            <div class="lg:w-7/12 p-8 sm:p-12">
                
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
                    <div>
                        <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Update Details</h2>
                        <p class="text-slate-500 mt-1 text-sm">Modify your registration information below.</p>
                    </div>
                    <!-- Current Queue Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-brand-50 border border-brand-100 rounded-full">
                        <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                        <span class="text-xs font-bold text-brand-700 uppercase tracking-wider">Queue #</span>
                        <span class="text-lg font-black text-brand-600">{{ $entry->queue_number }}</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('queue.update', $entry->queue_number) }}" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        
                        <!-- Full Name -->
                        <div class="sm:col-span-2 space-y-2">
                            <label for="name" class="text-sm font-semibold text-slate-700">Full Name <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <input type="text" id="name" name="name" value="{{ $entry->patient->name }}" required 
                                       class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none">
                            </div>
                            @error('name') 
                                <p class="text-red-500 text-xs flex items-center gap-1 mt-1 font-medium">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <!-- Mobile Number -->
                        <div class="space-y-2">
                            <label for="phone" class="text-sm font-semibold text-slate-700">Mobile Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <input type="text" id="phone" name="phone" value="{{ $entry->patient->phone }}" placeholder="+1 (555) 000-0000" 
                                       class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none">
                            </div>
                            @error('phone') 
                                <p class="text-red-500 text-xs flex items-center gap-1 mt-1 font-medium"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> 
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div class="space-y-2">
                            <label for="date_of_birth" class="text-sm font-semibold text-slate-700">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ $entry->patient->date_of_birth }}" 
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none">
                            @error('date_of_birth') 
                                <p class="text-red-500 text-xs flex items-center gap-1 mt-1 font-medium"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> 
                            @enderror
                        </div>

                        <!-- Department / Service -->
                        <div class="space-y-2">
                            <label for="service" class="text-sm font-semibold text-slate-700">Department <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <select id="service" name="service" required 
                                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none appearance-none">
                                    <option value="">Select a service</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service }}" {{ $entry->patient->service === $service ? 'selected' : '' }}>{{ $service }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('service') 
                                <p class="text-red-500 text-xs flex items-center gap-1 mt-1 font-medium"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> 
                            @enderror
                        </div>

                        <!-- Complaint -->
                        <div class="space-y-2">
                            <label for="complaint" class="text-sm font-semibold text-slate-700">Reason for Visit <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <select id="complaint" name="complaint" required 
                                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none appearance-none">
                                    <option value="">Reason for Visit</option>
                                    @foreach($complaints as $complaint_option)
                                        <option value="{{ $complaint_option }}" {{ $entry->patient->complaint === $complaint_option ? 'selected' : '' }}>{{ $complaint_option }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('complaint') 
                                <p class="text-red-500 text-xs flex items-center gap-1 mt-1 font-medium"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> 
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="sm:col-span-2 space-y-2">
                            <label for="address" class="text-sm font-semibold text-slate-700">Address <span class="text-slate-400 font-normal">(Optional)</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <input type="text" id="address" name="address" value="{{ $entry->patient->address }}" placeholder="123 Main St, City, State" 
                                       class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none">
                            </div>
                            @error('address') 
                                <p class="text-red-500 text-xs flex items-center gap-1 mt-1 font-medium"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> 
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-slate-100">
                        <button type="submit" class="w-full sm:w-2/3 bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-700 hover:to-brand-600 text-white font-semibold rounded-xl text-sm px-6 py-3.5 shadow-lg shadow-brand-500/30 transform transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Save Changes
                        </button>
                        
                        <a href="{{ route('queue.status', $entry->queue_number) }}" class="w-full sm:w-1/3 flex items-center justify-center gap-2 px-6 py-3.5 bg-white border border-slate-200 text-slate-600 font-semibold rounded-xl text-sm hover:bg-slate-50 hover:text-slate-800 transition-colors">
                            Cancel
                        </a>
                    </div>
                </form>
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