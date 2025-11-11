# Hosting & Server Configuration Guide
**Smart Grant Solutions WordPress Theme**  
**For Production Deployment**

---

## 🌐 SSL/HTTPS Configuration

### What is SSL and Why You Need It

**SSL (Secure Sockets Layer)** / **TLS (Transport Layer Security)** encrypts data between the user's browser and your server.

#### Benefits:
- 🔒 **Security** - Protects user data (form submissions, login credentials)
- 🔍 **SEO Boost** - Google ranks HTTPS sites higher
- ✅ **Browser Trust** - Modern browsers mark HTTP sites as "Not Secure"
- 💳 **PCI Compliance** - Required if processing payments
- 🎯 **User Confidence** - Shows your site is legitimate

### How to Enable SSL/HTTPS

**Good news:** Your WordPress theme doesn't need to do anything for SSL. It's handled at the hosting/server level.

#### Option 1: Let's Encrypt (FREE - Recommended)
Most modern hosting providers offer free SSL via Let's Encrypt:

**cPanel Hosting:**
1. Log into cPanel
2. Go to "SSL/TLS Status" or "Let's Encrypt"
3. Click "Issue" next to your domain
4. Certificate installs automatically

**Popular Hosts with Free SSL:**
- ✅ SiteGround - Auto-installs Let's Encrypt
- ✅ Bluehost - Free SSL included
- ✅ HostGator - Free SSL available
- ✅ WP Engine - SSL included
- ✅ Kinsta - Free SSL included
- ✅ Cloudflare - Free SSL + CDN

#### Option 2: Premium SSL Certificate ($50-200/year)
- **Extended Validation (EV)** - Shows green bar with company name
- **Wildcard SSL** - Covers all subdomains (*.yourdomain.com)
- Purchase from: DigiCert, Comodo, GeoTrust

#### After Enabling SSL:
1. **Update WordPress URLs:**
   - Go to Settings → General
   - Change "WordPress Address" to `https://yourdomain.com`
   - Change "Site Address" to `https://yourdomain.com`

2. **Install "Really Simple SSL" Plugin** (recommended):
   - Automatically redirects HTTP → HTTPS
   - Fixes mixed content warnings
   - One-click setup

3. **Test your SSL:**
   - Visit: https://www.ssllabs.com/ssltest/
   - Should score **A** or **A+**

---

## 🛡️ HTTP Security Headers

### What Are Security Headers?

HTTP security headers are instructions sent from your server to the browser, telling it how to handle your site's content securely.

**Important:** These are **NOT configured in your WordPress theme**. They must be set at the server/hosting level.

### Recommended Security Headers

#### 1. X-Content-Type-Options
**Prevents:** MIME type sniffing attacks
```apache
Header set X-Content-Type-Options "nosniff"
```

#### 2. X-Frame-Options
**Prevents:** Clickjacking attacks (your site being embedded in iframes)
```apache
Header set X-Frame-Options "SAMEORIGIN"
```

#### 3. X-XSS-Protection
**Prevents:** Cross-site scripting (XSS) attacks
```apache
Header set X-XSS-Protection "1; mode=block"
```

#### 4. Referrer-Policy
**Controls:** What information is sent in the Referrer header
```apache
Header set Referrer-Policy "strict-origin-when-cross-origin"
```

#### 5. Permissions-Policy (formerly Feature-Policy)
**Controls:** Browser features (camera, microphone, geolocation)
```apache
Header set Permissions-Policy "camera=(), microphone=(), geolocation=()"
```

#### 6. Strict-Transport-Security (HSTS)
**Forces:** HTTPS connections only (only add AFTER SSL is working!)
```apache
Header set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"
```

---

## 📝 How to Add Security Headers

### Method 1: .htaccess File (Apache Servers)

**Location:** WordPress root directory (same folder as wp-config.php)

Add this code to your `.htaccess` file:

```apache
# BEGIN Security Headers
<IfModule mod_headers.c>
    # Prevent MIME type sniffing
    Header set X-Content-Type-Options "nosniff"
    
    # Prevent clickjacking
    Header set X-Frame-Options "SAMEORIGIN"
    
    # Enable XSS protection
    Header set X-XSS-Protection "1; mode=block"
    
    # Control referrer information
    Header set Referrer-Policy "strict-origin-when-cross-origin"
    
    # Restrict browser features
    Header set Permissions-Policy "camera=(), microphone=(), geolocation=()"
    
    # Force HTTPS (only add after SSL is configured!)
    # Header set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"
</IfModule>
# END Security Headers

# BEGIN Browser Caching
<IfModule mod_expires.c>
    ExpiresActive On
    
    # Images
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType image/svg+xml "access plus 1 year"
    
    # CSS and JavaScript
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType application/x-javascript "access plus 1 month"
    
    # Fonts
    ExpiresByType font/woff "access plus 1 year"
    ExpiresByType font/woff2 "access plus 1 year"
    ExpiresByType application/font-woff "access plus 1 year"
    ExpiresByType application/font-woff2 "access plus 1 year"
    
    # Default
    ExpiresDefault "access plus 1 week"
</IfModule>
# END Browser Caching

# BEGIN Gzip Compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/json
</IfModule>
# END Gzip Compression
```

### Method 2: WordPress Plugin (Easiest)

**Recommended Plugin:** "Security Headers" by Dionysios Nikolopoulos
- One-click security header setup
- No code required
- WP admin interface

**Alternative:** "Really Simple SSL Pro" includes security headers

### Method 3: Cloudflare (CDN + Security)

If using Cloudflare (free tier available):
1. Enable **SSL/TLS** → Full (Strict)
2. Enable **Security Headers** in Transform Rules
3. Enable **Auto Minify** (CSS, JS, HTML)
4. Enable **Brotli Compression**
5. Enable **HTTP/3 (QUIC)**

### Method 4: Hosting Control Panel

Many hosts have built-in security header configuration:
- **SiteGround** - Site Tools → Security → Security Headers
- **Kinsta** - MyKinsta dashboard → Security settings
- **WP Engine** - Automatically configured

---

## 🔍 How to Test Your Security Headers

### Online Testing Tools:

1. **Security Headers** - https://securityheaders.com/
   - Enter your domain
   - Shows missing headers
   - Grade: F (bad) to A+ (excellent)
   - **Target Score: A or A+**

2. **Mozilla Observatory** - https://observatory.mozilla.org/
   - Comprehensive security scan
   - Shows specific recommendations
   - **Target Score: 90+**

3. **SSL Labs** - https://www.ssllabs.com/ssltest/
   - Tests SSL/TLS configuration
   - **Target Score: A or A+**

### Command Line Testing:
```bash
# Check security headers
curl -I https://yourdomain.com

# Should see headers like:
# x-content-type-options: nosniff
# x-frame-options: SAMEORIGIN
# x-xss-protection: 1; mode=block
```

---

## 📊 What Your Theme Already Handles

### ✅ Application-Level Security (Theme Level)
Your theme **already has** these protections:
- ✅ Input sanitization
- ✅ Output escaping
- ✅ AJAX nonce verification
- ✅ Direct file access prevention
- ✅ SQL injection prevention (via WP_Query)
- ✅ XSS prevention (via WordPress functions)

### ⚠️ Server-Level Security (Hosting Level)
These are **NOT** in the theme (they shouldn't be):
- ⚠️ SSL/HTTPS certificates
- ⚠️ HTTP security headers
- ⚠️ Server firewall rules
- ⚠️ DDoS protection
- ⚠️ Intrusion detection
- ⚠️ Server-level caching

**Why?** Because themes are application code, not server configuration. Mixing the two creates portability issues and conflicts.

---

## 🎯 Quick Setup Checklist

### Step 1: SSL Certificate (Day 1 - Before Launch)
- [ ] Enable Let's Encrypt SSL (free via hosting cPanel)
- [ ] Update WordPress URLs to https://
- [ ] Install "Really Simple SSL" plugin
- [ ] Test: Visit https://yourdomain.com (should work)
- [ ] Test: Visit http://yourdomain.com (should redirect to https)

### Step 2: Security Headers (Day 1 - Before Launch)
- [ ] Add security headers to .htaccess (see code above)
- [ ] OR install "Security Headers" plugin
- [ ] Test at https://securityheaders.com/ (target: A grade)

### Step 3: Caching & Performance (Day 2)
- [ ] Add browser caching to .htaccess (see code above)
- [ ] Enable Gzip compression
- [ ] Install caching plugin: WP Super Cache or W3 Total Cache
- [ ] Test at https://gtmetrix.com/ (target: A grade)

### Step 4: Security Plugin (Day 2)
- [ ] Install Wordfence or Sucuri Security
- [ ] Run initial security scan
- [ ] Enable firewall
- [ ] Enable login attempt limiting

### Step 5: Backups (Day 2)
- [ ] Install UpdraftPlus or BackupBuddy
- [ ] Configure automatic daily backups
- [ ] Test backup restoration
- [ ] Store backups off-site (Dropbox, Google Drive)

### Step 6: Monitoring (Day 3)
- [ ] Set up uptime monitoring (UptimeRobot - free)
- [ ] Enable Google Search Console
- [ ] Enable Google Analytics
- [ ] Set up email notifications for downtime

---

## 🏆 Recommended Hosting Providers

### Premium Managed WordPress Hosting (Best Performance)
| Host | Price/Month | SSL | CDN | Backups | Support |
|------|-------------|-----|-----|---------|---------|
| **WP Engine** | $20+ | ✅ Free | ✅ Included | ✅ Daily | ⭐⭐⭐⭐⭐ |
| **Kinsta** | $35+ | ✅ Free | ✅ Cloudflare | ✅ Daily | ⭐⭐⭐⭐⭐ |
| **Flywheel** | $15+ | ✅ Free | ✅ Included | ✅ Nightly | ⭐⭐⭐⭐⭐ |

### Shared Hosting (Budget-Friendly)
| Host | Price/Month | SSL | Support | Notes |
|------|-------------|-----|---------|-------|
| **SiteGround** | $3-15 | ✅ Free | ⭐⭐⭐⭐⭐ | Best budget option |
| **Bluehost** | $3-10 | ✅ Free | ⭐⭐⭐ | WordPress recommended |
| **DreamHost** | $3-12 | ✅ Free | ⭐⭐⭐⭐ | Reliable uptime |

### All Hosting Providers Should Include:
- ✅ Free SSL certificate (Let's Encrypt)
- ✅ PHP 7.4+ support
- ✅ MySQL 5.7+ or MariaDB 10.2+
- ✅ Daily backups
- ✅ One-click WordPress installation
- ✅ SSH access (optional but recommended)

---

## 🔧 Server Requirements (Minimum)

Your theme requires:
- **PHP:** 7.4+ (8.0+ recommended)
- **WordPress:** 5.0+ (6.4+ recommended)
- **MySQL:** 5.7+ or MariaDB 10.2+
- **RAM:** 256MB minimum, 512MB+ recommended
- **Disk Space:** 1GB minimum
- **PHP Extensions:**
  - mysqli (database)
  - json (AJAX)
  - gd or imagick (image processing)
  - curl (external API calls)
  - zip (plugin/theme installation)

---

## 📞 Support Resources

### If You Need Help:
1. **SSL Issues** → Contact your hosting provider's support
2. **Security Headers** → Use .htaccess method or plugin
3. **Performance** → Install WP Super Cache plugin
4. **Security Scans** → Install Wordfence plugin
5. **Backups** → Install UpdraftPlus plugin

### Testing Tools:
- SSL Test: https://www.ssllabs.com/ssltest/
- Security Headers: https://securityheaders.com/
- Page Speed: https://gtmetrix.com/
- Security Scan: https://sitecheck.sucuri.net/

---

## ✅ Summary

### Your Theme (Application Level) ✅
Your theme is **secure and production-ready** with proper input sanitization, output escaping, and WordPress best practices.

### Your Server (Infrastructure Level) ⚠️
You need to configure:
1. **SSL/HTTPS** - Free via Let's Encrypt (5 minutes)
2. **Security Headers** - Via .htaccess or plugin (5 minutes)
3. **Caching** - Via .htaccess or plugin (10 minutes)
4. **Security Plugin** - Wordfence or Sucuri (10 minutes)
5. **Backups** - UpdraftPlus plugin (10 minutes)

**Total Setup Time: ~40 minutes**

These are **standard practices for ANY WordPress site**, not specific to your theme. Once configured, they require minimal maintenance.

**You're already 90% done!** 🎉
