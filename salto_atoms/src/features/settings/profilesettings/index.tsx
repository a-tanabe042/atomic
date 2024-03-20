import React, { useState, useEffect } from "react";
import TitleCard from "../../../components/cards/TitleCard";
import useFetchApi from "../../../hooks/api/useFetchApi";
import useLoading from '../../../hooks/api/useLoading';

import useFetchLoginUser from "../../../hooks/api/useFetchLoginUser";
import UserNameInput from "../../../components/input/UserNameInput";
import EmailInput from "../../../components/input/EmailInput";
import JoinDateInput from "../../../components/input/JoinDateInput";
import PostInput from "../../../components/input/PostInput";
import DepartmentsInput from "../../../components/input/DepartmentsInput";
import SectionsInput from "../../../components/input/SectionsInput";
import GroupsInput from "../../../components/input/GroupsInput";
import Loading from "../../../components/loading/Loading";
import { UserType } from "../../../types"; // 仮の型定義の場所


const ProfileSettings: React.FC = () => {
  const loginUser: UserType | null = useFetchLoginUser();
  const { updateData } = useFetchApi();

  const delay: number = parseInt(process.env.REACT_APP_LOADING_DELAY ?? '2000', 10); 
  const isLoading: boolean = useLoading(delay);

  // useStateに型注釈を追加
  const [firstName, setFirstName] = useState<string>("");
  const [lastName, setLastName] = useState<string>("");
  const [email, setEmail] = useState<string>("");
  const [joinDate, setJoinDate] = useState<string | { startDate: Date | null; endDate: Date | null }>({ startDate: null, endDate: null });
  const [postId, setPostId] = useState<string>("");
  const [departmentId, setDepartmentId] = useState<string>("");
  const [sectionId, setSectionId] = useState<string>("");
  const [groupId, setGroupId] = useState<string>("");

  useEffect(() => {
    if (loginUser) {
      const { attributes } = loginUser;
      setFirstName(attributes.first_name ?? "");
      setLastName(attributes.last_name ?? "");
      setEmail(attributes.email ?? "");
      setJoinDate(attributes.join_date ?? { startDate: null, endDate: null }); // joinDate の初期値を修正
      setPostId(attributes.pos_id ?? "");
      setDepartmentId(attributes.dep_id ?? "");
      setSectionId(attributes.section_id ?? "");
      setGroupId(attributes.group_id ?? "");
    }
  }, [loginUser]);

  const handleUpdateProfile = async () => {
    if (!loginUser) return; // loginUser が null の場合は早期リターン

    const endpoint = `api/user-saltos/${loginUser.id}`;
    const payload = {
      data: {
        email,
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
    } catch (error: unknown) {
      if (error instanceof Error) {
        alert(`更新に失敗しました: ${error.message}`);
      } else {
        alert("予期せぬエラーが発生しました。");
      }
    }
  };

  if (isLoading) {
    return <Loading />;
  }


  return (
    <TitleCard title="プロフィール" >
      <div className="w-full px-1">
        {/* ------ ユーザープロフィール ------ */}
        <UserNameInput
          firstName={firstName}
          setFirstName={setFirstName}
          lastName={lastName}
          setLastName={setLastName}
        />
        <div className="flex w-full space-x-4">
          <EmailInput email={email} />
          <JoinDateInput
            joinDate={joinDate}
            setJoinDate={setJoinDate}
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
          />
          <SectionsInput
            sectionId={sectionId}
            setSectionId={setSectionId}
          />
          <GroupsInput
            groupId={groupId}
            setGroupId={setGroupId}
          />
        </div>
        <div className="divider my-10"></div>
        {/* ------ スキルセット 目標 ------ */}
        

        <div className="absolute right-5 bottom-5">
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
