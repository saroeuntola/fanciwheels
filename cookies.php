<!-- Cookie Consent Banner -->
<div id="cookieConsent" class="fixed bottom-0 left-0 w-full flex justify-center z-50 transform translate-y-full transition-transform duration-500">
    <div class="w-full max-w-7xl bg-gray-900 text-white p-4 flex flex-col md:flex-row items-center justify-between gap-2 rounded-t-lg shadow-lg">
        <p class="text-sm md:text-base">
            <?= $lang === 'en'
                ? 'We use cookies to improve your experience. By continuing to browse, you agree to our use of cookies. <a href="/privacy" class="underline text-blue-400">Privacy Policy</a>.'
                : 'আমরা আপনার সাইট অভিজ্ঞতা উন্নত করতে কুকি ব্যবহার করি। চালিয়ে যেতে, আপনি কুকি ব্যবহারে সম্মত হন। <a href="/privacy" class="underline text-blue-400">গোপনীয়তা নীতি</a>।' ?>
        </p>
        <div class="flex gap-2 mt-2 md:mt-0">
            <button id="acceptCookies" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                <?= $lang === 'en' ? 'Accept' : 'গ্রহণ করুন' ?>
            </button>
            <button id="rejectCookies" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-1 px-3 rounded">
                <?= $lang === 'en' ? 'Reject' : 'প্রত্যাখ্যান করুন' ?>
            </button>
        </div>
    </div>
</div>


<script>
    window.addEventListener('DOMContentLoaded', () => {
        const consentBanner = document.getElementById('cookieConsent');

        // Show banner if user hasn't made a choice
        if (!localStorage.getItem('cookieConsent')) {
            consentBanner.classList.remove('pointer-events-none');
            consentBanner.classList.add('opacity-100');
        }

        // Accept cookies
        document.getElementById('acceptCookies').addEventListener('click', () => {
            localStorage.setItem('cookieConsent', 'accepted');
            consentBanner.classList.remove('opacity-100');
            consentBanner.classList.add('opacity-0', 'pointer-events-none');
        });

        // Reject cookies
        document.getElementById('rejectCookies').addEventListener('click', () => {
            localStorage.setItem('cookieConsent', 'rejected');
            consentBanner.classList.remove('opacity-100');
            consentBanner.classList.add('opacity-0', 'pointer-events-none');
            // Optional: disable tracking scripts here
        });
    });
</script>