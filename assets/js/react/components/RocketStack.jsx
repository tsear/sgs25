import React, { useEffect, useRef } from 'react';
import './RocketStack.css';

const rocketParts = [
  'tild3764-3731-4235-b531-613966333738__1saturn_v_vs_n1_-_to.png',
  'tild3364-6535-4135-a634-386337336233__1saturn_v_vs_n1_-_to.png',
  'tild3932-3336-4765-a364-643364366263__1saturn_v_vs_n1_-_to.png',
  'tild6239-6462-4636-b161-353032393638__1saturn_v_vs_n1_-_to.png'
];

const flameParts = [
  { file: 'tild6430-6437-4930-b866-623334336661__group_1000011511.png', mod: 'left' },
  { file: 'tild3537-6631-4964-b061-363536653330__group_1000011512.png', mod: 'right' }
];

const startExhaustRotation = (flame, direction) => {
  let rotation = 0;
  let rafId;

  const animate = () => {
    const maxRotation = 15;
    const rotationValue = Math.sin(rotation) * maxRotation;
    flame.style.transform = `rotate(${rotationValue * direction}deg)`;
    rotation += 0.03;
    rafId = requestAnimationFrame(animate);
  };

  animate();
  return () => rafId && cancelAnimationFrame(rafId);
};

const FLAME_WIDTH = 190;
const FLAME_BOTTOM_OFFSET = -90;
const ROCKET_LEFT_VIEWPORT_OFFSET = 25;

const FLAME_GAP = -100;

const RocketStack = ({ themeUri = '' }) => {
  const assetPath = path => `${themeUri}${path.startsWith('/') ? '' : '/'}${path}`;
  const containerRef = useRef(null);
  const flameRefs = useRef([]);

  useEffect(() => {
    const container = containerRef.current;
    const flames = flameRefs.current.filter(Boolean);
    if (!container || flames.length === 0) {
      return undefined;
    }

    flames.forEach(flame => {
      flame.style.opacity = '0';
      flame.style.transition = 'opacity 1.5s ease-out';
      flame.style.transform = 'rotate(0deg)';
    });

    const cleanupFns = [];
    let delayTimer;

    const handleReveal = () => {
      flames.forEach(flame => {
        flame.style.opacity = '1';
        const direction = flame.dataset.side === 'left' ? -1 : 1;
        cleanupFns.push(startExhaustRotation(flame, direction));
      });
    };

    const observer = new IntersectionObserver(
      entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            delayTimer = window.setTimeout(handleReveal, 3000);
            observer.disconnect();
          }
        });
      },
      { root: null, rootMargin: '0px 0px -100px 0px', threshold: 0.2 }
    );

    observer.observe(container);

    return () => {
      observer.disconnect();
      window.clearTimeout(delayTimer);
      cleanupFns.forEach(stop => stop?.());
    };
  }, []);

  const computedGap = Math.max(0, FLAME_GAP);
  const overlapOffset = FLAME_GAP < 0 ? FLAME_GAP / 2 : 0;

  return (
    <div
      className="rocket-stack"
      aria-hidden="true"
      ref={containerRef}
      style={{ left: `calc((100% - 100vw) / 2 + ${ROCKET_LEFT_VIEWPORT_OFFSET}px)` }}
    >
      <div className="rocket-stack__column">
        <div className="rocket-stack__rockets">
          {rocketParts.map((file, index) => (
            <img
              key={file}
              src={assetPath(`assets/images/${file}`)}
              alt=""
              loading="lazy"
              className={`rocket-piece rocket-piece-${index + 1}`}
            />
          ))}
        </div>

        <div
          className="rocket-stack__flames"
          style={{
            bottom: `${FLAME_BOTTOM_OFFSET}px`,
            gap: `${computedGap}px`,
            columnGap: `${computedGap}px`
          }}
        >
          {flameParts.map(({ file, mod }, index) => (
            <img
              key={file}
              src={assetPath(`assets/images/${file}`)}
              alt=""
              loading="lazy"
              data-side={mod}
              className={`rocket-flame rocket-flame--${mod}`}
              style={{
                width: FLAME_WIDTH,
                maxWidth: 'none',
                marginRight: mod === 'left' && overlapOffset ? `${overlapOffset}px` : undefined,
                marginLeft: mod === 'right' && overlapOffset ? `${overlapOffset}px` : undefined
              }}
              ref={el => {
                flameRefs.current[index] = el;
              }}
            />
          ))}
        </div>
      </div>
    </div>
  );
};

export default RocketStack;
