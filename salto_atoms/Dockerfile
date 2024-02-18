# ベースイメージ
FROM node:18

# 作業ディレクトリを設定
WORKDIR /app

# 依存関係のファイルをコピー
COPY package.json package-lock.json ./

# 依存関係のインストール
RUN npm install

# アプリケーションのソースコードをコピー
COPY . .

# 環境変数を設定
ENV NODE_ENV=development

# 開発サーバーを起動
EXPOSE 3000
CMD ["npm", "start"]
