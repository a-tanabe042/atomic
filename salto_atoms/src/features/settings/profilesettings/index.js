import React, { useState, useEffect } from "react";
import TitleCard from "../../../components/cards/TitleCard";
import useFetchApi from "../../../hooks/useFetchApi";
import useLoading from '../../../hooks/useLoading';

import useFetchLoginUser from "../../../hooks/useFetchLoginUser";
import UserNameInput from "../../../components/input/UserNameInput";
import EmailInput from "../../../components/input/EmailInput";
import JoinDateInput from "../../../components/input/JoinDateInput";
import PostInput from "../../../components/input/PostInput";
import DepartmentsInput from "../../../components/input/DepartmentsInput";
import SectionsInput from "../../../components/input/SectionsInput";
import GroupsInput from "../../../components/input/GroupsInput";
import Loading from "../../../components/loading/Loading";


const ProfileSettings = () => {
  const loginUser = useFetchLoginUser();
  const { updateData } = useFetchApi();


  const delay = parseInt(process.env.REACT_APP_LOADING_DELAY, 10) || 2000; 
  const isLoading = useLoading(delay);

  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [email, setEmail] = useState("");
  const [joinDate, setJoinDate] = useState({ startDate: null, endDate: null });
  const [postId, setPostId] = useState("");
  const [departmentId, setDepartmentId] = useState("");
  const [sectionId, setSectionId] = useState("");
  const [groupId, setGroupId] = useState("");

  useEffect(() => {
    if (loginUser) {
      setFirstName(loginUser.attributes.first_name || "");
      setLastName(loginUser.attributes.last_name || "");
      setEmail(loginUser.attributes.email || "");
      setJoinDate(loginUser.attributes.join_date || "");
      setPostId(loginUser.attributes.pos_id || "");
      setDepartmentId(loginUser.attributes.dep_id || "");
      setSectionId(loginUser.attributes.section_id || "");
      setGroupId(loginUser.attributes.group_id || "");
    }
  }, [loginUser]);

  const handleUpdateProfile = async () => {
    const endpoint = `api/user-saltos/${loginUser.id}`;
    const payload = {
      data: {
        email: email,
        first_name: firstName,
        last_name: lastName,
        join_date: joinDate,
        pos_id: postId,
        dep_id: departmentId,
        section_id: sectionId,
        group_id: groupId,
      },
    };
    try {
      await updateData(endpoint, payload);
      alert("プロフィールが更新されました。");
    } catch (error) {
      alert(`更新に失敗しました: ${error.message}`);
    }
  };

  if (isLoading) {
    return <Loading />;
  }

  return (
    <TitleCard title="プロフィール" topMargin="mt-2">
      <div className="w-full">
        {/* ------ ユーザープロフィール ------ */}
        <UserNameInput
          firstName={firstName}
          setFirstName={setFirstName}
          lastName={lastName}
          setLastName={setLastName}
        />
        <div className="flex w-full space-x-4">
          <EmailInput email={email} className="flex-1" />
          <JoinDateInput
            joinDate={joinDate}
            setJoinDate={setJoinDate}
            className="flex-1"
          />
        </div>
        <div className="divider my-10"></div>
        {/* ------ 役職 所属 ------ */}
        <div className="">
          <PostInput postId={postId} setPostId={setPostId} />
        </div>
        <div className="flex w-full justify-between space-x-4">
          <DepartmentsInput
            departmentId={departmentId}
            setDepartmentId={setDepartmentId}
            className="flex-1"
          />
          <SectionsInput
            sectionId={sectionId}
            setSectionId={setSectionId}
            className="flex-1"
          />
          <GroupsInput
            groupId={groupId}
            setGroupId={setGroupId}
            className="flex-1"
          />
        </div>
        <div className="divider my-10"></div>
        {/* ------ スキルセット 目標 ------ */}

        <div className="mt-16">
          <button
            className="btn btn-primary float-right"
            onClick={handleUpdateProfile}
          >
            更新する
          </button>
        </div>
      </div>
    </TitleCard>
  );
};

export default ProfileSettings;
