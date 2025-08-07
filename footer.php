<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Gaming Footer</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <style>
      #privacyModal{
        color : black
      }
     #privacyModal h1, h2, h3 {
        color: red;
           font-weight: bold;
        }
       #privacyModal h1{
            font-size: 25px;
        }
        #privacyModal h3 {
            margin-top: 30px;
        }
        p {
            margin-bottom: 15px;
        }
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

        .logo-section {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            padding: 2rem;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .logo-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo::before {
            content: '🎮';
            font-size: 1.5rem;
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
            background: linear-gradient(135deg, #1da1f2, #0084b4);
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

            .logo-section {
                padding: 1.5rem;
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
    </style>
</head>

<body id="footer">
    <footer class="footer">
        <div class="footer-wave"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>

        <div class="footer-content">
            <!-- Logo & Description -->
            <div class="footer-section logo-section">
                <h2 class="logo glow">FancyWheel</h2>
                <p class="footer-description">
                    Explore, spin and play the most exciting games online.
                    Fun starts here with a click. Join millions of gamers worldwide!
                </p>
            </div>
            <!-- Navigation -->
            <div class="footer-section">
                <h3 class="footer-title">Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="about">About</a></li>
                    <li><a href="services">Services</a></li>
                    <li><a href="#games-grid">Games</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div class="footer-section">
                <h3 class="footer-title">Support</h3>
                <ul class="footer-links">
                    <li><a href="faq" id="faqLink">FAQs</a></li>
                    <li><a href="#" id="helpCenterLink">Help Center</a></li>
                    <li><a href="#" id="termsLink">Terms of Service</a></li>
                    <li><a href="#" id="privacyLink">Privacy Policy</a></li>
                </ul>

            </div>

            <!-- Social -->
            <div class="footer-section">
                <h3 class="footer-title">Connect With Us</h3>
                <p class="footer-description" style="margin-bottom: 1rem;">
                    Stay updated with the latest games and updates!
                </p>
                <div class="social-links">
                    <a href="#" class="social-link" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <div class="footer-section">

                <h3 class="footer-title">Join Now</h3>
                <p class="footer-description" style="margin-bottom: 1rem;">
                    Sign up to get exclusive access to new games, updates, and special offers!
                </p>

                <div>

                </div>
                <input type="email" placeholder="Enter your email" class="px-4 py-2 rounded-full bg-gray-800 text-white w-full mb-2" />
                <ul class="footer-links">
                    <a href="https://fancywin.city" target="_blank" class="relative group px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="relative z-10 font-medium">Get Started</span>

                    </a>

                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; <span class="current-year">2024</span> FancyWheel. All rights reserved. | Made with ❤️ for gamers worldwide
        </div>




        </div>



    </footer>

    <!-- Help Center Modal -->
    <div id="helpModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg max-w-md w-full shadow-lg relative">
            <button class="absolute top-2 right-2 text-gray-600 hover:text-black text-xl font-bold" onclick="closeModal('helpModal')">&times;</button>
            <h2 class="text-xl font-bold mb-4 text-center">Help Center</h2>
            <p class="text-gray-700 text-center">
                Welcome to the FancyWin Help Center. Here you’ll find support, guides, and answers to your questions.
            </p>
        </div>
    </div>

    <!-- Terms of Service Modal -->
    <div id="termsModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg max-w-md w-full shadow-lg relative">
            <button class="absolute top-2 right-2 text-gray-600 hover:text-black text-xl font-bold" onclick="closeModal('termsModal')">&times;</button>
            <h2 class="text-xl font-bold mb-4 text-center">Terms of Service</h2>
            <p class="text-gray-700 text-center">
                Please read our Terms of Service carefully before using FancyWin. By accessing our platform, you agree to be bound by these terms.
            </p>
        </div>
    </div>

    <!-- Privacy Policy Modal (Scrollable) -->
    <div id="privacyModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg max-w-md w-full shadow-lg relative max-h-[80vh] overflow-y-auto">
            <button class="absolute top-2 right-2 text-gray-600 hover:text-black text-xl font-bold" onclick="closeModal('privacyModal')">&times;</button>
           <h1>Privacy Policy – FancyWin Casino</h1>

    <section>
        <h3>1.1. Privacy</h3>
        <p>FancyWin is committed to protecting your personal information. This Privacy Policy explains what information we collect when you use our services, why we collect it, and how we use it.</p>
        <p>This policy is an integral part of FancyWin’s Terms and Conditions. We may update it periodically and will notify you by posting the modified terms on our platform. Please review this policy regularly.</p>
    </section>

    <section>
        <h3>1.2. Information Collected</h3>
        <p>We consider information that identifies an individual—such as name, date of birth, address, email, phone number, and other personal data—as <strong>Personal Information</strong>.</p>
        <p>We may collect this information when you:</p>
        <ul>
            <li>Use our website</li>
            <li>Register for an account</li>
            <li>Use our services</li>
        </ul>
        <p>Collected information includes:</p>
        <ul>
            <li>Contact details (email, phone)</li>
            <li>Billing/shipping info</li>
            <li>Transaction history</li>
            <li>Website usage preferences</li>
            <li>Feedback on services</li>
        </ul>
        <p>Our servers may log your IP address, access time/date, pages visited, language preferences, browser type, and crash reports.</p>
    </section>

    <section>
        <h3>1.3. Data Collection and Processing</h3>
        <p>We may receive your Personal Information:</p>
        <ul>
            <li>Automatically through our services</li>
            <li>When submitted by you directly</li>
            <li>From online vendors, service providers, and third-party marketing lists</li>
        </ul>
        <p>We may use third-party providers for technical support, processing transactions, and maintaining accounts. These parties are obligated to protect your privacy according to this policy.</p>
    </section>

    <section>
        <h3>1.4. Information Use</h3>
        <p>We use your information to:</p>
        <ul>
            <li>Provide services and support</li>
            <li>Perform security checks and identity verification</li>
            <li>Process transactions</li>
            <li>Enable participation in promotions</li>
            <li>Comply with business requirements</li>
        </ul>
        <p>We may also share your data with select partners to offer additional products and services.</p>
        <p>We may contact you with:</p>
        <ul>
            <li>Promotional offers about our services</li>
            <li>Offers from partners</li>
            <li>Surveys or contests (participation is voluntary)</li>
        </ul>
        <p>By accepting prizes, you consent to your name being used in promotions, unless prohibited by law.</p>
    </section>

    <section>
        <h3>1.5. Disclosures</h3>
        <p>We may disclose Personal Information to:</p>
        <ul>
            <li>Comply with legal obligations</li>
            <li>Protect our rights or users' safety</li>
            <li>Investigate fraud, manipulation, or other illegal activity</li>
        </ul>
        <p>If you are found to have violated our rules or engaged in fraud, we may share your data with:</p>
        <ul>
            <li>Other gaming platforms</li>
            <li>Banks and credit card companies</li>
            <li>Law enforcement agencies</li>
        </ul>
        <p>For addiction research, anonymized data may be shared with relevant institutions.</p>
    </section>

    <section>
        <h3>1.6. Access and Control</h3>
        <p>You can opt out of promotional communications via:</p>
        <ul>
            <li>Your account settings</li>
            <li>Links in emails</li>
            <li>Contacting customer service</li>
        </ul>
        <p>You may contact us to verify or update your Personal Information or to file complaints. We may retain certain data to comply with legal obligations.</p>
    </section>

    <section>
        <h3>1.7. Electronic Payment Providers</h3>
        <p>To play real money games, you must process transactions through third-party payment providers. By using these services, you consent to the transfer of necessary data, including international transfers, under privacy protection agreements.</p>
    </section>

    <section>
        <h3>1.8. Security Reviews</h3>
        <p>We may perform security reviews to:</p>
        <ul>
            <li>Validate registration data</li>
            <li>Check for terms violations</li>
            <li>Confirm financial transactions</li>
        </ul>
        <p>This may include checking against third-party databases, credit reports, and requesting documentation.</p>
    </section>

    <section>
        <h3>1.9. Security</h3>
        <p>We store Personal Information on secure, encrypted, password-protected servers behind advanced firewalls. SSL encryption is supported. Our partners also follow strict data security practices.</p>
    </section>

    <section>
        <h3>1.10. Protection of Minors</h3>
        <p>FancyWin services are only for users <strong>18 years or older</strong> (or legal age in their jurisdiction). Attempts by minors to register may result in account denial and data removal.</p>
    </section>

    <section>
        <h3>1.11. International Transfers</h3>
        <p>Personal Information may be stored or processed in countries outside your own. By using our services, you consent to such transfers. We ensure third parties maintain our privacy standards.</p>
    </section>

    <section>
        <h3>1.12. Cookies</h3>
        <p>We use cookies and flash cookies to:</p>
        <ul>
            <li>Store your preferences</li>
            <li>Improve your experience</li>
            <li>Track site usage and performance</li>
            <li>Display relevant ads</li>
        </ul>
        <p><strong>Cookie Types Used:</strong></p>
        <ul>
            <li><strong>Session cookies:</strong> Expire after your visit</li>
            <li><strong>Persistent cookies:</strong> Stay on your device longer</li>
            <li><strong>Analytical cookies:</strong> Help us improve site functionality</li>
        </ul>
        <p>You can manage cookies through your browser or Flash Player settings.</p>
    </section>

    <section>
        <h3>1.13. Third-Party Practices</h3>
        <p>We are not responsible for data collected by third-party sites linked from our platform. Their privacy policies apply.</p>
    </section>

    <section>
        <h3>1.14. Legal Disclaimer</h3>
        <p>Our services operate <strong>"as-is"</strong> and <strong>"as-available."</strong> We are not liable for uncontrollable events or errors affecting your Personal Information. Use of our services implies acceptance of potential privacy risks.</p>
    </section>

    <section>
        <h3>1.15. Consent to Privacy Policy</h3>
        <p>By using our services, you agree to this Privacy Policy. This document supersedes all previous versions. Changes will be posted on our platform. Continued use implies acceptance of any updates.</p>
    </section>

    <section>
        <h3>1.16. External Websites</h3>
        <p>Our website may link to third-party websites outside our control. Those sites may collect your data under their own privacy policies. We are not responsible for their content or practices.</p>
    </section>

        </div>
    </div>


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

</body>

</html>