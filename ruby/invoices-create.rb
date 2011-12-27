require 'uri'
require 'net/https'
require 'ostruct'
require 'rubygems'
require 'lib/invoicexpress_config'

host = [APP_CONFIG["screen_name"], APP_CONFIG["host"]].join(".")
api_key = APP_CONFIG["api_key"]


data = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\
          <invoice>\
            <date>#{Time.now.strftime("%D")}</date>\
            <due_date>#{Time.now.strftime("%D")}</due_date>\
          <client>\
            <name>Bruce Norris</name>\
          </client>\
          <items type=\"array\">\
            <item>\
              <name>Product 1</name>\
              <description>Cleaning product</description>\
              <unit_price>10.0</unit_price>\
              <quantity>1.0</quantity>\
              <unit>unit</unit>\
            </item>\
          </items>\
        </invoice>"


http = Net::HTTP.new(host, 443)
http.use_ssl = true

headers = {
  'Content-Type' => 'application/xml; charset=utf-8',
  'Accept' => 'text/plain' 
}

res = http.post("/invoices.xml?api_key=#{api_key}", data, headers)
case res
when Net::HTTPSuccess, Net::HTTPRedirection
  puts res.body
else
  puts res.to_ary[1]
end