<?php
/**
 * Template Name: Terms of Service
 * Description: Terms of Service page template
 *
 * @package Quezon_Care
 */

get_header();
?>

<!-- Hero Section -->
<section class="page-hero bg-gradient-to-r from-blue-600/90 to-teal-600/90 text-white py-32 -mt-24 pt-40 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-teal-500 opacity-90"></div>
    <div class="container max-w-7xl mx-auto px-4 md:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up"><?php esc_html_e('Terms of Service', 'quezon-care'); ?></h1>
        <p class="text-white/90 text-lg max-w-xl mx-auto mb-4" data-aos="fade-up" data-aos-delay="100"><?php esc_html_e('Please read these terms carefully before using our services', 'quezon-care'); ?></p>
        <nav class="breadcrumb flex justify-center gap-2 text-white/80" data-aos="fade-up" data-aos-delay="200">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Home', 'quezon-care'); ?></a>
            <span class="separator">/</span>
            <span class="current text-white"><?php esc_html_e('Terms of Service', 'quezon-care'); ?></span>
        </nav>
    </div>
</section>

<!-- Terms of Service Content -->
<section class="section legal-content py-20 bg-gradient-to-br from-slate-50 via-white to-blue-50">
    <div class="container max-w-4xl mx-auto px-4 md:px-8">
        <div class="glass-card no-tilt bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl shadow-xl p-8 md:p-12" data-aos="fade-up">
            
            <div class="legal-meta text-gray-500 text-sm mb-8 pb-6 border-b border-gray-200">
                <p><strong>Effective Date:</strong> January 1, 2024</p>
                <p><strong>Last Updated:</strong> <?php echo date('F j, Y'); ?></p>
            </div>

            <div class="legal-text prose prose-lg max-w-none">
                
                <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Agreement to Terms</h2>
                <p class="text-gray-700 mb-6">Welcome to Quezon Home Care. These Terms of Service ("Terms") govern your use of our website (quezon-homecare.local) and our home care services. By accessing our website or using our services, you agree to be bound by these Terms. If you do not agree to these Terms, please do not use our website or services.</p>
                <p class="text-gray-700 mb-6">These Terms constitute a legally binding agreement between you ("Client," "you," or "your") and Quezon Home Care ("Company," "we," "our," or "us").</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">2. Description of Services</h2>
                <p class="text-gray-700 mb-4">Quezon Home Care provides professional in-home care services including but not limited to:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Nursing care by licensed RNs and LPNs</li>
                    <li>Elderly companion care and daily living assistance</li>
                    <li>Post-surgery and post-hospitalization recovery care</li>
                    <li>Dementia and Alzheimer's specialized care</li>
                    <li>Respite care for family caregivers</li>
                    <li>Medication management and health monitoring</li>
                    <li>Personal care assistance (bathing, grooming, mobility)</li>
                </ul>
                <p class="text-gray-700 mb-6">All services are provided by licensed, trained, and background-checked healthcare professionals in accordance with Philippine healthcare regulations.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">3. Eligibility and Client Responsibilities</h2>
                
                <h3 class="text-xl font-semibold text-gray-800 mb-3">3.1 Eligibility</h3>
                <p class="text-gray-700 mb-4">To use our services, you must:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Be at least 18 years of age or be the legal guardian/authorized representative of the care recipient</li>
                    <li>Provide accurate and complete information during registration and service requests</li>
                    <li>Have the legal authority to enter into this agreement on behalf of the care recipient</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mb-3">3.2 Client Responsibilities</h3>
                <p class="text-gray-700 mb-4">As a client, you agree to:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Provide accurate medical history and care requirements</li>
                    <li>Maintain a safe and suitable environment for care delivery</li>
                    <li>Provide necessary supplies and equipment as agreed upon</li>
                    <li>Notify us promptly of any changes in health condition or care needs</li>
                    <li>Treat our caregivers with respect and dignity</li>
                    <li>Pay for services according to the agreed payment terms</li>
                    <li>Provide reasonable notice for appointment changes or cancellations</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">4. Service Agreements and Care Plans</h2>
                <p class="text-gray-700 mb-6">Prior to commencing services, we will conduct a free consultation and assessment to understand your care needs. Based on this assessment, we will develop a personalized care plan that outlines the specific services, schedule, and caregiver assignments. This care plan forms part of your service agreement with us.</p>
                <p class="text-gray-700 mb-6">Care plans may be modified as needed with mutual agreement. We will communicate any recommended changes and obtain your consent before implementation.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">5. Pricing and Payment Terms</h2>
                
                <h3 class="text-xl font-semibold text-gray-800 mb-3">5.1 Pricing</h3>
                <p class="text-gray-700 mb-6">Our current service packages and pricing are displayed on our Pricing page. Prices are quoted in Philippine Pesos (₱) and are subject to change with prior notice. Custom care arrangements may be priced separately based on specific requirements.</p>

                <h3 class="text-xl font-semibold text-gray-800 mb-3">5.2 Payment</h3>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Payment is due according to the terms specified in your service agreement</li>
                    <li>We accept payment via bank transfer, credit/debit cards, GCash, Maya, and cash</li>
                    <li>Monthly packages are billed in advance at the beginning of each service month</li>
                    <li>Hourly or daily services may be billed weekly or bi-weekly</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mb-3">5.3 Late Payment</h3>
                <p class="text-gray-700 mb-6">Late payments may result in service suspension. A 5% late fee may be applied to balances overdue by more than 15 days. We reserve the right to terminate services for accounts with persistent payment issues.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">6. Cancellation and Rescheduling</h2>
                
                <h3 class="text-xl font-semibold text-gray-800 mb-3">6.1 Client Cancellations</h3>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li><strong>24+ hours notice:</strong> No cancellation fee</li>
                    <li><strong>Less than 24 hours notice:</strong> 50% of the scheduled service fee may apply</li>
                    <li><strong>No-show:</strong> Full service fee may be charged</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mb-3">6.2 Company Cancellations</h3>
                <p class="text-gray-700 mb-6">If we must cancel or reschedule due to caregiver unavailability, we will provide as much notice as possible and attempt to arrange a replacement caregiver. No charges will apply for company-initiated cancellations.</p>

                <h3 class="text-xl font-semibold text-gray-800 mb-3">6.3 Service Termination</h3>
                <p class="text-gray-700 mb-6">Either party may terminate ongoing services with 7 days written notice. Prepaid amounts for unused services will be refunded proportionally, minus any applicable fees.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">7. Caregiver Conduct and Standards</h2>
                <p class="text-gray-700 mb-6">Our caregivers are bound by strict professional standards and codes of conduct. They will:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Provide care with professionalism, compassion, and respect</li>
                    <li>Maintain confidentiality of client information</li>
                    <li>Follow the prescribed care plan and medical instructions</li>
                    <li>Report any changes in the client's condition promptly</li>
                    <li>Refrain from accepting personal gifts or loans from clients</li>
                </ul>
                <p class="text-gray-700 mb-6">If you have concerns about a caregiver's conduct, please contact us immediately so we can address the issue.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">8. Limitation of Liability</h2>
                <p class="text-gray-700 mb-4">To the maximum extent permitted by Philippine law:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Our total liability for any claim arising from our services shall not exceed the total fees paid for the specific service in question</li>
                    <li>We are not liable for indirect, incidental, special, or consequential damages</li>
                    <li>We are not liable for outcomes resulting from the client's failure to provide accurate information or follow care instructions</li>
                    <li>We are not liable for pre-existing conditions or natural progression of illness</li>
                </ul>
                <p class="text-gray-700 mb-6">This limitation does not apply to liability for gross negligence, willful misconduct, or any liability that cannot be excluded by law.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">9. Insurance and Licensing</h2>
                <p class="text-gray-700 mb-6">Quezon Home Care maintains professional liability insurance and complies with all applicable Philippine healthcare regulations. All our nurses and caregivers hold valid professional licenses and certifications from the Professional Regulation Commission (PRC) and relevant regulatory bodies.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">10. Intellectual Property</h2>
                <p class="text-gray-700 mb-6">All content on our website, including text, graphics, logos, images, and software, is the property of Quezon Home Care and is protected by Philippine and international copyright laws. You may not reproduce, distribute, or use our content without prior written permission.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">11. Dispute Resolution</h2>
                <p class="text-gray-700 mb-6">In the event of any dispute arising from these Terms or our services:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>The parties agree to first attempt resolution through good-faith negotiation</li>
                    <li>If negotiation fails, disputes shall be referred to mediation</li>
                    <li>If mediation is unsuccessful, disputes shall be resolved through arbitration in Quezon City under Philippine Arbitration Law</li>
                    <li>These Terms shall be governed by the laws of the Republic of the Philippines</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">12. Modifications to Terms</h2>
                <p class="text-gray-700 mb-6">We reserve the right to modify these Terms at any time. Changes will be posted on this page with an updated "Last Updated" date. For material changes, we will notify active clients via email. Continued use of our services after changes constitutes acceptance of the modified Terms.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">13. Severability</h2>
                <p class="text-gray-700 mb-6">If any provision of these Terms is found to be unenforceable or invalid, that provision shall be modified to the minimum extent necessary to make it enforceable, or if not possible, shall be severed from these Terms. The remaining provisions shall continue in full force and effect.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">14. Entire Agreement</h2>
                <p class="text-gray-700 mb-6">These Terms, together with our Privacy Policy and any service agreements, constitute the entire agreement between you and Quezon Home Care regarding the use of our services and supersede any prior agreements or understandings.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">15. Contact Information</h2>
                <p class="text-gray-700 mb-4">For questions about these Terms of Service, please contact us:</p>
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 mt-4">
                    <p class="text-gray-800"><strong>Quezon Home Care</strong></p>
                    <p class="text-gray-700">123 Katipunan Ave, Quezon City, Philippines</p>
                    <p class="text-gray-700">Phone: +63 (02) 8123-4567</p>
                    <p class="text-gray-700">Email: legal@quezonhomecare.ph</p>
                    <p class="text-gray-700">General Inquiries: care@quezonhomecare.ph</p>
                </div>

                <div class="mt-10 pt-8 border-t border-gray-200">
                    <p class="text-gray-600 text-sm italic">By using our services, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service.</p>
                </div>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
