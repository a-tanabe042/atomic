import React, { useState, useEffect } from "react";
import { useRecoilState } from "recoil";
import {
  goalsState,
  skillsState,
  selectedPostState,
  selectedDivisionState,
  selectedDepartmentState,
  selectedSectionState,
  selectedGroupState,
  joinDateState,
} from "../../../state";
import TitleCard from "../../../components/Cards/TitleCard";
import useGoogleProfile from "../../../hooks/useGoogleProfile";
import useStrapi from "../../../hooks/useStrapi";
import Organization from "./Organization";
import Category from "./Category";
import Post from "./Post.js";
import JoinDate from "./JoinDate";
import LoadingModal from "../../user/LoadingModal";

const ProfileSettings = () => {
  const [itemId, setItemId] = useState(null);
  const [email, setEmail] = useState("");
  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [selectedPost, setSelectedPost] = useRecoilState(selectedPostState);
  const [selectedDivision, setSelectedDivision] = useRecoilState(selectedDivisionState);
  const [selectedDepartment, setSelectedDepartment] = useRecoilState(selectedDepartmentState);
  const [selectedSection, setSelectedSection] =useRecoilState(selectedSectionState);
  const [selectedGroup, setSelectedGroup] = useRecoilState(selectedGroupState);
  const [joinDate, setJoinDate] = useRecoilState(joinDateState);
  const [goals, setGoals] = useRecoilState(goalsState);
  const [skills, setSkills] = useRecoilState(skillsState);
  const [showModal, setShowModal] = useState(true);

  const [, setResponse] = useState("");

  const accessToken = localStorage.getItem("access_token");
  const googleId = useGoogleProfile(accessToken);
  const {data: membersData,loading: membersLoading,updateData} = useStrapi("user-saltos", {});

  // データの取得
  useEffect(() => {
    if (membersLoading) {
      // ローディング中はモーダルを表示
      setShowModal(true);
      setShowModal(false);
    }
    if (membersData && Array.isArray(membersData.data)) {
      const user = membersData.data.find((u) => u.attributes.google_id === googleId);
      if (user) {
        setItemId(user.id);
        setEmail(user.attributes.email || "");
        setFirstName(user.attributes.first_name || "");
        setLastName(user.attributes.last_name || "");
        setGoals(user.attributes.goals || []);
        setSkills(user.attributes.skills || []);
        setSelectedPost(user.attributes.pos_id || 0);
        setSelectedDivision(user.attributes.div_id || 0);
        setSelectedDepartment(user.attributes.dep_id || 0);
        setSelectedSection(user.attributes.section_id || 0);
        setSelectedGroup(user.attributes.group_id || 0);
        setJoinDate(user.attributes.join_date || []);
      }
    }
  }, [membersData, googleId]);

  // データ更新関数
  const handleUpdate = async () => {
    if (!itemId) {
      console.error("No user ID available for update.");
      return;
    }
    try {
      const updatedUser = {
        email: email,
        first_name: firstName,
        last_name: lastName,
        goals: goals,
        skills: skills,
        pos_id: selectedPost,
        div_id: selectedDivision,
        dep_id: selectedDepartment,
        section_id: selectedSection,
        group_id: selectedGroup,
        join_date: joinDate,
      };
      const result = await updateData(itemId, updatedUser);
      setResponse(JSON.stringify(result, null, 2));      
    } catch (error) {
      console.error(error);
    }
  };

  if (showModal) {
    return <LoadingModal />;
  }

  return (
    <TitleCard title="Profile" topMargin="mt-2">
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label className="label" htmlFor="firstName">
            性
          </label>
          <input
            type="text"
            id="firstName"
            value={firstName}
            className="input input-bordered  w-full border border-gray-300  rounded-lg bg-slate-100 text-black"
            onChange={(e) => setFirstName(e.target.value)}
            placeholder="First Name"
          />
        </div>
        <div>
          <label className="label" htmlFor="lastName">
            名
          </label>
          <input
            type="text"
            id="lastName"
            value={lastName}
            className="input input-bordered  w-full border border-gray-300  rounded-lg bg-slate-100 text-black"
            onChange={(e) => setLastName(e.target.value)}
            placeholder="Last Name"
          />
        </div>
        <div>
          <label className="label" htmlFor="email">
            Email
          </label>
          <input
            type="text"
            id="email"
            value={email}
            className="input input-bordered  w-full border border-gray-300  rounded-lg bg-slate-100 text-black"
            onChange={(e) => setEmail(e.target.value)}
            placeholder="Email"
            readOnly
          />
        </div>
      </div>
      <div className="divider my-10"></div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div>
          <Post />
        </div>
        <div>
          <label className="label" htmlFor="JoinDate">
            入社日
          </label>
          <JoinDate />
        </div>
      </div>
      <div className="mt-6">
        <Organization />
      </div>
      <div className="divider my-10"></div>
      <div>
        <Category />
      </div>

      <div className="mt-16">
        <button className="btn btn-primary float-right" onClick={handleUpdate}>
          更新する
        </button>
      </div>
    </TitleCard>
  );
};

export default ProfileSettings;
