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
# Nginxを使用する
FROM nginx:alpine

# Nginxの設定ファイルをコピー
COPY /nginx.conf /etc/nginx/nginx.conf

# ビルドされたファイルをNginxのサーブディレクトリにコピー
COPY --from=builder /app/build /usr/share/nginx/html

# 必要ならば他の設定ファイルや環境変数ファイルをここにコピー

# ポート3000を公開
EXPOSE 3000

# Nginxをフォアグラウンドで実行
CMD ["nginx", "-g", "daemon off;"]
