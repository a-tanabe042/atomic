import useFetchApi from "../hooks/useFetchApi";

const useUpdateProfile = (loginUser) => {
  const updateData = useFetchApi();

  const handleUpdateProfile = async () => {
    setLoading(true);
    const profileData = {
        first_name: firstName,
        last_name: lastName,
        email: email,
        join_date: joinDate,
        pos_id: postId,
        dep_id: departmentId,
        section_id: sectionId,
        group_id: groupId,
    };

    try {
      const endpoint = `api/user-saltos/${loginUser.id}`;
      await updateData(endpoint, { data: profileData });
      alert("プロフィールが更新されました。");
    } catch (error) {
      alert(`更新に失敗しました: ${error.message}`);
    } finally {
      setLoading(false);
    }
  };

  return {
    firstName,
    setFirstName,
    lastName,
    setLastName,
    email,
    setEmail,
    joinDate,
    setJoinDate,
    postId,
    setPostId,
    departmentId,
    setDepartmentId,
    sectionId,
    setSectionId,
    groupId,
    setGroupId,
    handleUpdateProfile,
  };
};

export default useUpdateProfile;