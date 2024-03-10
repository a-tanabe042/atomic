import { useState, useEffect } from "react";

/* ナビ */
function useSectionNavigator(initialSections, activeIndex) {
    const [sections, setSections] = useState([]);

    useEffect(() => {
        setSections(
            initialSections.map((section, index) => ({
                ...section,
                isActive: index === activeIndex,
            }))
        );
    }, [initialSections, activeIndex]);

    const scrollToSection = (currentIndex) => {
        setSections(sections.map((section, index) => ({
            ...section,
            isActive: index === currentIndex,
        })));
        const sectionId = initialSections[currentIndex].id;
        document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
    };

    return [sections, scrollToSection];
}

export default useSectionNavigator;
