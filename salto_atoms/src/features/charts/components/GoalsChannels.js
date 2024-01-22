import React, { useState, useEffect } from "react";
import TitleCard from "../../../components/Cards/TitleCard";
import useStrapi from "../../../hooks/useStrapi";

function GoalsChannels() {
  const { data: membersData, loading: membersLoading } = useStrapi("user-saltos", {});
  const [goalCount, setGoalCount] = useState([]);

  useEffect(() => {
    if (membersLoading || !membersData || !membersData.data) return;

    let goalMap = {};
    membersData.data.forEach(user => {
      if (user && user.attributes && user.attributes.goals) {
        user.attributes.goals.forEach(goal => {
          if (goal) {
            goalMap[goal] = (goalMap[goal] || 0) + 1;
          }
        });
      }
    });

    let sortedGoals = Object.entries(goalMap)
      .map(([name, count]) => ({
        name, 
        count, 
        percentage: ((count / membersData.data.length) * 100).toFixed(2)
      }))
      .sort((a, b) => b.count - a.count)
      .slice(0, 10);  // 7位までに制限

    setGoalCount(sortedGoals);
  }, [membersData, membersLoading]);

  if (membersLoading) {
    return <div>Loading...</div>;
  }

  if (!membersData || !membersData.data) {
    return <div>No data available</div>;
  }

  return (
    <TitleCard title={"Salto User Goals"}>
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
            {goalCount.map((goal, index) => (
              <tr key={index}>
                <td>{index+1}</td>
                <td>{goal.name.length > 15 ? `${goal.name.substring(0, 15)}...` : goal.name}</td>
                <td>{goal.count}</td>
                <td>{`${goal.percentage}%`}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </TitleCard>
  );
}

export default GoalsChannels;
