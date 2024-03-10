import { atom } from 'recoil';

export const loadingState = atom({
  key: 'loadingState', 
  default: false, 
});

export const errorState = atom({
    key: 'errorState', 
    default: null, 
  });

  export const sectionState = atom({
    key: 'sectionState', 
    default: [] 
  });