import React, { useState, useEffect } from "react";
import useFetchDepartments from "../../hooks/api/useFetchDepartments";
import { DepartmentType } from "../../types";


interface DepartmentsInputProps {
  departmentId: string | "";
  setDepartmentId: (departmentId: string | "") => void;
}

const DepartmentsInput: React.FC<DepartmentsInputProps> = ({ departmentId, setDepartmentId }) => {
  const departments = useFetchDepartments();

  const [selectedDepartment, setSelectedDepartment] = useState<string | "">(departmentId);

  useEffect(() => {
    setSelectedDepartment(departmentId);
  }, [departmentId]);

  const handleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    const newDepartmentId = e.target.value || "";
    setSelectedDepartment(newDepartmentId);
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
        value={selectedDepartment ?? ""} 
        onChange={handleChange}
      >
        <option value="">選択してください</option>
        {departments.map((dep: DepartmentType) => (
          <option key={dep.dep_id} value={dep.dep_id}>
            {dep.dep_name}
          </option>
        ))}
      </select>
    </div>
  );
};

export default DepartmentsInput;
