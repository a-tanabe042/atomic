import Subtitle from "../Typography/Subtitle";

function TitleCard({ title, children, topMargin, topSideButtons }) {
  return (
    <div className={"card w-full p-6 bg-base-100 shadow-xl " + (topMargin || "mt-6")}>

      {/* Title for Card */}
      <Subtitle styleClass={topSideButtons ? "inline-block" : ""}>
        {title}
        {topSideButtons && <div className="inline-block float-right">{topSideButtons}</div>}
      </Subtitle>
      
      <div className="divider mt-2"></div>
  
      <div className='h-full w-full pb-6 bg-base-100'>
        {children}
      </div>
    </div>
  );
}

export default TitleCard;
