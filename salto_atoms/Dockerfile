# ステージ1: ビルド用のベースイメージ
FROM node:18

# アプリケーションのディレクトリを設定
WORKDIR /app

# 依存関係のファイルをコピー
COPY package.json ./

# 依存関係のインストール
RUN npm install

# アプリケーションのソースコードをコピー
COPY . .

# アプリケーションのビルド
RUN npm run build

# アプリケーションの開始
CMD ["npm", "start"]

# ポートの公開
EXPOSE 3000