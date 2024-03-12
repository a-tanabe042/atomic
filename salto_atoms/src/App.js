import React, { useEffect } from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import { themeChange } from "theme-change";
import SquareBackgroundAnimation from "./components/SquareBackgroundAnimation";
import AuthGuard from "./app/AuthGuard";
import Login from "./pages/Login";
import AuthCallback from "./app/AuthCallBack";
import ErrorPage from "./features/user/ErrorPage";
import MainPage from "./containers/MainPage";

function App() {
  useEffect(() => {
    themeChange(false);
  }, []);

  return (
    <Router>
      <AuthGuard>
        <SquareBackgroundAnimation>
          <Routes>
            <Route path="/" element={<Login />} />
            <Route path="/login" element={<Login />} />
            <Route path="/app/*" element={<MainPage />} />
            <Route path="/auth/callback" element={<AuthCallback />} />
            <Route path="/error" element={<ErrorPage />} />
          </Routes>
        </SquareBackgroundAnimation>
      </AuthGuard>
    </Router>
  );
}

export default App;
