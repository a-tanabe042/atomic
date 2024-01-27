FROM jenkins/jenkins:lts-jdk11

USER root

# XorgとOpenboxのインストール
RUN apt-get update && apt-get install -y \
    xorg \
    openbox

# Docker CLIと関連パッケージのインストール
RUN apt-get install -y apt-transport-https \
       ca-certificates curl gnupg2 \
       software-properties-common && \
    curl -fsSL https://download.docker.com/linux/debian/gpg | apt-key add - && \
    apt-key fingerprint 0EBFCD88 && \
    add-apt-repository \
       "deb [arch=amd64] https://download.docker.com/linux/debian \
       $(lsb_release -cs) stable" && \
    apt-get update && apt-get install -y docker-ce-cli

# Jenkinsプラグインのインストール
RUN jenkins-plugin-cli --plugins "blueocean:1.25.0 docker-workflow:1.26"

USER jenkins
