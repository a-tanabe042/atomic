// ProfileSettings.js
import React, { useState, useEffect } from "react";
import TitleCard from "../../../components/Cards/TitleCard";
import useFetchLoginUser from "../../../hooks/useFetchLoginUser";
import UserNameInput from "../../../components/Input/UserNameInput";
import EmailInput from "../../../components/Input/EmailInput";
import JoinDateInput from "../../../components/Input/JoinDateInput";
import DepartmentsInput from "../../../components/Input/DepartmentsInput";
// import SectionsInput from "../../../components/Input/SectionsInput";
// import GroupsInput from "../../../components/Input/GroupsInput";


const ProfileSettings = () => {
  const loginUser = useFetchLoginUser();
  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [email, setEmail] = useState("");
  const [joinDate, setJoinDate] = useState("");
  const [departmentId, setDepartmentId] = useState([]);
  // const [sections, setSections] = useState([]);
  // const [groups, setGroups] = useState([]);


  useEffect(() => {
    if (loginUser && loginUser.attributes.first_name) {
      setFirstName(loginUser.attributes.first_name);
    }
    if (loginUser && loginUser.attributes.last_name) {
      setLastName(loginUser.attributes.last_name);
    }
    if (loginUser && loginUser.attributes.email) {
      setEmail(loginUser.attributes.email);
    }
    if (loginUser && loginUser.attributes.join_date.startDate) {
      setJoinDate(new Date(loginUser.attributes.join_date.startDate));
    }
    if (loginUser && loginUser.attributes.dep_id) {
      setDepartmentId(loginUser.attributes.dep_id);
    }
  }, [loginUser]);

  return (
    <TitleCard title="プロフィール" topMargin="mt-2">
      <div>

        {/* ------ ユーザー情報 ------ */}
        <UserNameInput
          firstName={firstName}
          setFirstName={setFirstName}
          lastName={lastName}
          setLastName={setLastName}
        />
        <EmailInput email={email} />
        <JoinDateInput joinDate={joinDate} setJoinDate={setJoinDate} />
        
        <div className="divider my-10"></div>
        {/* ------ 役職 所属部署 ------ */}
        <div className="flex justify-between items-center space-x-4">
        <DepartmentsInput departmentId={departmentId} setDepartmentId={setDepartmentId}/>
        {/* <SectionsInput sections={sections} setSections={setSections} /> */}
        {/* <GroupsInput groups={groups} setGroups={setGroups} /> */}
        </div>

        {/* ------ スキルセット 目標 ------ */}


      </div>
    </TitleCard>
  );
};

export default ProfileSettings;
