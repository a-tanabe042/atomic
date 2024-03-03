import React, { useMemo } from 'react';
//api request hooks
import useFetchLoginUser from "../../../hooks/useFetchLoginUser";
import useFilterUsers from "../../../hooks/useFilterUsers";
import useFetchPosts from "../../../hooks/useFetchPosts";
import useFetchDepartments from "../../../hooks/useFetchDepartments";
import useFetchSections from "../../../hooks/useFetchSections";
import useFetchGroups from "../../../hooks/useFetchGroups";
//layout components
import UserName from "../../../components/layout/UserName";
import Post from "../../../components/layout/Post";
import Email from "../../../components/layout/Email";
import UserAffiliation from "../../../components/layout/UserAffiliation";
// UI components
import TitleCard from "../../../components/Cards/TitleCard";
import Table from "../../../components/layout/Table";
import JoinDate from '../../../components/layout/JoinDate';

{/* 所属部署 */} 
function Team() {
  const loginUser = useFetchLoginUser(); 
  const posts = useFetchPosts();
  const departments = useFetchDepartments();
  const sections = useFetchSections();
  const groups = useFetchGroups();

  // フィルタ条件 : ログインユーザーと条件が一致したユーザー情報を取得
  const filterAffiliation = useMemo(() => loginUser ? {
    dep_id: loginUser.attributes.dep_id,
    section_id: loginUser.attributes.section_id,
    group_id: loginUser.attributes.group_id,
  } : {}, [loginUser]);

  const filterUsers = useFilterUsers(filterAffiliation);

  const columns = [
    {
      header: "名前",
      render: (item) => <UserName item={item} />,
    },
    {
      header: "Email",
      render: (item) => <Email item={item} />,
    },
    {
      header: "役職",
      render: (item) => <Post item={item} posts={posts} />,
    },
    {
      header: "入社日",
      render: (item) => <JoinDate item={item} />,
    },
  ];

  return (
    <>
      <TitleCard title="所属部署" topMargin="mt-2">
        {loginUser && (
          <UserAffiliation
            loginUser={loginUser}
            departments={departments}
            sections={sections}
            groups={groups}
          />
        )}
        <Table columns={columns} data={filterUsers || []} />
      </TitleCard>
    </>
  );
}

export default Team;
