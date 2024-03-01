import React, { lazy, useEffect } from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import { themeChange } from "theme-change";
import AuthGuard from "./app/AuthGuard";

const Layout = lazy(() => import("./containers/Layout"));
const Login = lazy(() => import("./pages/Login"));
const AuthCallback = lazy(() => import("./AuthCallBack"));
const ErrorPage = lazy(()=> import("./features/user/ErrorPage"));

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
          <Route path="/oauth/callback" element={<AuthCallback />} />
          <Route path="/error" element={<ErrorPage />} />
        </Routes>
      </AuthGuard>
    </Router>
  );
}

export default App;
