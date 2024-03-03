import React, { useEffect } from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import { themeChange } from "theme-change";
import AuthGuard from "./app/AuthGuard";
import Layout from "./containers/Layout";
import Login from "./pages/Login";
import AuthCallback from "./app/AuthCallBack";
import ErrorPage from "./features/user/ErrorPage";

function App() {
  useEffect(() => {
    themeChange(false);
  }, []);

  return (
    <Router>
      <AuthGuard>
        <Routes>
          <Route path="/" element={<Login />} />
          <Route path="/login" element={<Login />} />
          <Route path="/app/*" element={<Layout />} />
          <Route path="/auth/callback" element={<AuthCallback />} />
          <Route path="/error" element={<ErrorPage />} />
        </Routes>
      </AuthGuard>
    </Router>
  );
}

export default App;
