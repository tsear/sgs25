# Smart Grant Solutions WordPress Theme

A custom WordPress theme that provides a **1:1 exact recreation** of the Smart Grant Solutions website (smartgrantsolutions.com) originally built with Tilda CMS.

## Project Overview

I created this theme to recreate the entire MissionGranted by Smart Grant Solutions website exactly as it appears in the original Tilda export, maintaining pixel-perfect accuracy while converting it to a scalable WordPress custom theme architecture.

This project transforms a static Tilda CMS export into a fully functional WordPress theme with complete blog functionality and modular architecture.

## Key Features

### 🎯 1:1 Design Match
- **Exact color palette** from original Tilda design (#000000, #d81259, #FFB03F, #FCB03E)
- **Matching typography** using Inter, DM Sans, and Poppins fonts
- **Identical layouts** and spacing throughout
- **Precise animations** including the hero typed text effect
- **Original content** including all copy, testimonials, and feature descriptions

### 🔧 Technical Architecture
- **No theme.json** - Pure SCSS/CSS approach for maximum flexibility
- **Modular SCSS** using 7-1 architecture pattern
- **Component-based JavaScript** with ES6 modules
- **WordPress template system** with proper PHP integration
- **Responsive design** matching original breakpoints
- **Complete blog system** with modular template architecture

### 📝 Blog System
- **Modular template-parts/blog/** architecture for maintainability
- **Complete single post template** system with hero, content, navigation
- **Blog index page** with two-column header design (title/newsletter LEFT, description RIGHT)
- **Post grid system** with real WordPress data integration
- **Related posts** functionality with image cards
- **Responsive design** with mobile-first approach
- **Graphics integration** (ellipse PNG, union SVG) with floating animations
- **Newsletter signup** form component
- **Post navigation** with previous/next and back-to-blog functionality

## Theme Structure

```
smartgrantsolutions-theme/
├── assets/
│   ├── scss/
│   │   ├── abstracts/        # Variables, mixins, functions
│   │   ├── base/             # Reset, typography, global styles
│   │   ├── components/       # Buttons, cards, forms, hero, blog components
│   │   ├── layout/           # Header, footer, grid, video-features
│   │   ├── pages/            # Page-specific styles
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
│   ├── blog/                 # Complete blog system components
│   │   ├── blog-header.php   # Two-column blog index header
│   │   ├── post-grid.php     # WordPress posts loop
│   │   ├── post-card.php     # Individual post card template
│   │   ├── post-hero.php     # Single post hero section
│   │   ├── post-content.php  # Single post content area
│   │   ├── post-navigation.php # Post navigation with prev/next
│   │   ├── related-posts.php # Related articles section
│   │   ├── newsletter-form.php # Newsletter signup component
│   │   └── pagination.php    # Blog pagination
│   ├── hero-home.php         # Homepage hero section with typed animation
│   ├── video-features.php    # Video features with rocket animations
│   └── trusted-organizations.php # Trust section with logo carousel
├── functions.php             # WordPress theme setup and enqueuing
├── header.php               # Site header with navigation
├── footer.php               # Site footer
├── index.php                # Main homepage template
├── single.php               # Single post template orchestrator
├── page-blog.php            # Custom blog page template
├── home.php                 # WordPress posts index template
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

## Blog System Architecture

I built a complete, modular blog system that integrates seamlessly with the main website design while providing full WordPress functionality.

### Blog Index Page
- **Two-column header layout** with title/newsletter signup on LEFT, description on RIGHT
- **Newsletter signup form** with email validation and styling consistent with main site
- **Graphics integration** using ellipse PNG and union SVG elements with floating animations
- **Responsive divider system** that adapts to different screen sizes
- **Mobile-first responsive design** with proper content stacking on smaller screens

### Post Grid System
- **WordPress posts loop** pulling real post data (title, excerpt, featured image, date)
- **Custom WP_Query** implementation to handle page template vs posts index requirements
- **Post card components** with consistent styling and hover effects
- **Bottom border styling** matching main site design language
- **Pagination support** for handling multiple pages of posts

### Single Post Template System
- **Modular template architecture** using template-parts/blog/ for maintainability
- **Post hero section** with title, excerpt, featured image, and meta information
- **Content area** with proper typography, tags, and author information
- **Post navigation** with previous/next post links and back-to-blog functionality
- **Related posts section** showing relevant articles with image cards
- **SEO-friendly structure** with proper heading hierarchy

### Blog Component Architecture
```
template-parts/blog/
├── blog-header.php          # Two-column blog index header
├── newsletter-form.php      # Newsletter signup component
├── post-grid.php           # WordPress posts loop with custom query
├── post-card.php           # Individual post card template
├── post-hero.php           # Single post hero section
├── post-content.php        # Single post content and meta
├── post-navigation.php     # Post navigation with prev/next
├── related-posts.php       # Related articles section
├── pagination.php          # Blog pagination component
├── no-results.php          # No posts found template
└── search-form.php         # Search functionality component
```

### Blog SCSS Components
```
assets/scss/components/
├── _blog-hero.scss         # Blog header styling with graphics
├── _newsletter-form.scss   # Newsletter signup form styling
├── _post-card.scss         # Post card component styling
├── _post-hero.scss         # Single post hero section
├── _post-content.scss      # Post content typography and layout
├── _post-navigation.scss   # Post navigation styling
└── _related-posts.scss     # Related posts grid styling
```

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

I built comprehensive WordPress integration that maintains design fidelity while providing full CMS functionality:

- **Complete blog system** with modular template-parts architecture
- **Custom post types** for testimonials, case studies, and other content
- **Theme customizer** integration for easy content management
- **SEO-friendly** markup with proper heading hierarchy
- **Accessibility features** with ARIA labels and keyboard navigation
- **Performance optimized** with lazy loading and minified assets
- **Custom queries** for flexible content display (blog page vs posts index)
- **Real WordPress data integration** (posts, featured images, excerpts, meta)

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

**Note**: I built this theme to provide a complete 1:1 recreation of the original Smart Grant Solutions website as exported from Tilda CMS, maintaining exact visual fidelity while providing the flexibility and scalability of a custom WordPress theme. The modular blog system extends this foundation with full WordPress functionality while preserving the original design language.
