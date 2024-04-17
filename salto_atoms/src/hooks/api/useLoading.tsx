import { useState, useEffect } from 'react';

// loadingステータスを管理するカスタムフック
const useLoading=(delay: number): boolean => {
  const [isLoading, setLoading] = useState(true);

  useEffect(() => {
    const timer = setTimeout(() => setLoading(false), delay);
    return () => clearTimeout(timer);
  }, [delay]);

  return isLoading;
}

export default useLoading;
