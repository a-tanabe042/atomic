import React, { useState, useEffect, useMemo } from "react";
import TitleCard from "../../../components/Cards/TitleCard";
import useStrapi from "../../../hooks/useStrapi";
import useGoogleProfile from "../../../hooks/useGoogleProfile";
import LoadingModal from "../../user/LoadingModal";

function Team() {
  // ログインユーザーの情報の取得と設定
  const accessToken = localStorage.getItem("access_token");
  const googleId = useGoogleProfile(accessToken);
  const [currentUser, setCurrentUser] = useState(null);
  const [userDepartmentName, setUserDepartmentName] = useState("");
  const [userSectionName, setUserSectionName] = useState("");
  const [userGroupName, setUserGroupName] = useState("");
  const [userDivisionName, setUserDivisionName] = useState("");

  //全社員の情報の取得と設定
  const { data: membersData, loading: membersLoading } = useStrapi("user-saltos", {});
  const [members, setMembers] = useState([]);
  const { data: postData, loading: postLoading } = useStrapi("posts", {});
  const { data: departmentData, loading: departmentLoading } = useStrapi("departments",{});
  const { data: sectionData, loading: sectionLoading } = useStrapi("sections",{});
  const { data: groupData, loading: groupLoading } = useStrapi("groups", {});
  const { data: divisionData, loading: divisionLoading } = useStrapi("divisions",{});

  // ローディングモーダルの表示制御
  const [showModal, setShowModal] = useState(false);

  // ローディング状態を統合
  const isLoading = membersLoading || postLoading || departmentLoading || sectionLoading || groupLoading || divisionLoading;

  // 技術本部、SI営業本部、管理本部の各部署IDを配列で定義
  const technicalDivisionDepartmentIds = useMemo(() => [1, 2, 3, 5, 7, 8], []);
  const siSalesDivisionDepartmentIds = useMemo(() => [9, 10], []);
  const managementDivisionDepartmentIds = useMemo(() => [12, 13, 14, 15, 16, 17],[]);

  useEffect(() => {
    if (isLoading) {
      //trueの場合、ローディングモーダルを表示
      setShowModal(true);
      //falseの場合、ローディングモーダルを非表示
      setShowModal(false);
    }

    // ログインユーザーの情報の設定
    const user = membersData?.data?.find((user) => user.attributes.google_id === googleId);
    if (user) {
      setCurrentUser(user.attributes);
    }
    // ログインユーザーの部署名、課名、グループ名の設定
    if (
      currentUser &&
      departmentData?.data &&
      sectionData?.data &&
      groupData?.data
    ) {
      const department = departmentData.data.find(
        (dept) => dept.id === currentUser.dep_id
      );
      setUserDepartmentName(
        department ? department.attributes.dep_name : "所属なし"
      );

      const section = sectionData.data.find(
        (sect) => sect.id === currentUser.section_id
      );
      setUserSectionName(section ? section.attributes.section_name : "");

      const group = groupData.data.find(
        (grp) => grp.id === currentUser.group_id
      );
      setUserGroupName(group ? group.attributes.group_name : "");
    }

    // メンバーのフィルタリングと拡張
    let filteredMembers = [];
    if (currentUser && membersData?.data) {
      // ユーザーが本部に所属している場合の処理
      if ([1, 2, 3].includes(currentUser.pos_id)) {
        let divisionId = currentUser.div_id === 0 ? 1 : currentUser.div_id;
        const currentDivision = divisionData.data.find(
          (div) => div.id === divisionId
        );
        setUserDivisionName(currentDivision.attributes.div_name);

        let relatedDepartmentIds = [];
        // 本部に基づいて関連する部署のIDリストを作成
        switch (currentDivision.id) {
          case 1:
            relatedDepartmentIds = departmentData.data.map((dept) => dept.id);
            break;
          case 2:
            relatedDepartmentIds = technicalDivisionDepartmentIds;
            break;
          case 3:
            relatedDepartmentIds = siSalesDivisionDepartmentIds;
            break;
          case 4:
            relatedDepartmentIds = managementDivisionDepartmentIds;
            break;
          // その他のケース
          default:
            break;
        }
        filteredMembers = membersData.data.filter((member) =>
          relatedDepartmentIds.includes(member.attributes.dep_id)
        );
      } else {
        // ログインユーザーがセクションまたはグループを持つ場合の処理
        filteredMembers = membersData.data.filter(
          (member) =>
            member.attributes.dep_id === currentUser.dep_id &&
            (!currentUser.section_id ||
              member.attributes.section_id === currentUser.section_id) &&
            (!currentUser.group_id ||
              member.attributes.group_id === currentUser.group_id)
        );
      }
    }

    filteredMembers.sort((a, b) => a.attributes.pos_id - b.attributes.pos_id);

    setMembers(
      filteredMembers.map((member) => ({
        // メンバーの情報をマッピング
        id: member.id,
        picture: member.attributes.picture,
        first_name: member.attributes.first_name,
        last_name: member.attributes.last_name,
        email: member.attributes.email,
        post:
          postData.data.find((p) => p.id === member.attributes.pos_id)
            ?.attributes?.pos_name || "",
        pos_id: member.attributes.pos_id,
        join_date: member.attributes.join_date
          ? member.attributes.join_date.startDate
          : "-",
        department:
          departmentData.data.find((d) => d.id === member.attributes.dep_id)
            ?.attributes?.dep_name || "",
        section:
          sectionData.data.find((s) => s.id === member.attributes.section_id)
            ?.attributes?.section_name || "",
        group:
          groupData.data.find((g) => g.id === member.attributes.group_id)
            ?.attributes?.group_name || "",
      }))
    );
  }, [
    isLoading,
    currentUser,
    membersData,
    postData,
    departmentData,
    sectionData,
    groupData,
    divisionData,
    googleId,
    managementDivisionDepartmentIds,
    siSalesDivisionDepartmentIds,
    technicalDivisionDepartmentIds,
  ]);

  //ログインユーザーの所属部署の役職者の表示と役職項目の表示制御
  const renderDepartmentPositions = () => {
    const depId = currentUser?.dep_id;
    const sectionId = currentUser?.section_id;
    const posId = currentUser?.pos_id;

    // ログインユーザーの所属部署と課の役職者を検索
    const bucho = membersData?.data.find(
      (member) =>
        member.attributes.dep_id === depId &&
        (member.attributes.section_id === 0 ||
          member.attributes.section_id === sectionId) &&
        member.attributes.pos_id === 4
    );
    const kacho = membersData?.data.find(
      (member) =>
        member.attributes.dep_id === depId &&
        member.attributes.section_id === sectionId &&
        member.attributes.pos_id === 5
    );
    const kakaricho = membersData?.data.find(
      (member) =>
        member.attributes.dep_id === depId &&
        member.attributes.section_id === sectionId &&
        member.attributes.pos_id === 6
    );

    return (
      <div className="flex items-center space-x-4 mb-1">
        {/*部長項目を部長以上で非表示*/}
        {posId !== 1 && posId !== 2 && posId !== 3 && posId !== 4 && (
          <div className="flex space-x-4 items-center">
            <label className="badge badge-outline">部長</label>
            <p className="font-semibold">
              {bucho
                ? `${bucho.attributes.first_name} ${bucho.attributes.last_name}`
                : "-"}
            </p>
          </div>
        )}
        {/*課長項目を課長以上で非表示*/}
        {posId !== 1 &&
          posId !== 2 &&
          posId !== 3 &&
          posId !== 4 &&
          posId !== 5 && (
            <div className="flex space-x-4 items-center">
              <label className="badge badge-outline">課長</label>
              <p className="font-semibold ">
                {kacho
                  ? `${kacho.attributes.first_name} ${kacho.attributes.last_name}`
                  : "-"}
              </p>
            </div>
          )}
        {/*係長項目を係長以上で非表示*/}
        {posId !== 1 &&
          posId !== 2 &&
          posId !== 3 &&
          posId !== 4 &&
          posId !== 5 &&
          posId !== 6 && (
            <div className="flex space-x-4 items-center">
              <label className="badge badge-outline">係長</label>
              <p className="font-semibold ">
                {kakaricho
                  ? `${kakaricho.attributes.first_name} ${kakaricho.attributes.last_name}`
                  : "-"}
              </p>
            </div>
          )}
      </div>
    );
  };

  if (showModal) {
    return <LoadingModal />;
  }

  return (
    <>
      <TitleCard title="所属部署" topMargin="mt-2">
        <div>
          {/* pos_idが1, 2, 3の場合、本部名を表示 */}
          {[1, 2, 3].includes(currentUser?.pos_id) ? (
            <div className="flex space-x-4 items-center">
              <label className="badge badge-outline mb-3 font-semibold">
                {userDivisionName}
              </label>
              <p className="mb-3">
                {currentUser?.first_name} {currentUser?.last_name}
              </p>
            </div>
          ) : (
            <p className="mb-3 font-semibold ">
              {userDepartmentName} {userSectionName} {userGroupName}
            </p>
          )}
        </div>
        {renderDepartmentPositions()}

        {/*所属部署テーブル*/}
        <div className="overflow-auto w-full">
          <table className="table w-full">
            <thead>
              <tr>
                <th className=" text-center">Name</th>
                <th className="text-center">Mail</th>
                <th className="text-center">Post</th>
                <th className="text-center">Department</th>
                <th className="text-center">Join Date</th>
              </tr>
            </thead>
            <tbody>
              {members.map((member, index) => (
                <tr
                  key={index}
                  className="bg-white shadow-lg rounded-lg overflow-hidden mb-4"
                >
                  <td className="p-4">
                    <div className="flex items-center space-x-3 ">
                      <div className="avatar">
                        <div className="mask mask-squircle w-12 h-12">
                          <img src={member.picture} alt="Avatar" />
                        </div>
                      </div>
                      <div>
                        <div className="font-bold">{member.first_name}</div>
                        <div className=" text-gray-500">{member.last_name}</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div className="flex flex-wrap gap-1 justify-center items-center">
                      <span className="">{member.email}</span>
                    </div>
                  </td>
                  <td>
                    <div className="flex flex-wrap gap-1  justify-center items-center">
                      <span className="badge badge-outline">{member.post}</span>
                    </div>
                  </td>
                  <td>
                    <div className="flex flex-wrap gap-1  justify-center items-center">
                      <span>
                        {member.department} {member.section} {member.group}
                      </span>
                    </div>
                  </td>

                  <td>
                    <div className="flex flex-wrap gap-1  justify-center items-center">
                      <span className="">{member.join_date}</span>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </TitleCard>
    </>
  );
}

export default Team;
