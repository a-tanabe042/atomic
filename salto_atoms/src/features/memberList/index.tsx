import React from "react";
import useFetchUsers from '../../hooks/api/useFetchUsers';
import useFetchPosts from '../../hooks/api/useFetchPosts';
import useFetchDepartments from '../../hooks/api/useFetchDepartments';
import useFetchSections from '../../hooks/api/useFetchSections';
import useFetchGroups from '../../hooks/api/useFetchGroups';
import useLoading from '../../hooks/api/useLoading';
import UserName from "../../components/layout/UserName";
import Email from '../../components/layout/Email';
import Post from '../../components/layout/Post';
import Affiliation from '../../components/layout/Affiliation';
import JoinDate from '../../components/layout/JoinDate';
import Button from '../../components/button/Button';
import TitleCard from "../../components/cards/TitleCard";
import Table from "../../components/layout/Table";
import Loading from "../../components/loading/Loading";
// 型定義のインポート（仮定）
import { UserType, PostType, DepartmentType, SectionType, GroupType } from '../../types';

interface ColumnType {
  header: string;
  render: (item: UserType) => JSX.Element;
}

function MemberList() {
  const delay: number = parseInt(process.env.REACT_APP_LOADING_DELAY || '2000', 10); 
  const isLoading: boolean = useLoading(delay);
  const users: UserType[] = useFetchUsers();
  const posts: PostType[] = useFetchPosts();
  const departments: DepartmentType[] = useFetchDepartments();
  const sections: SectionType[] = useFetchSections();
  const groups: GroupType[] = useFetchGroups();

  const columns: ColumnType[] = [
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
      render: (item) => <Button />,
    },
  ];

  if (isLoading) {
    return <Loading />;
  }

  return (
    <>
      <TitleCard title="社員名簿">
        <Table columns={columns} data={users || []} />
      </TitleCard>
    </>
  );
}

export default MemberList;
