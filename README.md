# 🏠 Quezon Home Care - WordPress Theme

A modern, responsive WordPress theme designed for home healthcare service providers. Built with a focus on user experience, accessibility, and conversion optimization.

![WordPress](https://img.shields.io/badge/WordPress-6.9+-21759B?style=for-the-badge&logo=wordpress&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4+-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

## ✨ Features

### 🎨 Modern UI/UX
- **Glassmorphism Design** - Beautiful frosted glass effects with backdrop blur
- **Smooth Animations** - AOS (Animate on Scroll) integration for scroll-triggered animations
- **3D Card Effects** - Interactive hover effects with perspective transforms
- **Responsive Design** - Mobile-first approach, works on all devices
- **Tailwind CSS** - Utility-first CSS framework for rapid styling

### 🏥 Healthcare-Specific Features
- **Service Showcase** - Custom post type for healthcare services
- **Staff Profiles** - Team member management with qualifications
- **Testimonials** - Client feedback system with rating display
- **Booking Integration** - WooCommerce-powered appointment booking
- **Pricing Plans** - Clear pricing table with feature comparison

### 🔧 Technical Features
- **Custom Post Types** - Services, Testimonials, Staff Members
- **WooCommerce Ready** - E-commerce integration for paid services
- **SEO Optimized** - Clean markup, Yoast SEO compatible
- **Performance Focused** - Optimized asset loading
- **Security Hardened** - Best practices for WordPress security

## 📸 Screenshots

### Home Page
Modern hero section with glassmorphism cards and smooth scroll animations.

### Services Grid
Responsive service cards with hover effects and category organization.

### Pricing Plans
Clear pricing comparison with WooCommerce integration.

### Staff Directory
Team profiles with qualifications and specializations.

## 🚀 Installation

1. **Download** the theme files
2. **Upload** to `/wp-content/themes/quezon-care/`
3. **Activate** the theme in WordPress Admin → Appearance → Themes
4. **Install** required plugins when prompted
5. **Import** demo content (optional)

### Required Plugins
- Contact Form 7
- WooCommerce (for booking/pricing)
- Yoast SEO (recommended)

## 📁 File Structure

```
quezon-care/
├── assets/
│   ├── css/
│   │   └── custom.css         # Main stylesheet with animations
│   ├── js/
│   │   └── main.js            # JavaScript functionality
│   └── images/                # Theme images
├── inc/
│   ├── customizer.php         # Theme customizer settings
│   └── template-functions.php # Helper functions
├── template-parts/
│   ├── content.php            # Post content template
│   └── content-none.php       # No results template
├── front-page.php             # Homepage template
├── page-services.php          # Services archive
├── page-pricing.php           # Pricing page
├── page-staff.php             # Staff directory
├── page-booking.php           # Booking form
├── page-blog.php              # Blog archive
├── page-privacy-policy.php    # Privacy Policy
├── page-terms-of-service.php  # Terms of Service
├── single-service.php         # Single service template
├── functions.php              # Theme setup & enqueues
├── header.php                 # Site header
├── footer.php                 # Site footer
└── style.css                  # Theme declaration
```

## 🎨 Customization

### Colors
Edit the Tailwind config in `header.php`:
```javascript
tailwind.config = {
  theme: {
    extend: {
      colors: {
        primary: '#0d6efd',
        secondary: '#6f42c1',
        accent: '#20c997'
      }
    }
  }
}
```

### Animations
Customize AOS settings in `main.js`:
```javascript
AOS.init({
  duration: 800,
  easing: 'ease-out-cubic',
  once: true
});
```

## 🛠️ Technologies Used

| Technology | Purpose |
|------------|---------|
| WordPress 6.9+ | CMS Platform |
| PHP 8.2+ | Backend Language |
| Tailwind CSS 3.4 | Utility-first CSS |
| AOS Library | Scroll Animations |
| Font Awesome 6.5 | Icons |
| Inter Font | Typography |
| WooCommerce | E-commerce |
| Contact Form 7 | Forms |

## 📱 Responsive Breakpoints

- **Mobile**: < 640px
- **Tablet**: 640px - 1024px
- **Desktop**: 1024px - 1280px
- **Large**: > 1280px

## 🔒 Security Features

- Input sanitization
- CSRF protection via nonces
- Secure file permissions
- SQL injection prevention
- XSS protection

## 📄 Legal Pages

- **Privacy Policy** - Philippine DPA compliant
- **Terms of Service** - Comprehensive service terms

## 👨‍💻 Author

**John Gonzales**

- GitHub: [@jngonzales](https://github.com/jngonzales)

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

⭐ **Star this repo if you find it useful!**
