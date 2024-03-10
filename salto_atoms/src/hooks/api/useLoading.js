import { useState, useEffect } from 'react';

/* loading */
function useLoading(delay) {
  const [isLoading, setLoading] = useState(true);

  useEffect(() => {
    const timer = setTimeout(() => setLoading(false), delay);
    return () => clearTimeout(timer);
  }, [delay]);

  return isLoading;
}

export default useLoading;
