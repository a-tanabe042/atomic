FROM jenkins/jenkins:2.426.3-jdk17
USER root

# Install required packages
RUN apt-get update && apt-get install -y lsb-release

# Install Docker CLI and related packages
RUN curl -fsSLo /usr/share/keyrings/docker-archive-keyring.asc \
  https://download.docker.com/linux/debian/gpg
RUN echo "deb [arch=$(dpkg --print-architecture) \
  signed-by=/usr/share/keyrings/docker-archive-keyring.asc] \
  https://download.docker.com/linux/debian \
  $(lsb_release -cs) stable" > /etc/apt/sources.list.d/docker.list
RUN apt-get update && apt-get install -y docker-ce-cli

# Install Docker Compose
RUN curl -L \
  "https://github.com/docker/compose/releases/download/1.25.3/docker-compose-$(uname -s)-$(uname -m)" \
  -o /usr/local/bin/docker-compose \
  && chmod +x /usr/local/bin/docker-compose

# Copy SSH key to the Jenkins user's home directory
COPY jenkins-key.pem /var/jenkins_home/.ssh/id_rsa
RUN chown jenkins:jenkins /var/jenkins_home/.ssh/id_rsa
RUN chmod 600 /var/jenkins_home/.ssh/id_rsa

USER jenkins

# Install Jenkins plugins
RUN jenkins-plugin-cli --plugins "blueocean docker-workflow"
