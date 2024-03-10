import { useState, useEffect, useRef } from "react";

/* ドロップダウン　表示/非表示 */
const useToggleDropdown = () => {
  const [isExpanded, setIsExpanded] = useState(false);
  const dropdownRef = useRef(null);

  useEffect(() => {
    const handleClickOutside = (event) => {
      if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
        setIsExpanded(false);
      }
    };

    document.addEventListener("mousedown", handleClickOutside);
    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, []);

  const toggle = () => {
    setIsExpanded(!isExpanded);
  };

  return { isExpanded, toggle, dropdownRef };
};

export default useToggleDropdown;
