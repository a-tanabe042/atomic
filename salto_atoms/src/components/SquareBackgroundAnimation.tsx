import React, { ReactNode } from 'react';
import { AnimatePresence, motion } from 'framer-motion';

interface SquareItem {
  height: string;
  left: string;
  width: string;
}

const squareItem: SquareItem[] = [
  { height: '8rem', left: '2%', width: '8rem' },
  { height: '4rem', left: '25%', width: '4rem' },
  { height: '5rem', left: '46%', width: '5rem' },
  { height: '6rem', left: '37%', width: '6rem' },
  { height: '7rem', left: '54%', width: '7rem' },
  { height: '8rem', left: '62%', width: '8rem' },
  { height: '9rem', left: '15%', width: '9rem' },
  { height: '5rem', left: '82%', width: '5rem' },
  { height: '3rem', left: '74%', width: '3rem' },
  { height: '8rem', left: '86%', width: '8rem' },
];

interface SquareBackgroundAnimationProps {
  children: ReactNode;
}

const SquareBackgroundAnimation: React.FC<SquareBackgroundAnimationProps> = ({ children }) => {
  return (
    <>
      <div className="sticky top-0 z-[-20] h-screen w-full overflow-hidden">
        <AnimatePresence>
          {squareItem.map((item, idx) => (
            <div key={idx}>
              <motion.div
                animate="anim"
                initial="init"
                style={{
                  background: '#0c94e224',
                  borderRadius: '1rem',
                  bottom: '-10rem',
                  display: 'block',
                  position: 'absolute',
                  ...item,
                }}
                variants={{
                  anim: {
                    opacity: [0, 1, 1, 1, 1, 1, 1, 0],
                    rotate: 720,
                    transition: {
                      duration: 15 + Math.floor(Math.random() * 15),
                      ease: 'linear',
                    },
                    y: `-130vh`,
                  },
                  init: {
                    opacity: 0,
                    y: `0vh`,
                  },
                }}
              />
              <motion.div
                animate="anim"
                initial="init"
                style={{
                  background: '#0c94e224',
                  borderRadius: '1rem',
                  bottom: '-10rem',
                  display: 'block',
                  position: 'absolute',
                  ...item,
                }}
                variants={{
                  anim: {
                    rotate: 720,
                    transition: {
                      delay: Math.floor(Math.random() * 15),
                      duration: 15 + Math.floor(Math.random() * 21),
                      ease: 'linear',
                      repeat: Infinity,
                    },
                    y: '-130vh',
                  },
                  init: {
                    y: 0,
                  },
                }}
              />
            </div>
          ))}
        </AnimatePresence>
      </div>
      <div style={{ marginTop: 'calc(100vh / -1)' }}>{children}</div>
    </>
  );
};

export default SquareBackgroundAnimation;
