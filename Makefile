#!/usr/bin/make -f
#
# Build website with environment
#
#

WWW_SITE	:= v2.dbwebb.se
WWW_LOCAL	:= local.$(WWW_SITE)
SERVER_ADMIN := mos@$(WWW_SITE)

LOCAL_HTDOCS := $(HOME)/htdocs/$(WWW_SITE)/
ROBOTSTXT	 := robots.txt


#
# Update and publish
#
.PHONY: update
update: codebase-update site-build local-publish



#
# Publish website to local host
#
.PHONY: local-publish
local-publish:
	rsync -av --exclude old --exclude .git --exclude cache --delete "./" $(LOCAL_HTDOCS)
	@[ ! -f $(ROBOTSTXT) ] ||  cp $(ROBOTSTXT) "$(LOCAL_HTDOCS)/htdocs/robots.txt" 



#
# Clear the cache
#
.PHONY: local-cache-clear
local-cache-clear:
	- sudo rm $(LOCAL_HTDOCS)/cache/*/*



#
# Publish website to local host and clear the cache
#
.PHONY: local-publish-clear
local-publish-clear: local-cache-clear local-publish



#
# Update codebase
#
.PHONY: codebase-update
codebase-update:
	git pull
	composer update



#
# Update repo with all submodules
#
.PHONY: submodule-init submodule-update
submodule-init:
	git submodule update --init --recursive 

submodule-update:
	git pull --recurse-submodules && git submodule foreach git pull origin master



#
# Build
#
.PHONY: prepare-build

prepare-build: 
	rm -rf build
	install -d build/css build/lint



#
# less
#
.PHONY: less-update
less-update: less local-publish


.PHONY: less

LESS 			:= theme/style.less
LESS_OPTIONS 	:= --strict-imports --include-path=theme/mos-theme/style/
FONT_AWESOME	:= theme/mos-theme/style/font-awesome/fonts/

less: prepare-build
	lessc $(LESS_OPTIONS) $(LESS) build/css/style.css
	#lessc --clean-css $(LESS_OPTIONS) $(LESS) build/css/style.min.css
	cp build/css/style.css htdocs/css/style.css
	#cp build/css/style.min.css htdocs/css/style.min.css
	
	rsync -av $(FONT_AWESOME) htdocs/fonts/



#
# Lint
#
.PHONY: lint

lint: less
	lessc --lint $(LESS) > build/lint/style.less
	- csslint build/css/style.css > build/lint/style.css
	ls -l build/lint/



#
# Build site from codebase
#
.PHONY: site-build
site-build:
	# Copy Anax images
	#rsync -av vendor/mos/anax/webroot/img/ htdocs/img/

	# Copy from CImage
	install -d htdocs/cimage
	rsync -av vendor/mos/cimage/webroot/imgd.php htdocs/cimage/imgd.php
	rsync -av vendor/mos/cimage/icc/ htdocs/cimage/icc/
	rsync -av vendor/mos/cimage/webroot/img/ htdocs/img/cimage/

	# Copy from mos-theme
	#install -d htdocs/js/mos-theme
	#rsync -av theme/mos-theme/js/ htdocs/js/mos-theme/

	# Make cache parts writable
	install --directory --mode 777 cache/cimage cache/anax
	rsync -av "./cache/" $(LOCAL_HTDOCS)/cache/

	# Sync to virtual host dir
	rsync -av --exclude old --exclude .git --exclude cache/ --delete "./" $(LOCAL_HTDOCS)


#
#
#
.PHONY: production-update
production-update:
	git pull
	bin/setup.bash --sync --clear-content

# Does note update footer in forum, need to remove forum cache to update.



#
# Create a entry in the /etc/hosts
#
.PHONY: etc-hosts
etc-hosts:
	echo "127.0.0.1 $(WWW_LOCAL)" | sudo bash -c 'cat >> /etc/hosts'
	@tail -1 /etc/hosts



#
# Create local directory structure
#
.PHONY: create-local-structure
create-local-structure:
	install --directory $(HOME)/htdocs/$(WWW_SITE)



#
# Create a entry for the virtual host
#
.PHONY: virtual-host

define VIRTUAL_HOST
<VirtualHost *:80>
	Define site $(WWW_SITE)
	ServerAdmin $(SERVER_ADMIN)
	ServerName $${site} 
	ServerAlias www.$${site}
	ServerAlias local.$${site}
	DocumentRoot $(HOME)/htdocs/$${site}/htdocs

	<Directory />
		Options Indexes FollowSymLinks
		AllowOverride All
		Require all granted
		Order allow,deny
		Allow from all
	</Directory>     

	ErrorLog  /home/mos/htdocs/$${site}/error.log
	CustomLog /home/mos/htdocs/$${site}/access.log combined
</VirtualHost>
endef
export VIRTUAL_HOST

virtual-host: 
	echo "$$VIRTUAL_HOST" | sudo bash -c 'cat > /etc/apache2/sites-available/$(WWW_SITE).conf'
	ls -l /etc/apache2/sites-available/$(WWW_SITE).conf
	sudo a2ensite $(WWW_SITE)
	sudo service apache2 reload
