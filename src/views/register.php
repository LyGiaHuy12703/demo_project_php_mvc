<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/assets/css/register.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="./storeRegister" method="post" class="form">
            <h2>Register</h2>
            <label for="">name</label>
            <input class="input" type="text" name="name" placeholder="name" required>
            <label for="">username</label>
            <input class="input" type="text" name="email" placeholder="username" required>
            <label for="">password</label>
            <input class="input" type="password" name="password" placeholder="Password" required>
            <button class="button" type="submit">Register</button>
        </form>
    </div>
</body>
</html>