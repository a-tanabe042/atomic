import { useState, useEffect, useRef } from "react";

// TypeScript type for the return value of the useToggleDropdown hook
interface UseToggleDropdownReturn {
  isExpanded: boolean;
  toggle: () => void;
  dropdownRef: React.RefObject<HTMLDivElement>; // Specify the element type you expect to reference
}

const useToggleDropdown = (): UseToggleDropdownReturn => {
  const [isExpanded, setIsExpanded] = useState<boolean>(false);
  const dropdownRef = useRef<HTMLDivElement>(null); // Specify the element type for the ref

  useEffect(() => {
    const handleClickOutside = (event: MouseEvent) => {
      if (dropdownRef.current && !dropdownRef.current.contains(event.target as Node)) {
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
