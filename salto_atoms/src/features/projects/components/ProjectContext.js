import React from 'react';
import { DocumentTextIcon, LinkIcon } from '@heroicons/react/24/outline';
import githubMark from '../../../assets/img/github-mark.png'; // 正しいパスに変更してください



const ProjectContext = () => {
    const projectDetails = {
        title: "社内研修アプリの作成",
        badge: "個人開発",
        description: "このプロジェクトでは、社内研修のためのアプリケーションを開発します。",
        master: "田邉太郎",
        members: ["山田太郎", "佐藤花子", "鈴木一郎"],
        files: [
            { type: "pdf", name: "要件定義書.pdf", url: "https://example.com/file1.pdf" },
            { type: "excel", name: "画面定義書.xlsx", url: "https://example.com/file2.xlsx" },
            { type: "image", name: "プロジェクトイメージ.jpg", url: "https://example.com/image.jpg" }
        ],
        links: [
            { type: "url", url: "https://example.com" },
            { type: "git", url: "https://github.com/example/project" }
        ]
    };

    const getFileIcon = (type) => {
        switch(type) {
            case 'pdf': return <DocumentTextIcon className="h-5 w-5 inline-block" />;
            case 'excel': return <DocumentTextIcon className="h-5 w-5 inline-block" />;
            case 'image': return <DocumentTextIcon className="h-5 w-5 inline-block" />;
            default: return null;
        }
    };

    return (
        <div className="card bg-base-100 shadow-xl">
            <div className="card-body">
                <h2 className="card-title">{projectDetails.title}</h2>
                <span className={`badge badge-${projectDetails.badge === "個人開発" ? "success" : "info"}`}>{projectDetails.badge}</span>
                <p>{projectDetails.description}</p>
                <div className="divider"></div>
                <h3>管理者</h3>
                <ul>
                    <li className="badge badge-secondary mr-1">{projectDetails.master}</li>
                </ul>
                <h3>チームメンバー</h3>
                <ul>
                    {projectDetails.members.map((member, index) => (
                        <li key={index} className="badge badge-secondary mr-1">{member}</li>
                    ))}
                </ul>
                <div className="divider"></div>
                <div className="flex flex-wrap justify-between">
                    <div>
                        <h3>証跡</h3>
                        <ul className="list-disc pl-5 mt-2">
                            {projectDetails.files.map((file, index) => (
                                <li key={index} className="flex items-center mb-2">
                                    {getFileIcon(file.type)}
                                    <a href={file.url} target="_blank" rel="noopener noreferrer" className="ml-2">
                                        {file.name}
                                    </a>
                                </li>
                            ))}
                        </ul>
                    </div>
                    <div>
                        <h3>リンク</h3>
                        <ul className="list-disc pl-5">
                            {projectDetails.links.map((link, index) => (
                                <li key={index} className="flex items-center mb-2">
                                    <a href={link.url} target="_blank" rel="noopener noreferrer" className="flex items-center">
                                        {link.type === "url" ? <LinkIcon className="h-5 w-5 mt-2" /> : <img src={githubMark} alt="GitHub" className="h-5 w-5 bg-white rounded-full mt-2" />}
                                    </a>
                                </li>
                            ))}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ProjectContext;
