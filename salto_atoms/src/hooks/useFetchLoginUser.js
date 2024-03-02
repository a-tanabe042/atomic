import { useState, useEffect } from 'react';
import useFetchUsers from './useFetchUsers';
import useFetchGoogleId from './useFetchGoogleId';

{/* ログインユーザーの取得 */}
const useFetchLoginUser = () => {
    const accessToken = localStorage.getItem("access_token");
    const googleId = useFetchGoogleId(accessToken);
    const users = useFetchUsers();
    const [loginUser, setLoginUser] = useState(null);

    useEffect(() => {
        const user = users.find(user => user.attributes.google_id === googleId);
        setLoginUser(user);
    }, [googleId, users]);

    return loginUser;
};

export default useFetchLoginUser;
