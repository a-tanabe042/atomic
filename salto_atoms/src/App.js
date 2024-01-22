import React, { lazy, useEffect } from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import { themeChange } from "theme-change";
import "./App.css";
import initializeApp from "./app/init";
import AuthGuard from "./app/AuthGuard";

// Lazy-loaded components
const Layout = lazy(() => import("./containers/Layout"));
const Login = lazy(() => import("./pages/Login"));
// const ForgotPassword = lazy(() => import('./pages/ForgotPassword'));
// const Register = lazy(() => import('./pages/Register'));
const Documentation = lazy(() => import("./pages/Documentation"));
const OAuthCallback = lazy(() => import("./OAuthCallBack"));

const ErrorPage = lazy(()=> import("./features/user/ErrorPage")); // Adjust the import path as needed


initializeApp();

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
          <Route path="/documentation" element={<Documentation />} />
          <Route path="/app/*" element={<Layout />} />
          <Route path="/oauth/callback" element={<OAuthCallback />} />
          <Route path="/error" element={<ErrorPage />} />

          {/*GoogleLoginのみ実装のため不要*/}
          {/* <Route path="/forgot-password" element={<ForgotPassword />} /> */}
          {/* <Route path="/register" element={<Register />} /> */}
        </Routes>
      </AuthGuard>
    </Router>
  );
}

export default App;
