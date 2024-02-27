function GettingStartedContent() {
  return (
    <>
      <article className="prose">
        <h1 className="">Project Architecture</h1>
        <h2 id="getstarted1">Frontend</h2>
        <ul>
          <li>React</li>
          <li>Tailwind CSS</li>
          <li>DaisyUI</li>
        </ul>
        <h2>Backend</h2>
        <ul>
          <li>Strapi</li>
        </ul>
        <h2>インフラストラクチャ</h2>
        <ul>
          <li>AWS EC2</li>
          <li>Docker</li>
          <li>Nginx</li>
        </ul>
        <h2>CI/CD</h2>
        <ul>
          <li>Jenkins</li>
        </ul>
        <h2>バージョン管理</h2>
        <ul>
          <li>GitHub</li>
        </ul>

        {/* How to Use */}
        <h2 id="getstarted2">How to use?</h2>
        <p>Profileの設定をおねがいします。</p>
      </article>
      <p className="pt-20"></p>
    </>
  );
}

export default GettingStartedContent;
