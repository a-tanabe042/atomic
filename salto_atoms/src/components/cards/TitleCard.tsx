import React, { ReactNode } from "react";
import Subtitle from "../typography/Subtitle";
import "../../index.css";

interface TitleCardProps {
  title: string | ReactNode; 
  children?: ReactNode; 
  topMargin?: string; 
  topSideButtons?: ReactNode; 
}

const TitleCard: React.FC<TitleCardProps> = ({ title, children, topMargin = "", topSideButtons }) => {
  return (
    <div className={`card w-full h-full p-6 bg-base-100 shadow-xl ${topMargin}`}>
      <Subtitle styleClass={`${topSideButtons ? "inline-block" : ""}`}>
        {title}
        {topSideButtons && (
          <div className="inline-block float-right">{topSideButtons}</div>
        )}
      </Subtitle>

      <div className="divider mt-2"></div>

      <div className="hidden-scroll-bar overflow-y-auto h-full w-full pb-6">
        <div className="overflow-y-auto overflow-x-hidden">{children}</div>
      </div>
    </div>
  );
}

export default TitleCard;
