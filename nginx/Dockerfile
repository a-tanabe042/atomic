# ステージ1: Certbotのインストール
FROM nginx:alpine

# Nginxの設定ファイルをコピー
COPY nginx.conf /etc/nginx/nginx.conf
COPY conf.d/default.conf /etc/nginx/conf.d/default.conf


EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]

