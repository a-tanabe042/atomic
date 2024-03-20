import React, { useState, useEffect } from "react";
import useFetchGroups from "../../hooks/api/useFetchGroups";
import { Group } from "../../types";

interface GroupsInputProps {
  groupId: string | "";
  setGroupId: (groupId: string | "") => void;
}

const GroupsInput: React.FC<GroupsInputProps> = ({ groupId, setGroupId }) => {
  const groups = useFetchGroups();
  const [selectedGroup, setSelectedGroup] = useState<string | "">(groupId);

  useEffect(() => {
    setSelectedGroup(groupId);
  }, [groupId]);

  const handleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    const newGroupId = e.target.value || "";
    setSelectedGroup(newGroupId);
    setGroupId(newGroupId);
  };

  return (
    <div className="flex-1">
      <label htmlFor="group" className="label">
        グループ
      </label>
      <select
        id="group"
        className="select w-full border border-gray-300 rounded-lg bg-slate-100 text-black"
        value={selectedGroup ?? ""}
        onChange={handleChange}
      >
        <option value="">選択してください</option>
        {groups.map((group: Group) => (
          <option key={group.group_id} value={group.group_id}>
            {group.group_name}
          </option>
        ))}
      </select>
    </div>
  );
};

export default GroupsInput;
