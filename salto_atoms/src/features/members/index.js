import React from "react";
//api request hooks
import useFetchUsers from '../../hooks/useFetchUsers';
import useFetchPosts from '../../hooks/useFetchPosts';
import useFetchDepartments from '../../hooks/useFetchDepartments';
import useFetchSections from '../../hooks/useFetchSections';
import useFetchGroups from '../../hooks/useFetchGroups';
//layout components
import UserName from "../../components/layout/UserName";
import Email from '../../components/layout/Email';
import Post from '../../components/layout/Post';
import Affiliation from '../../components/layout/Affiliation';
import JoinDate from '../../components/layout/JoinDate';
// UI components
import TitleCard from "../../components/Cards/TitleCard";
import Table from "../../components/layout/Table";

{/* 社員名簿 */} 
function Members() {
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
  ];

  return (
    <>
      <TitleCard title="社員名簿" topMargin="mt-2">
        <Table columns={columns} data={users || []} />
      </TitleCard>
    </>
  );
}

export default Members;
