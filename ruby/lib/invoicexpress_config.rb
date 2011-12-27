require 'yaml'
raw_config = File.read("../config/config.yaml")
APP_CONFIG = YAML.load(raw_config)
