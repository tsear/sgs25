<?php
/**
 * Minimal Critical CSS for Homepage - Above the Fold Only
 * Only includes styles needed for header and hero section
 */

function get_minimal_critical_css_home() {
    return '
/* Reset and Base - Minimal */
*{box-sizing:border-box}
html{font-size:16px;scroll-behavior:smooth;overflow-x:hidden}
body{margin:0;padding:0;font-family:"Inter",-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Helvetica","Arial",sans-serif;font-size:16px;font-weight:400;line-height:1.55;color:#fff;background-color:#000;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;overflow-x:hidden}

/* Header Styles Only */
.site-header{background-color:#000;position:fixed;top:0;width:100%;z-index:100;height:60px}
.site-header::before{content:"";position:absolute;top:0;left:0;right:0;height:1px;background-color:#fff}
.site-header::after{content:"";position:absolute;bottom:0;left:0;right:0;height:1px;background-color:#fff}
.header-container{width:100vw;max-width:none;margin:0;padding:0;position:relative;height:60px}
.site-branding{position:absolute;left:33px;top:50%;transform:translateY(-50%)}
.site-branding .logo-cell{width:150px;height:60px;border:1px solid #fff;border-bottom:none;border-top:none;display:flex;align-items:center;justify-content:center;background-color:rgba(0,0,0,0);transition:background-color .2s ease-in-out}
.site-branding .logo-cell .site-logo img{height:28px}
.main-navigation{position:absolute;right:33px;top:50%;transform:translateY(-50%)}
@media(max-width: 1199px){.main-navigation{display:none}}

/* Hero Section Only */
.hero-section{font-family:"Poppins",Arial,sans-serif;width:100%;height:390px;background-color:#000;position:relative;overflow:hidden;margin:0;padding:0;top:0}
.hero-container{width:100%;height:100%;position:relative;margin:0;padding:0;top:0}
.hero-grid{position:absolute;top:0;left:0;width:100%;height:390px;z-index:1;opacity:.75}
.hero-logo{position:absolute;top:120px;left:100px;width:550px;z-index:10}
.hero-is-text{position:absolute;top:122px;left:670px;width:60px;z-index:10;color:#fff;font-size:62px;font-family:"Poppins",Arial,sans-serif;line-height:1;font-weight:800}
.hero-typewriter{position:absolute;top:210px;left:100px;width:1200px;z-index:10;color:#d81259;font-size:65px;font-family:"Poppins",Arial,sans-serif;line-height:1;font-weight:700;text-transform:uppercase;white-space:nowrap}
.bottom-right-section{position:absolute;bottom:20px;right:20px;z-index:10;display:flex;align-items:center;gap:15px}
.proudly-developed{color:#fff;font-size:14px;font-family:"Poppins",Arial,sans-serif;font-weight:400;white-space:nowrap}
.hero-sgs-logo{width:150px}

/* Mobile Hero Responsive */
@media screen and (max-width: 479px) {
    .hero-section{height:330px!important}
    .hero-logo{top:38px!important;left:35px!important;width:250px!important}
    .hero-is-text{top:78px!important;left:147px!important;width:26px!important;font-size:28px!important}
    .hero-typewriter{top:163px!important;left:33px!important;width:255px!important;font-size:28px!important;text-align:center!important}
}

/* Basic Image Styles */
img{max-width:100%;height:auto;display:block}
';
}
