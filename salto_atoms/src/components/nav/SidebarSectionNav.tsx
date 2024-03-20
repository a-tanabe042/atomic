import React, { useEffect } from "react";
import { useRecoilValue, useResetRecoilState } from "recoil";
import { useLocation } from "react-router-dom";
import { sidebarSectionState } from "../../state";
import useSidebarSectionNavigator from "../../hooks/useSidebarSectionNavigator";
import { SidebarSection } from "../../types"; // Adjusted import for the Section type

const SidebarSectionNav:React.FC=()=> {
  const location = useLocation();
  const sidebarSection = useRecoilValue(sidebarSectionState);
  const resetSidebarSection = useResetRecoilState(sidebarSectionState);
  const { sidebarSection: navSidebarSection, scrollToSidebarSection } = useSidebarSectionNavigator(sidebarSection, 0);

  useEffect(() => {
    resetSidebarSection();
  }, [location, resetSidebarSection]);

  if (sidebarSection.length === 0) {
    return (
      <ul className="menu w-40 mt-6 p-1 text-sm">
        <li className="menu-title">
          <span>開発中</span>
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
        <span>セクション</span>
      </li>
      {navSidebarSection.map((sidebarSection: SidebarSection, index: number) => (
        <li key={sidebarSection.id} className={sidebarSection.isActive ? "mb-1 bg-black rounded-lg text-white" : "mb-1 rounded-lg"}>
          <button onClick={() => scrollToSidebarSection(index)}>
            {sidebarSection.title}
          </button>
        </li>
      ))}
    </ul>
  );
}

export default SidebarSectionNav;
