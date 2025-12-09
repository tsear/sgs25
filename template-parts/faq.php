<?php
/**
 * Frequently Asked Questions Section
 */

$faqs = [
	[
		'question' => 'What does MissionGranted actually do?',
		'answer'   => 'It manages the financial side of grants—budgeting, allocations, compliance, reporting, and audit readiness.'
	],
	[
		'question' => 'How is MissionGranted different from other grant management software?',
		'answer'   => 'Other software focuses on grant acquisition and program tracking. We are the only software that focuses on financial management and how funding works together strategically.'
	],
	[
		'question' => 'Does MissionGranted integrate with our accounting system?',
		'answer'   => 'Yes. MissionGranted works with QuickBooks, Sage, MIP, Fund EZ, and more.'
	],
	[
		'question' => 'Can MissionGranted support multi-year or complex funding portfolios?',
		'answer'   => 'Yes. It handles multi-year grants, restricted funding, and budgets with a diverse mix of funding sources.'
	],
	[
		'question' => 'Do you offer support beyond the software?',
		'answer'   => 'Yes. SGS provides expert consulting for workflows, compliance, internal controls, and financial strategy.'
	],
	[
		'question' => 'Can you help us stay compliant with federal rules like Uniform Guidance (2 CFR 200)?',
		'answer'   => 'Yes. Both - the software and consulting services support UGG compliance.'
	],
	[
		'question' => 'Is MissionGranted built for nonprofits, local governments, or grantmakers?',
		'answer'   => 'All three. The platform adapts to nonprofit, municipal, and funder workflows.'
	],
	[
		'question' => 'How long does it take to get started?',
		'answer'   => 'The platform adapts to nonprofit and local government workflows and works with funders to support grantees.'
	],
];
?>

<section class="faq" id="faq">
	<div class="faq__container">
		<div class="faq__header">
			<p class="faq__eyebrow">FAQ</p>
			<h2 class="faq__title">MissionGranted answers the finance questions teams actually ask</h2>
			<p class="faq__subtitle">From integrations to compliance, here’s what organizations want to know before modernizing their grant operations.</p>
		</div>

		<div class="faq__grid">
			<?php foreach ($faqs as $index => $faq) :
				$display_number = sprintf('%02d', $index + 1);
			?>
				<article class="faq-card" data-faq-index="<?php echo esc_attr($index + 1); ?>">
					<div class="faq-card__meta">
						<span class="faq-card__number"><?php echo esc_html($display_number); ?></span>
						<span class="faq-card__label">Question</span>
					</div>
					<h3 class="faq-card__question"><?php echo esc_html($faq['question']); ?></h3>
					<p class="faq-card__answer"><?php echo esc_html($faq['answer']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="faq__cta">
			<p>Still have questions? <strong>Book a strategy call</strong> and we’ll map MissionGranted to your funding model.</p>
			<a href="<?php echo esc_url(home_url('/contact/')); ?>" class="faq__button">Talk with SGS</a>
		</div>
	</div>
</section>
