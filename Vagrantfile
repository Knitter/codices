# -*- mode: ruby -*-
# vi: set ft=ruby :

# Please don't change it unless you know what you're doing.
Vagrant.configure(2) do |config|
  # config.vm.box = "debian/jessie64"
  config.vm.box = "debian-webbase"
  config.vm.network "forwarded_port", guest: 80, host: 8080

  # Apenas para MS Windows
  config.vm.synced_folder ".", "/vagrant", type: "virtualbox"

  config.vm.provider "virtualbox" do |v|
    v.customize ["modifyvm", :id, "--memory", "1024", "--vram", "64"]
  end
  
  # config.vm.provision "shell", path: "vagrant-bootstrap.sh"
end
