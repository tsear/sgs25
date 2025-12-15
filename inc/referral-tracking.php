<?php
/**
 * Referral Tracking System - API Based
 * 
 * Uses HubSpot API for all referral tracking:
 * 1. Contacts with referral codes stored in HubSpot
 * 2. Associations tracked via HubSpot
 * 3. Admin UI to view/manage via API
 */

// Admin menu for referral code generation
add_action('admin_menu', 'sgs_referral_admin_menu');
function sgs_referral_admin_menu() {
    add_menu_page(
        'Referral Management',         // Page title
        'Referrals',                   // Menu title
        'edit_others_posts',           // Capability (Admin + Author)
        'sgs-referral-codes',          // Menu slug
        'sgs_referral_admin_page',     // Callback function
        'dashicons-groups',            // Icon
        30                             // Position
    );
}

// Admin page content
function sgs_referral_admin_page() {
    // Fetch all referral contacts from HubSpot API
    $referral_codes = sgs_fetch_referrals_from_hubspot();
    
    // Calculate stats
    $total_referrers = count($referral_codes);
    $total_conversions = 0;
    $active_this_month = 0;
    $current_month = date('Y-m');
    
    foreach ($referral_codes as $data) {
        $total_conversions += count($data['referrals'] ?? []);
        if (!empty($data['created_at']) && strpos($data['created_at'], $current_month) === 0) {
            $active_this_month++;
        }
    }
    
    $conversion_rate = $total_referrers > 0 ? round(($total_conversions / $total_referrers) * 100, 1) : 0;
    
    // Handle refresh from HubSpot
    if (isset($_POST['refresh_from_hubspot'])) {
        check_admin_referer('sgs_refresh_hubspot');
        $referral_codes = sgs_fetch_referrals_from_hubspot();
        echo '<div class="notice notice-success"><p>✓ Refreshed data from HubSpot</p></div>';
    }
    
    ?>
    <div class="wrap sgs-referral-admin">
        <h1>Referral Management</h1>
        
        <!-- Stats Dashboard -->
        <div class="sgs-stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: #FFB03F;">👥</div>
                <div class="stat-content">
                    <h3>Total Referrers</h3>
                    <p class="stat-number"><?php echo $total_referrers; ?></p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: #4CAF50;">✓</div>
                <div class="stat-content">
                    <h3>Total Conversions</h3>
                    <p class="stat-number"><?php echo $total_conversions; ?></p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: #2196F3;">%</div>
                <div class="stat-content">
                    <h3>Conversion Rate</h3>
                    <p class="stat-number"><?php echo $conversion_rate; ?>%</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: #9C27B0;">📅</div>
                <div class="stat-content">
                    <h3>Active This Month</h3>
                    <p class="stat-number"><?php echo $active_this_month; ?></p>
                </div>
            </div>
        </div>
        
        <!-- Manual Code Generator -->
        <div class="sgs-generator-card">
            <h2>Generate Referral Code</h2>
            <p>Create a referral link manually to enroll partners.</p>
            
            <form id="sgs-manual-generator" class="sgs-generator-form">
                <div class="form-row">
                    <div class="form-field">
                        <label for="gen_first_name">First Name *</label>
                        <input type="text" id="gen_first_name" name="first_name" required>
                    </div>
                    <div class="form-field">
                        <label for="gen_last_name">Last Name *</label>
                        <input type="text" id="gen_last_name" name="last_name" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-field">
                        <label for="gen_email">Email *</label>
                        <input type="email" id="gen_email" name="email" required>
                    </div>
                    <div class="form-field">
                        <label for="gen_organization">Organization *</label>
                        <input type="text" id="gen_organization" name="organization" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-field">
                        <label for="gen_custom_code">Custom Code (optional)</label>
                        <input type="text" id="gen_custom_code" name="custom_code" placeholder="Auto-generated if empty">
                    </div>
                    <div class="form-field">
                        <!-- Empty field for alignment -->
                    </div>
                </div>
                
                <button type="submit" class="button button-primary button-large">Generate Referral Link</button>
            </form>
            
            <div id="sgs-generator-result" style="display: none;">
                <div class="result-success">
                    <h3>✓ Referral Link Generated</h3>
                    <div class="generated-link-wrapper">
                        <input type="text" id="generated-link" readonly>
                        <button type="button" class="button" onclick="sgsCopeLink()">Copy Link</button>
                    </div>
                    <p class="generated-code">Code: <strong id="generated-code"></strong></p>
                    <button type="button" class="button" onclick="sgsResetGenerator()">Create Another</button>
                </div>
            </div>
        </div>
        
        <!-- Referrer Table -->
        <div class="sgs-table-card">
            <div class="table-header">
                <h2>All Referrers</h2>
                <div class="table-actions">
                    <form method="post" style="display: inline;">
                        <?php wp_nonce_field('sgs_refresh_hubspot'); ?>
                        <button type="submit" name="refresh_from_hubspot" class="button">
                            🔄 Refresh from HubSpot
                        </button>
                    </form>
                    <button type="button" class="button" onclick="sgsExportCSV()">📥 Export CSV</button>
                </div>
            </div>
            
            <div class="table-filters">
                <input type="text" id="sgs-search" placeholder="Search by name, organization, or code..." class="sgs-search-input">
            </div>
            
            <table class="wp-list-table widefat fixed striped sgs-referral-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Organization</th>
                        <th>Code</th>
                        <th>Conversions</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="sgs-referral-tbody">
                    <?php if (empty($referral_codes)): ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 40px;">
                                No referrers yet. Use the generator above or visit the <a href="<?php echo home_url('/referral-program'); ?>">Referral Program page</a>.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($referral_codes as $code => $data): ?>
                            <?php 
                            $referrals = $data['referrals'] ?? [];
                            $conversion_count = count($referrals);
                            $is_active = $conversion_count > 0 || (!empty($data['created_at']) && strpos($data['created_at'], date('Y-m')) === 0);
                            ?>
                            <tr data-code="<?php echo esc_attr($code); ?>" data-search="<?php echo esc_attr(strtolower($data['first_name'] . ' ' . $data['last_name'] . ' ' . ($data['organization'] ?? '') . ' ' . $code)); ?>">
                                <td>
                                    <strong><?php echo esc_html($data['first_name'] . ' ' . $data['last_name']); ?></strong>
                                </td>
                                <td><?php echo esc_html($data['organization'] ?? 'N/A'); ?></td>
                                <td><code class="sgs-code"><?php echo esc_html($code); ?></code></td>
                                <td>
                                    <span class="sgs-conversion-badge <?php echo $conversion_count > 0 ? 'has-conversions' : ''; ?>">
                                        <?php echo $conversion_count; ?>
                                    </span>
                                    <?php if ($conversion_count > 0): ?>
                                        <button type="button" class="button button-small sgs-view-btn" onclick="sgsToggleConversions('<?php echo esc_js($code); ?>')">View</button>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo esc_html(!empty($data['created_at']) ? date('M j, Y', strtotime($data['created_at'])) : 'N/A'); ?></td>
                                <td>
                                    <span class="sgs-status-badge <?php echo $is_active ? 'active' : 'inactive'; ?>">
                                        <?php echo $is_active ? 'Active' : 'Inactive'; ?>
                                    </span>
                                </td>
                                <td class="sgs-actions">
                                    <button type="button" class="button button-small" onclick="sgsCopyReferralLink('<?php echo esc_js($code); ?>')" title="Copy Link">
                                        📋
                                    </button>
                                    <?php if (!empty($data['hubspot_contact_id'])): ?>
                                        <a href="https://app.hubspot.com/contacts/44675524/contact/<?php echo esc_attr($data['hubspot_contact_id']); ?>" target="_blank" class="button button-small" title="View in HubSpot">
                                            🔗
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php if (!empty($referrals)): ?>
                                <tr id="conversions-<?php echo esc_attr($code); ?>" class="sgs-conversions-row" style="display: none;">
                                    <td colspan="7">
                                        <div class="sgs-conversions-detail">
                                            <h4>Conversions from <?php echo esc_html($code); ?></h4>
                                            <table class="sgs-sub-table">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Submitted</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($referrals as $referral): ?>
                                                        <tr>
                                                            <td><?php echo esc_html($referral['name'] ?? 'N/A'); ?></td>
                                                            <td><a href="mailto:<?php echo esc_attr($referral['email']); ?>"><?php echo esc_html($referral['email']); ?></a></td>
                                                            <td><?php echo esc_html($referral['submitted_at'] ?? 'N/A'); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
    // Manual Generator Form Submission
    jQuery(document).ready(function($) {
        $('#sgs-manual-generator').on('submit', function(e) {
            e.preventDefault();
            
            const $form = $(this);
            const $btn = $form.find('button[type="submit"]');
            const btnText = $btn.text();
            
            $btn.prop('disabled', true).text('Generating...');
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'sgs_generate_referral_link',
                    nonce: '<?php echo wp_create_nonce("sgs_referral_signup"); ?>',
                    first_name: $('#gen_first_name').val(),
                    last_name: $('#gen_last_name').val(),
                    email: $('#gen_email').val(),
                    organization: $('#gen_organization').val(),
                    custom_code: $('#gen_custom_code').val()
                },
                success: function(response) {
                    if (response.success) {
                        $('#generated-link').val(response.data.referral_link);
                        $('#generated-code').text(response.data.referral_code);
                        $form.hide();
                        $('#sgs-generator-result').fadeIn();
                    } else {
                        alert('Error: ' + (response.data.message || 'Failed to generate link'));
                        $btn.prop('disabled', false).text(btnText);
                    }
                },
                error: function() {
                    alert('Network error. Please try again.');
                    $btn.prop('disabled', false).text(btnText);
                }
            });
        });
        
        // Search functionality
        $('#sgs-search').on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();
            $('#sgs-referral-tbody tr').each(function() {
                const $row = $(this);
                if ($row.hasClass('sgs-conversions-row')) return;
                
                const searchData = $row.data('search') || '';
                if (searchData.indexOf(searchTerm) > -1) {
                    $row.show();
                } else {
                    $row.hide();
                }
            });
        });
    });
    
    function sgsResetGenerator() {
        jQuery('#sgs-manual-generator')[0].reset();
        jQuery('#sgs-manual-generator').show();
        jQuery('#sgs-generator-result').hide();
    }
    
    function sgsCopeLink() {
        const input = document.getElementById('generated-link');
        input.select();
        document.execCommand('copy');
        alert('Link copied to clipboard!');
    }
    
    function sgsCopyReferralLink(code) {
        const link = '<?php echo home_url("/contact/?referral_source="); ?>' + code;
        const temp = document.createElement('input');
        document.body.appendChild(temp);
        temp.value = link;
        temp.select();
        document.execCommand('copy');
        document.body.removeChild(temp);
        alert('Referral link copied!');
    }
    
    function sgsToggleConversions(code) {
        const row = document.getElementById('conversions-' + code);
        row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
    }
    
    function sgsExportCSV() {
        const rows = [];
        rows.push(['Name', 'Organization', 'Code', 'Conversions', 'Created', 'Status']);
        
        jQuery('#sgs-referral-tbody tr').each(function() {
            const $row = jQuery(this);
            if ($row.hasClass('sgs-conversions-row')) return;
            
            const cells = $row.find('td');
            if (cells.length > 0) {
                rows.push([
                    cells.eq(0).text().trim(),
                    cells.eq(1).text().trim(),
                    cells.eq(2).text().trim(),
                    cells.eq(3).text().trim().split('\n')[0],
                    cells.eq(4).text().trim(),
                    cells.eq(5).text().trim()
                ]);
            }
        });
        
        const csvContent = rows.map(row => row.join(',')).join('\n');
        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'referrals-' + new Date().toISOString().split('T')[0] + '.csv';
        a.click();
    }
    </script>
    
    <style>
    .sgs-referral-admin {
        max-width: 1400px;
    }
    
    .sgs-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin: 30px 0;
    }
    
    .stat-card {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #fff;
    }
    
    .stat-content h3 {
        margin: 0 0 5px 0;
        font-size: 13px;
        color: #666;
        font-weight: 500;
    }
    
    .stat-number {
        margin: 0;
        font-size: 28px;
        font-weight: bold;
        color: #000;
    }
    
    .sgs-generator-card {
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }
    
    .sgs-generator-card h2 {
        margin-top: 0;
        font-size: 18px;
    }
    
    .sgs-generator-form .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .form-field label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }
    
    .form-field input {
        width: 100%;
        padding: 8px 12px;
    }
    
    .result-success {
        background: #d4edda;
        border: 1px solid #c3e6cb;
        padding: 20px;
        border-radius: 4px;
        color: #155724;
    }
    
    .result-success h3 {
        margin-top: 0;
        color: #155724;
    }
    
    .generated-link-wrapper {
        display: flex;
        gap: 10px;
        margin: 15px 0;
    }
    
    .generated-link-wrapper input {
        flex: 1;
        padding: 8px 12px;
        font-family: monospace;
    }
    
    .generated-code {
        margin: 10px 0;
    }
    
    .sgs-table-card {
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .table-header h2 {
        margin: 0;
        font-size: 18px;
    }
    
    .table-actions {
        display: flex;
        gap: 10px;
    }
    
    .table-filters {
        margin-bottom: 15px;
    }
    
    .sgs-search-input {
        width: 100%;
        max-width: 400px;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    
    .sgs-code {
        background: #f0f0f0;
        padding: 4px 8px;
        border-radius: 4px;
        font-family: monospace;
        font-size: 12px;
    }
    
    .sgs-conversion-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 12px;
        background: #e0e0e0;
        font-size: 12px;
        font-weight: 600;
    }
    
    .sgs-conversion-badge.has-conversions {
        background: #4CAF50;
        color: #fff;
    }
    
    .sgs-status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .sgs-status-badge.active {
        background: #d4edda;
        color: #155724;
    }
    
    .sgs-status-badge.inactive {
        background: #f8d7da;
        color: #721c24;
    }
    
    .sgs-view-btn {
        margin-left: 5px;
    }
    
    .sgs-actions button, .sgs-actions a {
        margin-right: 5px;
    }
    
    .sgs-conversions-row td {
        background: #f9f9f9;
        padding: 20px !important;
    }
    
    .sgs-conversions-detail h4 {
        margin-top: 0;
        margin-bottom: 15px;
    }
    
    .sgs-sub-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .sgs-sub-table th {
        text-align: left;
        padding: 8px;
        background: #fff;
        border-bottom: 2px solid #ddd;
    }
    
    .sgs-sub-table td {
        padding: 8px;
        border-bottom: 1px solid #eee;
    }
    
    @media (max-width: 1200px) {
        .sgs-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .sgs-stats-grid {
            grid-template-columns: 1fr;
        }
        .sgs-generator-form .form-row {
            grid-template-columns: 1fr;
        }
    }
    </style>
    <?php
}

