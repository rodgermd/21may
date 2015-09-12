set :application, "21may"
set :domain,      "ec2-52-27-153-196.us-west-2.compute.amazonaws.com"
set :deploy_to,   "/var/www/21may"
set :app_path,    "app"

set :repository,  "git@github.com:rodgermd/21may.git"
set :scm,         :git

set :model_manager, "doctrine"

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server
role :db,         domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  10

set :keep_releases,   10
set :shared_children, [app_path + "/logs", app_path + "/cache/sessions", web_path + "/uploads"]
set :shared_files,    ["app/config/parameters.yml", "app/config/parameters.private.yml"]
set :use_composer,    true
set :update_vendors,  false
set :use_sudo,        true
set :user,            "ubuntu"

set :writable_dirs,     ["app/cache", "app/logs", "web", "web/media"]
set :webserver_user,    "www-data"
set :permission_method, :acl

set :dump_assetic_assets, true
set :interactive_mode, false

logger.level = Logger::MAX_LEVEL

after "deploy", "deploy:set_permissions"