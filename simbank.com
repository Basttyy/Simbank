map $http_upgrade $connection_upgrade {
	default upgrade;
	'' close;
}
server {
	listen 80;
	root /var/www/html/simbank/public;
	index index.php;
	server_name simbank.com;

	location = /index.php {
		#ensure there is no such file named "not_exists"
		#in your "public" directory
		try_files /not_exists @swoole;
	}

	location / {
		try_files $uri $uri/ @swoole;
	}

	location @swoole {
		set $suffix "";

		if ($uri = /index.php) {
			set $suffix ?query_string;
		}

		proxy_http_version 1.1;
		proxy_set_header Host $http_host;
		proxy_set_header Scheme $scheme;
		proxy_set_header SERVER_PORT $server_port;
		proxy_set_header REMOTE_ADDR $remote_addr;
		proxy_set_header X-Forwarded_For $proxy_add_x_forwarded_for;
		proxy_set_header Upgrade $http_upgrade;
		proxy_set_header Connection $connection_upgrade;

		#IF Https
#		proxy_set_header HTTPS "on";

		proxy_pass http://127.0.0.1:8083$suffix;
	}

#	location ~ \.php$ {
#		include snippets/fastcgi-php.conf;
#		fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
#	}

	location ~ /\.ht {
		deny all;
	}

	error_log /var/log/nginx/simbank_error.log;
}
