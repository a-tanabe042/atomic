export interface SidebarSection {
    id: string;
    title: string;
    description: string;
    content: string;
    isActive: boolean;
  }

 export interface User {
  attributes: {
    google_id: string;
    email: string;
    picture: string;
    deleted_flag: number;
    first_name: string | null;
    last_name: string | null;
    hd: string | null;
    pos_id: number;
    dep_id: number;
    section_id: number;
    group_id: number;
    join_date: string | null;
    div_id: number;
  };
}
  
export interface Department {
  dep_id: string;
  dep_name: string;
}

export interface Section {
  section_id: string;
  section_name: string;
}

export interface Group {
  group_id: string;
  group_name: string;
}

export interface Post {
  pos_id: string;
  pos_name: string;
}



