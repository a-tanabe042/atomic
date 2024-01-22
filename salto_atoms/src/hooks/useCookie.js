import { useState, useEffect } from "react";
import { useSetRecoilState } from "recoil";
import { cookieState } from "../state"; // Recoilの状態をインポートします。

// Reactアプリケーションでクッキーを管理するためのカスタムフック `useCookie` です。
export const useCookie = (name, initialValue) => {
  // クッキーの状態管理のためのRecoilの状態設定関数。
  const setRecoilCookie = useSetRecoilState(cookieState(name));

  // クッキーの値を保存するためのStateフック。
  // 初期状態は保存されたクッキーの値か、それがなければ初期値になります。
  const [value, setValue] = useState(() => {
    const savedValue = getCookie(name);
    return savedValue !== null ? savedValue : initialValue;
  });

  // 値が変更されるたびにクッキーを設定し、Recoilの状態も更新します。
  useEffect(() => {
    setCookie(name, value, 7); // 7日間のクッキーを設定します。
    setRecoilCookie(value);
  }, [value, name, setRecoilCookie]);

  // 現在のクッキーの値と、その値を設定する関数を返します。
  return [value, setValue];
};

// クッキーを設定するための関数。
const setCookie = (name, value, days) => {
  const d = new Date();
  d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
  const expires = "expires=" + d.toUTCString();
  document.cookie = name + "=" + value + ";" + expires + ";path=/";
};

// クッキーを取得するための関数。
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
