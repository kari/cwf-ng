# Some development tasks for CWF site
require "rake/clean"

desc "Clean view cache"
task :clean_view_cache do
  rm_f FileList["app/tmp/cache/views/*"]
end

desc "Clean image thumbnail cache"
task :clean_thumbnail_cache do
  rm_f FileList["app/webroot/img/cache/*"]
end

task :clean => :clean_view_cache
task :clobber => :clean_thumbnail_cache

task :default => :clean_view_cache


