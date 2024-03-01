import React from "react";
//API request hooks
import useFetchUsers from '../../hooks/useFetchUsers';
import useFetchDepartments from '../../hooks/useFetchDepartments';
//data components
import  User from "./components/data/User";
import Department from './components/data/Department';
// UI components
import TitleCard from "../../components/Cards/TitleCard";
import Table from "./components/Table";


function Members() {
  const users = useFetchUsers();
  const departments = useFetchDepartments();

  if (!users || !departments) return <div>Loading...</div>;

  const columns = [
    {
      header: "Name",
      render: (item) => <User item={item} />,
    },
    {
      header: 'Department',
      render: (item) => <Department dep_id={item.attributes.dep_id} departments={departments} />,
    },
  ];

  return (
    <>
      <TitleCard title="Members" topMargin="mt-2">
        <Table columns={columns} data={users || []} />
      </TitleCard>
    </>
  );
}

export default Members;
