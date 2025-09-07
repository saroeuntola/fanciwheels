<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<style>
    #privacyModal section {
        margin-bottom: 30px;
        padding-bottom: 10px;
        border-bottom: 1px solid #ccc;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .footer {
        background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="60" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="60" cy="80" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="20" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
        animation: float 20s infinite linear;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .footer-wave {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 60px;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="%23667eea"/><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="%23667eea"/><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="%23667eea"/></svg>') no-repeat;
        background-size: cover;
        animation: wave 3s ease-in-out infinite;
    }

    @keyframes wave {

        0%,
        100% {
            transform: translateX(0px);
        }

        50% {
            transform: translateX(-10px);
        }
    }

    .footer-content {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
        padding: 4rem 2rem 2rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 3rem;
        padding: 75px 0px;
    }

    .footer-section {
        position: relative;
    }

    .footer-section::before {
        content: '';
        position: absolute;
        top: -10px;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
        opacity: 0;
        transform: translateX(-20px);
        animation: slideIn 0.8s ease-out forwards;
    }

    @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }




    .logo {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }


    .footer-description {
        color: rgba(255, 255, 255, 0.7);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .footer-title {
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        color: #fff;
        font-weight: 600;
        position: relative;
        display: inline-block;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        transition: width 0.3s ease;
    }

    .footer-section:hover .footer-title::after {
        width: 100%;
    }

    .footer-links {
        list-style: none;
        space-y: 0.75rem;
    }

    .footer-links li {
        margin-bottom: 0.75rem;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        position: relative;
        padding-left: 20px;
    }

    .footer-links a::before {
        content: '▸';
        position: absolute;
        left: 0;
        color: #667eea;
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s ease;
    }

    .footer-links a:hover {
        color: #667eea;
        transform: translateX(5px);
    }

    .footer-links a:hover::before {
        opacity: 1;
        transform: translateX(0);
    }

    .social-links {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .social-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .social-link:hover::before {
        left: 100%;
    }

    .social-link:hover {
        transform: translateY(-3px) scale(1.1);
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .social-link:nth-child(1):hover {
        background: linear-gradient(135deg, #3b5998, #8b9dc3);
    }

    .social-link:nth-child(2):hover {
        background: linear-gradient(135deg, #69C9D0, #EE1D52);
    }

    .social-link:nth-child(3):hover {
        background: linear-gradient(135deg, #e4405f, #f77737);
    }

    .social-link:nth-child(4):hover {
        background: linear-gradient(135deg, #ff0000, #cc0000);
    }

    .footer-bottom {
        background: rgba(0, 0, 0, 0.3);
        text-align: center;
        padding: 1.5rem;
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        z-index: 2;
    }

    .footer-bottom::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 1px;
        background: linear-gradient(90deg, transparent, #667eea, transparent);
    }

    .current-year {
        color: #667eea;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .footer-content {
            grid-template-columns: 1fr;
            gap: 2rem;
            padding: 3rem 1rem 1rem;
        }



        .social-links {
            justify-content: center;
        }
    }

    /* Glowing animation for special elements */
    .glow {
        animation: glow 2s ease-in-out infinite alternate;
    }

    @keyframes glow {
        from {
            text-shadow: 0 0 10px rgba(102, 126, 234, 0.5);
        }

        to {
            text-shadow: 0 0 20px rgba(102, 126, 234, 0.8);
        }
    }

    /* Particle effect */
    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: rgba(102, 126, 234, 0.6);
        border-radius: 50%;
        animation: particle-float 6s infinite ease-in-out;
    }

    .particle:nth-child(1) {
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }

    .particle:nth-child(2) {
        top: 60%;
        left: 90%;
        animation-delay: 1s;
    }

    .particle:nth-child(3) {
        top: 80%;
        left: 20%;
        animation-delay: 2s;
    }

    .particle:nth-child(4) {
        top: 30%;
        left: 70%;
        animation-delay: 3s;
    }

    @keyframes particle-float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
            opacity: 1;
        }

        33% {
            transform: translateY(-30px) rotate(120deg);
            opacity: 0.7;
        }

        66% {
            transform: translateY(30px) rotate(240deg);
            opacity: 0.4;
        }
    }

    @media (max-width: 1024px) {
        .footer-content {
            padding: 60px 22px;
        }
    }

    .social-link:nth-child(1) {
        background: linear-gradient(135deg, #3b5998, #8b9dc3);
    }

    .social-link:nth-child(2) {

        background-color: #000;
    }

    .social-link:nth-child(3) {
        background: linear-gradient(135deg, #e4405f, #f77737);
    }

    .social-link:nth-child(4) {
        background: linear-gradient(135deg, #ff0000, #cc0000);
    }

    .social-link:nth-child(5) {

        background: linear-gradient(135deg, #1da1f2, #0084b4);

    }
</style>

<?php
$footerTexts = [
    'en' => [
        'quick_links' => 'Quick Links',
        'support' => 'Support',
        'connect' => 'Connect With Us',
        'join' => 'Join Now',
        'email_placeholder' => 'Enter your email',
        'get_started' => 'Get Started'
    ],
    'bn' => [
        'quick_links' => 'দ্রুত লিঙ্ক',
        'support' => 'সহায়তা',
        'connect' => 'আমাদের সাথে সংযুক্ত থাকুন',
        'join' => 'এখন যোগ দিন',
        'email_placeholder' => 'আপনার ইমেল লিখুন',
        'get_started' => 'শুরু করুন'
    ]
];
$texts = $footerTexts[$lang];
?>

<main id="footer">
    <footer class="footer">
        <div class="footer-wave"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>

        <div class="footer-content">


            <!-- Logo & Description -->
            <div class="footer-section logo-section">
                <h1 class="logo glow">Fancy Wheel</h1>
                <p class="footer-description">
                    <?= $lang === 'en'
                        ? 'Discover the best bus services and milk tea spots across Bangladesh. Travel comfortably and enjoy delicious tea at every stop!'
                        : 'বাংলাদেশে সেরা বাস সার্ভিস এবং মিল্কটি স্পটগুলো আবিষ্কার করুন। আরামদায়ক ভ্রমণ করুন এবং প্রতিটি স্টপে সুস্বাদু চা উপভোগ করুন!' ?>
                </p>

            </div>
            <!-- Follow Us Section -->
            <div class="footer-section">
                <h3 class="footer-title"><?= $texts['connect'] ?></h3>
                <p class="footer-description">
                    <?= $lang === 'en'
                        ? 'Stay connected with us on social media for the latest updates and promotions.'
                        : 'সর্বশেষ আপডেট এবং প্রচারের জন্য আমাদের সোশ্যাল মিডিয়ায় সংযুক্ত থাকুন।' ?>
                </p>
                <div class="social-links">
                    <a href="https://facebook.com" target="_blank" class="social-link" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.tiktok.com/@Username" target="_blank" class="social-link" aria-label="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>

                    <a href="https://instagram.com" target="_blank" class="social-link" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://youtube.com" target="_blank" class="social-link" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://t.me/TelegramUsername" target="_blank" class="social-link" aria-label="Telegram">
                        <i class="fab fa-telegram-plane"></i>
                    </a>
                </div>
            </div>

            <!-- Navigation -->
            <div class="footer-section">
                <h3 class="footer-title"><?= $texts['quick_links'] ?></h3>
                <ul class="footer-links">


                    <li> <?php echo navLink('/', $menu['home'], $lang, $currentPage, $currentId); ?></li>
                    <li><?php echo navLink('about', $menu['about'], $lang, $currentPage, $currentId); ?> </li>
                    <li><?php echo navLink('services', $menu['services'], $lang, $currentPage, $currentId); ?></li>
                    <li><?php echo navLink('faq', $menu['faq'], $lang, $currentPage, $currentId); ?></li>
                </ul>

            </div>

            <!-- Support -->
            <div class="footer-section">
                <h3 class="footer-title"><?= $texts['support'] ?></h3>
                <ul class="footer-links">
                    <li><a href="#" id="helpCenterLink"><?= $lang === 'en' ? 'Help Center' : 'হেল্প সেন্টার' ?></a></li>
                    <li><a href="#" id="termsLink"><?= $lang === 'en' ? 'Terms of Service' : 'সেবার শর্তাবলী' ?></a></li>
                    <li><a href="#" id="privacyLink"><?= $lang === 'en' ? 'Privacy Policy' : 'গোপনীয়তার নীতি' ?></a></li>
                </ul>
            </div>

            <!-- Join Now -->
            <div class="footer-section">
                <h3 class="footer-title"><?= $texts['join'] ?></h3>
                <p class="footer-description" style="margin-bottom: 1rem;">
                    <?= $lang === 'en'
                        ? 'Sign up to get exclusive access to new games, updates, and special offers!'
                        : 'নতুন গেম, আপডেট এবং বিশেষ অফারের জন্য সাইন আপ করুন!' ?>
                </p>

                <input type="email" placeholder="<?= $texts['email_placeholder'] ?>" class="px-4 py-2 rounded-full bg-gray-800 text-white w-full mb-2" />
                <ul class="footer-links">
                    <button onclick="window.open('https://fancywin.city/bd/bn/new-register-entry/account', '_blank')" class="relative group px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="relative z-10 font-medium"><?= $texts['get_started'] ?></span>
                    </button>
                </ul>
            </div>


        </div>

        <div class="footer-bottom">
            &copy; <span class="current-year">2025</span> Fancy Wheel. <?= $lang === 'en' ? 'All rights reserved.' : 'সকল অধিকার সংরক্ষিত।' ?>
        </div>
        </div>



    </footer>


    <script>
        // Update current year
        document.querySelector('.current-year').textContent = new Date().getFullYear();

        // Add smooth scroll effect for links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe footer sections
        document.querySelectorAll('.footer-section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });

        // Add click effects to social links
        document.querySelectorAll('.social-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Create ripple effect
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.left = '50%';
                ripple.style.top = '50%';
                ripple.style.width = '20px';
                ripple.style.height = '20px';
                ripple.style.marginLeft = '-10px';
                ripple.style.marginTop = '-10px';

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple animation CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
    <script>
        // Open modals
        document.getElementById("helpCenterLink").addEventListener("click", function(e) {
            e.preventDefault();
            document.getElementById("helpModal").classList.remove("hidden");
        });

        document.getElementById("termsLink").addEventListener("click", function(e) {
            e.preventDefault();
            document.getElementById("termsModal").classList.remove("hidden");
        });

        document.getElementById("privacyLink").addEventListener("click", function(e) {
            e.preventDefault();
            document.getElementById("privacyModal").classList.remove("hidden");
        });

        // Close modal
        function closeModal(id) {
            document.getElementById(id).classList.add("hidden");
        }
    </script>
    <style>
        .max-h-\[80vh\]::-webkit-scrollbar {
            width: 6px;
        }

        .max-h-\[80vh\]::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 3px;
        }
    </style>
</main>