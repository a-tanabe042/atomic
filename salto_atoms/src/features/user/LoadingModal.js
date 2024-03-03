import React from 'react';
import Lottie from 'lottie-react';
import LoadingAnimation from '../../assets/lottie/loading.json'; 

/* ローディングモーダル(実装なし) */
const LoadingModal = () => {
  return (
    <div className="fixed inset-0  flex justify-center items-center">
      <div className="bg-transparent p-5 rounded-lg flex items-center justify-center">
        <Lottie animationData={LoadingAnimation}  />
      </div>
    </div>
  );
};

export default LoadingModal;
