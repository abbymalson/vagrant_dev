Given(/^I am on the Welcome Page$/) do
Capybara.current_driver = :selenium
visit('http://192.168.33.50:3000')
end

Then(/^I should see the title "(.*?)"$/) do |message|
fail unless page.has_title? message
end
Then(/^wait$/) do |message|
sleep(5000)
end