import React from 'react';
import { createRoot } from 'react-dom/client';
import VideoFeatures from './VideoFeatures';
import './styles.css';

// Initialize React component when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('video-features-root');
  
  if (container) {
    const themeUri = container.dataset.themeUri || '';
    const root = createRoot(container);
    root.render(<VideoFeatures themeUri={themeUri} />);
  }
});
