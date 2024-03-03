import { useState, useEffect } from "react";
import { useSetRecoilState } from "recoil";
import { cookieState } from "../state"; 

/* クッキーの取得*/
export const useCookie = (name, initialValue) => {
  const setRecoilCookie = useSetRecoilState(cookieState(name));
  const [value, setValue] = useState(() => {
    const savedValue = getCookie(name);
    return savedValue !== null ? savedValue : initialValue;
  });

  useEffect(() => {
    setCookie(name, value, 7); 
    setRecoilCookie(value);
  }, [value, name, setRecoilCookie]);
  return [value, setValue];
};

const setCookie = (name, value, days) => {
  const d = new Date();
  d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
  const expires = "expires=" + d.toUTCString();
  document.cookie = name + "=" + value + ";" + expires + ";path=/";
};

const getCookie = (name) => {
  const nameEQ = name + "=";
  const ca = document.cookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) === " ") c = c.substring(1);
    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
};
