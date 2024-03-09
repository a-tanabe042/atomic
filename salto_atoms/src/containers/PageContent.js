import Header from "./Header";
import {  Route, Routes } from "react-router-dom";
import routes from "../routes";
import  Page404  from "../pages/protected/404";

/* header, main */
function PageContent() {

  return (
    <div className="drawer-content flex flex-col ">
      <Header />
      <main
        className="flex-1 overflow-y-auto pt-8 px-6  bg-base-200"
      >
          <Routes>
            {routes.map((route, key) => {
              return (
                <Route
                  key={key}
                  exact={true}
                  path={`${route.path}`}
                  element={<route.component />}
                />
              );
            })}
            <Route path="*" element={<Page404 />} />
          </Routes>
        <div className="h-16"></div>
      </main>
    </div>
  );
}

export default PageContent;
