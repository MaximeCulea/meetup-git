# Introduction au gestionnaire de version GIT

## Git WorkFlow
1. add a file from IDE : maxime.php
2. add it to git : <code>git add maxime.php</code>

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
7. on server, only get the modifications : <code>git fetch -a</code>
8. to apply the new modifications : <code>git pull -f</code>
9. we can change branches (content) as we want : <code>git checkout evol/1</code>
10. finally merge the two branches on master :
10.1 go on master : <code>git checkout master</code>
10.2 merge branches : <code>git merge evol/1</code> and <code>git merge evol/2</code>
