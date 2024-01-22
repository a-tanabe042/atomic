import React, { useState, useEffect } from "react";
import useStrapi from "../../../hooks/useStrapi";
import LoadingModal from "../../user/LoadingModal";
import TitleCard from "../../../components/Cards/TitleCard";
import Filter from "../../../components/filter/Filter";
import ProjectMemberList from "./ProjectMemberList";

const AddNewMember = () => {
  const { data: membersData, loading: membersLoading } = useStrapi(
    "user-saltos",
    {}
  );
  const { data: departmentData, loading: departmentLoading } = useStrapi(
    "departments",
    {}
  );
  const { data: sectionData, loading: sectionLoading } = useStrapi(
    "sections",
    {}
  );
  const { data: groupData, loading: groupLoading } = useStrapi("groups", {});
  const { data: postData, loading: postLoading } = useStrapi("posts", {});
  const { data: divisionData, loading: divisionLoading } = useStrapi(
    "divisions",
    {}
  );

  const isLoading =
    membersLoading ||
    postLoading ||
    departmentLoading ||
    sectionLoading ||
    groupLoading ||
    divisionLoading;

  const [selectedMembers, setSelectedMembers] = useState([]);
  const postsList =
    postData?.data.map((post) => post.attributes.pos_name) || [];
  const departmentsList =
    departmentData?.data.map((department) => department.attributes.dep_name) ||
    [];
  const [filteredMembers, setFilteredMembers] = useState([]);

  const [, setFilterParam] = useState("");

  useEffect(() => {
    setFilteredMembers([]);
  }, [departmentData, sectionData, groupData, postData, divisionData]);

  const handleAddMember = (member) => {
    setSelectedMembers((prevMembers) => {
      if (prevMembers.find((m) => m.id === member.id)) {
        return prevMembers;
      }
      return [...prevMembers, member];
    });
  };

  const handleSave = () => {
    console.log("Saving members:", selectedMembers);
  };

  const handleRemoveMember = (memberId) => {
    setSelectedMembers((currentMembers) =>
      currentMembers.filter((member) => member.id !== memberId)
    );
  };

  const applyFilter = (filterParam) => {
    setFilterParam(filterParam);
    if (membersData && membersData.data) {
      let filtered = membersData.data.map(enhanceMemberData);
      if (filterParam !== "All") {
        filtered = filtered.filter(
          (member) =>
            member.post === filterParam || member.department === filterParam
        );
      }
      setFilteredMembers(filtered);
    }
  };

  const removeFilter = () => {
    setFilterParam("");
    if (membersData && membersData.data) {
      setFilteredMembers([]);
    }
  };

  const applySearch = (searchText) => {
    const searchWords = searchText
      .toLowerCase()
      .split(/\s+/)
      .filter((word) => word.length > 0);

    if (searchWords.length === 0) {
      setFilteredMembers(membersData.data.map(enhanceMemberData));
    } else {
      const filteredData = membersData.data
        .map(enhanceMemberData)
        .filter((member) => {
          const memberDataString = `
            ${member.first_name}${member.last_name}
            ${member.department}${member.section}${member.group}
            ${member.post}${member.division}${member.skills.join("")}`
            .toLowerCase()
            .replace(/\s+/g, "");

          return searchWords.every((word) => memberDataString.includes(word));
        });

      setFilteredMembers(filteredData);
    }
  };

  const enhanceMemberData = (member) => ({
    id: member.id,
    ...member.attributes,
    department:
      departmentData.data.find((d) => d.id === member.attributes.dep_id)
        ?.attributes?.dep_name || "",
    section:
      sectionData.data.find((s) => s.id === member.attributes.section_id)
        ?.attributes?.section_name || "",
    group:
      groupData.data.find((g) => g.id === member.attributes.group_id)
        ?.attributes?.group_name || "",
    post:
      postData.data.find((p) => p.id === member.attributes.pos_id)?.attributes
        ?.pos_name || "",
    division:
      divisionData.data.find((d) => d.id === member.attributes.div_id)
        ?.attributes?.div_name || "",
    skills: member.attributes.skills || [],
    goals: member.attributes.goals || [],
  });

  if (isLoading) {
    return <LoadingModal />;
  }

  return (
    <>
      <TitleCard
        title="Add Member"
        topMargin="mt-4"
        TopSideButtons={
          <Filter
            applySearch={applySearch}
            applyFilter={applyFilter}
            removeFilter={removeFilter}
            posts={postsList}
            departments={departmentsList}
          />
        }
      >
        <div id="top-of-page" className="overflow-auto w-full py-2">
          <table className="table w-full">
            <thead>
              <tr>
                <th className="text-center">Name</th>
                <th className="text-center">Post</th>
                <th className="text-center">Department</th>
                <th className="text-center">Skills</th>
                <th className="text-center">Add Members</th>
              </tr>
            </thead>
            <tbody>
              {filteredMembers.length > 0 ? (
                filteredMembers.map((member, index) => (
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
                          <div className="text-gray-500">
                            {member.last_name}
                          </div>
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
                    <td className="max-w-[300px] overflow-auto">
                      <div className="flex flex-wrap gap-1 justify-left items-center">
                        {member.skills && member.skills.length > 0 ? (
                          member.skills.slice(0, 3).map((skill, skillIndex) => (
                            <span
                              key={skillIndex}
                              className="badge badge-outline text-xs"
                            >
                              {skill}
                            </span>
                          ))
                        ) : (
                          <span className="text-xs items-center"></span>
                        )}
                      </div>
                    </td>
                    <td>
                      <div className="flex justify-center">
                        <button
                          onClick={() => handleAddMember(member)}
                          className="btn btn-outline btn-success"
                        >
                          Add
                        </button>
                      </div>
                    </td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan="5" className="text-center p-4">
                    Add New Member
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </TitleCard>
      <div>
        <ProjectMemberList
          members={selectedMembers}
          onRemove={handleRemoveMember}
        />
        <button
          onClick={handleSave}
          className="btn btn-error text-white fixed right-5 bottom-5 rounded-full"
        >
          Save Members
        </button>
      </div>
    </>
  );
};

export default AddNewMember;
