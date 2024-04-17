import React, { useMemo } from 'react';
import useFetchLoginUser from "../../hooks/api/useFetchLoginUser";
import useFilterUsers from "../../hooks/api/useFilterUsers";
import useFetchPosts from "../../hooks/api/useFetchPosts";
import useFetchDepartments from "../../hooks/api/useFetchDepartments";
import useFetchSections from "../../hooks/api/useFetchSections";
import useFetchGroups from "../../hooks/api/useFetchGroups";
import useLoading from '../../hooks/api/useLoading';
import UserName from "../../components/layout/UserName";
import Post from "../../components/layout/Post";
import Email from "../../components/layout/Email";
import UserAffiliation from "../../components/layout/UserAffiliation";
import Button from "../../components/button/Button";
import TitleCard from "../../components/cards/TitleCard";
import Table from "../../components/layout/Table";
import JoinDate from '../../components/layout/JoinDate';
import Loading from "../../components/loading/Loading";
// 型定義のインポート
import { UserType, PostType, DepartmentType, SectionType, GroupType } from '../../types';

interface FilterCriteriaType {
  dep_id?: string;
  section_id?: string;
  group_id?: string;
}

interface ColumnType {
  header: string;
  render: (item: UserType) => JSX.Element;
}

function Affiliation() {
  const delay: number = parseInt(process.env.REACT_APP_LOADING_DELAY || '2000', 10);
  const isLoading: boolean = useLoading(delay);
  const loginUser: UserType | null = useFetchLoginUser(); 
  const posts: PostType[] = useFetchPosts();
  const departments: DepartmentType[] = useFetchDepartments();
  const sections: SectionType[] = useFetchSections();
  const groups: GroupType[] = useFetchGroups();

  const filterAffiliation: FilterCriteriaType = useMemo(() => loginUser ? {
    dep_id: loginUser.attributes.dep_id,
    section_id: loginUser.attributes.section_id,
    group_id: loginUser.attributes.group_id,
  } : {}, [loginUser]);

  const filteredUsers: UserType[] = useFilterUsers(filterAffiliation);

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
      header: '入社日',
      render: (item) => <JoinDate item={item} />,
    },
    {
      header: 'プロフィール',
      render: () => <Button />,
    },
  ];

  if (isLoading) {
    return <Loading />;
  }

  return (
    <>
      <TitleCard title="所属部署">
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

export default Affiliation;
