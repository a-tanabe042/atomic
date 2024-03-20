import React, { useEffect, useState, useCallback } from "react";
import Loading from "../components/loading/Loading";

interface Profile {
  id: string; // id を number から string に修正してください。API の実装に応じて適宜調整してください。
  email: string;
  verified_email: boolean;
  picture: string;
  hd: string | null;
}

const AuthCallback: React.FC = () => {
  const API_HOST = process.env.REACT_APP_API_HOST as string;
  const [loading, setLoading] = useState<boolean>(true);
  const [error, setError] = useState<string>("");

  const saveProfile = useCallback(async (profile: Profile) => {
    try {
      const existingUserResponse = await fetch(
        `${API_HOST}/api/user-saltos?google_id=${profile.id}`
      );
      if (!existingUserResponse.ok) {
        throw new Error("Failed to check if user exists");
      }
      const existingUserData = await existingUserResponse.json();

      if (existingUserData && existingUserData.length > 0) {
        // 既存ユーザーの場合、プロファイルを更新
        const googleId = existingUserData[0].id;
        await fetch(
          `${API_HOST}/api/user-saltos/${googleId}`,
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
        console.log("既存ユーザーのプロファイルを更新しました。");
      } else {
        // 新規ユーザーの場合、プロファイルを登録
        await fetch(`${API_HOST}/api/user-saltos`, {
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
        });
        console.log("新規ユーザーのプロファイルを登録しました。");
      }
    } catch (error: any) {
      console.error("Error handling profile:", error.message || error);
      setError(error.message || String(error));
    }
  }, [API_HOST]);

  const fetchGoogleProfile = useCallback(async (accessToken: string) => {
    try {
      const response = await fetch(
        "https://www.googleapis.com/oauth2/v2/userinfo",
        {
          headers: {
            Authorization: `Bearer ${accessToken}`,
          },
        }
      );

      if (!response.ok) {
        throw new Error("Failed to fetch Google profile");
      }
      const profile: Profile = await response.json();
      await saveProfile(profile);
    } catch (error: any) {
      console.error("Error fetching Google profile:", error.message || error);
    }
  }, [saveProfile]);

  useEffect(() => {
    const handleLogin = async () => {
      const idToken = new URLSearchParams(window.location.search).get("id_token");
      const accessToken = new URLSearchParams(window.location.search).get("access_token");

      if (!idToken || !accessToken) {
        setError("認証情報が不足しています。");
        window.location.href = "/login";
        return;
      }

      localStorage.setItem("id_token", idToken);
      localStorage.setItem("access_token", accessToken);

      await fetchGoogleProfile(accessToken);
      // fetchGoogleProfileが完了した後にリダイレクトする
      setLoading(false);
      window.location.href = "/app/welcome";
    };

    handleLogin().catch((error) => {
      console.error("プロファイルの取得に失敗しました:", error);
      setError("プロファイルの取得に失敗しました。");
      window.location.href = "/login";
    });
  }, [fetchGoogleProfile]);

  if (loading) {
    return <Loading />;
  }
  if (error) {
    return <div>Error: {error}</div>;
  }

  return <Loading />;
};

export default AuthCallback;
