# Smart Grant Solutions WordPress Theme

A custom WordPress theme that provides a **1:1 exact recreation** of the Smart Grant Solutions website (smartgrantsolutions.com) originally built with Tilda CMS, enhanced with a complete multi-post-type content management system.

## Project Overview

This theme recreates the entire MissionGranted by Smart Grant Solutions website exactly as it appears in the original Tilda export, maintaining pixel-perfect accuracy while converting it to a scalable WordPress custom theme architecture with full blog functionality, grants management, and success stories showcase.

The project transforms a static Tilda CMS export into a fully functional WordPress theme with complete content management capabilities and modular architecture.

## Key Features

### 🎯 1:1 Design Match
- **Exact color palette** from original Tilda design (#000000, #d81259, #FFB03F, #FCB03E)
- **Matching typography** using Inter, DM Sans, and Poppins fonts
- **Identical layouts** and spacing throughout
- **Precise animations** including the hero typed text effect and rocket animations
- **Original content** including all copy, testimonials, and feature descriptions
- **Viewport-spanning horizontal dividers** across all sections

### 🔧 Technical Architecture
- **No theme.json** - Pure SCSS/CSS approach for maximum flexibility
- **Modular SCSS** using 7-1 architecture pattern
- **Component-based JavaScript** with ES6 modules and Rollup bundling
- **WordPress template system** with proper PHP integration
- **Responsive design** matching original breakpoints
- **Complete multi-post-type system** with modular template architecture

### 📝 Content Management System
- **Blog Posts** - Traditional WordPress blog with show more functionality
- **Grant Opportunities** - Custom post type with deadline, amount, and organization metadata
- **Success Stories** - Custom post type showcasing client achievements
- **Single post templates** that work across all post types
- **Archive templates** for each custom post type
- **Modular template-parts** architecture for maintainability
- **AJAX show more** functionality for all post grids
- **Search functionality** integrated across all post types

### 🎨 Brand-Specific Design Systems
- **Yellow branding** for grants (yellow-circle.png, yellow-grid.svg)
- **Blue branding** for success stories (blue-circle.png, blue-grid.svg)
- **Fisheye radial gradient effects** with proper positioning
- **Consistent visual language** across all post types

## Theme Structure

```
sgs25/
├── assets/
│   ├── scss/
│   │   ├── abstracts/        # Variables, mixins, functions
│   │   ├── base/             # Reset, typography, global styles
│   │   ├── components/       # Buttons, cards, forms, hero, search components
│   │   ├── layout/           # Header, footer, grid, navigation
│   │   ├── pages/            # Page-specific styles including all post types
│   │   └── main.scss         # Main SCSS compilation file
│   ├── js/
│   │   ├── src/
│   │   │   ├── modules/      # Blog search, show more, animations
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

## Post Type System

### Blog Posts (post)
- **Default WordPress posts** for blog content
- **Show more functionality** with AJAX loading
- **Search integration** with filtering
- **Category and tag support**
- **Featured images and excerpts**

### Grant Opportunities (grant_opportunity)
- **Custom post type** for grant listings
- **Custom meta fields**: deadline, amount, organization
- **Yellow brand theming** with yellow-grid.svg backgrounds
- **Archive page** at `/grants/` URL
- **Search and filter functionality**

### Success Stories (success_story)
- **Custom post type** for client success stories
- **Organization metadata** for client attribution
- **Blue brand theming** with blue-grid.svg backgrounds
- **Archive page** at `/success-stories/` URL
- **Achievement showcase format**

## Template Parts Architecture

### Blog System (`template-parts/blog/`)
```
blog/
├── blog-hero.php             # Blog page header with newsletter signup
├── blog-header.php           # Two-column blog index header
├── post-grid.php             # WordPress posts loop with show more
├── post-card.php             # Individual post card template
├── post-hero.php             # Single post hero section
├── post-content.php          # Single post content area
├── post-navigation.php       # Post navigation with prev/next
├── related-posts.php         # Related articles section
├── search-form.php           # Blog search functionality
├── search-results.php        # Search results display
├── pagination.php            # Blog pagination
├── no-results.php            # No posts found template
└── newsletter-form.php       # Newsletter signup component
```

### Grants System (`template-parts/grants/`)
```
grants/
├── grants-hero.php           # Yellow-themed grants header with fisheye
├── grants-search-form.php    # Grants-specific search with yellow styling
├── grants-grid.php           # Grant opportunities loop with show more
├── grant-card.php            # Individual grant card with metadata
└── no-results.php            # No grants found template
```

### Success Stories System (`template-parts/success-stories/`)
```
success-stories/
├── success-stories-hero.php  # Blue-themed success stories header
├── success-stories-search-form.php # Blue-styled search form
├── success-stories-grid.php  # Success stories loop with show more
├── success-story-card.php    # Individual story card with organization
└── no-results.php            # No stories found template
```

## SCSS Architecture

### Modular Styling System
```
assets/scss/
├── abstracts/
│   ├── _variables.scss       # Brand colors, typography, spacing
│   └── _mixins.scss          # Responsive breakpoints, utilities
├── base/
│   ├── _reset.scss           # CSS reset and normalization
│   └── _typography.scss      # Font declarations and text styles
├── components/
│   ├── _buttons.scss         # Button styles across all post types
│   ├── _search-form.scss     # Search functionality styling
│   ├── _post-card.scss       # Post card components (blog/grants/success)
│   └── _hero-sections.scss   # Hero section styling
├── layout/
│   ├── _header.scss          # Site header and navigation
│   ├── _footer.scss          # Site footer
│   ├── _grid.scss            # Grid system and containers
│   └── _navigation.scss      # Menu and navigation elements
├── pages/
│   ├── _blog-archive.scss    # Blog-specific styling
│   ├── _grants.scss          # Grants page styling with yellow theme
│   ├── _success-stories-*.scss # Success stories styling with blue theme
│   └── _homepage.scss        # Homepage component styling
└── main.scss                 # Main compilation file with imports
```

## JavaScript Modules

### Core Functionality
- **TypedAnimation** - Hero section text cycling animation
- **BlogShowMore** - AJAX show more functionality for blog posts
- **SearchForms** - Search functionality across all post types
- **RocketAnimations** - Video features section scroll-triggered animations
- **TrustCarousel** - Auto-rotating logo carousel
- **Navigation** - Mobile menu and smooth scroll effects

### Build System
```bash
# Install dependencies
npm install

# Development builds
npm run build-css-dev    # Expanded CSS with source maps
npm run build-js         # Compile JavaScript modules

# Production builds
npm run build-css        # Compressed CSS
npm run build            # Full production build

# Development mode
npm run watch            # Watch SCSS changes
npm run build-js-watch   # Watch JavaScript changes
```

## WordPress Integration

### Custom Post Types
```php
// Grant Opportunities
register_post_type('grant_opportunity', [
    'public' => true,
    'rewrite' => ['slug' => 'grants'],
    'has_archive' => true,
    'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'custom-fields']
]);

// Success Stories  
register_post_type('success_story', [
    'public' => true,
    'rewrite' => ['slug' => 'success-stories'],
    'has_archive' => true,
    'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'custom-fields']
]);
```

### Template Hierarchy
- **Homepage**: `index.php` → homepage sections
- **Blog**: `page-blog.php` → blog template parts
- **Grants**: `page-grants.php` + `archive-grant_opportunity.php`
- **Success Stories**: `page-success-stories.php` + `archive-success_story.php`
- **Single Posts**: `single.php`, `single-grant_opportunity.php`, `single-success_story.php`

### AJAX Functionality
- **Show more buttons** for all post grids
- **Search filtering** across post types
- **Progressive loading** with animated transitions
- **Loading states** with SVG spinners

## Brand Visual System

### Color Palette
```scss
// Primary Brand Colors
$color-black: #000000;        // Primary background
$color-white: #ffffff;        // Text on dark backgrounds
$color-brand-pink: #d81259;   // Primary accent, typed animation
$color-brand-yellow: #FFB03F; // Grants branding, CTA buttons
$color-brand-blue: #0066CC;   // Success stories branding

// Extended Palette
$color-gray-dark: #666666;    // Navigation separators
$color-gray-light: #f8f8f8;   // Light backgrounds
```

### Typography System
```scss
$font-primary: 'Inter', Arial, sans-serif;     // Body text, navigation
$font-secondary: 'DM Sans', Arial, sans-serif; // Headlines, section titles  
$font-tertiary: 'Poppins', Arial, sans-serif;  // Accent font, buttons
```

### Graphics Assets
- **Yellow System**: `yellow-circle.png`, `yellow-grid.svg`, `yellow-grid-sqr.svg`
- **Blue System**: `blue-circle.png`, `blue-grid.svg`
- **Original Tilda Assets**: 100+ exported images and SVGs maintained
- **Brand Elements**: SGS logos, funder organization logos, icons

## Performance Optimizations

### Frontend Performance
- **Compressed CSS/JS** in production builds
- **Image optimization** with responsive sizing
- **Lazy loading** for below-fold content
- **GPU-accelerated animations** with transform/opacity
- **Efficient DOM queries** with minimal jQuery dependency

### WordPress Performance
- **Custom queries** optimized for each post type
- **Template part caching** where appropriate
- **Minimal plugin dependencies**
- **Clean markup** with semantic HTML5

## Browser Support & Compatibility

### Supported Browsers
- Chrome 60+ (full feature support)
- Firefox 55+ (full feature support)
- Safari 12+ (full feature support)
- Edge 79+ (full feature support)
- Mobile browsers (iOS Safari 12+, Chrome Mobile 60+)

### Progressive Enhancement
- **Core content** accessible without JavaScript
- **Enhanced interactions** with JavaScript enabled
- **Responsive design** works across all screen sizes
- **Fallback fonts** for improved loading

## Installation & Setup

### Requirements
- WordPress 5.0+
- PHP 7.4+
- Node.js 14+ (for development)

### Installation Steps
1. **Extract theme** to `/wp-content/themes/sgs25/`
2. **Install dependencies**: `npm install`
3. **Build assets**: `npm run build`
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
# Start development mode
npm run build-css-dev && npm run build-js-watch

# Or run individual builds
npm run build-css     # Compile SCSS
npm run build-js      # Compile JavaScript
npm run watch         # Watch SCSS changes
```

### Production Deployment
```bash
# Build production assets
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
