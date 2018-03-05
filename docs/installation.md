# INSTALLATION

## TABLE OF CONTENTS
- [Before you begin](#before-you-begin)
- [Manual installation](#manual-installation)
    - [Requirements](#requirements)
    - [Setup application](#setup-application)
    - [Configure your web server](#configure-your-web-server)

- [Docker installation](#docker-installation)
- [Vagrant installation](#vagrant-installation)
- [Single domain installtion](#single-domain-installation)
- [Demo users](#demo-users)
- [Important-notes](#important-notes)

## Before you begin
1. If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

2. Install NPM or Yarn to build frontend scripts
- [NPM] (https://docs.npmjs.com/getting-started/installing-node)
- Yarn (https://yarnpkg.com/en/docs/install)

### Get source code
#### Download sources
https://github.com/trntv/yii2-starter-kit/archive/master.zip

#### Or clone repository manually
```
git clone https://github.com/trntv/yii2-starter-kit.git
```
#### Install composer dependencies
```
composer install
```

### Get source code via Composer
You can install this application template with `composer` using the following command:

```
composer create-project --prefer-dist --stability=dev trntv/yii2-starter-kit
```

## Manual installation

### REQUIREMENTS
The minimum requirement by this application template that your Web server supports PHP 5.6.0.
Required PHP extensions:
- intl
- gd
- mcrypt
- com_dotnet (for Windows)

### Setup application
1. Copy `.env.dist` to `.env` in the project root.
2. Adjust settings in `.env` file
	- Set debug mode and your current environment
	```
	YII_DEBUG   = true
	YII_ENV     = dev
	```
	- Set DB configuration
	```
	DB_DSN           = mysql:host=127.0.0.1;port=3306;dbname=yii2-starter-kit
	DB_USERNAME      = user
	DB_PASSWORD      = password
	```

	- Set application canonical urls
	```
	FRONTEND_HOST_INFO    = http://yii2-starter-kit.localhost
	BACKEND_HOST_INFO     = http://backend.yii2-starter-kit.localhost
	STORAGE_HOST_INFP     = http://storage.yii2-starter-kit.localhost
	```

3. Run in command line
```
php console/yii app/setup
npm install
npm run build
```

### Configure your web server
- Copy `docker/vhost.conf` to your nginx config directory
- Change it to fit your environment

## Docker installation
1. Install [docker](https://docs.docker.com/engine/installation/) and [docker-compose](https://docs.docker.com/compose/install/) to your system
2. Add ``127.0.0.1 yii2-starter-kit.localhost backend.yii2-starter-kit.localhost storage.yii2-starter-kit.localhost``* to your `/etc/hosts` file
3. Copy `.env.dist` to `.env` in the project root
4. Run `docker-compose up -d`
5. Install composer dependencies `docker-compose exec app composer install`
6. Install npm dependencies `docker-compose run --rm webpacker npm install`
7. Build assets `docker-compose run --rm webpacker npm run build`
6. Setup application with `docker-compose exec app php console/yii app/setup --interactive=0`
7. That's all - your application is accessible on http://yii2-starter-kit.localhost

 * - docker host IP address may vary on Windows and MacOS systems
 
*PS* Also you can use bash inside application container. To do so run `docker-compose exec app bash`

### Docker FAQ
1. How do i run yii console commands from outside a container?

`docker-compose exec app console/yii help`

`docker-compose exec app console/yii migrate`

`docker-compose exec app console/yii rbac-migrate`

2. How to connect to the application database with my workbench, navicat etc?
MySQL is available on `yii2-starter-kit.localhost`, port `3306`. User - `root`, password - `root`

## Vagrant installation
If you want, you can use bundled Vagrant instead of installing app to your local machine.

1. Install [Vagrant](https://www.vagrantup.com/)
2. Copy files from `docs/vagrant-files` to application root
3. Copy `./vagrant/vagrant.yml.dist` to `./vagrant/vagrant.yml`
4. Create GitHub [personal API token](https://github.com/blog/1509-personal-api-tokens)
5. Edit values as desired including adding the GitHub personal API token to `./vagrant/vagrant.yml`
6. Run:
```
vagrant plugin install vagrant-hostmanager
vagrant up
```
That`s all. After provision application will be accessible on http://yii2-starter-kit.localhost

## Demo data
### Demo Users
```
Login: webmaster
Password: webmaster

Login: manager
Password: manager

Login: user
Password: user
```

## Single domain installation
1. Setup application
Adjust settings in `.env` file

```
FRONTEND_BASE_URL   = /
BACKEND_BASE_URL    = /backend/web
STORAGE_BASE_URL    = /storage/web
```

2. Adjust settings in `backend/config/web.php` file
```
    ...
    'components'=>[
        ...
        'request' => [
            'baseUrl' => '/admin',
        ...
```
3. Adjust settings in `frontend/config/web.php` file
```
    ...
    'components'=>[
        ...
        'request' => [
            'baseUrl' => '',
        ...
```

4. Configure your web server
Example of single domain config for nginx can be found [here](https://github.com/trntv/yii2-starter-kit/blob/master/docker/nginx/vhost_single_domain.conf)

## Important notes
- There is a VirtualBox bug related to sendfile that can lead to corrupted files, if not turned-off
Uncomment this in your nginx config if you are using Vagrant:
```sendfile off;```
