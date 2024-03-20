import { useState, useEffect } from 'react';
import useFetchUsers from './useFetchUsers';
import useFetchGoogleId from './useFetchGoogleId';
import { UserType } from '../../types'; // User型を適切な場所からインポート

// ログインユーザーの取得
const useFetchLoginUser = () => {
  const accessToken = localStorage.getItem("access_token") || ''; // accessTokenがnullの場合を考慮
  const googleId = useFetchGoogleId(accessToken);
  const users = useFetchUsers();
  const [loginUser, setLoginUser] = useState<UserType | null>(null);

  useEffect(() => {
    const user = users.find((user:UserType) => user.attributes.google_id === googleId);
    setLoginUser(user || null);
  }, [googleId, users]);

  return loginUser;
};

export default useFetchLoginUser;

