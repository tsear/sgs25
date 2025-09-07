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
│   │   ├── abstracts/        # Variables, mixins, functions
│   │   ├── base/             # Reset, typography, global styles
│   │   ├── components/       # Buttons, cards, forms, hero
│   │   ├── layout/           # Header, footer, grid, video-features
│   │   └── main.scss         # Main SCSS compilation file
│   ├── js/
│   │   ├── components/       # Navigation, forms, animations
│   │   ├── modules/          # Typed animation, carousel, trust
│   │   ├── utils/            # Helper functions
│   │   ├── rocket-animations.js  # Video features rocket & exhaust animations
│   │   ├── video-features.js     # Video features section logic
│   │   └── main.js           # Main JavaScript entry point
│   ├── css/                  # Original Tilda exported CSS files
│   └── images/               # Theme images and Tilda assets
├── template-parts/           # Reusable template components
│   ├── hero.php             # Hero section with typed animation
│   ├── video-features.php   # Video features with rocket animations
│   └── trust-carousel.php   # Trust section with logo carousel
├── functions.php             # WordPress theme setup and enqueuing
├── header.php               # Site header with navigation
├── footer.php               # Site footer
├── index.php                # Main homepage template
├── style.css                # Compiled main stylesheet
└── package.json             # NPM dependencies and build scripts
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

### Hero Section
- **MissionGranted branding** with animated cycling text
- **Grid background pattern** with moving pink spotlight effect
- **Typed animation**: "spreadsheet automation", "grant&fund management", "simplified compliance", "proudly built by"
- **Color-matched cursor** animation (#d81259)
- **Mouse-following spotlight** with radial gradient effect

### Value Proposition Section
- **Main headline**: "We Make Financial Grant Management and Compliance Easy, So You Can Focus on What Matters Most – Your Mission."
- **Grid background** with fish-eye distortion effect
- **CTA buttons** with exact styling and hover effects
- **Left-aligned content** with background grid pattern

### Trusted Organizations Section  
- **Auto-rotating logo carousel** with organization logos
- **Section title**: "TRUSTED BY ORGANIZATIONS MANAGING GRANTS FROM TOP U.S. FUNDERS"
- **Smooth carousel transitions** with pause on hover
- **Multiple funder organization logos** in continuous loop

### Financial Compliance Section
- **Section headline**: "Propelling Your Financial Compliance" 
- **Descriptive content** about compliance management
- **CTA integration** with proper styling
- **Top border separator** for section division

### Video Features Section
- **Animated rocket sequence** with scroll-triggered fade-in effects
- **Four rocket stages** representing product evolution
- **Exhaust flame animations** with rotation effects beneath final rocket
- **Connection labels** linking rockets to feature cards
- **Background ellipses** with precise positioning from original design
- **Scroll detection** with intersection observer for performance
- **White floor border** providing visual foundation

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

### RocketAnimations  
- **Scroll-triggered rocket animations** with intersection observer
- **Sequential fade-in effects** with staggered timing
- **Exhaust flame animations** with 3-second delay after rockets
- **Rotation effects** using sine wave motion (left rotates left, right rotates right)
- **Performance optimized** with requestAnimationFrame
- **One-time triggers** preventing re-animation on scroll

### TrustCarousel
- Auto-rotating logo carousel
- Pause on hover functionality
- Smooth transitions between slides

### VideoFeatures
- Coordinates video features section interactions
- Manages scroll effects and timing
- Integrates with rocket animation system

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

## Development Setup

### Prerequisites
- Node.js and npm for SCSS compilation
- WordPress development environment

### Build System
```bash
# Install dependencies
npm install

# Development build (expanded CSS with source maps)
npm run build-css-dev

# Production build (compressed CSS)
npm run build-css-prod

# Watch mode for development
npm run watch-css
```

### SCSS Architecture
- **7-1 Pattern**: Organized SCSS following industry standards
- **Component-based**: Modular styles for maintainability  
- **Variables**: Centralized color and typography system
- **Mixins**: Reusable responsive breakpoints and utilities

## Installation

1. Extract theme to `/wp-content/themes/smartgrantsolutions-theme/`
2. Run `npm install` to install SCSS dependencies
3. Run `npm run build-css-dev` to compile styles
4. Activate theme in WordPress admin
5. Copy images from original Tilda export `/project13160023/images/` to `/assets/images/`
6. Configure navigation menus
7. Add content through WordPress admin

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
