<form action="signup.php" method="POST" autocomplete="off">
    <div class="form form-signup">
        <div class="title">Welcome</div>
        <div class="subtitle">Let's create your account!</div>
        <div class="input-container ic1">
            <input name="idfirst" id="firstname" class="input" type="text" placeholder=" " />
            <div class="cut"></div>
            <label for="firstname" class="placeholder">First name</label>
        </div>
        <div class="input-container ic2">
            <input name="idlast" id="lastname" class="input" type="text" placeholder=" " />
            <div class="cut"></div>
            <label for="lastname" class="placeholder">Last name</label>
        </div>
        <div class="input-container ic2">
            <input name="idemail" id="email" class="input" type="email" placeholder=" " />
            <div class="cut cut-short"></div>
            <label for="email" class="placeholder">Email</label>
        </div>
        <div class="input-container ic2">
            <input name="idpass" id="password" class="input" type="password" placeholder=" " />
            <div class="cut cut-short"></div>
            <label for="password" class="placeholder">password</label>
        </div>
        <button type="submit" class="submit">submit</button>
    </div>
</form>