import { atom ,atomFamily } from 'recoil';

export const cookieState = atomFamily({
  key: 'cookieState',
  default: null,
});
export const skillsState = atom({
  key: 'skillsState',
  default: [], 
});

export const goalsState = atom({
  key: 'goalsState',
  default: [],
});

export const selectedDepartmentState = atom({
  key: 'selectedDepartmentState', 
  default: '', 
});

export const selectedSectionState = atom({
  key: 'selectedSectionState',
  default: '',
});

export const selectedGroupState = atom({
  key: 'selectedGroupState',
  default: '',
});

export const selectedPostState = atom({
  key: 'selectedPostState',
  default: 0,
});

export const selectedDivisionState = atom({
  key: 'selectedDivisionState',
  default: 0,
});

export const isPostSelectedState = atom({
  key: 'isPostSelectedState',
  default: false,
});

export const joinDateState = atom({
  key: 'joinDateState', 
  default: null, 
});

export const tabState = atom({
  key: 'tabState', 
  default: 'myProjects', 
});

export const selectedProjectState = atom({
  key: 'selectedProjectState',
  default: null, 
});