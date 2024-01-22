import React, { useState, useEffect } from "react";
import TitleCard from "../../../components/Cards/TitleCard";
import useStrapi from "../../../hooks/useStrapi";

function SkillsChannels() {
  const { data: membersData, loading: membersLoading } = useStrapi("user-saltos", {});
  const [skillCount, setSkillCount] = useState([]);

  useEffect(() => {
    if (membersLoading || !membersData || !membersData.data) return;

    let skillMap = {};
    membersData.data.forEach((user) => {
      if (user && user.attributes && user.attributes.skills) {
        user.attributes.skills.forEach((skill) => {
          if (skill) {
            skillMap[skill] = (skillMap[skill] || 0) + 1;
          }
        });
      }
    });

    let sortedSkills = Object.entries(skillMap)
      .map(([name, count]) => ({
        name,
        count,
        percentage: ((count / membersData.data.length) * 100).toFixed(2),
      }))
      .sort((a, b) => b.count - a.count)
      .slice(0, 10); // 7位までに制限

    setSkillCount(sortedSkills);
  }, [membersData, membersLoading]);

  if (membersLoading) {
    return <div>Loading...</div>;
  }

  if (!membersData || !membersData.data) {
    return <div>No data available</div>;
  }

  return (
    <TitleCard title={"Salto User Skill Sets"}>
      <div className="overflow-x-auto">
        <table className="table w-full">
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Count</th>
              <th>Percentage</th>
            </tr>
          </thead>
          <tbody>
            {skillCount.map((skill, index) => (
              <tr key={index}>
                <td>{index + 1}</td>
                <td>
                  {skill.name.length > 15
                    ? `${skill.name.substring(0, 15)}...`
                    : skill.name}
                </td>
                <td>{skill.count}</td>
                <td>{`${skill.percentage}%`}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </TitleCard>
  );
}

export default SkillsChannels;
