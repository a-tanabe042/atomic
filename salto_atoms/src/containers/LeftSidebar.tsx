import SidebarSectionNav from "../components/nav/SidebarSectionNav";

const LeftSidebar: React.FC = () => {
  return (
    <div className="w-40 bg-base-100 my-8 shadow-xl rounded-2xl opacity-80">
      <SidebarSectionNav />
    </div>
  );
};

export default LeftSidebar;
