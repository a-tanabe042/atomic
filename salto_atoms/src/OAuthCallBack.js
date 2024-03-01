import React, { useEffect, useState } from "react";

function OAuthCallback() {
  const API_HOST = process.env.REACT_APP_API_HOST;
  const [loading, setLoading] = useState(true); 
  const [error, setError] = useState(""); 

  useEffect(() => {
    const handleLogin = async () => {
      setLoading(true);
      const idToken = new URLSearchParams(window.location.search).get(
        "id_token"
      );
      const accessToken = new URLSearchParams(window.location.search).get(
        "access_token"
      );

      if (idToken && accessToken) {
        localStorage.setItem("id_token", idToken);
        localStorage.setItem("access_token", accessToken);

        try {
          await fetchGoogleProfile(accessToken);
          window.location.href = "/app/welcome";
        } catch (err) {
          setError("プロフィールの取得に失敗しました。");
          window.location.href = "/login";
        }
      } else {
        setError("認証情報が不足しています。");
        window.location.href = "/login";
      }

      setLoading(false);
    };

    handleLogin();
  }, []);

  const fetchGoogleProfile = async (accessToken) => {
    try {
      const response = await fetch(
        "https://www.googleapis.com/oauth2/v2/userinfo",
        {
          headers: {
            Authorization: `Bearer ${accessToken}`,
          },
        }
      );

      if (response.ok) {
        const profile = await response.json();
        console.log("Google Profile:", profile);
        await saveProfile(profile);
      } else {
        throw new Error("Failed to fetch Google profile");
      }
    } catch (error) {
      console.error("Error fetching Google profile:", error);
    }
  };

  const saveProfile = async (profile) => {
    try {
      // 1. ユーザーの存在チェック
      const existingUserResponse = await fetch(
        `${API_HOST}/api/user-saltos?google_id=${profile.id}`
      );
      if (!existingUserResponse.ok) {
        throw new Error("Failed to check if user exists");
      }
      const existingUserData = await existingUserResponse.json();

      // 2. プロフィール情報の更新（ユーザーが存在する場合）
      if (existingUserData && existingUserData.length > 0) {
        const userId = existingUserData[0].id;
        const updateResponse = await fetch(
          `${API_HOST}/api/user-saltos/${userId}`,
          {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              data: {
                email: profile.email,
                verified_email: profile.verified_email.toString(),
                picture: profile.picture,
                hd: profile.hd,
              },
            }),
          }
        );

        if (!updateResponse.ok) {
          const errorData = await updateResponse.json();
          console.error("Error updating profile in Strapi:", errorData);
          throw new Error("Failed to update profile in Strapi");
        }
      } else {
        // 3. 新しいユーザーの場合の処理
        try {
          const response = await fetch(
            `${API_HOST}/api/user-saltos`,
            {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({
                data: {
                  google_id: profile.id,
                  email: profile.email,
                  verified_email: profile.verified_email.toString(),
                  picture: profile.picture,
                  hd: profile.hd,
                },
              }),
            }
          );

          if (!response.ok) {
            const errorData = await response.json();
            console.error("Error saving profile to Strapi:", errorData);
            throw new Error("Failed to save profile to Strapi");
          }

          const data = await response.json();
          console.log("Profile saved to Strapi:", data);
        } catch (error) {
          console.error("Error saving profile to Strapi:", error);
        }
      }
    } catch (error) {
      console.error("Error handling profile in Strapi:", error);
    }
  };

  if (loading) {
    return <div>Loading...</div>; // ローディング表示
  }

  if (error) {
    return <div>Error: {error}</div>; // エラー表示
  }

  return <div>Loading...</div>;
}

export default OAuthCallback;
