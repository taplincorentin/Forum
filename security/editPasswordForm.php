<form action="/index.php?ctrl=security&action=changePassword&id=<?=$id?>" method="post">
        <div> 
            <p>
                <label>password</label>
                <input type='password' name='password' placeholder="at least 8 characters">
            </p>
            <p>
                <label>confirm password</label>
                <input type='password' name='password2'>
            </p>
            <p>
                <input type='submit' name='submit' value="change password">
            </p>
        </div>
</form>