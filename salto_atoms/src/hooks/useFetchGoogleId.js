import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";

const useFetchGoogleId = (accessToken) => {
  const [googleId, setGoogleId] = useState("");
  const navigate = useNavigate();

  useEffect(() => {
    let isLoading = true; 

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
        if (isLoading) setGoogleId(profile.id);
      } catch (error) {
        console.error("Error fetching Google profile:", error);
        navigate('/error');
      }
    };
    fetchGoogleProfile();
    return () => {
      isLoading = false; 
    };
  }, [accessToken, navigate]);
  return googleId;
};

export default useFetchGoogleId;
