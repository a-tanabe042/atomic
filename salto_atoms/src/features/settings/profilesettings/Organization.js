import React, { useState, useEffect } from "react";
import { useRecoilState, useRecoilValue } from "recoil";
import {
  selectedDepartmentState,
  selectedSectionState,
  selectedGroupState,
  selectedPostState,
  isPostSelectedState
} from "../../../state";
import useStrapi from "../../../hooks/useStrapi";

const Organization = () => {
  const [selectedDepartmentId, setSelectedDepartmentId] = useRecoilState(selectedDepartmentState);
  const [selectedSectionId, setSelectedSectionId] = useRecoilState(selectedSectionState);
  const [selectedGroupId, setSelectedGroupId] = useRecoilState(selectedGroupState);
  const selectedPostId = useRecoilValue(selectedPostState);
  const isPostSelected = useRecoilValue(isPostSelectedState);

  const { data: organizationChartData } = useStrapi("organization-charts", {});
  const { data: departmentData } = useStrapi("departments", {});
  const { data: sectionData } = useStrapi("sections", {});
  const { data: groupData } = useStrapi("groups", {});

  const [filteredSections, setFilteredSections] = useState([]);
  const [filteredGroups, setFilteredGroups] = useState([]);

  useEffect(() => {
    // If the selected post is 0, 1, 2, or 3, disable the department, section, and group dropdowns
    const shouldDisable = [0, 1, 2, 3].includes(selectedPostId);
    if (shouldDisable) {
      setSelectedDepartmentId(0);
      setSelectedSectionId(0);
      setSelectedGroupId(0);
    }
  }, [selectedPostId, setSelectedDepartmentId, setSelectedSectionId, setSelectedGroupId]);

  const handleDepartmentChange = (e) => {
    const newId = parseInt(e.target.value, 10); // e.target.value を整数に変換
    setSelectedDepartmentId(newId);
  
    // セクションとグループの選択をリセット
    setSelectedSectionId(0);
    setSelectedGroupId(0);
  };
  
  const handleSectionChange = (e) => {
    const newId = e.target.value;
    setSelectedSectionId(newId === "0" ? 0 : parseInt(newId));
  
    // グループの選択をリセット
    setSelectedGroupId(0);
  };
  
  const handleGroupChange = (e) => {
    const newId = e.target.value;
    setSelectedGroupId(newId === "0" ? 0 : parseInt(newId));
  };
  
  
  useEffect(() => {
    if (
      organizationChartData &&
      organizationChartData.data &&
      sectionData &&
      sectionData.data
    ) {
      // Create a new Set to hold unique sections
      const sectionSet = new Set();

      const sections = organizationChartData.data
        .filter(
          (chart) =>
            String(chart.attributes.dep_id) === String(selectedDepartmentId)
        )
        .map((chart) => {
          return sectionData.data.find(
            (sec) => sec.id === chart.attributes.section_id
          );
        })
        // Add each unique section to the Set
        .filter((section) => {
          const isUnique = section && !sectionSet.has(section.id);
          if (isUnique) {
            sectionSet.add(section.id);
          }
          return isUnique;
        });

      setFilteredSections(sections);
    } else {
      setFilteredSections([]);
    }
  }, [selectedDepartmentId, organizationChartData, sectionData]);

  // Similar updates for the groupData useEffect

  useEffect(() => {
    if (
      organizationChartData &&
      organizationChartData.data &&
      groupData &&
      groupData.data &&
      selectedSectionId // Only proceed if a section is selected
    ) {
      // Filter the organization chart data for the selected department and section
      const groups = organizationChartData.data
        .filter(
          (chart) =>
            String(chart.attributes.section_id) === String(selectedSectionId) &&
            String(chart.attributes.dep_id) === String(selectedDepartmentId)
        )
        .map((chart) => {
          // Find the group details using the group ID from the chart
          return groupData.data.find(
            (grp) => grp.id === chart.attributes.group_id
          );
        })
        // Remove any undefined or null values
        .filter((group) => group != null);

      setFilteredGroups(groups);
    } else {
      setFilteredGroups([]);
    }
    // Don't reset the selected group id here as it might not be necessary
  }, [
    selectedDepartmentId,
    selectedSectionId,
    organizationChartData,
    groupData,
  ]);

  
  

  return (
    <div className="flex justify-between items-center space-x-4">
      {/* Department Dropdown */}
      <div className="flex-1">
        <label className="label" htmlFor="department">部署</label>
        <select
          id="department"
          className="select w-full border border-gray-300 rounded-lg bg-slate-100 text-black"
          value={selectedDepartmentId}
          onChange={handleDepartmentChange}
          disabled={!isPostSelected}
        >
          <option value="0">Select Department</option>
          {departmentData?.data?.map((dep) => (
            <option key={dep.id} value={dep.id}>{dep.attributes.dep_name}</option>
          ))}
        </select>
      </div>

      {/* Section Dropdown */}
      <div className="flex-1">
        <label className="label" htmlFor="section">
          課
        </label>
        <select
          id="section"
          className="select w-full border border-gray-300  rounded-lg bg-slate-100 text-black"
          value={selectedSectionId}
          onChange={handleSectionChange}
          disabled={!isPostSelected}
        >
          <option value="0">Select Section</option>
          {filteredSections.map((sec, index) => (
            <option key={`${sec.id}-${index}`} value={sec.id}>
              {sec.attributes.section_name}
            </option>
          ))}
        </select>
      </div>

      {/* Group Dropdown */}
      <div className="flex-1">
        <label className="label" htmlFor="group">
          グループ
        </label>
        <select
          id="group"
          className="select w-full border border-gray-300  rounded-lg bg-slate-100 text-black"
          value={selectedGroupId}
          onChange={handleGroupChange}
          disabled={!isPostSelected}
        >
          <option value="0">Select Group</option>
          {filteredGroups.map((grp, index) => (
            <option key={`${grp.id}-${index}`} value={grp.id}>
              {grp.attributes.group_name}
            </option>
          ))}
        </select>
      </div>
    </div>
  );
};

export default Organization;
