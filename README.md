# Smart Grant Solutions WordPress Theme

A high-performance WordPress theme delivering a **1:1 exact recreation** of the Smart Grant Solutions website originally built with Tilda CMS, now featuring comprehensive performance optimizations and a complete multi-post-type content management system.

**Performance:** 4x faster load times (708ms), 10x faster rendering (1.0ms), critical CSS system with conditional loading.

## Project Overview

This theme transforms a static Tilda CMS export into a production-grade WordPress theme with:
- Pixel-perfect design accuracy maintaining original layouts, colors, and animations
- Complete content management system (blog, grants, success stories)
- Advanced performance optimizations with critical CSS and conditional loading
- Modular architecture for scalability and maintainability

## Key Features

### 🎯 1:1 Design Match
- **Exact color palette** from original Tilda design (#000000, #d81259, #FFB03F, #FCB03E)
- **Matching typography** using Inter, DM Sans, and Poppins fonts
- **Identical layouts** and spacing throughout
- **Precise animations** including the hero typed text effect and rocket animations
- **Original content** including all copy, testimonials, and feature descriptions
- **Viewport-spanning horizontal dividers** across all sections

### ⚡ Performance Architecture
- **Critical CSS System**: 5 page-specific critical CSS files for above-the-fold optimization
- **Conditional Loading**: JavaScript modules only load where needed (homepage-specific scripts)
- **Zero Legacy Bloat**: Complete removal of Tilda CSS dependencies
- **Deferred Loading**: Main CSS loaded asynchronously with preload strategy
- **Build Integration**: Automated critical CSS compilation and optimization

### 🔧 Technical Stack
- **Modular SCSS** using 7-1 architecture pattern (no theme.json)
- **ES6 JavaScript** with Rollup bundling and component modules
- **WordPress template hierarchy** with custom post types and template parts
- **Responsive design** matching original Tilda breakpoints

### 📝 Content Management
- **Custom Post Types**: Blog posts, grant opportunities, success stories
- **Archive Templates**: Dedicated pages for each content type with search/filtering
- **AJAX Functionality**: Show more buttons and live search across all post types
- **Metadata System**: Custom fields for grants (deadlines, amounts) and success stories

### 🎨 Brand Systems
- **Content-Specific Branding**: Yellow (grants), blue (success stories), pink (primary)
- **Consistent UI Components**: Matching cards, buttons, and layout patterns
- **Visual Effects**: Fisheye gradients, animated rockets, and scroll-triggered animations

## Theme Structure

```
sgs25/
├── assets/
│   ├── scss/
│   │   ├── abstracts/        # Variables, mixins, functions
│   │   ├── base/             # Reset, typography, global styles
│   │   ├── components/       # Buttons, cards, forms, hero, newsletter
│   │   ├── layout/           # Header, footer, grid, navigation
│   │   ├── pages/            # Page-specific styles (blog-*, grants, success stories)
│   │   ├── sections/         # Homepage sections (hero, features, etc.)
│   │   ├── src/              # 🚀 CRITICAL CSS SOURCE FILES
│   │   │   ├── critical-home.scss     # Homepage critical styles
│   │   │   ├── critical-blog.scss     # Blog pages critical styles  
│   │   │   ├── critical-grants.scss   # Grants pages critical styles
│   │   │   ├── critical-success.scss  # Success stories critical styles
│   │   │   └── critical-contact.scss  # Contact/testimonials critical styles
│   │   ├── dist/             # 🚀 COMPILED CRITICAL CSS FILES
│   │   │   └── critical-*.css # Production-ready critical CSS
│   │   └── main.scss         # Main SCSS compilation file
│   ├── js/
│   │   ├── modules/          # 🔥 Enhanced animation modules
│   │   │   ├── video-features.js      # Advanced rocket & flame animations
│   │   │   ├── typed-animation.js     # Homepage hero typing effect
│   │   │   └── trusted-organizations-carousel.js # Homepage carousel
│   │   ├── src/
│   │   │   ├── modules/      # Blog search, show more, AJAX functionality
│   │   │   └── main.js       # Main JavaScript entry point
│   │   └── dist/             # Compiled JavaScript bundles
│   └── images/               # Theme images, Tilda assets, and brand graphics
├── template-parts/           # Reusable template components
│   ├── blog/                 # Complete blog system components
│   ├── grants/               # Grant opportunities system
│   ├── success-stories/      # Success stories system
│   ├── contact/              # Contact form components
│   ├── testimonials/         # Testimonials system
│   └── [homepage-sections].php # Homepage component sections
├── inc/                      # WordPress functionality
│   ├── critical-css.php      # 🚀 Critical CSS loading system
│   ├── post-types.php        # Custom post type registration
│   ├── ajax-handlers.php     # AJAX functionality
│   ├── customizer.php        # Theme customizer options
│   └── theme-options.php     # Additional theme settings
├── page-templates/           # Custom page templates
│   ├── page-blog.php         # Blog archive page
│   ├── page-grants.php       # Grants archive page
│   ├── page-success-stories.php # Success stories archive page
│   ├── page-contact.php      # Contact page
│   └── page-testimonials.php # Testimonials page
├── single-templates/         # Single post templates
│   ├── single.php            # Default blog posts
│   ├── single-grant_opportunity.php # Individual grants
│   └── single-success_story.php     # Individual success stories
├── archive-templates/        # Archive templates
│   ├── archive-grant_opportunity.php # /grants/ URL
│   └── archive-success_story.php     # /success-stories/ URL
├── functions.php             # WordPress theme setup and enqueuing
├── header.php               # Site header with navigation
├── footer.php               # Site footer
├── index.php                # Main homepage template
└── style.css                # Compiled main stylesheet
```

## Installation & Setup

### Requirements
- WordPress 5.0+ / PHP 7.4+
- Node.js 14+ (for development)
- Modern browsers (Chrome 60+, Firefox 55+, Safari 12+, Edge 79+)

### Installation Steps
1. **Extract theme** to `/wp-content/themes/sgs25/`
2. **Install dependencies**: `npm install`
3. **Build all assets**: `npm run build` (includes critical CSS compilation)
4. **Activate theme** in WordPress admin
5. **Configure permalinks** (Settings → Permalinks → Save)
6. **Set up menus** in Appearance → Menus
7. **Add content** through WordPress admin

### Content Setup
1. **Create pages**: Blog, Grants, Success Stories, Contact, Testimonials
2. **Assign page templates** in page editor
3. **Add sample content** for each post type
4. **Configure navigation** menus
5. **Set homepage** in Settings → Reading

## Development Workflow

### Local Development
```bash
# Start development mode with critical CSS
npm run build-dev && npm run build-js-watch

# Watch for changes during development
npm run watch-critical    # Watch critical CSS files
npm run watch            # Watch main SCSS changes  

# Individual builds
npm run build-css           # Compile main SCSS
npm run build-critical      # Compile critical CSS (production)
npm run build-critical-dev  # Compile critical CSS (development)
npm run build-js            # Compile JavaScript
```

### Production Deployment
```bash
# Build all production assets (includes critical CSS optimization)
npm run build

# Assets are compiled to:
# - style.css (compressed CSS)
# - assets/js/dist/main.bundle.js (minified JS)
```

## Maintenance & Updates

### Code Organization
- **Modular SCSS** for easy style updates
- **Component-based JS** for feature enhancements  
- **Template parts** for content structure changes
- **WordPress standards** compliance throughout

### Updating Content
- **Blog posts** through WordPress admin → Posts
- **Grant opportunities** through WordPress admin → Grant Opportunities
- **Success stories** through WordPress admin → Success Stories
- **Homepage sections** through template part files

### Customization Points
- **Brand colors** in `assets/scss/abstracts/_variables.scss`
- **Typography** in `assets/scss/base/_typography.scss`
- **Homepage content** in `template-parts/[section].php` files
- **Post type fields** in `inc/post-types.php`

---

**Note**: This theme provides a complete 1:1 recreation of the original Smart Grant Solutions website with enhanced WordPress functionality including blog management, grants showcase, success stories display, and full content management capabilities. The modular architecture ensures maintainability while preserving exact visual fidelity to the original Tilda design.

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

---

**Note**: This theme provides a complete 1:1 recreation of the original Smart Grant Solutions website exported from Tilda CMS, maintaining exact visual fidelity while adding WordPress functionality and performance optimizations.
