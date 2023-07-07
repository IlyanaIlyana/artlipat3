# ARTLIPAT
#### Video Demo:  <https://youtu.be/tyoERHKC0PA>
#### URL: https://artlipat.ru/online/lend.html
#### Description:

This project is my Final Project for CS50 (2021) and is the third version of the implementation of my idea "low scale software for IP lawyers" because originally, I am Russian/Eurasian Patent Attorney.   

There are a lot of software for management intellectual property (IP) portfolio. However, it looks like every existing service tends to become more and more complex through its life. And it is not easy for a new user to start using any service. Normally some kind of training is necessary, and attorneys can avoid using services in full giving it to paralegals. My idea was to create a pocket software which is as simple as Google calendar but a little bit more powerful and IP oriented. 

My first version included process-oriented approach which I escaped in the second version. The second version included two types of dates (external and internal) which I escaped in this version.  

This, third, version requiers user's terms only (like calendar). 

I develop my project under the slogan: 
>Don't make me think!

And may be some further clarification of the interface can come up in future.  

The only textual input in Artlipat is the name of the case to work on. Tasks to-do are to be chosen from a pre-determined list. Two these input fields can be found on the main page.   

Terms shall also be indicated manually. But this is not necessary (current date is used by default). Some other information about cases can be inputed as well as on other pages of the serice.

The feature of the service is absence of any confidential data in the service database, which allows using it in software-cloud mode. 

In this version of the service the following tasks were solved: 

- using handmade capture to protect bot registration (from which the second version suffered); 

- using checkboxes for completed tasks (visually like Trello or Wunderlist); checking checkbox results in updating db and crossing out the task name, both with [jQuery functions](https://api.jquery.com/jQuery.post/); 

- since 60 tasks are in the pre-determined list, to facilitate the search of the task in the list I used dinamic search with jQuery plugin [Chosen](https://harvesthq.github.io/chosen/); 

- since input of the case name envisages both new case and already existed case name, I used [jQuery Autocomplete function](https://jqueryui.com/autocomplete/#remote); 

- the service is made bilingual; for this purpose I had to solve two tasks: how to change "static content" (titles on html pages) and how to use appropriate pre-determined list of e.g.tasks from database. For "statis content" I used a special "translation" table with column names "title_lung" where lung-part is amended by php. For predetermined lists I have chosen to use different tables with names table_lung and identical column names; at the moment only two languages are supported (en and ru), however theoretically not only langiuages but contries should be separated and lists of different content might have to be used for different countires; with my structure of db if new language/country is added, one field should be added in "static content", and five tables specific for this language/country (in one of them id column should be treated carefully for correct work of js file).

The project is realized with PHP and MySQL; 

I tried to separate business logic and layout and make the structure as close as possible to mvc pattern. 

As for php, the new feature for me were: 

- using php if condition in html tags to manipulate their style property and checkbox status: 

``` 
<div class="panel panel-default"
 <?php if ($row_casedata['not_closed_case']==0):?>
  style='color:red'
 <?php endif; ?>
>
``` 

- passing array through method POST (to have a list of checked checkboxes) 
```
<form action="done.php" method="post">
 while($row = mysqli_fetch_assoc($result)){         
 ?>
 <tr>
  <td>
   <div class="checkboxes">
	<input class="active" 
	<?php if ($row['status'] == 0): ?>checked="checked"<?php endif; ?> 
	name="checkbox_done[]"
	value="<?php echo $row['id']?>" 
	type="checkbox" />
   </div>
  </td>
 </tr>
}
</form>

//Array ( [checkbox_done] => Array ([0] => 61 [1] => 62 [2] => 63 [3] => 57 [4] => 58 ))
```

in jQuery the new features for me were: 

- [Chosen](https://harvesthq.github.io/chosen/); 

- [Autocomplete](https://jqueryui.com/autocomplete/#remote) (which was a real headache); 

My plan is to add "reports" to the service. Firstly, the hours and money spent to each task. But the service must still be simple.

If I finish CS50 WebDevelopement, the next step may be to rewrite the service on Python or some other kind of object-oriented language with mvc pattern. 

The task which is not still solved is SQL injections. Even though user-input is very limited in the service, it has not been checked in full for this attack's resistance. 

For layout the following template was used:
###### Theme Name: NiceAdmin
###### Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
###### Theme Author: BootstrapMade
###### Theme Author URL: https://bootstrapmade.com 
