import { useState, useEffect } from "react";

interface Section {
  id: string;
  name: string;
  isActive: boolean;
}

interface SectionNavigator {
  sections: Section[];
  scrollToSection: (index: number) => void;
}

const useSectionNavigator = (initialSections: Section[], activeIndex: number): SectionNavigator => {
  const [sections, setSections] = useState<Section[]>(() => 
    initialSections.map((section, index) => ({
      ...section,
      isActive: index === activeIndex,
    }))
  );

  useEffect(() => {
    setSections(
      initialSections.map((section, index) => ({
        ...section,
        isActive: index === activeIndex,
      }))
    );
  }, [initialSections, activeIndex]);

  const scrollToSection = (currentIndex: number) => {
    setSections(sections.map((section, index) => ({
      ...section,
      isActive: index === currentIndex,
    })));

    const sectionId = initialSections[currentIndex].id;
    const sectionElement = document.getElementById(sectionId);
    if(sectionElement) {
      sectionElement.scrollIntoView({ behavior: 'smooth' });
    }
  };

  return { sections, scrollToSection };
};

export default useSectionNavigator;
