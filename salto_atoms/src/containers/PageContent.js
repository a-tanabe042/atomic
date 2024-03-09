import Header from "./Header";
import { Route, Routes } from "react-router-dom";
import routes from "../routes";
import Page404 from "../pages/protected/404";
import RightSidebar from "./RightSidebar";
import "../index.css";

function PageContent() {
  return (
    <div className="flex flex-col h-screen bg-base-200">
      <Header className="sticky top-0 z-10" />
      <div className="flex flex-1 overflow-hidden">
        <main className="hidden-scroll-bar flex-1 px-6 py-8 overflow-y-auto">
          <Routes>
            {routes.map((route, key) => (
              <Route
                key={key}
                exact={true}
                path={`${route.path}`}
                element={<route.component />}
              />
            ))}
            <Route path="*" element={<Page404 />} />
          </Routes>
        </main>
        <RightSidebar />
      </div>
    </div>
  );
}

export default PageContent;
