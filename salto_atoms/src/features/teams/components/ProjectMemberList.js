import React from "react";
import TitleCard from "../../../components/Cards/TitleCard";

function ProjectMemberList({ members, onRemove }) {

  if (!members || members.length === 0) {
    return (
      <TitleCard title="Project Members">
        <p className="text-center">No members found.</p>
      </TitleCard>
    );
  }

  return (
    <TitleCard title="Project Members">
      <div className="overflow-auto w-full py-2">
        <table className="table w-full">
          <thead>
            <tr>
              <th className="text-center">Name</th>
              <th className="text-center">Post</th>
              <th className="text-center">Department</th>
              <th className="text-center">Project Role</th>
              <th className="text-center">Remove</th>
            </tr>
          </thead>
          <tbody>
            {members.map((member, index) => (
               <tr
               key={index}
               className="bg-white shadow-lg rounded-lg overflow-hidden mb-4"
             >
                <td className="p-4">
                  <div className="flex items-center space-x-3">
                    <div className="avatar">
                      <div className="mask mask-squircle w-12 h-12">
                        <img src={member.picture} alt="Avatar" />
                      </div>
                    </div>
                    <div>
                      <div className="font-bold">{member.first_name}</div>
                      <div className="text-gray-500">{member.last_name}</div>
                    </div>
                  </div>
                </td>
                <td>
                  <div className="flex flex-wrap gap-1 justify-center items-center">
                    <span className="badge badge-outline">
                      {member.post}
                    </span>
                  </div>
                </td>
                <td>
                  <div className="flex justify-center">
                    {member.division} {member.department} {member.section}{" "}
                    {member.group}
                  </div>
                </td>
                <td className="text-center">
                  <select className="select select-bordered w-full">
                    <option>Member</option>
                    <option>Project Leader(PL)</option>
                    <option>Project Manager(PM)</option>
                    <option>Master</option>

                  </select>
                </td>
                <td className="flex justify-center">
                  <div>
                  <button
                    onClick={() => onRemove(member.id)}
                    className="btn btn-outline btn-error"
                  >
                    Remove
                  </button>
                  </div>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </TitleCard>
  );
}

export default ProjectMemberList;
