import React, { useState, useEffect } from "react";
import { useRecoilState } from "recoil";
import { goalsState, skillsState } from "../../../state.js";
import { categoryData } from "../../../utils/categoryData.js";

const Category = () => {
  const [editableSkills, setEditableSkills] = useState(Array(9).fill(""));
  const [editableGoals, setEditableGoals] = useState(Array(9).fill(""));
  const [selectedSkills, setSelectedSkills] = useRecoilState(skillsState);
  const [selectedGoals, setSelectedGoals] = useRecoilState(goalsState);

  const [editMode, setEditMode] = useState({ skills: false, goals: false });

  useEffect(() => {
    setEditableSkills(
      selectedSkills.concat(Array(3 - selectedSkills.length).fill(""))
    );
    setEditableGoals(
      selectedGoals.concat(Array(6 - selectedGoals.length).fill(""))
    );
  }, [selectedSkills, selectedGoals]);

  const handleCheckboxChange = (field, item) => {
    const setFunction =
      field === "skills" ? setSelectedSkills : setSelectedGoals;
    setFunction((prevItems) => {
      if (prevItems.includes(item)) {
        return prevItems.filter((i) => i !== item);
      } else {
        const limit = field === "skills" ? 3 : 6;
        return prevItems.length < limit ? [...prevItems, item] : prevItems;
      }
    });
  };

  const toggleEditMode = (field) => {
    if (field === "skills" && editMode.goals) {
      alert(
        "現在Goalsを編集中です。Skillsの編集を開始する前にSAVEまたはCLOSEしてください。"
      );
      return;
    }
    if (field === "goals" && editMode.skills) {
      alert(
        "現在Skillsを編集中です。Goalsの編集を開始する前にSAVEまたはCLOSEしてください。"
      );
      return;
    }
    setEditMode((prev) => ({ ...prev, [field]: !prev[field] }));
  };

  const resetFields = (type) => {
    if (type === 'skills') {
      setSelectedSkills([]); // Reset selectedSkills to an empty array
    } else if (type === 'goals') {
      setSelectedGoals([]); // Reset selectedGoals to an empty array
    }
  };

  const getRankStyle = (rank) =>
    ({
      S: "bg-red-100 border-red-500 text-red-800",
      A: "bg-blue-100 border-blue-500 text-blue-800",
      B: "bg-green-100 border-green-500 text-green-800",
      C: "bg-yellow-100 border-yellow-500 text-yellow-800",
      D: "bg-gray-100 border-gray-500 text-gray-800",
    }[rank] || "bg-white");

  const getCategoryStyle = (categoryName) =>
    categoryName === "資格"
      ? ""
      : "bg-gray-100 rounded-md p-4 mb-4 shadow-sm border-l-8 border-purple-500";

  const isDisabled = (item) => {
    if (editMode.skills) {
      return selectedGoals.includes(item);
    } else if (editMode.goals) {
      return selectedSkills.includes(item);
    }
    return false;
  };

  const renderSubcategories = (subcategories, type) => {
    return subcategories.map((subcat, idx) => (
      <div
        key={idx}
        className={`pt-2 mt-2 rounded-md p-4 border-l-4 ${getRankStyle(
          subcat.rank
        )}`}
      >
        <p className="font-semibold text-md">{subcat.rank}</p>
        <div className="flex flex-wrap gap-2">
          {subcat.skills.map((item, itemIdx) => (
            <label
              key={itemIdx}
              className={`label cursor-pointer flex items-center p-2 ${
                isDisabled(item) ? "opacity-50" : ""
              }`}
            >
              <input
                type="checkbox"
                className="checkbox checkbox-primary mr-2"
                checked={
                  type === "skills"
                    ? selectedSkills.includes(item)
                    : selectedGoals.includes(item)
                }
                onChange={() => handleCheckboxChange(type, item)}
                disabled={isDisabled(item)}
              />
              <span className="label-text text-sm">{item}</span>
            </label>
          ))}
        </div>
      </div>
    ));
  };

  const renderSkills = (skills, type) => {
    return (
      <div className="flex flex-wrap gap-2">
        {skills.map((skill, skillIdx) => (
          <label
            key={skillIdx}
            className={`label cursor-pointer flex items-center p-2 ${
              isDisabled(skill) ? "opacity-50" : ""
            }`}
          >
            <input
              type="checkbox"
              className="checkbox checkbox-primary mr-2"
              checked={
                type === "skills"
                  ? selectedSkills.includes(skill)
                  : selectedGoals.includes(skill)
              }
              onChange={() => handleCheckboxChange(type, skill)}
              disabled={isDisabled(skill)}
            />
            <span className="label-text text-sm">{skill}</span>
          </label>
        ))}
      </div>
    );
  };

  // カテゴリーのレンダリングを切り替える関数
  const renderCategories = (type) => {
    return categoryData.categories.map((category, index) => (
      <div key={index} className={getCategoryStyle(category.category)}>
        <p className="font-bold text-lg mb-2">{category.category}</p>
        {category.subcategories
          ? renderSubcategories(category.subcategories, type)
          : renderSkills(category.skills, type)}
      </div>
    ));
  };

  return (
    <>
      {/* Editable fields and buttons for skills */}
      <EditableFields
        label="Skill"
        fields={editableSkills}
        editMode={editMode.skills}
        toggleEditMode={() => toggleEditMode("skills")}
        resetFields={() => resetFields("skills")} // Pass the reset function
        type="skills"
      />
      {editMode.skills && renderCategories("skills")}

      {/* Editable fields for goals */}
      <EditableFields
        label="Goal"
        fields={editableGoals}
        editMode={editMode.goals}
        toggleEditMode={() => toggleEditMode("goals")}
        resetFields={() => resetFields("goals")} // Pass the reset function
        type="goals"
      />
      {editMode.goals && renderCategories("goals")}
    </>
  );
};

const EditableFields = ({
  label,
  fields,
  editMode,
  toggleEditMode,
  resetFields,
}) => {
  const buttonColor = "btn-secondary";

  return (
    <div className="my-4">
      <div className="flex justify-between items-center mb-2">
        <label className="label">{label}</label>
        <div>
          <button
            className={`btn ${buttonColor} btn-sm`}
            onClick={toggleEditMode}
          >
            {editMode ? "Close" : "Edit"}
          </button>
          {editMode && (
            <button className="btn btn-sm btn-error ml-2" onClick={resetFields}>
              Reset
            </button>
          )}
        </div>
      </div>
      <div className="grid grid-cols-3 gap-4">
        {fields.map((field, index) => (
          <input
            key={index}
            type="text"
            className="input input-bordered w-full border border-gray-300  rounded-lg bg-slate-100 text-black"
            value={field}
            readOnly={!editMode}
          />
        ))}
      </div>
    </div>
  );
};

export default Category;
