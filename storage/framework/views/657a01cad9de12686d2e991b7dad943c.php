<?php $__env->startSection('title', 'SPC Promissorynote'); ?>

<?php $__env->startSection('content'); ?>

<header class="w-full">
    
    <div class="bg-black text-white text-[11px] md:text-xs py-0.5">
        <div class="max-w-7xl mx-auto px-4">
            <div class="marquee">
                <span>DATA-DRIVEN PROMISSORY NOTE MANAGEMENT SYSTEM WITH INTEGRATED NOTIFICATION AND ANALYTICS SOLUTION</span>
            </div>
        </div>
    </div>

    
    <div class="bg-[#660809] text-white py-1"></div>

    
    <div class="bg-white shadow dark:bg-gray-300 dark:text-white transition duration-300">
        <div class="max-w-10xl mx-auto grid grid-cols-[auto_1fr_auto] items-center gap-4 md:gap-8 px-5 py-1.5">
            <div class="flex items-center gap-2 md:gap-3">
                <img src="<?php echo e(asset('img/spc-wordmark1.1.png')); ?>" alt="SPC Wordmark" class="h-12 md:h-16 object-contain">
            </div>

            <nav class="hidden md:flex items-center gap-5 font-semibold text-[12px]">
                
            </nav>

            <div class="flex items-center gap-3 justify-end">
                
                <button id="theme-toggle" class="text-[#660809] dark:text-[#660809] hover:text-black dark:hover:text-black text-lg">
                    <iconify-icon icon="mdi:weather-night" id="theme-icon"></iconify-icon>
                </button>

                
                

                
                <a href="<?php echo e(route('auth.login')); ?>"
                   id="login-btn"
                   class="bg-[#660809] text-white px-3 py-1.5 rounded-md shadow hover:bg-black flex items-center gap-1 text-[12px] relative z-30 transition duration-300">
                    <iconify-icon icon="mdi:login" class="text-sm"></iconify-icon>
                    <span class="ml-1">Login</span>
                </a>
            </div>
        </div>
    </div>
</header>


<div class="relative min-h-[calc(100vh-120px)] overflow-hidden transition duration-300">

    
    <div id="slideshow" class="absolute inset-0 w-full h-full z-0 overflow-hidden">
        <img src="<?php echo e(asset('img/background1.jpg')); ?>" class="slide active" alt="Background 1">
        <img src="<?php echo e(asset('img/background2.jpg')); ?>" class="slide" alt="Background 2">
        <img src="<?php echo e(asset('img/background3.jpg')); ?>" class="slide" alt="Background 3">
    </div>

    
    <div class="absolute inset-0 bg-black/70 dark:bg-black/60 z-10 transition duration-500"></div>

    
    <div id="slide-text"
         class="relative z-20 flex flex-col items-center justify-center text-center text-white px-6 h-[calc(100vh-120px)]
                transition-all duration-700 ease-in-out">
        <h1 id="slide-title"
            class="font-extrabold text-3xl sm:text-4xl lg:text-5xl leading-tight mb-4 transition-all duration-700 max-w-3xl opacity-0 translate-y-6">
        </h1>
        <h2 id="slide-subtitle"
            class="text-amber-300 font-medium text-xl sm:text-2xl lg:text-3xl mb-4 transition-all duration-700 opacity-0 translate-y-6">
        </h2>
        <p id="slide-description"
           class="text-white/80 max-w-2xl text-base sm:text-lg transition-all duration-700 opacity-0 translate-y-6">
        </p>
    </div>

    
    <div id="dots" class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-3 z-20">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</div>


<div id="loading-overlay" class="fixed inset-0 bg-black/40 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-500 z-50">
    <div class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-8 py-6 rounded-2xl shadow-2xl flex flex-col items-center animate-fadeIn">
        <img src="<?php echo e(asset('img/logo.png')); ?>" alt="SPC Logo" class="spc-logo mb-3 w-28 animate-bounce">
        <p class="text-[#660809] font-semibold text-sm tracking-wide animate-pulse">Loading...</p>
    </div>
</div>


<script>
window.addEventListener('load', () => {
    const slides = document.querySelectorAll('#slideshow .slide');
    const dots = document.querySelectorAll('#dots .dot');
    const title = document.getElementById('slide-title');
    const subtitle = document.getElementById('slide-subtitle');
    const desc = document.getElementById('slide-description');
    const overlay = document.getElementById('loading-overlay');
    const loginBtn = document.getElementById('login-btn');
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');

    let index = 0;

    const slideData = [
        {
            title: "DATA-DRIVEN PROMISSORY NOTE MANAGEMENT SYSTEM",
            subtitle: "Integrated Notification and Analytics Solution",
            desc: "Streamline financial processes, ensure timely student payments, and gain valuable insights with our advanced management platform.",
            accent: "#FFDE59"
        },
        {
            title: "AUTOMATED PAYMENT REMINDER PLATFORM",
            subtitle: "Smart Notifications for Every Deadline",
            desc: "Empower students and administrators with real-time updates, reminders, and predictive alerts for better financial accountability.",
            accent: "#fbbf24"
        },
        {
            title: "INSIGHTFUL FINANCIAL DASHBOARD",
            subtitle: "Analytics-Driven Decision Making",
            desc: "Transform raw payment data into actionable insights through visual dashboards and smart reports.",
            accent: "#FFD700"
        }
    ];

    function showSlide(i) {
        slides.forEach((s, idx) => {
            s.classList.toggle('active', idx === i);
            dots[idx].classList.toggle('active', idx === i);
        });

        // Animate text
        [title, subtitle, desc].forEach(el => {
            el.style.opacity = 0;
            el.style.transform = 'translateY(20px)';
        });

        setTimeout(() => {
            title.textContent = slideData[i].title;
            subtitle.textContent = slideData[i].subtitle;
            desc.textContent = slideData[i].desc;
            subtitle.style.color = slideData[i].accent;

            [title, subtitle, desc].forEach(el => {
                el.style.opacity = 1;
                el.style.transform = 'translateY(0)';
            });
        }, 400);
    }

    // Initial slide
    showSlide(index);

    // Auto slide change
    setInterval(() => {
        index = (index + 1) % slides.length;
        showSlide(index);
    }, 6000);

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            index = i;
            showSlide(index);
        });
    });

    // ✅ Loading animation on login
    loginBtn.addEventListener('click', (e) => {
        e.preventDefault();
        overlay.classList.remove('opacity-0', 'pointer-events-none');
        overlay.classList.add('opacity-100');
        setTimeout(() => {
            window.location.href = loginBtn.getAttribute('href');
        }, 2000);
    });

    // 🌗 Theme toggle logic
    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        const isDark = document.body.classList.contains('dark');
        themeIcon.setAttribute('icon', isDark ? 'mdi:weather-sunny' : 'mdi:weather-night');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });

    // 🌙 Persist theme on reload
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark');
        themeIcon.setAttribute('icon', 'mdi:weather-sunny');
    }
});
</script>

<style>
/* ✅ Slideshow */
#slideshow .slide {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    transform: scale(1.05);
    transition: opacity 1.5s ease-in-out, transform 6s ease-in-out;
}
#slideshow .slide.active {
    opacity: 1;
    transform: scale(1);
}

/* ✅ Dots */
#dots .dot {
    width: 12px;
    height: 12px;
    border-radius: 9999px;
    background-color: rgba(255,255,255,0.4);
    cursor: pointer;
    border: 1px solid rgba(255,255,255,0.6);
    transition: background-color 0.3s, transform 0.3s;
}
#dots .dot.active {
    background-color: #FFDE59;
    transform: scale(1.1);
}

/* ✅ Text animation */
#slide-text h1, #slide-text h2, #slide-text p {
    transition: opacity 0.6s ease, transform 0.6s ease;
}

/* ✅ Dark mode styling */
body.dark {
    background-color: #111;
    color: #eee;
}
body.dark #slideshow .slide {
    filter: brightness(0.6);
}

/* ✅ Responsive text */
@media (max-width: 768px) {
    #slide-text h1 { font-size: 1.8rem; }
    #slide-text h2 { font-size: 1.2rem; }
    #slide-text p { font-size: 1rem; }

    #dots {
        position: absolute;
        left: 59%;
        bottom: 24px; /* pwede nimo usbon para mas taas/ubos */
        transform: translateX(-50%);
        display: flex;
        gap: 12px;
        justify-content: center;
        align-items: center;
        z-index: 20;
    }
}
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/welcome.blade.php ENDPATH**/ ?>