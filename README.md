# Smart Grant Solutions Theme

**Version:** 1.1.0  
**Requires:** WordPress 6.0+ | PHP 8.0+  
**Author:** Tyler Sear

WordPress theme for Smart Grant Solutions (MissionGranted platform). Features modular homepage, custom post types for grants/testimonials/downloads, HubSpot integration, and industry-specific landing pages.

---

## What This Theme Does

**Marketing Website:**
- Modular homepage with hero animation, features, video testimonials, consulting CTA, FAQ
- Industry landing pages (nonprofits, grantmakers, local government) with unique designs
- Product showcase, about, contact, blog, referral program pages

**Content Management:**
- Custom post types: Grant Opportunities, Testimonials, Downloads
- Taxonomies: Grant categories, funding amounts, testimonial categories, download categories
- Archive pages with AJAX search and filtering
- Single post templates with related content

**HubSpot Integration:**
- Referral tracking with URL parameter capture and cookie storage
- Admin dashboard for referral management (stats, code generator, CSV export)
- Newsletter signup forms connected to HubSpot Forms API
- Contact form embedding with referral source tracking

**Performance & Build:**
- Critical CSS system for above-the-fold optimization
- SCSS compilation with 7-1 architecture
- JavaScript bundling (Rollup) + React components (Vite)
- Deferred script loading, cache busting, asset optimization

---

## Quick Start

```bash
cd wp-content/themes/
git clone [repo-url] sgs25
cd sgs25
npm install
npm run build
```

Activate theme in WordPress admin, then set permalinks to "Post name" (Settings → Permalinks → Save).

---

## Content Types

**Custom Post Types** (`inc/post-types.php`):
- **Grant Opportunities** (`grant_opportunity`) - `/grants/` - Custom fields for deadlines, amounts, categories
- **Testimonials** (`success_story`) - `/testimonials/` - Video embeds, categories, featured content
- **Downloads** (`downloadable_content`) - `/downloads/` - File attachments, categories, gated content
- **Blog Posts** (standard WordPress) - `/blog/` - Categories, tags, featured images

**Taxonomies:**
- `grant_category` - Hierarchical categories for grants
- `funding_amount` - Non-hierarchical tags for grant amounts  
- `success_story_category` - Hierarchical categories for testimonials
- `download_category` - Hierarchical categories for downloads

**Archive Templates:**
- `archive-grant_opportunity.php` - Grants grid with search/filter
- `archive-success_story.php` - Testimonials grid with AJAX load more
- `archive-downloadable_content.php` - Downloads list with category filter
- `page-blog.php` - Blog archive with search
- Plus taxonomy archives: `taxonomy-grant_category.php`, `taxonomy-funding_amount.php`, `taxonomy-success_story_category.php`

**Single Templates:**
- `single-grant_opportunity.php` - Individual grant with metadata
- `single-success_story.php` - Testimonial with related stories
- `single-downloadable_content.php` - Download page with file gateway
- `single.php` - Standard blog post

---

## HubSpot Integration

**Referral Tracking System:**
- URL parameter capture: `/?referral_source=CODE`
- Cookie storage: `sgs_referral_public` (30-day expiration, SameSite=Lax)
- Auto-populates HubSpot form fields with referral source
- Admin dashboard: `inc/referral-tracking.php` (stats cards, manual code generator, searchable table, CSV export)
- API integration: `inc/referral-api.php` (creates contacts with referral_code property)
- Frontend JS: `referral-minimal.js` (URL capture), `referral-signup.js` (public form)
- Admin access: Authors + Admins (capability: `edit_others_posts`)

**Newsletter Signups:**
- HubSpot Forms API integration (`inc/ajax-handlers.php`)
- Newsletter forms throughout site (`template-parts/newsletter-signup.php`)
- JavaScript handler: `assets/js/src/modules/newsletter.js`
- Tracked in HubSpot with email property

**Contact Forms:**
- HubSpot embedded form on contact page
- Referral source field auto-populated from cookie
- Form ID: 2cd3f48e-c5a2-4f5f-89ae-70d16a736d04
- Portal ID: 44675524

---

## Page Templates & Features

**Homepage** (`index.php`):
- Landing hero with typed animation effect
- Features section with icon grid
- Video testimonial showcase
- React-powered video features component (rocket animations)
- Consulting services CTA
- Funnel conversion section
- Financial compliance badges
- Directory CTA
- Mission separator
- FAQ accordion

**Industry Landing Pages:**
- `page-nonprofits.php` - Pink brand theme, vertical flow design
- `page-grantmakers.php` - Yellow brand theme, split layout
- `page-local-government.php` - Blue brand theme, feature grid

**Archive Pages:**
- `page-blog.php` - Blog archive with AJAX search
- `page-grants.php` - Grants list with filtering
- `page-success-stories.php` - Testimonials grid
- `page-downloads.php` - Downloads gateway
- `page-testimonials.php` - Video testimonials display

**Marketing Pages:**
- `page-about.php` - Company overview, team
- `page-product.php` - MissionGranted platform showcase
- `page-contact.php` - HubSpot embedded contact form
- `page-referral-program.php` - Referral program details with signup form
- `page-cloud-software.php` - Cloud software solutions
- `page-consulting-services.php` - Consulting services
- `page-industries.php` - Industries served overview

**Utility Pages:**
- `page-privacy-policy.php` - Privacy policy
- `page-terms-of-service.php` - Terms of service
- `404.php` - Custom error page
- `search.php` - Global search results
- `search-grant_opportunity.php` - Grant-specific search
- `search-success_story.php` - Testimonial-specific search

---

## Build System

**Commands:**
```bash
npm run build          # Production: minified CSS + JS + React
npm run build-css      # Compile SCSS to style.css
npm run build-critical # Compile critical CSS files
npm run build-js       # Bundle main.js with Rollup
npm run vite:build     # Build React components
npm run watch          # Dev mode: auto-rebuild SCSS
```

**Critical CSS:**
Page-specific critical styles in `assets/scss/src/critical-*.scss` compile to `assets/scss/dist/critical-*.css`. Loaded conditionally via `inc/critical-css.php`.

**JavaScript Modules** (`assets/js/src/modules/`):
- `blog-search.js` - AJAX blog search
- `blog-showmore.js` - Load more posts functionality
- `contact-page.js` - Contact form enhancements
- `downloads.js` - Download gateway logic
- `hubspot-tracking.js` - HubSpot form submission tracking
- `landing-hero.js` - Homepage hero animations
- `mobile-menu.js` - Mobile navigation
- `newsletter.js` - Newsletter signup handling
- `referral-minimal.js` - Referral URL capture & cookie
- `referral-signup.js` - Public referral form
- `rocket-animation.js` - Animated rocket graphics
- `rss-feed-fincom.js` - Financial compliance RSS
- `rss-feed-mission-div.js` - Mission division RSS
- `value-prop-animations.js` - Scroll-triggered animations

Modules bundle to `assets/js/dist/main.bundle.js` via Rollup. React components (video features) build separately with Vite to `assets/dist/video-features.js`.

---

## File Structure

```
sgs25/
├── assets/
│   ├── scss/
│   │   ├── abstracts/     # Variables, mixins
│   │   ├── base/          # Typography, reset
│   │   ├── components/    # Buttons, cards, forms
│   │   ├── layout/        # Header, footer, grid
│   │   ├── pages/         # Page-specific styles
│   │   ├── sections/      # Homepage sections
│   │   └── src/           # Critical CSS source
│   ├── js/
│   │   ├── src/
│   │   │   ├── main.js    # Entry point
│   │   │   └── modules/   # Feature modules
│   │   └── dist/          # Compiled bundles
│   └── images/            # Theme assets
├── inc/
│   ├── ajax-handlers.php       # AJAX endpoints
│   ├── critical-css.php        # Critical CSS loader
│   ├── customizer.php          # Theme customizer
│   ├── post-types.php          # CPT registration
│   ├── referral-api.php        # HubSpot API
│   ├── referral-tracking.php   # Admin dashboard
│   └── theme-options.php       # Settings
├── template-parts/
│   ├── about/                  # About sections
│   ├── blog/                   # Blog components
│   ├── contact/                # Contact form
│   ├── downloads/              # Downloads grid
│   ├── grantmakers/            # Grantmakers content
│   ├── grants/                 # Grants grid
│   ├── local-government/       # Local gov content
│   ├── nonprofits/             # Nonprofits content
│   ├── success-stories/        # Testimonials
│   └── [homepage sections]     # Hero, features, etc.
├── functions.php               # Theme setup
├── header.php                  # Site header
├── footer.php                  # Site footer
├── index.php                   # Homepage
├── single.php                  # Blog posts
├── page-*.php                  # Page templates (18)
├── single-*.php                # CPT singles (3)
├── archive-*.php               # CPT archives (3)
├── style.css                   # Compiled CSS
└── package.json                # Build dependencies
```

---

## Template Parts System

**Modular Components** (`template-parts/`):
- `about/` - About hero, overview, team sections
- `blog/` - Blog hero, post grid, post card, search, pagination, newsletter form
- `cloud-software/` - Cloud software page sections
- `consulting-services/` - Consulting page components
- `contact/` - Contact form, CTA sections
- `downloads/` - Downloads grid, search, filters
- `grantmakers/` - Grantmakers hero and content
- `grants/` - Grants grid, search, filters
- `industries/` - Industries overview sections
- `local-government/` - Local government hero and content
- `nonprofits/` - Nonprofits hero and content
- `products/` - Product showcase sections
- `referral-program/` - Referral signup form
- `success-stories/` - Testimonials grid, hero, filters
- `testimonials/` - Video testimonials, grid display

**Reusable Sections:**
- `directory-cta.php` - CTA to directory
- `features-section.php` - Homepage features grid
- `financial-compliance.php` - Compliance badges
- `footer-badge-carousel.php` - Footer badge slider
- `funnel-cta.php` - Conversion CTAs
- `hero-home.php` - Typed hero animation (legacy)
- `landing-hero.php` - Main homepage hero
- `mission-separator.php` - Visual section dividers
- `newsletter-signup.php` - Newsletter forms
- `page-breaker.php` - Page section breaks
- `testimonial-video.php` - Video testimonial embed
- `trusted-organizations.php` - Logo carousel
- `value-proposition.php` - Value prop section
- `video-features.php` - Legacy video features
- `video-features-react.php` - React video component

## Development Workflow

**SCSS:**
7-1 architecture in `assets/scss/`. Edit source files, compile with `npm run build-css`.

**JavaScript:**
Create modules in `assets/js/src/modules/`, import in `main.js`, bundle with `npm run build-js`.

**React Components:**
Create in `assets/src/`, build with `npm run vite:build`. React components use Vite for hot module replacement and optimized builds.

**Adding Pages:**
1. Create `page-name.php` in root
2. Add styles to `assets/scss/pages/_name.scss`
3. Import in `assets/scss/main.scss`
4. Create template parts in `template-parts/name/`
5. Run `npm run build`

**Testing:**
- PHP 8.0+ required (enforced in `functions.php`)
- WordPress 6.0+ required (checked on theme activation)
- Test in Chrome 60+, Firefox 55+, Safari 12+, Edge 79+
- Mobile testing on iOS 12+ and Android Chrome 60+

---

## Security

- Input sanitization on all `$_GET`, `$_POST`, `$_REQUEST`
- Nonce verification on AJAX endpoints
- PHP 8.0+ and WordPress 6.0+ enforcement
- Direct file access prevention (`ABSPATH` checks)
- XML-RPC disabled
- WordPress version hidden

---

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+ (Chromium)
- iOS Safari 12+
- Android Chrome 60+

No IE11 support (uses CSS Grid, Flexbox, ES6).

---

## Documentation

- **QUICK_START.md** - Production deployment checklist
- **HOSTING_SETUP.md** - Server configuration (SSL, headers)
- **SECURITY_AUDIT.md** - Security assessment
- **BROWSER_COMPATIBILITY.md** - Browser testing guide

---

## Changelog

**1.1.0** (Dec 15, 2025)
- Added HubSpot referral tracking system
- Admin dashboard with stats, code generator, CSV export
- Changed admin access to Authors + Admins
- Removed automated emails (CRM integration only)
- Updated requirements: WP 6.0+, PHP 8.0+
- Cleaned JavaScript debug code

**1.0.2** (Nov 2025)
- Industry landing pages (nonprofits, grantmakers, local gov)
- PHP/WP version enforcement
- Security hardening (95/100 score)
- Performance optimization

---

**License:** Proprietary  
**Copyright:** © 2025 Smart Grant Solutions
