export interface Section {
    id: string;
    title: string;
    isActive: boolean;
  }

 export interface LoginUser {
  attributes: {
    google_id: string;
    email: string;
    picture: string;
    deleted_flag: number;
    first_name: string | null;
    last_name: string | null;
    verified_email: string;
    hd: string | null;
    pos_id: number;
    skills: string | null;
    goals: string | null;
    dep_id: number;
    section_id: number;
    group_id: number;
    join_date: string | null;
    div_id: number;
    createdAt: string;
    updatedAt: string;
    publishedAt: string;
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



