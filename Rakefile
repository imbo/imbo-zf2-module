require 'date'
require 'digest/md5'
require 'fileutils'

basedir  = "."
build    = "#{basedir}/build"
source   = "#{basedir}/src"
tests    = "#{basedir}/tests"

desc "Default task"
task :default => [:prepare, :lint, :installdep, :apidocs, :test]

desc "Run tests"
task :test => [:phpunit]

desc "Clean up and create artifact directories"
task :prepare do
  FileUtils.rm_rf build
  FileUtils.mkdir build

  ["docs", "coverage"].each do |d|
    FileUtils.mkdir "#{build}/#{d}"
  end
end

desc "Check syntax on all php files in the project"
task :lint do
  `git ls-files "*.php"`.split("\n").each do |f|
    begin
      sh %{php -l #{f}}
    rescue Exception
      exit 1
    end
  end
end

desc "Install dependencies"
task :installdep do
  if ENV["TRAVIS"] == "true"
    system "composer -n --no-ansi install --dev --prefer-source"
  else
    Rake::Task["install_composer"].invoke
    system "php -d \"apc.enable_cli=0\" composer.phar -n install --dev --prefer-source"
  end
end

desc "Update dependencies"
task :updatedep do
  Rake::Task["install_composer"].invoke
  system "php -d \"apc.enable_cli=0\" composer.phar -n update --dev --prefer-source"
end

desc "Install/update composer itself"
task :install_composer do
  if File.exists?("composer.phar")
    system "php -d \"apc.enable_cli=0\" composer.phar self-update"
  else
    system "curl -s http://getcomposer.org/installer | php -d \"apc.enable_cli=0\""
  end
end

desc "Generate API documentation"
task :apidocs do
  system "phpdoc -d #{source} -t #{build}/docs --title \"Imbo ZF2 module API docs\""
end

desc "Run PHPUnit tests"
task :phpunit do
  begin
    sh %{vendor/bin/phpunit --verbose --coverage-html build/coverage --coverage-clover build/logs/clover.xml --log-junit build/logs/junit.xml -c #{tests}}
  rescue Exception
    exit 1
  end
end
