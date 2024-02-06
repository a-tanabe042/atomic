# Nginxのベースイメージを使用
FROM nginx:alpine

RUN chown -R nginx:nginx /usr/share/nginx/html

# ポート80を公開
EXPOSE 80

# Nginxを起動
CMD ["nginx", "-g", "daemon off;"]
