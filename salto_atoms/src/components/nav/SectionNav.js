import React, { useEffect } from "react";
import { useRecoilValue, useResetRecoilState } from "recoil";
import { useLocation } from "react-router-dom";
import { sectionState } from "../../state";
import useSectionNavigator from "../../hooks/useSectionNavigator";

function SectionNav() {
  const location = useLocation();
  const sections = useRecoilValue(sectionState);
  const resetSections = useResetRecoilState(sectionState);
  const [navSections, scrollToSection] = useSectionNavigator(sections, 0);

  useEffect(() => {
    resetSections();
  }, [location, resetSections]);

  if (sections.length === 0) {
    return (
      <ul className="menu w-40 mt-6 p-1 text-sm">
      <li className="menu-title">
        <span className="mb-1">開発中</span>
      </li>
      <li className="bg-black rounded-lg text-white">
        <button>セクション1</button>
      </li>
    </ul>
    );
  }

  return (
    <ul className="menu w-40 mt-6 p-1 text-sm">
      <li className="menu-title">
        <span className="mb-1">セクション1</span>
      </li>
      {navSections.map((section, index) => (
        <li key={section.id} className={section.isActive ? "mb-1 bg-black rounded-lg text-white" : "mb-1 rounded-lg"}>
          <button onClick={() => scrollToSection(index)}>
            {section.title}
          </button>
        </li>
      ))}
    </ul>
  );
}

export default SectionNav;
