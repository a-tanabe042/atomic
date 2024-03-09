import PageContent from "./PageContent"
import LeftSidebar from "./LeftSidebar"

/* PageContent→ header,main */
function Layout(){
    return(
      <>
        <div className="drawer drawer-mobile">
            <input id="left-sidebar-drawer" type="checkbox" className="drawer-toggle" />
            <PageContent/>
            <LeftSidebar />
        </div>
      </>
    )
}

export default Layout