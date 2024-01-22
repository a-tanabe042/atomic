import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";

const useGoogleProfile = (accessToken) => {
  const [googleId, setGoogleId] = useState("");
  const navigate = useNavigate();

  useEffect(() => {
    let isMounted = true; // マウント状態を追跡

    const fetchGoogleProfile = async () => {
      if (!accessToken) return;

      try {
        const response = await fetch("https://www.googleapis.com/oauth2/v2/userinfo", {
          headers: { Authorization: `Bearer ${accessToken}` },
        });

        if (!response.ok) {
          throw new Error("Failed to fetch Google profile");
        }

        const profile = await response.json();
        if (isMounted) setGoogleId(profile.id);
      } catch (error) {
        console.error("Error fetching Google profile:", error);
        navigate('/error');
      }
    };

    fetchGoogleProfile();

    return () => {
      isMounted = false; // コンポーネントがアンマウントされたらフラグをfalseに
    };
  }, [accessToken, navigate]);

  return googleId;
};

export default useGoogleProfile;
