import React, { useMemo } from 'react';
//api request hooks
import useFetchLoginUser from "../../hooks/useFetchLoginUser";
import useFilterUsers from "../../hooks/useFilterUsers";
import useFetchPosts from "../../hooks/useFetchPosts";
import useFetchDepartments from "../../hooks/useFetchDepartments";
import useFetchSections from "../../hooks/useFetchSections";
import useFetchGroups from "../../hooks/useFetchGroups";
import useLoading from '../../hooks/useLoading';
//layout components
import UserName from "../../components/layout/UserName";
import Post from "../../components/layout/Post";
import Email from "../../components/layout/Email";
import UserAffiliation from "../../components/layout/UserAffiliation";
import Button from "../../components/button/Button";
// UI components
import TitleCard from "../../components/cards/TitleCard";
import Table from "../../components/layout/Table";
import JoinDate from '../../components/layout/JoinDate';
//loading component
import Loading from "../../components/loading/Loading";

/* 所属部署 */
function Affiliation() {
  const delay = parseInt(process.env.REACT_APP_LOADING_DELAY, 10) || 2000; 
  const isLoading = useLoading(delay);
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
      header: "メールアドレス",
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
    {
      header: "プロフィール",
      render: (item) => <Button item={item} />,
    },
  ];

  if (isLoading) {
    return <Loading />;
  }





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

export default Affiliation;
