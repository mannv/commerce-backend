## install docker

tham khảo: https://docs.docker.com/install/linux/docker-ce/ubuntu/

```
sudo apt update
sudo apt-get install apt-transport-https ca-certificates curl gnupg-agent software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo apt-key fingerprint 0EBFCD88
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
sudo apt-get update
sudo apt-get install docker-ce docker-ce-cli containerd.io
```

kiểm tra đã cài đặt thành công hay chưa

```
docker --version
```

## install docker-compose

tham khảo: https://docs.docker.com/compose/install/

```
sudo curl -L "https://github.com/docker/compose/releases/download/1.25.3/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```

sau khi cài docker, các lệnh thao tác thêm terminal đều cần phải thêm **sudo** đằng trước rất khó chịu và bực mình, để tài khoản thường có thể thao tác được với lệnh **docker** thì chạy 2 lệnh bên dưới

**B1:** 
```
sudo groupadd docker
sudo usermod -aG docker $USER
```

**B2:**
Logout và đăng nhập lại máy tính để sử dụng bình thường



```
        Name                       Command               State                    Ports                  
---------------------------------------------------------------------------------------------------------
training_mysql_1        docker-entrypoint.sh mysqld      Up      0.0.0.0:3306->3306/tcp, 33060/tcp       
training_nginx_1        nginx -g daemon off;             Up      0.0.0.0:443->443/tcp, 0.0.0.0:80->80/tcp
training_nuxtjs_1       docker-entrypoint.sh node        Up      3000/tcp                                
training_php-fpm_1      /bin/bash /opt/startup.sh        Up      9000/tcp, 9001/tcp                      
training_phpmyadmin_1   /docker-entrypoint.sh apac ...   Up      0.0.0.0:8080->80/tcp                    
training_redis_1        docker-entrypoint.sh redis ...   Up      0.0.0.0:3679->6379/tcp
```

|Services        |Description                    |
|----------------|-------------------------------|
|mysql      |nơi lưu trữ database của hệ thống  |
|nginx      |webserver                          |
|nuxtjs     |nơi thực thi code nuxtjs           |
|php-fpm    |compibe PHP                        |
|phpmyadmin |giao diện quản trị dữ liệu         |
|redis      |cache services                     |
