import React, { ElementType } from "react";
import { Route, Routes } from "react-router-dom";
import routes from "../routes"; 
import Page404 from "../pages/protected/404";
import LeftSidebar from "./LeftSidebar";
import RightSidebar from "./RightSidebar";
import Header from "./Header";

interface RouteType {
  path: string;
  component: ElementType;
}

const MainPage: React.FC = () => {
  return (
    <div className="flex flex-col h-screen">
      <Header />
      <div className="flex flex-1 overflow-hidden">
        <LeftSidebar />
        <main className="flex-1 overflow-hidden px-6 py-8">
          <Routes>
            {routes.map((route: RouteType, key: number) => (
              <Route
                key={key}
                path={route.path}
                element={React.createElement(route.component)}
              />
            ))}
            <Route path="*" element={<Page404 />} />
          </Routes>
        </main>
        <RightSidebar />
      </div>
    </div>
  );
};

export default MainPage;
