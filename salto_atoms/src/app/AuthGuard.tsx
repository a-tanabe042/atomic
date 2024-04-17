import React, { ReactNode, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

// AuthGuardコンポーネントのプロパティの型定義
interface AuthGuardProps {
  children: ReactNode; // 任意のReactノードを受け取れるようにする
}

const AuthGuard: React.FC<AuthGuardProps> = ({ children }) => {
  const navigate = useNavigate();

  useEffect(() => {
    const token = localStorage.getItem('access_token');
    if (!token) {
      navigate('/login');
    }
  }, [navigate]);

  return <>{children}</>;
};

export default AuthGuard;
