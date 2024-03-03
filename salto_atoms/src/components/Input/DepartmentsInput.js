import React, { useState, useEffect } from "react";
import useFetchDepartments from "../../hooks/useFetchDepartments";

/* 部署フォーム */
const DepartmentsInput = ({ departmentId, setDepartmentId }) => {
  const departments = useFetchDepartments();
  const [selectedDepartment, setSelectedDepartment] = useState(
    departmentId || ""
  );

  useEffect(() => {
    setSelectedDepartment(departmentId || "");
  }, [departmentId]);

  const handleChange = (e) => {
    const newDepartmentId = e.target.value === "" ? null : e.target.value;
    setSelectedDepartment(newDepartmentId);
    // Assuming setDepartmentId can handle null values appropriately
    setDepartmentId(newDepartmentId);
  };

  return (
    <div className="flex-1">
      <label htmlFor="department" className="label">
        部署
      </label>
      <select
        id="department"
        className="select w-full border border-gray-300 rounded-lg bg-slate-100 text-black"
        value={selectedDepartment || ""} // Ensure the select resets to the placeholder when null
        onChange={handleChange}
      >
        <option value="">選択して下さい</option>
        {departments.map((dep) => (
          <option key={dep.dep_id} value={dep.dep_id}>
            {dep.dep_name}
          </option>
        ))}
      </select>
    </div>
  );
};

export default DepartmentsInput;
