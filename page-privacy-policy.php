<?php
/**
 * Template Name: Privacy Policy
 * Description: Privacy Policy page template
 *
 * @package Quezon_Care
 */

get_header();
?>

<!-- Hero Section -->
<section class="page-hero bg-gradient-to-r from-blue-600/90 to-teal-600/90 text-white py-32 -mt-24 pt-40 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-teal-500 opacity-90"></div>
    <div class="container max-w-7xl mx-auto px-4 md:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up"><?php esc_html_e('Privacy Policy', 'quezon-care'); ?></h1>
        <p class="text-white/90 text-lg max-w-xl mx-auto mb-4" data-aos="fade-up" data-aos-delay="100"><?php esc_html_e('Your privacy is important to us', 'quezon-care'); ?></p>
        <nav class="breadcrumb flex justify-center gap-2 text-white/80" data-aos="fade-up" data-aos-delay="200">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Home', 'quezon-care'); ?></a>
            <span class="separator">/</span>
            <span class="current text-white"><?php esc_html_e('Privacy Policy', 'quezon-care'); ?></span>
        </nav>
    </div>
</section>

<!-- Privacy Policy Content -->
<section class="section legal-content py-20 bg-gradient-to-br from-slate-50 via-white to-blue-50">
    <div class="container max-w-4xl mx-auto px-4 md:px-8">
        <div class="glass-card no-tilt bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl shadow-xl p-8 md:p-12" data-aos="fade-up">
            
            <div class="legal-meta text-gray-500 text-sm mb-8 pb-6 border-b border-gray-200">
                <p><strong>Effective Date:</strong> January 1, 2024</p>
                <p><strong>Last Updated:</strong> <?php echo date('F j, Y'); ?></p>
            </div>

            <div class="legal-text prose prose-lg max-w-none">
                
                <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Introduction</h2>
                <p class="text-gray-700 mb-6">Quezon Home Care ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website quezon-homecare.local and use our home care services.</p>
                <p class="text-gray-700 mb-6">By using our website and services, you consent to the data practices described in this policy. If you do not agree with this policy, please do not use our website or services.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">2. Information We Collect</h2>
                
                <h3 class="text-xl font-semibold text-gray-800 mb-3">2.1 Personal Information</h3>
                <p class="text-gray-700 mb-4">We may collect personal information that you voluntarily provide, including:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Full name and contact details (phone number, email address, home address)</li>
                    <li>Date of birth and age information</li>
                    <li>Health and medical information relevant to care services</li>
                    <li>Emergency contact information</li>
                    <li>Payment and billing information</li>
                    <li>Insurance details (if applicable)</li>
                    <li>Information about care preferences and requirements</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mb-3">2.2 Automatically Collected Information</h3>
                <p class="text-gray-700 mb-4">When you visit our website, we may automatically collect:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>IP address and device information</li>
                    <li>Browser type and version</li>
                    <li>Pages visited and time spent on pages</li>
                    <li>Referring website addresses</li>
                    <li>Cookies and similar tracking technologies</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">3. How We Use Your Information</h2>
                <p class="text-gray-700 mb-4">We use the information we collect to:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Provide, maintain, and improve our home care services</li>
                    <li>Process bookings and consultations</li>
                    <li>Communicate with you about your care plan and appointments</li>
                    <li>Send important updates and service-related notices</li>
                    <li>Process payments and billing</li>
                    <li>Respond to your inquiries and support requests</li>
                    <li>Comply with legal obligations and regulatory requirements</li>
                    <li>Improve our website and user experience</li>
                    <li>Send marketing communications (with your consent)</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">4. Information Sharing and Disclosure</h2>
                <p class="text-gray-700 mb-4">We may share your information with:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li><strong>Care Providers:</strong> Licensed nurses and caregivers assigned to your care</li>
                    <li><strong>Healthcare Professionals:</strong> Doctors and medical facilities involved in your treatment (with consent)</li>
                    <li><strong>Service Providers:</strong> Third-party vendors who assist with payment processing, website hosting, and analytics</li>
                    <li><strong>Legal Requirements:</strong> When required by law, court order, or regulatory authority</li>
                    <li><strong>Emergency Situations:</strong> When necessary to protect your health, safety, or welfare</li>
                </ul>
                <p class="text-gray-700 mb-6">We do not sell, rent, or trade your personal information to third parties for marketing purposes.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">5. Data Security</h2>
                <p class="text-gray-700 mb-6">We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. These measures include:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>SSL encryption for data transmission</li>
                    <li>Secure password policies and access controls</li>
                    <li>Regular security assessments and updates</li>
                    <li>Staff training on data protection practices</li>
                    <li>Secure physical storage of paper records</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">6. Cookies and Tracking</h2>
                <p class="text-gray-700 mb-4">Our website uses cookies and similar technologies to:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Remember your preferences and settings</li>
                    <li>Analyze website traffic and usage patterns</li>
                    <li>Improve website functionality and user experience</li>
                </ul>
                <p class="text-gray-700 mb-6">You can control cookies through your browser settings. However, disabling cookies may affect some website features.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">7. Your Rights</h2>
                <p class="text-gray-700 mb-4">Under the Philippine Data Privacy Act of 2012 (RA 10173), you have the right to:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li><strong>Access:</strong> Request a copy of your personal data we hold</li>
                    <li><strong>Correction:</strong> Request correction of inaccurate or incomplete data</li>
                    <li><strong>Erasure:</strong> Request deletion of your personal data (subject to legal retention requirements)</li>
                    <li><strong>Object:</strong> Object to processing of your personal data for direct marketing</li>
                    <li><strong>Portability:</strong> Request transfer of your data to another service provider</li>
                    <li><strong>Withdraw Consent:</strong> Withdraw consent for processing at any time</li>
                </ul>
                <p class="text-gray-700 mb-6">To exercise these rights, please contact us using the details provided below.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">8. Data Retention</h2>
                <p class="text-gray-700 mb-6">We retain your personal information for as long as necessary to provide our services and fulfill the purposes described in this policy. Medical and care records are retained in accordance with Philippine healthcare regulations and professional standards, typically for a minimum of 10 years after the last service.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">9. Children's Privacy</h2>
                <p class="text-gray-700 mb-6">Our services may involve care for minors. We collect information about minor patients only with parental or guardian consent and use this information solely for providing care services. We do not knowingly collect personal information from children under 18 for marketing purposes.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">10. Changes to This Policy</h2>
                <p class="text-gray-700 mb-6">We may update this Privacy Policy from time to time. Changes will be posted on this page with an updated "Last Updated" date. We encourage you to review this policy periodically. Continued use of our services after changes constitutes acceptance of the updated policy.</p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-10">11. Contact Us</h2>
                <p class="text-gray-700 mb-4">If you have questions about this Privacy Policy or wish to exercise your data rights, please contact us:</p>
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 mt-4">
                    <p class="text-gray-800"><strong>Quezon Home Care</strong></p>
                    <p class="text-gray-700">123 Katipunan Ave, Quezon City, Philippines</p>
                    <p class="text-gray-700">Phone: +63 (02) 8123-4567</p>
                    <p class="text-gray-700">Email: privacy@quezonhomecare.ph</p>
                    <p class="text-gray-700">Data Protection Officer: dpo@quezonhomecare.ph</p>
                </div>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
