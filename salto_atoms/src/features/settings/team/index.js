import React, { useState, useEffect } from "react";
//api request hooks
import useFetchGoogleId from "../../../hooks/useFetchGoogleId";
import useFetchUsers from "../../../hooks/useFetchUsers";
import useFetchPosts from "../../../hooks/useFetchPosts";
import useFetchDepartments from "../../../hooks/useFetchDepartments";
import useFetchSections from "../../../hooks/useFetchSections";
import useFetchGroups from "../../../hooks/useFetchGroups";
//layout components
import UserName from "../../../components/table/UserName";
import Post from "../../../components/table/Post";
import UserAffiliation from "../../../components/user/UserAffiliation";
// UI components
import TitleCard from "../../../components/Cards/TitleCard";
import Table from "../../../components/table/Table";

function Team() {
  const accessToken = localStorage.getItem("access_token");
  const googleId = useFetchGoogleId(accessToken);
  const users = useFetchUsers();
  const posts = useFetchPosts();
  const departments = useFetchDepartments();
  const sections = useFetchSections();
  const groups = useFetchGroups();
  const [loginUser, setLoginUser] = useState(null);
  const [filteredUsers, setFilteredUsers] = useState([]);

  useEffect(() => {
    const user = users.find((user) => user.attributes.google_id === googleId);
    setLoginUser(user);
  }, [googleId, users]);


  useEffect(() => {
    if (loginUser) {
      const dep_id = loginUser.attributes.dep_id;
      const usersInSameDepartment = users.filter(
        (user) => user.attributes.dep_id === dep_id
      );
      setFilteredUsers(usersInSameDepartment);
    }
  }, [loginUser, users]);

  const columns = [
    {
      header: "名前",
      render: (item) => <UserName item={item} />,
    },
    {
      header: "役職",
      render: (item) => <Post item={item} posts={posts} />,
    },
  ];

  return (
    <>
      <TitleCard title="社員名簿" topMargin="mt-2">
        {loginUser && (
          <UserAffiliation
            loginUser={loginUser}
            departments={departments}
            sections={sections}
            groups={groups}
          />
        )}
        <Table columns={columns} data={filteredUsers || []} />
      </TitleCard>
    </>
  );
}

export default Team;
