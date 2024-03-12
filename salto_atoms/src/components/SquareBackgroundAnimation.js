import { AnimatePresence, motion } from 'framer-motion'

const squareItem = [
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
]

export default function SquareBackgroundAnimation({ children }) {
  return (
    <>
      <div className="sticky top-0 z-[-20] h-screen w-full overflow-hidden">
        <AnimatePresence>
          {squareItem.map((css, idx) => (
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
                  ...css,
                }}
                variants={{
                  anim: {
                    opacity: [0, 1, 1, 1, 1, 1, 1, 0], // このままで問題ありません
                    rotate: 720, // 数値のままで問題ありません
                    transition: {
                      duration: 15 + Math.floor(Math.random() * 15),
                      ease: 'linear',
                    },
                    y: `-130vh`, // `-130vh` は文字列ですが、他のキーフレームと型を一致させる
                  },
                  init: {
                    opacity: 0, // 数値
                    y: `0vh`, // 型を一致させるために文字列に変更
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
                  ...css,
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
  )
}