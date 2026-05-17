<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register - Medicenter</title>
    
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
</head>
<body class="bg-slate-50 text-slate-800 antialiased relative min-h-screen flex flex-col overflow-x-hidden">

    <!-- Decorative Background Blobs -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-brand-500/20 rounded-full mix-blend-multiply filter blur-[100px] animate-pulse-slow"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[500px] h-[500px] bg-teal-400/20 rounded-full mix-blend-multiply filter blur-[120px] animate-pulse-slow" style="animation-delay: 2s;"></div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col items-center justify-center px-4 sm:px-6 relative z-10 py-12">
        
        <div class="w-full max-w-md animate-fade-in-up">
            <!-- Logo Section -->
            <div class="flex flex-col items-center justify-center gap-3 mb-8">
                <div class="w-14 h-14 bg-gradient-to-br from-brand-500 to-brand-700 rounded-2xl flex items-center justify-center shadow-lg shadow-brand-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <div class="text-center">
                    <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-brand-900 to-brand-600">Medicenter</h1>
                    <p class="text-slate-500 font-medium mt-1">Create Admin Account</p>
                </div>
            </div>

            <!-- Register Form Card -->
            <div class="bg-white rounded-[2rem] shadow-2xl shadow-brand-900/5 border border-slate-100 p-8 sm:p-10">
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Get Started</h2>
                <p class="text-slate-500 text-sm mb-8">Register for a new administrator account.</p>

                <!-- Styled Alerts (Replaces intrusive JS alerts) -->
                @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-start gap-3 text-emerald-700 text-sm font-medium">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                @if(session('error') || $errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 flex items-start gap-3 text-red-600 text-sm font-medium">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        @if(session('error')) <p>{{ session('error') }}</p> @endif
                        @if($errors->any()) <p>{!! implode('<br>', $errors->all()) !!}</p> @endif
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('admin.register') }}" class="space-y-4">
                    @csrf
                    
                    <!-- Full Name Input -->
                    <div class="space-y-1.5">
                        <label for="name" class="text-sm font-semibold text-slate-700">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <input type="text" id="name" name="name" required placeholder="John Doe" 
                                   class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none text-slate-700">
                        </div>
                    </div>

                    <!-- Email Input -->
                    <div class="space-y-1.5">
                        <label for="email" class="text-sm font-semibold text-slate-700">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="email" id="email" name="email" required placeholder="admin@medicenter.com" 
                                   class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none text-slate-700">
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-1.5">
                        <label for="password" class="text-sm font-semibold text-slate-700">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" id="password" name="password" required placeholder="••••••••" 
                                   class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none text-slate-700">
                        </div>
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="text-sm font-semibold text-slate-700">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••" 
                                   class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all duration-200 outline-none text-slate-700">
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-center pt-2 pb-1">
                        <input id="terms" type="checkbox" name="terms" required
                               class="w-4 h-4 text-brand-600 bg-slate-100 border-slate-300 rounded focus:ring-brand-500 focus:ring-2 cursor-pointer" />
                        <label for="terms" class="ml-2 text-sm font-medium text-slate-600 cursor-pointer select-none">
                            I agree to the <a href="#" class="text-brand-600 hover:text-brand-700 font-semibold transition-colors">terms & conditions</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" class="w-full bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-700 hover:to-brand-600 text-white font-semibold rounded-xl text-sm px-6 py-3.5 shadow-lg shadow-brand-500/30 transform transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0">
                            Create Account
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-slate-400 font-medium">Or</span>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-slate-500 text-sm">
                        Already have an account? 
                        <a href="/admin/login" class="text-brand-600 hover:text-brand-700 font-semibold transition-colors">Login here</a>
                    </p>
                </div>
            </div>

            <!-- Security Notice -->
            <div class="mt-8 flex items-center justify-center gap-2 text-slate-400 text-xs font-medium" style="animation-delay: 0.2s;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                <span>Restricted area. Authorized registration only.</span>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="relative z-10 pb-6 text-center text-slate-500 text-xs">
        <p>&copy; 2026 Medicenter Admin Panel. All rights reserved.</p>
    </footer>

</body>
</html>