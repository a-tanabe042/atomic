import { atom, atomFamily } from 'recoil';

// エディター関連の状態
//DB
export const tabsState = atom({
  key: 'tabsState',
  default: [],
});

//DB
export const currentSqlQueryState = atom({
  key: 'currentSqlQueryState',
  default: '',
});

//DB
export const sqlTabContentState = atom({
  key: 'sqlTabContentState',
  default: '',
});

//DB
export const iframeContentState = atom({
  key: 'iframeContentState',
  default: '',
});

// UI表示制御関連の状態
export const mainDisplayAreaState = atom({
  key: 'MainDisplayAreaState',
  default: 'flex flex-1 overflow-auto'
});

export const displayModeState = atom({
  key: 'displayModeState',
  default: 5,
});

export const isConsoleVisibleState = atom({
  key: 'isConsoleVisibleState',
  default: true
});

export const isSidebarVisibleState = atom({
  key: 'isSidebarVisibleState',
  default: true
});

export const isSqlTableVisibleState = atom({
  key: 'isSqlTableVisibleState',
  default: false,
});

export const showModalState = atom({
  key: 'showModalState',
  default: false,
});

// 問題・回答関連の状態
//DB
export const problemsState = atom({
  key: 'problemsState',
  default: [],
});

//DB
export const currentProblemIndexState = atom({
  key: 'currentProblemIndexState',
  default: 0,
});

//DB
export const answerState = atom({
  key: 'answerState',
  default: null,
});

// チュートリアルステップ関連の状態
//DB
export const howToStepsState = atom({
  key: 'howToStepsState',
  default: {},
});

// クッキー関連の状態
export const cookieState = atomFamily({
  key: 'cookieState',
  default: null,
});
