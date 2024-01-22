import { atom ,atomFamily } from 'recoil';

// クッキー関連の状態
export const cookieState = atomFamily({
  key: 'cookieState',
  default: null,
});
export const skillsState = atom({
  key: 'skillsState', // unique ID (with respect to other atoms/selectors)
  default: [], // default value (aka initial value)
});

export const goalsState = atom({
  key: 'goalsState',
  default: [],
});

export const selectedDepartmentState = atom({
  key: 'selectedDepartmentState', // unique key
  default: '', // default value
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
  key: 'joinDateState', // 一意のID
  default: null, // 初期値
});

export const tabState = atom({
  key: 'tabState', // ユニークなキー
  default: 'myProjects', // デフォルト値
});

export const selectedProjectState = atom({
  key: 'selectedProjectState',
  default: null, // 初期値はnullまたは最初のプロジェクトのID
});