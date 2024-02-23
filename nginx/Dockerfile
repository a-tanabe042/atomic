# ステージ1: Certbotのインストール
FROM nginx:alpine

# Certbotの依存関係をインストール
RUN apk add --update --no-cache certbot certbot-nginx

# Nginxの設定ファイルをコピー
COPY nginx.conf /etc/nginx/nginx.conf
COPY conf.d/default.conf /etc/nginx/conf.d/default.conf

#Certbotの設定（後述のスクリプト参照）
COPY renew-certs.sh /etc/periodic/daily/renew-certs
RUN chmod +x /etc/periodic/daily/renew-certs

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]
