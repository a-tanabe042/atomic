export interface SidebarSectionType {
    id: string;
    title: string;
    description: string;
    content: string;
    isActive: boolean;
  }

 export interface UserType {
  attributes: {
    google_id: string;
    email: string;
    picture: string;
    deleted_flag: string;
    first_name: string | null;
    last_name: string | null;
    hd: string | null;
    pos_id: string;
    dep_id: string;
    section_id: string;
    group_id: string;
    join_date: string | null;
    div_id: string;
    [key: string]: any;
  };
}
  
export interface DepartmentType {
  dep_id: string;
  dep_name: string;
}

export interface SectionType {
  section_id: string;
  section_name: string;
}

export interface GroupType {
  group_id: string;
  group_name: string;
}

export interface PostType {
  pos_id: string;
  pos_name: string;
}



