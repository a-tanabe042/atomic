import React from 'react';
import { useNavigate } from 'react-router-dom';
import Lottie from "lottie-react";
import ErrorAnimation from "../../assets/lottie/error.json"; 

/* エラーページ Error fetching Google profile: */
const ErrorPage = () => {
  const navigate = useNavigate();

  const redirectToLogin = () => {
    navigate('/login');
  };

  return (
    <div className="flex items-center justify-center h-screen bg-gray-100">
      <div className="text-center">
        <div style={{ width: '300px', height: '300px', margin: '0 auto' }}>
          <Lottie animationData={ErrorAnimation} />
        </div>    
        <p className="mb-4">予期しないエラーが発生しました。お手数ですが、再度ログインしてください。</p>
        <button
          onClick={redirectToLogin}
          className="btn btn-primary"
        >
          ログインページへ
        </button>
      </div>
    </div>
  );
};

export default ErrorPage;
