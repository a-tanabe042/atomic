import { useState, useEffect } from "react";
import { SidebarSection } from "../types";

interface SidebarSectionNavigator {
  sidebarSection: SidebarSection[];
  scrollToSidebarSection: (index: number) => void;
}

const useSidebarSectionNavigator = (initialSidebarSection: SidebarSection[], activeIndex: number): SidebarSectionNavigator => {
  const [sidebarSection, setSidebarSection] = useState<SidebarSection[]>(() => 
    initialSidebarSection.map((sidebarSection, index) => ({
      ...sidebarSection,
      isActive: index === activeIndex,
    }))
  );

  useEffect(() => {
    setSidebarSection(
      initialSidebarSection.map((sidebarSection, index) => ({
        ...sidebarSection,
        isActive: index === activeIndex,
      }))
    );
  }, [initialSidebarSection, activeIndex]);

  const scrollToSidebarSection = (currentIndex: number) => {
    setSidebarSection(sidebarSection.map((sidebarSection, index) => ({
      ...sidebarSection,
      isActive: index === currentIndex,
    })));

    const sidebarSectionId = initialSidebarSection[currentIndex].id;
    const sidebarSectionElement = document.getElementById(sidebarSectionId);
    if(sidebarSectionElement) {
      sidebarSectionElement.scrollIntoView({ behavior: 'smooth' });
    }
  };

  return { sidebarSection, scrollToSidebarSection };
};

export default useSidebarSectionNavigator;
