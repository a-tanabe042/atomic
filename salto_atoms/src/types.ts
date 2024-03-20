export interface Section {
    id: string;
    title: string;
    isActive: boolean;
  }
  
export interface LoginUser {
  attributes: {
    google_id: string;
    picture?: string;
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



