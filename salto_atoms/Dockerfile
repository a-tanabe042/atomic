# ステージ1: ビルド用のベースイメージ
FROM node:18 AS build

WORKDIR /app

# 依存関係のファイルをコピー
COPY package.json package-lock.json ./

# 依存関係のインストール
RUN npm ci

# アプリケーションのソースコードをコピー
COPY . .

# アプリケーションのビルド
RUN npm run build

# ステージ2: Nginxを使用して静的ファイルを提供
FROM nginx:alpine

# Nginxの設定ファイルをコピー
COPY nginx/nginx.conf /etc/nginx/nginx.conf
COPY nginx/default.conf /etc/nginx/conf.d/default.conf
COPY nginx/api.conf /etc/nginx/conf.d/api.conf

# Reactアプリのビルド成果物をコピー
COPY --from=build /app/build /usr/share/nginx/html

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
