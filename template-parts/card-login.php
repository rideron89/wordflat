<div class="card sidebar">
    <h2>Sign In</h2>
    <form action="<?= get_option('home') . '/wp-login.php' ?>" method="post" id="login-form">
        <fieldset>
            <label for="username">Username</label>
            <input class="error" type="text" name="log" id="username" aria-required="true" required="required" />
        </fieldset>
        <fieldset>
            <label for="password">Password</label>
            <input type="text" name="pwd" id="password" aria-required="true" required="required" />
        </fieldset>
        <p class="form-message error-message">Please fill out all fields.</p>
        <fieldset>
            <input type="hidden" name="redirect_to" value="<?= $_SERVER['PHP_SELF'] ?>" />
            <input class="button-green" type="submit" value="Sign In" />
        </fieldset>
        <p>Don't have an account? <a href="">Sign up!</a></p>
    </form>
</div>