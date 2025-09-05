# Smart Grant Solutions WordPress Theme

A custom WordPress theme that provides a **1:1 exact recreation** of the Smart Grant Solutions website (smartgrantsolutions.com) originally built with Tilda CMS.

## Project Overview

This theme recreates the entire MissionGranted by Smart Grant Solutions website exactly as it appears in the original Tilda export, maintaining pixel-perfect accuracy while converting it to a scalable WordPress custom theme architecture.

## Key Features

### 🎯 1:1 Design Match
- **Exact color palette** from original Tilda design (#000000, #d81259, #FFB03F, #FCB03E)
- **Matching typography** using Inter and DM Sans fonts
- **Identical layouts** and spacing throughout
- **Precise animations** including the hero typed text effect
- **Original content** including all copy, testimonials, and feature descriptions

### 🔧 Technical Architecture
- **No theme.json** - Pure SCSS/CSS approach as requested
- **Modular SCSS** using 7-1 architecture pattern
- **Component-based JavaScript** with ES6 modules
- **WordPress template system** with proper PHP integration
- **Responsive design** matching original breakpoints

## Theme Structure

```
smartgrantsolutions-theme/
├── assets/
│   ├── scss/
│   │   ├── abstracts/        # Variables, mixins
│   │   ├── base/             # Reset, typography
│   │   ├── components/       # Reusable components
│   │   ├── layout/           # Header, footer, grid
│   │   └── main.scss         # Main import file
│   ├── js/
│   │   ├── components/       # Navigation, forms, etc.
│   │   ├── modules/          # Typed animation, carousel
│   │   ├── utils/            # Helper functions
│   │   └── main.js           # Main JavaScript entry
│   └── images/               # Theme images
├── inc/                      # Theme functions
├── template-parts/           # Reusable template parts
├── functions.php             # WordPress theme setup
├── header.php               # Site header
├── footer.php               # Site footer
├── index.php                # Homepage template
└── style.css                # Main stylesheet
```

## Original Content Recreation

### Hero Section
- **MissionGranted branding** with animated cycling text
- **Exact animation**: "spreadsheet automation", "grant&fund management", "simplified compliance", "proudly built by"
- **Color-matched cursor** animation (#d81259)

### Value Proposition
- **Main headline**: "We Make Financial Grant Management and Compliance Easy, So You Can Focus on What Matters Most – Your Mission."
- **CTA buttons** with exact styling and hover effects
- **Video integration** placeholder for customer demo

### Trust Section
- **Funder logos carousel** with auto-rotation
- **Exact copy**: "TRUSTED BY ORGANIZATIONS MANAGING GRANTS FROM TOP U.S. FUNDERS"
- **Logo grid** with opacity hover effects

### Product Features
- **Four main features** with alternating layouts:
  1. Strategic Insights for Growth
  2. Automation Over Spreadsheets  
  3. Simplified Compliance & Guidance
  4. Embedded Best Practices
- **White background cards** with videos and descriptions
- **Exact copy** from original Tilda site

### Testimonial Section
- **Customer testimonial**: "MissionGranted addressed all of the things I was looking for in a Grant management system"
- **Attribution**: Elizabeth Crisfield, Executive Director, ClearWater Conservancy
- **Video integration** with proper styling

### Final CTA
- **Main headline**: "Our Mission is to Fuel Yours"
- **Three-line tagline**: "Eliminate Spreadsheets. Ensure Compliance. Drive Strategy."

## Navigation Structure

Exact recreation of original navigation:
- HOME | BLOG | TESTIMONIALS | REQUEST A DEMO
- Fixed header with black background
- Orange highlighting for CTA links
- Mobile-responsive hamburger menu

## Brand Colors

```scss
$color-black: #000000;        // Primary background
$color-primary: #d81259;      // Typed animation highlight
$color-secondary: #ffb03f;    // CTA buttons and accents
$color-accent: #fcb03e;       // Orange text highlights
$color-white: #ffffff;        // Text on dark backgrounds
$color-gray-dark: #666666;    // Navigation separators
```

## Typography

```scss
$font-primary: 'Inter'        // Main body text, navigation
$font-secondary: 'DM Sans'    // Headlines, section titles
$font-tertiary: 'Poppins'     // Additional accent font
```

## JavaScript Modules

### TypedAnimation
- Recreates Tilda's t635 typed text component
- Configurable speed, delay, and loop settings
- Matches original animation timing exactly

### TrustCarousel
- Auto-rotating logo carousel
- Pause on hover functionality
- Smooth transitions between slides

### Navigation
- Mobile menu toggle
- Smooth scroll effects
- Active state management

## WordPress Integration

- **Custom post types** for testimonials, case studies
- **Theme customizer** integration for easy content management
- **SEO-friendly** markup with proper heading hierarchy
- **Accessibility features** with ARIA labels and keyboard navigation
- **Performance optimized** with lazy loading and minified assets

## Installation

1. Extract theme to `/wp-content/themes/smartgrantsolutions-theme/`
2. Activate theme in WordPress admin
3. Copy images from original Tilda export `/project13160023/images/` to `/assets/images/`
4. Configure navigation menus
5. Add content through WordPress admin

## Asset Requirements

The theme references specific images from the original Tilda export that need to be copied:

### Required Images:
- MissionGranted logos and branding elements
- Funder organization logos (12 total)
- Feature section icons
- Background graphics and patterns

See `/assets/images/README.md` for complete asset list.

## Maintenance

This theme is designed to be highly maintainable with:
- **Modular SCSS** for easy style updates
- **Component-based JS** for feature enhancements
- **WordPress standards** compliance
- **Clear documentation** and comments throughout codebase

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance

- **Optimized CSS** with 7-1 SCSS architecture
- **Lazy loaded images** for faster page loads
- **Minified JavaScript** modules
- **Efficient animations** with GPU acceleration
- **Mobile-first** responsive design approach

---

**Note**: This theme provides a complete 1:1 recreation of the original Smart Grant Solutions website as exported from Tilda CMS, maintaining exact visual fidelity while providing the flexibility and scalability of a custom WordPress theme.
