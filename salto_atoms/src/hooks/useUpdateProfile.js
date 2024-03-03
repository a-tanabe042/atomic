// import { useState, useEffect } from "react";
// import useFetchApi from "../hooks/useFetchApi";

// const useUpdateProfile = (loginUser) => {
//   const updateData = useFetchApi();
//   const [firstName, setFirstName] = useState("");
//   const [lastName, setLastName] = useState("");
//   const [email, setEmail] = useState("");
//   const [joinDate, setJoinDate] = useState({ startDate: null, endDate: null });
//   const [postId, setPostId] = useState("");
//   const [departmentId, setDepartmentId] = useState("");
//   const [sectionId, setSectionId] = useState("");
//   const [groupId, setGroupId] = useState("");
//   const [, setLoading] = useState(false);

//   useEffect(() => {
//     if (loginUser) {
//       setFirstName(loginUser.attributes.first_name || "");
//       setLastName(loginUser.attributes.last_name || "");
//       setEmail(loginUser.attributes.email || "");
//       setJoinDate(loginUser.attributes.join_date || "");
//       setPostId(loginUser.attributes.pos_id || "");
//       setDepartmentId(loginUser.attributes.dep_id || "");
//       setSectionId(loginUser.attributes.section_id || "");
//       setGroupId(loginUser.attributes.group_id || "");
//     }
//   }, [loginUser]);

//   const handleUpdateProfile = async () => {
//     setLoading(true);
//     const profileData = {
//         email: email,
//         first_name: firstName,
//         last_name: lastName,
//         join_date: joinDate,
//         pos_id: postId,
//         dep_id: departmentId,
//         section_id: sectionId,
//         group_id: groupId,
//     };

//     try {
//       const endpoint = `api/user-saltos/${loginUser.id}`;
//       await updateData(endpoint, { data: profileData });
//       alert("プロフィールが更新されました。");
//     } catch (error) {
//       alert(`更新に失敗しました: ${error.message}`);
//     } finally {
//       setLoading(false);
//     }
//   };

//   return {
//     firstName,
//     setFirstName,
//     lastName,
//     setLastName,
//     email,
//     setEmail,
//     joinDate,
//     setJoinDate,
//     postId,
//     setPostId,
//     departmentId,
//     setDepartmentId,
//     sectionId,
//     setSectionId,
//     groupId,
//     setGroupId,
//     handleUpdateProfile,
//   };
// };

// export default useUpdateProfile;