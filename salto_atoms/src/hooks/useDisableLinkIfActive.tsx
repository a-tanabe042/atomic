// useDisableLinkIfActive.ts
import { useLocation } from 'react-router-dom';

const useDisableLinkIfActive = (path: string): boolean => {
  const location = useLocation();
  return location.pathname === path;
};

export default useDisableLinkIfActive;
