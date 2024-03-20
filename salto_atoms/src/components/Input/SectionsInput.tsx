import React, { useState, useEffect } from "react";
import useFetchSections from "../../hooks/api/useFetchSections";
import { SectionType } from "../../types";


interface SectionsInputProps {
  sectionId: string | "";
  setSectionId: (sectionId: string | "") => void;
}

/* 課フォーム */
const SectionsInput:React.FC<SectionsInputProps> = ({ sectionId, setSectionId }) => {
  const sections = useFetchSections();
  const [selectedSection, setSelectedSection] = useState(
    sectionId || ""
  );

  useEffect(() => {
    setSelectedSection(sectionId || "");
  }, [sectionId]);

  const handleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    const newSectionId = e.target.value || "";
    setSelectedSection(newSectionId);
    setSectionId(newSectionId);
  };

  return (
    <div className="flex-1">
      <label htmlFor="section"  className="label">
        課
      </label>
      <select
        id="section"
        className="select w-full border border-gray-300 rounded-lg bg-slate-100 text-black"
        value={selectedSection}
        onChange={handleChange}
      >
        <option value="">選択してください</option>
        {sections.map((section: SectionType) => (
          <option key={section.section_id} value={section.section_id}>
            {section.section_name}
          </option>
        ))}
      </select>
    </div>
  );
};

export default SectionsInput;
