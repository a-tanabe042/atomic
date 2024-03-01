import React from "react";

//API request hooks
import useFetchUsers from '../../hooks/useFetchUsers';
import useFetchDepartments from '../../hooks/useFetchDepartments';
import useFetchSections from '../../hooks/useFetchSections';
import useFetchGroups from '../../hooks/useFetchGroups';
//layout components
import  User from "./components/layout/User";
import Affiliation from './components/layout/Affiliation';
// UI components
import TitleCard from "../../components/Cards/TitleCard";
import Table from "./components/Table";


function Members() {
  const users = useFetchUsers();
  const departments = useFetchDepartments();
  const sections = useFetchSections();
  const groups = useFetchGroups();


  const columns = [
    {
      header: "名前",
      render: (item) => <User item={item} />,
    },
    {
      header: '所属部署',
      render: (item) => <Affiliation item={item} departments={departments} sections={sections} groups={groups} />,
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
