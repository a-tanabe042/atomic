import {
  faJs, // JavaScript icon
  faCss3Alt, // CSS3 icon
  faHtml5, // HTML5 icon
  //   faPython, // Python icon
  //   faPhp, // PHP icon
  //   faJava, // Java icon
} from "@fortawesome/free-brands-svg-icons";

import { faFileCode } from "@fortawesome/free-solid-svg-icons";

export const languagesData = [
  {
    language: "javascript",
    extension: "js",
    icon: faJs,
    initialCode: `
document.getElementById('myButton').addEventListener('click', function () {
  alert('Button clicked!');
});      
    `,
  },
  {
    language: "css",
    extension: "css",
    icon: faCss3Alt,
    initialCode: `
h1 {
  color: red;
}
    
button {
  background-color: gray;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}`,
  },
  {
    language: "html",
    extension: "html",
    icon: faHtml5,
    initialCode: `
<!DOCTYPE html>
<html lang="ja">

<body>
  <h1>Hello World</h1>
  <button id="myButton">Click Me</button>
</body>

</html>
    
    `,
  },
  {
    language: "sql",
    extension: "sql",
    icon: faFileCode,
    initialCode: "",
  },
  //   {
  //     language: 'typescript',
  //     extension: 'ts',
  //     icon: faFileCode,
  //     initialCode: '// TypeScript code\nconsole.log("Hello, TypeScript!");',
  //   },
  //   {
  //     language: 'json',
  //     extension: 'json',
  //     icon: faFileCode,
  //     initialCode: '{\n  "name": "John Doe",\n  "age": 30,\n  "city": "New York"\n}',
  //   },
  //   {
  //     language: 'xml',
  //     extension: 'xml',
  //     icon: faFileCode,
  //     initialCode: '<?xml version="1.0" encoding="UTF-8"?>\n<note>\n  <to>Tove</to>\n  <from>Jani</from>\n  <heading>Reminder</heading>\n  <body>Don\'t forget me this weekend!</body>\n</note>',
  //   },
  //   {
  //     language: 'php',
  //     extension: 'php',
  //     icon: faPhp,
  //     initialCode: '<?php\n  echo "Hello, World!";\n?>',
  //   },
  //   {
  //     language: 'java',
  //     extension: 'java',
  //     icon: faJava,
  //     initialCode: 'public class HelloWorld {\n    public static void main(String[] args) {\n        System.out.println("Hello, World!");\n    }\n}',
  //   },
  //   {
  //     language: 'python',
  //     extension: 'py',
  //     icon: faPython,
  //     initialCode: '# Python code\nprint("Hello, World!")',
  //   },
];

export default languagesData;
