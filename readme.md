# Introduction au gestionnaire de version GIT

Slides : https://slides.com/maximeculea/meetup-wordpress-git
YouTube vidéo : https://www.youtube.com/watch?v=-VFoqwbQSM8

## General git workflow
1. add a file from IDE : `maxime.php`
2. add it to git : <code>git add maxime.php</code> or all files with <code>git add .</code>
3. edit the file then commit changes : <code>git commit -m "my first commit"</code>
4. push them : <code>git commit -m "my first commit"</code>

## Git Conflict
1. create a new branch from master : <code>git checkout -b evol/1</code>
2. edit the file :
```
<!DOCTYPE html>
<html>
<body class="toto">

<h1>My First Heading</h1>
<p>My first paragraph.</p>

</body>
</html>
```
3. push the changes : <code>git push origin evol/1</code>
4. create from master a other one : <code>git checkout -b evol/2</code>
5. edit the file :
```
<!DOCTYPE html>
<html>
<body class="toto titi">

<h1><?php the_title(); ?></h1>
<p>My first paragraph.</p>

</body>
</html>
```
6. push changes : <code>git push origin evol/2</code>
7. we can change branches (content) as we want : <code>git checkout evol/1</code>
8. on server, only get the modifications : <code>git fetch -a</code>
9. to apply the new modifications : <code>git pull -f</code>
10. finally merge the two branches on master :
    - go on master : <code>git checkout master</code>
    - merge branches : <code>git merge evol/1</code> and <code>git merge evol/2</code>
11. It results into a conflict :
    - edit the final modification into the file
    - stage changes : <code>git add .</code>
    - then commit them : <code>git commit -m "Resolved merge conflict by incorporating both suggestions."</code>
