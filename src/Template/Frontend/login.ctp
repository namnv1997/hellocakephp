<form class="content-login">
    <div class="form-group div-frontend">
        <label for="exampleInputEmail1">Username</label>
        <input type="text" id="username" class="form-control"
               aria-describedby="emailHelp" placeholder="Username"">
        <span class="error text-danger"></span>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" id="password" class="form-control" placeholder="Password">
        <span class="error text-danger"></span>

    </div>
</form>
<div class="text-center">
    <button class="btn btn-primary" id="btn-login" name="login">Login</button>
</div>
<div class="modal fade bd-example-modal-sm" id="modalLogin" aria-modal="true" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content text-center padding20">
            <span class="glyphicon glyphicon-ok color-gryl" aria-hidden="true"></span>
            <span>Login Successfully</span>
            <p> Back to Home in 3s...</p>
        </div>
    </div>
</div>
