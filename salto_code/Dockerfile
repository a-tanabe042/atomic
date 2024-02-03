# ステージ1: ビルド用のベースイメージ
FROM node:18-alpine as builder

# アプリケーションのディレクトリを設定
WORKDIR /app

# 依存関係のファイルをコピー
COPY package.json package-lock.json ./

# 依存関係のインストール
RUN npm install

# アプリケーションのソースコードと必要なファイルをコピー
COPY . .

# アプリケーションのビルド
RUN npm run build

# ステージ2: 実行用のベースイメージ
FROM node:18-alpine

WORKDIR /app

# ステージ1からビルドされたファイルと必要な設定ファイルをコピー
COPY --from=builder /app/build ./build
COPY --from=builder /app/node_modules ./node_modules
COPY --from=builder /app/package.json ./
COPY --from=builder /app/public ./public
COPY --from=builder /app/src ./src
COPY --from=builder /app/*.config.js ./

# 環境変数ファイルなど、他に必要なファイルがあればここに追加

# アプリケーションの開始
CMD ["npm", "start"]

# ポートの公開
EXPOSE 3000