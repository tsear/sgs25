import React from 'react';
import CardSwap, { Card } from '@components/CardSwap';
import RocketStack from '@components/RocketStack';
import '@components/CardSwap.css';

/**
 * Video Features Component
 * A clean, modern replacement for the complex rocket/video features section
 */
const VideoFeatures = ({ themeUri = '' }) => {
  return (
    <section className="video-features">
      <div className="video-features__container">
        <div className="video-features__header">
          <h2 className="video-features__title">
            Powerful Features for Your Mission
          </h2>
        </div>

        <div
          className="video-features__body"
          style={{ minHeight: '650px', position: 'relative', paddingLeft: '0px' }}
        >
          <RocketStack themeUri={themeUri} />
          <div className="video-features__cta">
            <p className="video-features__cta-eyebrow">Purpose-built for public good</p>
            <h3 className="video-features__cta-heading">See MissionGranted in action</h3>
            <p className="video-features__cta-copy">
              Bring every grant, budget, and compliance check into one command center. We’ll walk your team through a live
              workspace tailored to your needs.
            </p>
            <div className="video-features__cta-actions">
              <a className="video-features__cta-button" href="/contact">
                Book a live demo
              </a>
              <a className="video-features__cta-link" href="/downloads">
                Download overview ↗
              </a>
            </div>
          </div>
          <CardSwap
            width={580}
            height={440}
            cardDistance={60}
            verticalDistance={70}
            delay={5000}
            pauseOnHover={true}
            easing="elastic"
          >
            <Card customClass="card--pink">
              <div className="feature-card">
                <div className="feature-card__gif">
                  <img 
                    src={`${themeUri}/assets/images/strategic-resource-management.gif`}
                    alt="Strategic Resource Management"
                    loading="lazy"
                  />
                </div>
                <div className="feature-card__content">
                  <h3>Simplified Compliance</h3>
                  <p>MissionGranted works alongside your accounting system to spot compliance risks early and offer clear guidance on spending and budgets. With smart alerts and recommendations, you can align funding to shifting program needs while staying compliant and making the most of your limited resources.</p>
                </div>
              </div>
            </Card>
            <Card customClass="card--yellow">
              <div className="feature-card">
                <div className="feature-card__gif">
                  <img 
                    src={`${themeUri}/assets/images/automation-over-spreadsheets.gif`}
                    alt="Automation Over Spreadsheets"
                    loading="lazy"
                  />
                </div>
                <div className="feature-card__content">
                  <h3>Compliance Ready Data</h3>
                  <p>Built for social impact organizations, MissionGranted combines an easy-to-use interface with built-in financial best practices and real-time compliance guidance. It keeps your budgets up to date, your team confident, and your organization ready to meet regulatory requirements without stress.</p>
                </div>
              </div>
            </Card>
            <Card customClass="card--blue">
              <div className="feature-card">
                <div className="feature-card__gif">
                  <img 
                    src={`${themeUri}/assets/images/simplified-compliance.gif`}
                    alt="Simplified Compliance"
                    loading="lazy"
                  />
                </div>
                <div className="feature-card__content">
                  <h3>Strategic Resource Management</h3>
                  <p>Budgeting is the cornerstone of compliance, and MissionGranted makes it easy. Our tools pull all your funding sources into one clear view so you can see how they work together, plan for what-ifs, adjust when things change, and make confident decisions that move your mission forward.</p>
                </div>
              </div>
            </Card>
            <Card customClass="card--cobalt">
              <div className="feature-card">
                <div className="feature-card__gif">
                  <img 
                    src={`${themeUri}/assets/images/audit-ready-data.gif`}
                    alt="Audit Ready Data"
                    loading="lazy"
                  />
                </div>
                <div className="feature-card__content">
                  <h3>Automation Over Spreadsheets</h3>
                  <p>MissionGranted takes the messy compliance work you're stuck doing in spreadsheets —like indirect costs and personnel distributions — and automates them. That means fewer mistakes, less wasted time, and more capacity for your team to focus on the bigger picture.</p>
                </div>
              </div>
            </Card>
          </CardSwap>
        </div>
      </div>
    </section>
  );
};

export default VideoFeatures;
