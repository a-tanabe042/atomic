import React from "react";
//api request hooks
import useFetchUsers from '../../hooks/useFetchUsers';
import useFetchPosts from '../../hooks/useFetchPosts';
import useFetchDepartments from '../../hooks/useFetchDepartments';
import useFetchSections from '../../hooks/useFetchSections';
import useFetchGroups from '../../hooks/useFetchGroups';
import useLoading from '../../hooks/useLoading';
//layout components
import UserName from "../../components/layout/UserName";
import Email from '../../components/layout/Email';
import Post from '../../components/layout/Post';
import Affiliation from '../../components/layout/Affiliation';
import JoinDate from '../../components/layout/JoinDate';
import Button from '../../components/button/Button';
// UI components
import TitleCard from "../../components/cards/TitleCard";
import Table from "../../components/layout/Table";
//loading component
import Loading from "../../components/loading/Loading";

/* 社員名簿 */
function MemberList() {
  const delay = parseInt(process.env.REACT_APP_LOADING_DELAY, 10) || 2000; 
  const isLoading = useLoading(delay);
  const users = useFetchUsers();
  const posts = useFetchPosts();
  const departments = useFetchDepartments();
  const sections = useFetchSections();
  const groups = useFetchGroups();

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
      header: '役職',
      render: (item) => <Post item={item} posts={posts} />,
    },
    {
      header: '所属部署',
      render: (item) => <Affiliation item={item} departments={departments} sections={sections} groups={groups} />,
    },
    {
      header: '入社日',
      render: (item) => <JoinDate item={item} />,
    },
    {
      header: 'プロフィール',
      render: (item) => <Button item={item} />,
    },
  ];


  if (isLoading) {
    return <Loading />;
  }


  return (
    <>
      <TitleCard title="社員名簿" topMargin="mt-2">
        <Table columns={columns} data={users || []} />
      </TitleCard>
    </>
  );
}

export default MemberList;
