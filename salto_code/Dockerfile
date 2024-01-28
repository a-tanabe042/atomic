# ステージ1: ビルド用のベースイメージ
FROM node:18-alpine as builder

# アプリケーションのディレクトリを設定
WORKDIR /app

# 依存関係のファイルをコピー
COPY package.json package-lock.json ./

# 依存関係のインストール
RUN npm install

# アプリケーションのソースコードをコピー
COPY . .

# アプリケーションのビルド
RUN npm run build

# ステージ2: 実行用のベースイメージ
FROM node:18-alpine

WORKDIR /app

# ステージ1からビルドされたファイルをコピー
COPY --from=builder /app/build ./build
COPY --from=builder /app/node_modules ./node_modules

# アプリケーションの開始
CMD ["npm", "start"]

# ポートの公開
EXPOSE 3000
