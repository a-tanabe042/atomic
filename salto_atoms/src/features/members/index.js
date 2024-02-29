import React,{useState,useEffect} from "react";
import useFetchApi from "../../hooks/useFetchApi";
import ErrorMessage from "../../components/Typography/ErrorMessage";
import TitleCard from "../../components/Cards/TitleCard";
import Table from "./components/Table";
import Name from "./components/column/Name";
import Department from "./components/user/Department";

function Members() {
  const { data, loading, error } = useFetchApi([
    { endpoint: "api/user-saltos", queryCondition: {} },
    { endpoint: "api/departments", queryCondition: {} },
  ]);

  const [departments, setDepartments] = useState([]);

  useEffect(() => {
    if (data && data["api/departments"]) {
      const transformedDepartments = data["api/departments"].data.reduce((acc, {attributes}) => {
        acc[attributes.dep_id] = attributes.dep_name;
        return acc;
      }, {});
      setDepartments(transformedDepartments);
    }
  }, [data]);
  
  

  const columns = [
    {
      header: "Name",
      render: (item) => <Name item={item} />,
    },
    {
      header: "Department",
      render: (item) => <Department dep_Id={item.dep_Id} departments={departments}/>
    },
  ];

  if (loading) return <div>Loading...</div>;
  if (error) return <ErrorMessage message={error} />;

  return (
    <>
      <TitleCard title="Members" topMargin="mt-2">
        <Table columns={columns} data={data["api/user-saltos"]?.data || []} />
      </TitleCard>
    </>
  );
}

export default Members;
