import { useLocation } from "react-router-dom";

/*Linkを再押下できなくすることで不要なリクエストを減らす。*/
function useDisableLinkIfActive(to) {
    const location = useLocation();
    return location.pathname === to;
  }

export default useDisableLinkIfActive;