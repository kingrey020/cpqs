<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Registration - Medicenter</title>
    
    <!-- Modern Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="text-slate-800 antialiased relative overflow-x-hidden">

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
                    <a href="/" class="text-brand-600 font-semibold transition-colors">Home</a>
                    <a href="#" class="hover:text-brand-600 transition-colors">Services</a>
                    <a href="#" class="hover:text-brand-600 transition-colors">About</a>
                    <a href="#" class="hover:text-brand-600 transition-colors">Contact</a>
                    <button class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-lg transition-all duration-200 shadow-md">Patient Portal</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <!-- Queue Status Lookup -->
        <div class="max-w-2xl mx-auto mb-12 animate-fade-in-up">
            <div class="bg-white rounded-2xl p-2 shadow-xl shadow-slate-200/50 border border-slate-100 flex flex-col sm:flex-row items-center gap-2">
                <div class="flex-1 flex items-center px-4 w-full">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="queue_lookup" placeholder="Check existing queue status (e.g., 001)" 
                           class="w-full bg-transparent border-none focus:ring-0 text-slate-700 placeholder-slate-400 px-4 py-3 outline-none text-sm font-medium">
                </div>
                <button onclick="checkQueueStatus()" class="w-full sm:w-auto bg-brand-50 text-brand-700 hover:bg-brand-600 hover:text-white font-semibold rounded-xl text-sm px-8 py-3 transition-all duration-300 flex items-center justify-center gap-2">
                    Search
                </button>
            </div>
        </div>

        <!-- Registration Container (Unified Split Card) -->
        <div class="bg-white rounded-[2rem] shadow-2xl shadow-brand-900/5 border border-slate-100 overflow-hidden flex flex-col lg:flex-row animate-fade-in-up" style="animation-delay: 0.1s;">
            
            <!-- Left Side - Image & Features Overlay -->
            <div class="lg:w-5/12 relative hidden md:flex flex-col justify-end min-h-[500px]">
                <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?q=80&w=2070&auto=format&fit=crop" 
                     alt="Healthcare Professionals" class="absolute inset-0 w-full h-full object-cover">
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-brand-900 via-brand-900/80 to-transparent"></div>
                
                <!-- Overlay Content -->
                <div class="relative z-10 p-10 text-white w-full">
                    <h2 class="text-3xl font-bold mb-3 leading-tight">Your Health,<br>Our Priority.</h2>
                    <p class="text-brand-100 text-sm mb-8">Experience seamless healthcare access with our digital queuing system.</p>
                    
                    <div class="space-y-4">
                        <!-- Feature 1 -->
                        <div class="glass-card rounded-xl p-4 flex items-center gap-4 transition-transform hover:translate-x-2 duration-300">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-sm">Quick Registration</h4>
                                <p class="text-xs text-brand-100 mt-0.5">Join the queue in seconds</p>
                            </div>
                        </div>
                        <!-- Feature 2 -->
                        <div class="glass-card rounded-xl p-4 flex items-center gap-4 transition-transform hover:translate-x-2 duration-300">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-sm">Real-time Updates</h4>
                                <p class="text-xs text-brand-100 mt-0.5">Track your status anywhere</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Registration Form -->
            <div class="lg:w-7/12 p-8 sm:p-12">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Book an Appointment</h2>
                    <p class="text-slate-500 mt-2 text-sm">Fill in the details below to get your digital queue number instantly.</p>
                </div>

                <form method="POST" action="{{ route('queue.register.store') }}" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div class="sm:col-span-2 space-y-2">
                            <label for="name" class="text-sm font-semibold text-slate-700">Full Name <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <input type="text" id="name" name="name" required placeholder="John Doe" 
                                       class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none">
                            </div>
                        </div>

                        <!-- Mobile Number -->
                        <div class="space-y-2">
                            <label for="phone" class="text-sm font-semibold text-slate-700">Mobile Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <input type="tel" id="phone" name="phone" placeholder="+1 (555) 000-0000" 
                                       class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none">
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="space-y-2">
                            <label for="date_of_birth" class="text-sm font-semibold text-slate-700">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" 
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none">
                        </div>

                        <!-- Visit Date -->
                        <div class="space-y-2">
                            <label for="visit_date" class="text-sm font-semibold text-slate-700">Visit Date</label>
                            <input type="date" id="visit_date" name="visit_date" 
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none">
                        </div>

                        <!-- Service -->
                        <div class="space-y-2">
                            <label for="service" class="text-sm font-semibold text-slate-700">Department <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <select id="service" name="service" required 
                                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none appearance-none">
                                    <option value="" selected disabled>Select a service</option>
                                    <option value="General Consultation">General Consultation</option>
                                    <option value="Dental">Dental Care</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Laboratory">Laboratory</option>
                                </select>
                            </div>
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
                                    <option value="" selected disabled>Select reason</option>
                                    <option value="Consultation">Consultation</option>
                                    <option value="Follow-up">Follow-up</option>
                                    <option value="Check-up">Routine Check-up</option>
                                    <option value="Prescription refill">Prescription Refill</option>
                                </select>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="sm:col-span-2 space-y-2">
                            <label for="address" class="text-sm font-semibold text-slate-700">Address <span class="text-slate-400 font-normal">(Optional)</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <input type="text" id="address" name="address" placeholder="123 Main St, City, State" 
                                       class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-700 hover:to-brand-600 text-white font-semibold rounded-xl text-base px-6 py-4 shadow-lg shadow-brand-500/30 transform transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                            Get Queue Number
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-brand-600 rounded-md flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                </div>
                <span class="font-bold text-slate-800 text-lg">Medicenter</span>
            </div>
            <p class="text-slate-500 text-sm">&copy; 2025 Medicenter. All rights reserved.</p>
            <div class="flex gap-4 text-sm text-slate-500">
                <a href="#" class="hover:text-brand-600 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-brand-600 transition-colors">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        function checkQueueStatus() {
            const queueNumber = document.getElementById('queue_lookup').value.trim();
            if (!queueNumber) {
                // Shake effect for empty input
                const searchContainer = document.getElementById('queue_lookup').parentElement.parentElement;
                searchContainer.classList.add('animate-[shake_0.5s_ease-in-out]');
                setTimeout(() => searchContainer.classList.remove('animate-[shake_0.5s_ease-in-out]'), 500);
                return;
            }
            // Add your loading state here if needed
            window.location.href = `/status/${queueNumber}`;
        }

        document.getElementById('queue_lookup').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                checkQueueStatus();
            }
        });
        
        // Add custom shake keyframe to Tailwind dynamically
        document.head.insertAdjacentHTML("beforeend", `<style>
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                50% { transform: translateX(5px); }
                75% { transform: translateX(-5px); }
            }
        </style>`);
    </script>
</body>
</html>