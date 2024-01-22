import React, { useState, useEffect } from "react";
import TitleCard from "../../components/Cards/TitleCard";
import useStrapi from "../../hooks/useStrapi";
import Filter from "../../components/filter/Filter";
import LoadingModal from "../user/LoadingModal";

function Members() {
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

  const [filteredMembers, setFilteredMembers] = useState([]);
  const [, setFilterParam] = useState("");
  const postsList =
    postData?.data.map((post) => post.attributes.pos_name) || [];
  const departmentsList =
    departmentData?.data.map((department) => department.attributes.dep_name) ||
    [];

  const [currentPage, setCurrentPage] = useState(1);
  const membersPerPage = 10; // Set the number of members per page

  // Calculate the current members to display
  const indexOfLastMember = currentPage * membersPerPage;
  const indexOfFirstMember = indexOfLastMember - membersPerPage;
  const currentMembers = filteredMembers.slice(
    indexOfFirstMember,
    indexOfLastMember
  );

  // Change page and scroll to top
  const paginate = (pageNumber) => {
    setCurrentPage(pageNumber);

    const element = document.getElementById("top-of-page");
    if (element) {
      element.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  };

  // Calculate total pages
  const pageNumbers = [];
  for (
    let i = 1;
    i <= Math.ceil(filteredMembers.length / membersPerPage);
    i++
  ) {
    pageNumbers.push(i);
  }

  // Enhance member data with additional information
  useEffect(() => {
    if (isLoading) return; // データがまだロード中の場合は何もしない

    const enhancedMembers = membersData.data.map((member) => ({
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
    }));

    setFilteredMembers(enhancedMembers);
  }, [
    membersData,
    departmentData,
    sectionData,
    groupData,
    postData,
    divisionData,
  ]);

  // フィルター適用関数
  const applyFilter = (filterParam) => {
    setFilterParam(filterParam); // フィルターパラメータを設定

    if (membersData && membersData.data) {
      // membersData.data が存在する場合のみフィルタリングを実行
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
    setFilterParam(""); // フィルターパラメータをクリア

    if (membersData && membersData.data) {
      
      const originalMembers = membersData.data.map((member) => ({
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
          postData.data.find((p) => p.id === member.attributes.pos_id)
            ?.attributes?.pos_name || "",
        division:
          divisionData.data.find((d) => d.id === member.attributes.div_id)
            ?.attributes?.div_name || "",
        skills: member.attributes.skills || [],
        goals: member.attributes.goals || [],
      }));

      setFilteredMembers(originalMembers);
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
            ${member.post}${member.division}${member.skills.join(
            ""
          )}${member.goals.join("")}`
            .toLowerCase()
            .replace(/\s+/g, "");

          return searchWords.every((word) => memberDataString.includes(word));
        });

      setFilteredMembers(filteredData);
    }
  };

  
  const enhanceMemberData = (member) => ({
    id: member.id, // メンバーの ID を含める
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
        title="Members"
        topMargin="mt-2"
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
                <th className="text-xs text-center">Name</th>
                <th className="text-xs text-center">Post</th>
                <th className="text-xs text-center">Department</th>
                <th className="text-xs text-center">Skill</th>
                <th className="text-xs text-center">Goal</th>
              </tr>
            </thead>
            <tbody>
              {currentMembers.map((member, index) => (
                <tr
                  key={index}
                  className="bg-white shadow-lg rounded-lg overflow-hidden mb-4"
                >
                  <td className="p-4">
                    <div className="flex items-center space-x-3">
                      <div className="avatar">
                        <div className="mask mask-squircle w-8 h-8">
                          <img src={member.picture} alt="Avatar" />
                        </div>
                      </div>
                      <div>
                        <div className="font-bold text-xs">
                          {member.first_name}
                        </div>
                        <div className="text-xs text-gray-500">
                          {member.last_name}
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div className="flex flex-wrap gap-1 text-xs justify-center items-center">
                      <span className="badge badge-outline text-xs">
                        {member.post}
                      </span>
                    </div>
                  </td>
                  <td>
                    <div className="text-xs flex justify-center">
                      {member.division} {member.department} {member.section}{" "}
                      {member.group}
                    </div>
                  </td>
                  <td className="max-w-[300px] overflow-auto">
                    {/* Skills */}
                    <div className="flex flex-wrap gap-1 justify-center items-center">
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
                  <td className="max-w-[300px] overflow-auto">
                    {/* Goals */}
                    <div className="flex flex-wrap gap-1 justify-left items-center">
                      {member.goals && member.goals.length > 0 ? (
                        member.goals.slice(0, 6).map((goal, goalIndex) => (
                          <span
                            key={goalIndex}
                            className="badge badge-outline text-xs"
                          >
                            {goal}
                          </span>
                        ))
                      ) : (
                        <span className="text-xs"></span>
                      )}
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
        <div className="flex justify-center my-4">
          <div className="btn-group mt-8">
            {pageNumbers.map((number) => (
              <button
                key={number}
                className={`btn btn-sm ${
                  currentPage === number ? "btn-neutral" : "btn-outline"
                }`}
                onClick={() => paginate(number)}
              >
                {number}
              </button>
            ))}
          </div>
        </div>
      </TitleCard>
    </>
  );
}

export default Members;
