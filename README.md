# ARTLIPAT
#### Video Demo:  <URL HERE>
#### URL: https://artlipat.online/lend.html
#### Description:

This project is my Final Project for CS50 (2021) and is the third version of the implementation of my idea "low scale software for IP lawyers" because originally, I am Russian/Eurasian Patent Attorney.   

There are a lot of software for management intellectual property (IP) portfolio. However, it looks like every existing service tends to become more and more complex through its life. And it is not easy for a new user to start using any service. Normally some kind of training is necessary, and attorneys can avoid using services in full giving it to paralegals. My idea was to create a pocket software which is as simple as Google calendar but a little bit more powerful and IP oriented. 

My first version included process-oriented approach which I escaped in the second version. The second version included two types of dates (external and internal) which I escaped in this version.  

This, third, version requiers user's terms only (like calendar). 

I develop my project under the slogan: "do not make me think!". And may be some further clarification of the interface can come up in future.  

The only textual input in the Artlipat is the name of the case to work on. Tasks to-do are to be chosen from a pre-determined list. Two these input fields can be found on the main page.   

Terms shall also be indicated manually. But this is not necessary (current date is used by default). Some other information about cases can be inputed as well as on other pages of the serice.

The feature of the service is absence of any confidential data in the service database, which allows using it in software-cloud mode. 

In this version of the service the following tasks were solved: 

- using handmade capture to protect bot registration (from which the second version suffered); 

- using checkboxes for completed tasks (visually like Trello or Wunderlist); checking checkbox results in updating db (MySQL) and crossing over the task name, both with jQuery functions; 

- since 60 tasks are in the pre-determined list, to facilitate the search of the task in the list I used dinamic search with jQuery function "chosen"; 

- since input of the case name envisages both new case and already existed case name, I used jQuery Autocomplete function; 

- the service is made bilingual; for this purpose, I had to solve two tasks: how to change "static content" (titles on html pages) and how to use appropriate pre-determined list of tasks from db. For "statis content" I used a special "translation" table with column names "title_lung" where lung-part is amended by php. For predetermined lists ....; 

The project is realized with PHP and MySQL; 

I tried to separate business logic and layout and make the structure as close as possible to mvc pattern. 

As for php, the new feature for me were: 

- using php if condition in html tags to manipulate their style property and checkbox status. 

- passing array through method POST (to have a list of checked checkboxes) 

in jQuery the new feature for me were: 

- change; 

- autocomplete (which was a real headache); 

My plan is to add "reports" to the service. Firstly, the hours and money spent to each task. But the service must still be simple.

If I finish CS50  WebDevelopement, the next step may be to rewrite the service on python or some other kind of object-oriented language with mvc pattern. 

The task which is not still solved is SQL injections. Even though user-input is very limited in the service, it has not been checked in full for this attack's resistance. 

for layout the following template was used:
Theme Name: NiceAdmin
Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
Theme Author: BootstrapMade
Theme Author URL: https://bootstrapmade.com 